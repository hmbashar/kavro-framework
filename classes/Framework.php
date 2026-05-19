<?php
/**
 * Main Kavro framework registry.
 *
 * The Framework class stores developer-defined option containers and sections,
 * then instantiates the correct module controllers after WordPress initializes.
 *
 * @package Kavro\Core
 */

namespace Kavro;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Framework
 *
 * Static public API target behind the global KAVRO facade.
 */
final class Framework {
    /** @var array Registered option/metabox/customizer containers. */
    protected static $containers = array();

    /** @var array Section definitions grouped by option container ID. */
    protected static $sections = array();

    /** @var array Runtime module instances keyed by option container ID. */
    protected static $instances = array();

    /**
     * Register the late initialization hook.
     *
     * @return void
     */
    public static function boot() {
        add_action( 'init', array( __CLASS__, 'init_instances' ), 20 );
    }

    /**
     * Register a new admin option panel.
     *
     * @param string $id   Unique option container ID.
     * @param array  $args Menu/screen arguments.
     * @return void
     */
    public static function createOptions( $id, $args = array() ) {
        self::$containers[ sanitize_key( $id ) ] = wp_parse_args(
            $args,
            array(
                'menu_title'      => 'Kavro',
                'menu_slug'       => sanitize_key( $id ),
                'menu_type'       => 'menu',
                'menu_parent'     => 'options-general.php',
                'menu_capability' => 'manage_options',
                'menu_icon'       => 'dashicons-admin-customizer',
                'menu_position'   => null,
                'show_bar_menu'   => false,
                'theme'           => 'premium',
                'footer_credit'   => 'Kavro Framework © Md Abul Bashar · hmbashar.com · facebook.com/hmbashar',
            )
        );
    }

    /**
     * Add a section to an option container.
     *
     * Child sections should be nested through the `children` key. Kavro does not
     * require or use a `parent` key, which keeps section data portable.
     *
     * @param string $id      Option container ID.
     * @param array  $section Section configuration.
     * @return void
     */
    public static function createSection( $id, $section ) {
        $id = sanitize_key( $id );

        if ( ! isset( self::$sections[ $id ] ) ) {
            self::$sections[ $id ] = array();
        }

        self::$sections[ $id ][] = $section;
    }

    /**
     * Register a WordPress Customizer option panel.
     *
     * Customizer containers share the same section registration API as admin
     * options and metaboxes. Child sections are flattened because WordPress
     * Customizer does not support nested sections natively.
     *
     * @param string $id   Unique container ID.
     * @param array  $args Customizer arguments.
     * @return void
     */
    public static function createCustomizeOptions( $id, $args = array() ) {
        self::$containers[ sanitize_key( $id ) ] = wp_parse_args(
            array_merge( $args, array( '_module' => 'customizer' ) ),
            array(
                'title'       => 'Kavro Customizer',
                'description' => 'Customizer settings registered with Kavro Framework.',
                'priority'    => 160,
            )
        );
    }


    /**
     * Register taxonomy term option fields.
     *
     * @param string $id   Unique taxonomy option container ID.
     * @param array  $args Taxonomy option arguments.
     * @return void
     */
    public static function createTaxonomyOptions( $id, $args = array() ) {
        self::$containers[ sanitize_key( $id ) ] = wp_parse_args(
            array_merge( $args, array( '_module' => 'taxonomy' ) ),
            array(
                'taxonomy' => array( 'category' ),
            )
        );
    }


    /**
     * Register user profile option fields.
     *
     * @param string $id   Unique profile option container ID.
     * @param array  $args Profile option arguments.
     * @return void
     */
    public static function createProfileOptions( $id, $args = array() ) {
        self::$containers[ sanitize_key( $id ) ] = wp_parse_args(
            array_merge( $args, array( '_module' => 'profile' ) ),
            array(
                'title' => 'Kavro Profile Options',
                'roles' => array(),
            )
        );
    }



    /**
     * Register nav menu item option fields.
     *
     * @param string $id   Unique nav menu option container ID.
     * @param array  $args Nav menu option arguments.
     * @return void
     */
    public static function createNavMenuOptions( $id, $args = array() ) {
        self::$containers[ sanitize_key( $id ) ] = wp_parse_args(
            array_merge( $args, array( '_module' => 'nav_menu' ) ),
            array(
                'title'      => 'Kavro Menu Options',
                'capability' => 'edit_theme_options',
            )
        );
    }


