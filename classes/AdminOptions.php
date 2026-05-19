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
            array( 'sanitize_callback' => array( Fields::class, 'sanitize' ) )
        );
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

        wp_enqueue_media();
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_style( 'dashicons' );
        wp_enqueue_style( 'kavro-admin', KAVRO_URL . 'assets/css/admin.css', array( 'wp-color-picker' ), KAVRO_VERSION );
        wp_enqueue_script( 'kavro-admin', KAVRO_URL . 'assets/js/admin.js', array( 'jquery', 'wp-color-picker', 'jquery-ui-sortable' ), KAVRO_VERSION, true );
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
        if ( ! current_user_can( $this->args['menu_capability'] ) ) {
            wp_die( esc_html__( 'You do not have permission to export these settings.', 'kavro-framework' ) );
        }

        check_admin_referer( 'kavro_export_' . $this->unique );

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
        if ( ! current_user_can( $this->args['menu_capability'] ) ) {
            wp_die( esc_html__( 'You do not have permission to import these settings.', 'kavro-framework' ) );
        }

        check_admin_referer( 'kavro_import_' . $this->unique );

        $raw = '';

        if ( ! empty( $_FILES['kavro_import_file']['tmp_name'] ) ) {
            $raw = file_get_contents( $_FILES['kavro_import_file']['tmp_name'] ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
        }

        if ( empty( $raw ) && isset( $_POST['kavro_import_json'] ) ) {
            $raw = wp_unslash( $_POST['kavro_import_json'] );
        }

        $decoded = json_decode( $raw, true );
        $status  = 'invalid';

        if ( is_array( $decoded ) ) {
            $settings = isset( $decoded['settings'] ) && is_array( $decoded['settings'] ) ? $decoded['settings'] : $decoded;
            $settings = Fields::sanitize( $settings );
            update_option( $this->unique, $settings );
            $status = 'imported';
        }

        $redirect = add_query_arg(
            array(
                'page'         => $this->args['menu_slug'],
                'kavro_status' => $status,
            ),
            admin_url( 'admin.php' )
        );

        wp_safe_redirect( $redirect . '#__kavro_tools' );
        exit;
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

        echo '<main class="kavro-main"><form method="post" action="options.php">';
        settings_fields( $this->unique . '_group' );
        echo '<input type="hidden" name="kavro_active_section" class="kavro-active-section" value="">';

        echo '<div class="kavro-topbar"><div><h1>' . esc_html( $this->args['menu_title'] ) . '</h1><p>Configure your theme or plugin settings with a premium Kavro dashboard.</p></div><div class="kavro-actions"><button type="submit" class="button button-primary kavro-save">Save Changes</button><span class="kavro-save-status" aria-live="polite">Saving...</span></div></div>';

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

        echo '<div class="kavro-footer"><span>' . esc_html( $this->args['footer_credit'] ) . '</span><button type="submit" class="button button-primary kavro-save">Save Changes</button></div>';
        echo '</form>';
        $this->render_tools_section();
        echo '</main></div></div>';
    }
}
