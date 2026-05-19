<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

final class KAVRO {
    protected static $containers = array();
    protected static $sections   = array();
    protected static $instances  = array();

    public static function boot() {
        add_action( 'init', array( __CLASS__, 'init_instances' ), 20 );
    }

    public static function createOptions( $id, $args = array() ) {
        self::$containers[ $id ] = wp_parse_args( $args, array(
            'menu_title'      => 'Kavro',
            'menu_slug'       => $id,
            'menu_type'       => 'menu',
            'menu_parent'     => 'options-general.php',
            'menu_capability' => 'manage_options',
            'menu_icon'       => 'dashicons-admin-generic',
            'menu_position'   => null,
            'show_bar_menu'   => false,
            'theme'           => 'premium',
            'footer_credit'   => 'Built with Kavro Framework',
        ) );
    }

    public static function createSection( $id, $section ) {
        if ( ! isset( self::$sections[ $id ] ) ) {
            self::$sections[ $id ] = array();
        }
        self::$sections[ $id ][] = $section;
    }

    public static function createCustomizeOptions( $id, $args = array() ) {
        // Reserved for Pro/customizer module. Kept now for forward-compatible public API.
        self::createOptions( $id, array_merge( $args, array( '_module' => 'customizer' ) ) );
    }

    public static function createMetabox( $id, $args = array() ) {
        // Reserved for Pro/metabox module. Kept now for forward-compatible public API.
        self::$containers[ $id ] = array_merge( $args, array( '_module' => 'metabox' ) );
    }

    public static function init_instances() {
        foreach ( self::$containers as $id => $args ) {
            if ( isset( self::$instances[ $id ] ) || ( isset( $args['_module'] ) && 'metabox' === $args['_module'] ) ) {
                continue;
            }
            self::$instances[ $id ] = new Kavro_Admin_Options( $id, $args, isset( self::$sections[ $id ] ) ? self::$sections[ $id ] : array() );
        }
    }
}
