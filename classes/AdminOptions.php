<?php
namespace Kavro;

if ( ! defined( 'ABSPATH' ) ) { exit; }

class AdminOptions {
    protected $unique;
    protected $args;
    protected $sections;
    protected $flat_sections = array();

    public function __construct( $unique, $args, $sections ) {
        $this->unique = sanitize_key( $unique );
        $this->args = $args;
        $this->sections = $this->prepare_sections( $sections );
        $this->flat_sections = $this->flatten_sections( $this->sections );
        add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
        add_action( 'admin_init', array( $this, 'register_setting' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_assets' ) );
    }

    public function register_setting() {
        register_setting( $this->unique . '_group', $this->unique, array( 'sanitize_callback' => array( Fields::class, 'sanitize' ) ) );
    }

    public function add_admin_menu() {
        $callback = array( $this, 'render_page' );
        if ( 'submenu' === ( $this->args['menu_type'] ?? 'menu' ) ) {
            add_submenu_page( $this->args['menu_parent'], $this->args['menu_title'], $this->args['menu_title'], $this->args['menu_capability'], $this->args['menu_slug'], $callback );
        } else {
            add_menu_page( $this->args['menu_title'], $this->args['menu_title'], $this->args['menu_capability'], $this->args['menu_slug'], $callback, $this->args['menu_icon'], $this->args['menu_position'] );
        }
    }

    public function enqueue_assets( $hook ) {
        if ( false === strpos( $hook, $this->args['menu_slug'] ) ) { return; }
        wp_enqueue_media();
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_style( 'kavro-admin', KAVRO_URL . 'assets/css/admin.css', array(), KAVRO_VERSION );
        wp_enqueue_script( 'kavro-admin', KAVRO_URL . 'assets/js/admin.js', array( 'jquery', 'wp-color-picker', 'jquery-ui-sortable' ), KAVRO_VERSION, true );
    }

    protected function prepare_sections( $sections, $depth = 0, $path = '' ) {
        $prepared = array();
        foreach ( $sections as $index => $section ) {
            $base_slug = isset( $section['id'] ) ? sanitize_key( $section['id'] ) : sanitize_title( $section['title'] ?? 'section-' . $index );
            $slug = $path ? $path . '/' . $base_slug : $base_slug;
            $section['_slug'] = $slug;
            $section['_depth'] = $depth;
            if ( ! empty( $section['children'] ) && is_array( $section['children'] ) ) {
                $section['children'] = $this->prepare_sections( $section['children'], $depth + 1, $slug );
            }
            $prepared[] = $section;
        }
        return $prepared;
    }

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

    protected function render_nav( $sections ) {
        echo '<ul class="kavro-nav-list">';
        foreach ( $sections as $section ) {
            $slug = esc_attr( $section['_slug'] );
            $has_children = ! empty( $section['children'] );
            $depth = isset( $section['_depth'] ) ? absint( $section['_depth'] ) : 0;
            echo '<li class="kavro-nav-item' . ( $has_children ? ' has-children' : '' ) . '" data-kavro-depth="' . esc_attr( $depth ) . '">';
            echo '<div class="kavro-nav-row">';
            echo '<a href="#' . $slug . '" data-kavro-tab="' . $slug . '"><span>' . esc_html( $section['title'] ?? 'Untitled' ) . '</span></a>';
            if ( $has_children ) {
                echo '<button type="button" class="kavro-nav-toggle" aria-expanded="false" aria-label="Toggle ' . esc_attr( $section['title'] ?? 'section' ) . '"><span></span></button>';
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

    public function render_page() {
        $options = get_option( $this->unique, array() );
        echo '<div class="wrap kavro-wrap"><div class="kavro-shell">';
        echo '<aside class="kavro-sidebar"><div class="kavro-brand"><div class="kavro-logo">K</div><div><strong>' . esc_html( $this->args['menu_title'] ) . '</strong><small>Options Framework</small></div></div>';
        $this->render_nav( $this->sections );
        echo '</aside>';
        echo '<main class="kavro-main"><form method="post" action="options.php">';
        settings_fields( $this->unique . '_group' );
        echo '<div class="kavro-topbar"><div><h1>' . esc_html( $this->args['menu_title'] ) . '</h1><p>Configure your theme or plugin settings.</p></div><button type="submit" class="button button-primary kavro-save">Save Changes</button></div>';
        foreach ( $this->flat_sections as $slug => $section ) {
            echo '<section class="kavro-section" data-kavro-section="' . esc_attr( $slug ) . '"><div class="kavro-card">';
            echo '<h2>' . esc_html( $section['title'] ?? 'Untitled' ) . '</h2>';
            if ( ! empty( $section['subtitle'] ) ) { echo '<p class="kavro-section-desc">' . esc_html( $section['subtitle'] ) . '</p>'; }
            if ( ! empty( $section['fields'] ) ) {
                foreach ( $section['fields'] as $field ) {
                    $field_id = isset( $field['id'] ) ? sanitize_key( $field['id'] ) : '';
                    $value = $field_id && isset( $options[ $field_id ] ) ? $options[ $field_id ] : ( $field['default'] ?? '' );
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
