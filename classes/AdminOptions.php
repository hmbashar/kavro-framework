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
     * Render the complete Kavro settings page.
     *
     * @return void
     */
    public function render_page() {
        $options = get_option( $this->unique, array() );

        echo '<div class="wrap kavro-wrap"><div class="kavro-shell">';
        echo '<aside class="kavro-sidebar"><div class="kavro-brand"><div class="kavro-logo">K</div><div><strong>' . esc_html( $this->args['menu_title'] ) . '</strong><small>Options Framework</small></div></div>';
        $this->render_nav( $this->sections );
        echo '</aside>';

        echo '<main class="kavro-main"><form method="post" action="options.php">';
        settings_fields( $this->unique . '_group' );

        echo '<div class="kavro-topbar"><div><h1>' . esc_html( $this->args['menu_title'] ) . '</h1><p>Configure your theme or plugin settings with a premium Kavro dashboard.</p></div><button type="submit" class="button button-primary kavro-save">Save Changes</button></div>';

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
        echo '</form></main></div></div>';
    }
}
