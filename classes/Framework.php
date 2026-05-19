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
                'footer_credit'   => 'Built with Kavro Framework by <a href="https://hmbashar.com" target="_blank">Md Abul Bashar</a>',
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
     * Placeholder API for future Customizer support.
     *
     * @param string $id   Unique container ID.
     * @param array  $args Customizer arguments.
     * @return void
     */
    public static function createCustomizeOptions( $id, $args = array() ) {
        self::createOptions( $id, array_merge( $args, array( '_module' => 'customizer' ) ) );
    }

    /**
     * Placeholder API for future metabox support.
     *
     * @param string $id   Unique metabox ID.
     * @param array  $args Metabox arguments.
     * @return void
     */
    public static function createMetabox( $id, $args = array() ) {
        self::$containers[ sanitize_key( $id ) ] = array_merge( $args, array( '_module' => 'metabox' ) );
    }

    /**
     * Instantiate registered modules after developers have defined containers.
     *
     * @return void
     */
    public static function init_instances() {
        foreach ( self::$containers as $id => $args ) {
            if ( isset( self::$instances[ $id ] ) || ( isset( $args['_module'] ) && 'metabox' === $args['_module'] ) ) {
                continue;
            }

            self::$instances[ $id ] = new AdminOptions( $id, $args, isset( self::$sections[ $id ] ) ? self::$sections[ $id ] : array() );
        }
    }
}