    /**
     * Register a WordPress widget powered by Kavro fields.
     *
     * @param string $id   Unique widget ID.
     * @param array  $args Widget registration arguments.
     * @return void
     */
    public static function createWidgetOptions( $id, $args = array() ) {
        self::$containers[ sanitize_key( $id ) ] = wp_parse_args(
            array_merge( $args, array( '_module' => 'widget' ) ),
            array(
                'title'       => 'Kavro Widget',
                'description' => 'A widget powered by Kavro Framework fields.',
                'classname'   => 'kavro-widget',
            )
        );
    }


    /**
     * Register comment edit screen option fields.
     *
     * @param string $id   Unique comment option container ID.
     * @param array  $args Comment option arguments.
     * @return void
     */
    public static function createCommentOptions( $id, $args = array() ) {
        self::$containers[ sanitize_key( $id ) ] = wp_parse_args(
            array_merge( $args, array( '_module' => 'comment' ) ),
            array(
                'title'      => 'Kavro Comment Options',
                'capability' => 'edit_comment',
            )
        );
    }



    /**
     * Register a shortcode generator and runtime shortcode.
     *
     * @param string $id   Unique shortcode container ID.
     * @param array  $args Shortcode arguments.
     * @return void
     */
    public static function createShortcode( $id, $args = array() ) {
        self::$containers[ sanitize_key( $id ) ] = wp_parse_args(
            array_merge( $args, array( '_module' => 'shortcode' ) ),
            array(
                'title'       => 'Kavro Shortcode',
                'tag'         => sanitize_key( $id ),
                'description' => 'A shortcode registered with Kavro Framework.',
                'capability'  => 'manage_options',
                'menu_parent' => 'tools.php',
                'render'      => null,
            )
        );
    }

    /**
     * Placeholder API for future metabox support.
     *
     * @param string $id   Unique metabox ID.
     * @param array  $args Metabox arguments.
     * @return void
     */
    public static function createMetabox( $id, $args = array() ) {
        self::$containers[ sanitize_key( $id ) ] = wp_parse_args(
            array_merge( $args, array( '_module' => 'metabox' ) ),
            array(
                'title'     => 'Kavro Metabox',
                'post_type' => array( 'post', 'page' ),
                'context'   => 'normal',
                'priority'  => 'default',
            )
        );
    }

    /**
     * Instantiate registered modules after developers have defined containers.
     *
     * @return void
     */
    public static function init_instances() {
        foreach ( self::$containers as $id => $args ) {
            if ( isset( self::$instances[ $id ] ) ) {
                continue;
            }

            if ( isset( $args['_module'] ) && 'metabox' === $args['_module'] ) {
                self::$instances[ $id ] = new Metabox( $id, $args, isset( self::$sections[ $id ] ) ? self::$sections[ $id ] : array() );
                continue;
            }

            if ( isset( $args['_module'] ) && 'customizer' === $args['_module'] ) {
                self::$instances[ $id ] = new Customizer( $id, $args, isset( self::$sections[ $id ] ) ? self::$sections[ $id ] : array() );
                continue;
            }


            if ( isset( $args['_module'] ) && 'profile' === $args['_module'] ) {
                self::$instances[ $id ] = new Profile( $id, $args, isset( self::$sections[ $id ] ) ? self::$sections[ $id ] : array() );
                continue;
            }





            if ( isset( $args['_module'] ) && 'widget' === $args['_module'] ) {
                $widget = new Widget( $id, $args, isset( self::$sections[ $id ] ) ? self::$sections[ $id ] : array() );
                $widget->register();
                self::$instances[ $id ] = $widget;
                continue;
            }


            if ( isset( $args['_module'] ) && 'comment' === $args['_module'] ) {
                self::$instances[ $id ] = new Comment( $id, $args, isset( self::$sections[ $id ] ) ? self::$sections[ $id ] : array() );
                continue;
            }

            if ( isset( $args['_module'] ) && 'shortcode' === $args['_module'] ) {
                self::$instances[ $id ] = new Shortcode( $id, $args, isset( self::$sections[ $id ] ) ? self::$sections[ $id ] : array() );
                continue;
            }

            if ( isset( $args['_module'] ) && 'nav_menu' === $args['_module'] ) {
                self::$instances[ $id ] = new NavMenu( $id, $args, isset( self::$sections[ $id ] ) ? self::$sections[ $id ] : array() );
                continue;
            }

            if ( isset( $args['_module'] ) && 'taxonomy' === $args['_module'] ) {
                self::$instances[ $id ] = new Taxonomy( $id, $args, isset( self::$sections[ $id ] ) ? self::$sections[ $id ] : array() );
                continue;
            }

            self::$instances[ $id ] = new AdminOptions( $id, $args, isset( self::$sections[ $id ] ) ? self::$sections[ $id ] : array() );
        }
    }
}
