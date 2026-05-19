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
        Extensions::boot();
        add_action( 'init', array( __CLASS__, 'init_instances' ), 20 );
    }


    /**
     * Register or override a Kavro module controller.
     *
     * This is the public bridge used by Kavro Pro and add-ons. It allows new
     * modules to be connected to the same container/section registry without
     * modifying Kavro core.
     *
     * @param string $module Module key.
     * @param string $class  Fully-qualified controller class.
     * @param array  $args   Optional module metadata.
     * @return void
     */
    public static function registerModule( $module, $class, $args = array() ) {
        Extensions::register_module( $module, $class, $args );
    }

    /**
     * Return all registered Kavro modules.
     *
     * @return array
     */
    public static function getModules() {
        return Extensions::modules();
    }

    /**
     * Determine if a module is available.
     *
     * @param string $module Module key.
     * @return bool
     */
    public static function isModuleAvailable( $module ) {
        return Extensions::is_module_available( $module );
    }

    /**
     * Check whether a Pro companion build is active.
     *
     * @return bool
     */
    public static function isPro() {
        return Extensions::is_pro_active();
    }

    /**
     * Return the current edition slug: free or pro.
     *
     * @return string
     */
    public static function edition() {
        return Extensions::edition();
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
     * Module creation is now registry-driven. This keeps the free plugin stable
     * while allowing Kavro Pro or third-party add-ons to override controller
     * classes through `KAVRO::registerModule()` or the `kavro/register_modules`
     * action.
     *
     * @return void
     */
    public static function init_instances() {
        foreach ( self::$containers as $id => $args ) {
            if ( isset( self::$instances[ $id ] ) ) {
                continue;
            }

            $module = isset( $args['_module'] ) ? sanitize_key( $args['_module'] ) : 'options';

            if ( ! Extensions::is_module_available( $module ) ) {
                /**
                 * Fires when a registered container requests an unavailable module.
                 *
                 * @param string $module Module key.
                 * @param string $id     Container ID.
                 * @param array  $args   Container arguments.
                 */
                do_action( 'kavro/module_unavailable', $module, $id, $args );
                continue;
            }

            $class    = Extensions::module_class( $module );
            $sections = isset( self::$sections[ $id ] ) ? self::$sections[ $id ] : array();

            if ( ! $class || ! class_exists( $class ) ) {
                do_action( 'kavro/module_class_missing', $module, $class, $id, $args );
                continue;
            }

            /**
             * Fires before a module controller is created.
             *
             * @param string $module   Module key.
             * @param string $id       Container ID.
             * @param array  $args     Container arguments.
             * @param array  $sections Registered sections.
             */
            do_action( 'kavro/before_module_init', $module, $id, $args, $sections );

            self::$instances[ $id ] = new $class( $id, $args, $sections );

            if ( 'widget' === $module && method_exists( self::$instances[ $id ], 'register' ) ) {
                self::$instances[ $id ]->register();
            }

            /**
             * Fires after a module controller has been created.
             *
             * @param object $instance Module controller instance.
             * @param string $module   Module key.
             * @param string $id       Container ID.
             */
            do_action( 'kavro/after_module_init', self::$instances[ $id ], $module, $id );
        }
    }
}
