<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

class Kavro_Admin_Options {
    protected $unique;
    protected $args;
    protected $sections;
    protected $flat_sections = array();

    public function __construct( $unique, $args, $sections ) {
        $this->unique   = sanitize_key( $unique );
        $this->args     = $args;
        $this->sections = $sections;
        $this->flat_sections = $this->flatten_sections( $sections );
        add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
        add_action( 'admin_init', array( $this, 'register_setting' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_assets' ) );
    }

    public function register_setting() {
        register_setting( $this->unique . '_group', $this->unique, array( 'sanitize_callback' => array( 'Kavro_Fields', 'sanitize' ) ) );
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
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_style( 'kavro-admin', KAVRO_URL . 'assets/css/admin.css', array(), KAVRO_VERSION );
        wp_enqueue_script( 'kavro-admin', KAVRO_URL . 'assets/js/admin.js', array( 'jquery', 'wp-color-picker' ), KAVRO_VERSION, true );
    }

    protected function flatten_sections( $sections, $depth = 0, $parent = '' ) {
        $flat = array();
        foreach ( $sections as $section ) {
            $slug = isset( $section['id'] ) ? sanitize_key( $section['id'] ) : sanitize_title( $section['title'] ?? uniqid( 'section-' ) );
            $section['_slug']   = $parent ? $parent . '/' . $slug : $slug;
            $section['_depth']  = $depth;
            $flat[ $section['_slug'] ] = $section;
            if ( ! empty( $section['children'] ) && is_array( $section['children'] ) ) {
                $flat = array_merge( $flat, $this->flatten_sections( $section['children'], $depth + 1, $section['_slug'] ) );
            }
        }
        return $flat;
    }

    protected function render_nav( $sections ) {
        echo '<ul class="kavro-nav-list">';
        foreach ( $sections as $section ) {
            $slug = esc_attr( $this->section_slug( $section ) );
            $has_children = ! empty( $section['children'] );
            echo '<li class="kavro-nav-item' . ( $has_children ? ' has-children' : '' ) . '">';
            echo '<a href="#' . $slug . '" data-kavro-tab="' . $slug . '"><span>' . esc_html( $section['title'] ?? 'Untitled' ) . '</span>' . ( $has_children ? '<b>⌄</b>' : '' ) . '</a>';
            if ( $has_children ) {
                $this->render_nav( $section['children'] );
            }
            echo '</li>';
        }
        echo '</ul>';
    }

    protected function section_slug( $section ) {
        if ( isset( $section['_slug'] ) ) { return $section['_slug']; }
        $slug = isset( $section['id'] ) ? sanitize_key( $section['id'] ) : sanitize_title( $section['title'] ?? '' );
        foreach ( $this->flat_sections as $key => $flat ) {
            if ( ( $flat['id'] ?? '' ) === ( $section['id'] ?? null ) || ( $flat['title'] ?? '' ) === ( $section['title'] ?? null ) ) { return $key; }
        }
        return $slug;
    }

    public function render_page() {
        $options = get_option( $this->unique, array() );
        echo '<div class="wrap kavro-wrap"><div class="kavro-shell">';
        echo '<aside class="kavro-sidebar"><div class="kavro-brand"><div class="kavro-logo">K</div><div><strong>' . esc_html( $this->args['menu_title'] ) . '</strong><small>Kavro Framework</small></div></div>';
        $this->render_nav( $this->sections );
        echo '</aside>';
        echo '<main class="kavro-main"><form method="post" action="options.php">';
        settings_fields( $this->unique . '_group' );
        echo '<div class="kavro-topbar"><div><h1>' . esc_html( $this->args['menu_title'] ) . '</h1><p>Modern options panel powered by Kavro.</p></div><button type="submit" class="button button-primary kavro-save">Save Changes</button></div>';
        foreach ( $this->flat_sections as $slug => $section ) {
            echo '<section class="kavro-section" data-kavro-section="' . esc_attr( $slug ) . '"><div class="kavro-card"><h2>' . esc_html( $section['title'] ?? 'Untitled' ) . '</h2>';
            if ( ! empty( $section['subtitle'] ) ) { echo '<p class="kavro-section-desc">' . wp_kses_post( $section['subtitle'] ) . '</p>'; }
            foreach ( (array) ( $section['fields'] ?? array() ) as $field ) {
                $fid = $field['id'] ?? '';
                Kavro_Fields::render( $field, $fid && isset( $options[ $fid ] ) ? $options[ $fid ] : ( $field['default'] ?? '' ), $this->unique );
            }
            echo '</div></section>';
        }
        echo '<div class="kavro-footer"><button type="submit" class="button button-primary kavro-save">Save Changes</button><span>' . esc_html( $this->args['footer_credit'] ) . '</span></div>';
        echo '</form></main></div></div>';
    }
}
