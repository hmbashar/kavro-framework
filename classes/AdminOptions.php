<?php
/**
 * Admin option panel controller.
 *
 * This class registers the WordPress admin menu, enqueues admin assets, prepares
 * nested section data, and renders the Kavro settings dashboard.
 *
 * @package Kavro\Core
 */

namespace Kavro;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * AdminOptions
 *
 * Builds one complete admin options screen from a Kavro option container.
 */
class AdminOptions {
    /** @var string Unique option container key. */
    protected $unique;

    /** @var array Admin menu and screen arguments. */
    protected $args;

    /** @var array Nested section tree. */
    protected $sections;

    /** @var array Flattened section list used for rendering content panels. */
    protected $flat_sections = array();

    /**
     * Register hooks for this options screen.
     *
     * @param string $unique   Unique option container key.
     * @param array  $args     Admin menu/screen arguments.
     * @param array  $sections Nested section configuration.
     */
    public function __construct( $unique, $args, $sections ) {
        $this->unique        = sanitize_key( $unique );
        $this->args          = $args;
        $this->sections      = $this->prepare_sections( $sections );
        $this->flat_sections = $this->flatten_sections( $this->sections );

        add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
        add_action( 'admin_init', array( $this, 'register_setting' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_assets' ) );
        add_action( 'admin_post_kavro_export_' . $this->unique, array( $this, 'export_settings' ) );
        add_action( 'admin_post_kavro_import_' . $this->unique, array( $this, 'import_settings' ) );
        add_action( 'admin_post_kavro_reset_' . $this->unique, array( $this, 'reset_settings' ) );
        add_action( 'wp_ajax_kavro_ajax_save_' . $this->unique, array( $this, 'ajax_save_settings' ) );
        add_action( 'wp_ajax_kavro_ajax_reset_' . $this->unique, array( $this, 'ajax_reset_settings' ) );
    }

    /**
     * Register the WordPress option used by this Kavro screen.
     *
     * @return void
     */
    public function register_setting() {
        register_setting(
            $this->unique . '_group',
            $this->unique,
            array( 'sanitize_callback' => array( $this, 'sanitize_options' ) )
        );
    }


    /**
     * Sanitize options for this screen using its registered field schema.
     *
     * @param mixed $values Raw submitted option payload.
     * @return array
     */
    public function sanitize_options( $values ) {
        $values = is_array( $values ) ? $values : array();
        return Fields::sanitize_values( $values, $this->sections );
    }

    /**
     * Add the parent WordPress admin page.
     *
     * Deep child sections are rendered inside Kavro's own dashboard navigation,
     * because WordPress core admin menus only support one submenu level reliably.
     *
     * @return void
     */
    public function add_admin_menu() {
        $callback = array( $this, 'render_page' );

        if ( 'submenu' === ( $this->args['menu_type'] ?? 'menu' ) ) {
            add_submenu_page(
                $this->args['menu_parent'],
                $this->args['menu_title'],
                $this->args['menu_title'],
                $this->args['menu_capability'],
                $this->args['menu_slug'],
                $callback
            );
        } else {
            add_menu_page(
                $this->args['menu_title'],
                $this->args['menu_title'],
                $this->args['menu_capability'],
                $this->args['menu_slug'],
                $callback,
                $this->args['menu_icon'],
                $this->args['menu_position']
            );
        }
    }

    /**
     * Enqueue Kavro assets only on the current Kavro admin screen.
     *
     * @param string $hook Current admin page hook suffix.
     * @return void
     */
    public function enqueue_assets( $hook ) {
        if ( false === strpos( $hook, $this->args['menu_slug'] ) ) {
            return;
        }

        Assets::enqueue(
            $this->sections,
            array(
                'unique'       => $this->unique,
                'saveAction'   => 'kavro_ajax_save_' . $this->unique,
                'resetAction'  => 'kavro_ajax_reset_' . $this->unique,
                'nonce'        => wp_create_nonce( 'kavro_ajax_' . $this->unique ),
                'confirmReset' => __( 'Reset all saved Kavro settings for this panel?', 'kavro-framework' ),
                'messages'     => array(
                    'saving'    => __( 'Saving...', 'kavro-framework' ),
                    'saved'     => __( 'Saved', 'kavro-framework' ),
                    'resetting' => __( 'Resetting...', 'kavro-framework' ),
                    'reset'     => __( 'Reset complete', 'kavro-framework' ),
                    'error'     => __( 'Something went wrong. Please try again.', 'kavro-framework' ),
                ),
            )
        );
    }

    /**
     * Prepare nested sections by adding internal slugs and depth metadata.
     *
     * @param array  $sections Section tree.
     * @param int    $depth    Current nesting depth.
     * @param string $path     Parent slug path.
     * @return array
     */
    protected function prepare_sections( $sections, $depth = 0, $path = '' ) {
        $prepared = array();

        foreach ( $sections as $index => $section ) {
            $base_slug = isset( $section['id'] ) ? sanitize_key( $section['id'] ) : sanitize_title( $section['title'] ?? 'section-' . $index );
            $slug      = $path ? $path . '/' . $base_slug : $base_slug;

            $section['_slug']  = $slug;
            $section['_depth'] = $depth;

            if ( ! empty( $section['children'] ) && is_array( $section['children'] ) ) {
                $section['children'] = $this->prepare_sections( $section['children'], $depth + 1, $slug );
            }

            $prepared[] = $section;
        }

        return $prepared;
    }

    /**
     * Convert the nested section tree into a flat lookup array.
     *
     * @param array $sections Section tree.
     * @return array
     */
    protected function flatten_sections( $sections ) {
        $flat = array();

        foreach ( $sections as $section ) {
            $flat[ $section['_slug'] ] = $section;

            if ( ! empty( $section['children'] ) && is_array( $section['children'] ) ) {
                $flat = array_merge( $flat, $this->flatten_sections( $section['children'] ) );
            }
        }

        return $flat;
    }

    /**
     * Render the recursive sidebar navigation.
     *
     * @param array $sections Section tree.
     * @return void
     */
    protected function render_nav( $sections ) {
        echo '<ul class="kavro-nav-list">';

        foreach ( $sections as $section ) {
            $slug         = esc_attr( $section['_slug'] );
            $has_children = ! empty( $section['children'] );
            $depth        = isset( $section['_depth'] ) ? absint( $section['_depth'] ) : 0;
            $title        = $section['title'] ?? 'Untitled';

            echo '<li class="kavro-nav-item' . ( $has_children ? ' has-children' : '' ) . '" data-kavro-depth="' . esc_attr( $depth ) . '">';
            echo '<div class="kavro-nav-row">';
            echo '<a href="#' . $slug . '" data-kavro-tab="' . $slug . '"><span>' . esc_html( $title ) . '</span></a>';

            if ( $has_children ) {
                echo '<button type="button" class="kavro-nav-toggle" aria-expanded="false" aria-label="Toggle ' . esc_attr( $title ) . '"><span></span></button>';
            }

            echo '</div>';

            if ( $has_children ) {
                echo '<div class="kavro-nav-children">';
                $this->render_nav( $section['children'] );
                echo '</div>';
            }

            echo '</li>';
        }

        echo '</ul>';
    }

    /**
     * Export the current option array as a downloadable JSON file.
     *
     * The export endpoint is intentionally handled through admin-post.php so it
     * can verify capabilities and nonces before streaming the JSON response.
     *
     * @return void
     */
    public function export_settings() {
        if ( ! Security::can( $this->args['menu_capability'] ) ) {
            Security::wp_die_permission( __( 'You do not have permission to export these settings.', 'kavro-framework' ) );
        }

        if ( ! Security::verify_nonce_from_request( $_REQUEST, '_wpnonce', 'kavro_export_' . $this->unique ) ) {
            Security::wp_die_nonce();
        }

        $payload = array(
            'generator'  => 'Kavro Framework',
            'version'    => defined( 'KAVRO_VERSION' ) ? KAVRO_VERSION : '1.0.0',
            'option_id'  => $this->unique,
            'exported'   => gmdate( 'c' ),
            'settings'   => get_option( $this->unique, array() ),
        );

        nocache_headers();
        header( 'Content-Type: application/json; charset=utf-8' );
        header( 'Content-Disposition: attachment; filename="' . sanitize_file_name( $this->unique . '-settings.json' ) . '"' );
        echo wp_json_encode( $payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES );
        exit;
    }

    /**
     * Import settings from a Kavro JSON payload or a raw option-array JSON value.
     *
     * @return void
     */
    public function import_settings() {
        if ( ! Security::can( $this->args['menu_capability'] ) ) {
            Security::wp_die_permission( __( 'You do not have permission to import these settings.', 'kavro-framework' ) );
        }

        if ( ! Security::verify_nonce_from_request( $_REQUEST, '_wpnonce', 'kavro_import_' . $this->unique ) ) {
            Security::wp_die_nonce();
        }

        $raw = '';

        if ( ! empty( $_FILES['kavro_import_file']['tmp_name'] ) ) {
            $upload_check = Security::validate_import_upload( $_FILES['kavro_import_file'] );

            if ( is_wp_error( $upload_check ) ) {
                $this->redirect_after_import( $upload_check->get_error_code() );
            }

            $raw = file_get_contents( $_FILES['kavro_import_file']['tmp_name'] ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
        }

        if ( empty( $raw ) && isset( $_POST['kavro_import_json'] ) ) {
            $raw = wp_unslash( $_POST['kavro_import_json'] );
        }

        $decoded = json_decode( $raw, true );
        $status  = 'invalid';

        if ( is_array( $decoded ) ) {
            $settings = isset( $decoded['settings'] ) && is_array( $decoded['settings'] ) ? $decoded['settings'] : $decoded;
            $settings = Fields::sanitize_values( $settings, $this->sections );
            update_option( $this->unique, $settings );
            $status = 'imported';
        }

        $this->redirect_after_import( $status );
    }

    /**
     * Redirect back to the import/export tools panel after an import attempt.
     *
     * @param string $status Import result status.
     * @return never
     */
    protected function redirect_after_import( $status ) {
        $redirect = Security::admin_page_url(
            $this->args['menu_slug'],
            array( 'kavro_status' => sanitize_key( $status ) )
        );

        wp_safe_redirect( $redirect . '#__kavro_tools' );
        exit;
    }


    /**
     * Reset this Kavro option container to an empty/default state.
     *
     * This endpoint is triggered from the dashboard topbar. It removes the saved
     * option payload, then redirects back to the same active Kavro section so the
     * developer can continue testing without losing their place in the UI.
     *
     * @return void
     */
    public function reset_settings() {
        if ( ! Security::can( $this->args['menu_capability'] ) ) {
            Security::wp_die_permission( __( 'You do not have permission to reset these settings.', 'kavro-framework' ) );
        }

        if ( ! Security::verify_nonce_from_request( $_POST, 'kavro_reset_nonce', 'kavro_reset_' . $this->unique ) ) {
            Security::wp_die_nonce( __( 'Reset verification failed. Please try again.', 'kavro-framework' ) );
        }

        delete_option( $this->unique );

        $active = isset( $_POST['kavro_active_section'] ) ? sanitize_text_field( wp_unslash( $_POST['kavro_active_section'] ) ) : '';
        $redirect = Security::admin_page_url(
            $this->args['menu_slug'],
            array(
                'kavro_status'  => 'reset',
                'kavro_section' => $active,
            )
        );

        wp_safe_redirect( $redirect );
        exit;
    }


    /**
     * Verify AJAX capability and nonce checks for this option screen.
     *
     * This method keeps non-reload saves as strict as the regular WordPress
     * Settings API fallback: users must have the configured capability and must
     * send the screen-specific Kavro nonce generated for this option container.
     *
     * @return void
     */
    protected function verify_ajax_request() {
        if ( ! Security::can( $this->args['menu_capability'] ) ) {
            Security::ajax_permission_error( __( 'You do not have permission to update these settings.', 'kavro-framework' ) );
        }

        $nonce = isset( $_POST['kavro_ajax_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['kavro_ajax_nonce'] ) ) : '';

        if ( ! wp_verify_nonce( $nonce, 'kavro_ajax_' . $this->unique ) ) {
            Security::ajax_nonce_error();
        }
    }

    /**
     * Save option values without reloading the admin page.
     *
     * The normal Settings API form remains in place as a no-JavaScript fallback.
     * This AJAX path reuses the same Kavro field schema sanitizer before writing
     * to the WordPress options table.
     *
     * @return void
     */
    public function ajax_save_settings() {
        $this->verify_ajax_request();

        $raw_values = isset( $_POST[ $this->unique ] ) ? wp_unslash( $_POST[ $this->unique ] ) : array(); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
        $raw_values = is_array( $raw_values ) ? $raw_values : array();
        $values     = Fields::sanitize_values( $raw_values, $this->sections );

        update_option( $this->unique, $values );

        wp_send_json_success(
            array(
                'message' => __( 'Settings saved successfully.', 'kavro-framework' ),
                'section' => isset( $_POST['kavro_active_section'] ) ? sanitize_text_field( wp_unslash( $_POST['kavro_active_section'] ) ) : '',
            )
        );
    }

    /**
     * Reset option values without reloading the admin page.
     *
     * @return void
     */
    public function ajax_reset_settings() {
        $this->verify_ajax_request();
        delete_option( $this->unique );

        wp_send_json_success(
            array(
                'message' => __( 'Settings reset successfully.', 'kavro-framework' ),
                'section' => isset( $_POST['kavro_active_section'] ) ? sanitize_text_field( wp_unslash( $_POST['kavro_active_section'] ) ) : '',
            )
        );
    }

    /**
     * Render the import/export tools panel.
     *
     * @return void
     */
    protected function render_tools_section() {
        $status = isset( $_GET['kavro_status'] ) ? sanitize_key( wp_unslash( $_GET['kavro_status'] ) ) : '';

        echo '<section class="kavro-section" data-kavro-section="__kavro_tools"><div class="kavro-card kavro-tools-card">';
        echo '<h2>' . esc_html__( 'Import / Export', 'kavro-framework' ) . '</h2>';
        echo '<p class="kavro-section-desc">' . esc_html__( 'Move settings between environments or keep a safe backup of your current option payload.', 'kavro-framework' ) . '</p>';

        if ( 'imported' === $status ) {
            echo '<div class="kavro-notice kavro-notice-success">' . esc_html__( 'Settings imported successfully.', 'kavro-framework' ) . '</div>';
        } elseif ( 'invalid' === $status ) {
            echo '<div class="kavro-notice kavro-notice-error">' . esc_html__( 'Import failed. Please provide valid JSON.', 'kavro-framework' ) . '</div>';
        } elseif ( in_array( $status, array( 'kavro_upload_error', 'kavro_upload_too_large', 'kavro_upload_type', 'kavro_upload_missing' ), true ) ) {
            echo '<div class="kavro-notice kavro-notice-error">' . esc_html__( 'Import failed. Please upload a valid JSON file under the allowed size limit.', 'kavro-framework' ) . '</div>';
        }

        echo '<div class="kavro-tools-grid">';

        echo '<form class="kavro-tool-box" method="post" action="' . esc_url( admin_url( 'admin-post.php' ) ) . '">';
        echo '<input type="hidden" name="action" value="kavro_export_' . esc_attr( $this->unique ) . '">';
        wp_nonce_field( 'kavro_export_' . $this->unique );
        echo '<h3>' . esc_html__( 'Export Settings', 'kavro-framework' ) . '</h3>';
        echo '<p>' . esc_html__( 'Download the current settings as a portable JSON backup file.', 'kavro-framework' ) . '</p>';
        echo '<button type="submit" class="button button-primary kavro-save kavro-tool-button">' . esc_html__( 'Download Export File', 'kavro-framework' ) . '</button>';
        echo '</form>';

        echo '<form class="kavro-tool-box" method="post" enctype="multipart/form-data" action="' . esc_url( admin_url( 'admin-post.php' ) ) . '">';
        echo '<input type="hidden" name="action" value="kavro_import_' . esc_attr( $this->unique ) . '">';
        wp_nonce_field( 'kavro_import_' . $this->unique );
        echo '<h3>' . esc_html__( 'Import Settings', 'kavro-framework' ) . '</h3>';
        echo '<p>' . esc_html__( 'Upload an export file or paste JSON below. Importing replaces the current option values.', 'kavro-framework' ) . '</p>';
        echo '<input type="file" name="kavro_import_file" accept="application/json,.json" class="kavro-import-file">';
        echo '<textarea name="kavro_import_json" rows="8" placeholder="' . esc_attr__( 'Paste Kavro JSON here...', 'kavro-framework' ) . '"></textarea>';
        echo '<button type="submit" class="button button-primary kavro-save kavro-tool-button">' . esc_html__( 'Import Settings', 'kavro-framework' ) . '</button>';
        echo '</form>';

        echo '</div></div></section>';
    }

    /**
     * Render the complete Kavro settings page.
     *
     * @return void
     */
    public function render_page() {
        $options = get_option( $this->unique, array() );

        echo '<div class="wrap kavro-wrap"><div class="kavro-shell">';
        echo '<aside class="kavro-sidebar"><div class="kavro-brand"><div class="kavro-logo">K</div><div class="kavro-brand-copy"><strong>' . esc_html( $this->args['menu_title'] ) . '</strong><small>Options Framework</small><span class="kavro-version-badge">v' . esc_html( KAVRO_VERSION ) . '</span></div></div>';
        $this->render_nav( $this->sections );
        echo '<ul class="kavro-nav-list kavro-nav-tools"><li class="kavro-nav-item"><div class="kavro-nav-row"><a href="#__kavro_tools" data-kavro-tab="__kavro_tools"><span>' . esc_html__( 'Import / Export', 'kavro-framework' ) . '</span></a></div></li></ul>';
        echo '</aside>';

        echo '<main class="kavro-main"><form class="kavro-options-form" method="post" action="options.php" data-kavro-ajax="1">';
        settings_fields( $this->unique . '_group' );
        echo '<input type="hidden" name="kavro_active_section" class="kavro-active-section" value="">';
        echo '<input type="hidden" name="kavro_ajax_nonce" value="' . esc_attr( wp_create_nonce( 'kavro_ajax_' . $this->unique ) ) . '">';
        echo '<input type="hidden" name="kavro_reset_nonce" value="' . esc_attr( wp_create_nonce( 'kavro_reset_' . $this->unique ) ) . '">';

        echo '<div class="kavro-topbar"><div><h1>' . esc_html( $this->args['menu_title'] ) . '</h1><p>Configure your theme or plugin settings with a premium Kavro dashboard.</p></div><div class="kavro-actions"><button type="submit" name="action" value="kavro_reset_' . esc_attr( $this->unique ) . '" formmethod="post" formaction="' . esc_url( admin_url( 'admin-post.php' ) ) . '" class="button kavro-reset">Reset</button><button type="submit" class="button button-primary kavro-save">Save Changes</button><span class="kavro-save-status" aria-live="polite">Saving...</span></div></div>';

        foreach ( $this->flat_sections as $slug => $section ) {
            echo '<section class="kavro-section" data-kavro-section="' . esc_attr( $slug ) . '"><div class="kavro-card">';
            echo '<h2>' . esc_html( $section['title'] ?? 'Untitled' ) . '</h2>';

            if ( ! empty( $section['subtitle'] ) ) {
                echo '<p class="kavro-section-desc">' . esc_html( $section['subtitle'] ) . '</p>';
            }

            if ( ! empty( $section['fields'] ) ) {
                foreach ( $section['fields'] as $field ) {
                    $field_id = isset( $field['id'] ) ? sanitize_key( $field['id'] ) : '';
                    $value    = $field_id && isset( $options[ $field_id ] ) ? $options[ $field_id ] : ( $field['default'] ?? '' );

                    Fields::render( $field, $value, $this->unique );
                }
            } else {
                echo '<div class="kavro-empty">No fields have been added to this section yet.</div>';
            }

            echo '</div></section>';
        }

        echo '<div class="kavro-footer"><span>' . esc_html( $this->args['footer_credit'] ) . '</span><div class="kavro-actions"><button type="submit" name="action" value="kavro_reset_' . esc_attr( $this->unique ) . '" formmethod="post" formaction="' . esc_url( admin_url( 'admin-post.php' ) ) . '" class="button kavro-reset">Reset</button><button type="submit" class="button button-primary kavro-save">Save Changes</button></div></div>';
        echo '</form>';
        $this->render_tools_section();
        echo '</main></div></div>';
    }
}
