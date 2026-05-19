<?php
namespace Kavro;

if ( ! defined( 'ABSPATH' ) ) { exit; }

final class Framework {
    protected static $containers = array();
    protected static $sections = array();
    protected static $instances = array();

    public static function boot() {
        add_action( 'init', array( __CLASS__, 'init_instances' ), 20 );
    }

    public static function createOptions( $id, $args = array() ) {
        self::$containers[ sanitize_key( $id ) ] = wp_parse_args( $args, array(
            'menu_title'      => 'Kavro',
            'menu_slug'       => sanitize_key( $id ),
            'menu_type'       => 'menu',
            'menu_parent'     => 'options-general.php',
            'menu_capability' => 'manage_options',
            'menu_icon'       => 'dashicons-admin-customizer',
            'menu_position'   => null,
            'show_bar_menu'   => false,
            'theme'           => 'premium',
            'footer_credit'   => 'Built with Kavro Framework',
        ) );
    }

    public static function createSection( $id, $section ) {
        $id = sanitize_key( $id );
        if ( ! isset( self::$sections[ $id ] ) ) { self::$sections[ $id ] = array(); }
        self::$sections[ $id ][] = $section;
    }

    public static function createCustomizeOptions( $id, $args = array() ) {
        self::createOptions( $id, array_merge( $args, array( '_module' => 'customizer' ) ) );
    }

    public static function createMetabox( $id, $args = array() ) {
        self::$containers[ sanitize_key( $id ) ] = array_merge( $args, array( '_module' => 'metabox' ) );
    }

    public static function init_instances() {
        foreach ( self::$containers as $id => $args ) {
            if ( isset( self::$instances[ $id ] ) || ( isset( $args['_module'] ) && 'metabox' === $args['_module'] ) ) { continue; }
            self::$instances[ $id ] = new AdminOptions( $id, $args, isset( self::$sections[ $id ] ) ? self::$sections[ $id ] : array() );
        }
    }
}
