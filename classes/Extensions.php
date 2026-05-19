<?php
/**
 * Kavro module and edition registry.
 *
 * This class is intentionally small and hook-driven. Kavro Free can ship a
 * stable core while Kavro Pro, third-party add-ons, or a theme can register
 * additional modules/classes without editing the framework source files.
 *
 * @package Kavro\Core
 */

namespace Kavro;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Extensions
 *
 * Stores module metadata and exposes WordPress filters/actions for Pro builds.
 */
final class Extensions {
    /**
     * Registered module definitions.
     *
     * @var array<string,array<string,mixed>>
     */
    protected static $modules = array();

    /**
     * Whether default modules have been registered.
     *
     * @var bool
     */
    protected static $booted = false;

    /**
     * Register Kavro core modules once.
     *
     * @return void
     */
    public static function boot() {
        if ( self::$booted ) {
            return;
        }

        self::$booted = true;

        self::register_module( 'options', 'Kavro\\AdminOptions', array( 'label' => 'Options Framework', 'free' => true ) );
        self::register_module( 'metabox', 'Kavro\\Metabox', array( 'label' => 'Metabox Framework', 'free' => true ) );
        self::register_module( 'customizer', 'Kavro\\Customizer', array( 'label' => 'Customizer Framework', 'free' => true ) );
        self::register_module( 'taxonomy', 'Kavro\\Taxonomy', array( 'label' => 'Taxonomy Options', 'free' => true ) );
        self::register_module( 'profile', 'Kavro\\Profile', array( 'label' => 'Profile Options', 'free' => true ) );
        self::register_module( 'nav_menu', 'Kavro\\NavMenu', array( 'label' => 'Nav Menu Options', 'free' => true ) );
        self::register_module( 'widget', 'Kavro\\Widget', array( 'label' => 'Widget Options', 'free' => true ) );
        self::register_module( 'comment', 'Kavro\\Comment', array( 'label' => 'Comment Options', 'free' => true ) );
        self::register_module( 'shortcode', 'Kavro\\Shortcode', array( 'label' => 'Shortcode Framework', 'free' => true ) );

        /**
         * Fires after Kavro has registered built-in module definitions.
         *
         * Pro plugins should register or override modules here:
         * `Kavro\Extensions::register_module( 'module_id', My_Module::class );`
         */
        do_action( 'kavro/register_modules' );
    }

    /**
     * Register or override a module controller.
     *
     * @param string $module Module key, for example `options` or `metabox`.
     * @param string $class  Fully-qualified controller class name.
     * @param array  $args   Module metadata.
     * @return void
     */
    public static function register_module( $module, $class, $args = array() ) {
        $module = sanitize_key( $module );

        if ( '' === $module || '' === $class ) {
            return;
        }

        self::$modules[ $module ] = wp_parse_args(
            $args,
            array(
                'class'   => ltrim( $class, '\\' ),
                'label'   => ucwords( str_replace( '_', ' ', $module ) ),
                'free'    => false,
                'enabled' => true,
            )
        );
    }

    /**
     * Return all registered module definitions.
     *
     * @return array<string,array<string,mixed>>
     */
    public static function modules() {
        self::boot();

        /**
         * Filter registered modules before Kavro initializes them.
         *
         * @param array $modules Module definitions.
         */
        return apply_filters( 'kavro/modules', self::$modules );
    }

    /**
     * Determine if a module is available and enabled.
     *
     * @param string $module Module key.
     * @return bool
     */
    public static function is_module_available( $module ) {
        $module  = sanitize_key( $module );
        $modules = self::modules();

        if ( empty( $modules[ $module ] ) ) {
            return false;
        }

        $enabled = isset( $modules[ $module ]['enabled'] ) ? (bool) $modules[ $module ]['enabled'] : true;

        /**
         * Filter whether a module should be initialized.
         *
         * @param bool   $enabled Module availability.
         * @param string $module  Module key.
         * @param array  $config  Module config.
         */
        return (bool) apply_filters( 'kavro/module_available', $enabled, $module, $modules[ $module ] );
    }

    /**
     * Return the controller class for a module.
     *
     * @param string $module Module key.
     * @return string
     */
    public static function module_class( $module ) {
        $module  = sanitize_key( $module );
        $modules = self::modules();
        $class   = isset( $modules[ $module ]['class'] ) ? $modules[ $module ]['class'] : '';

        /**
         * Filter a module controller class.
         *
         * @param string $class  Controller class.
         * @param string $module Module key.
         */
        return (string) apply_filters( 'kavro/module_class', $class, $module );
    }

    /**
     * Determine whether a Pro companion plugin is active.
     *
     * @return bool
     */
    public static function is_pro_active() {
        $active = defined( 'KAVRO_PRO_VERSION' ) || class_exists( '\\KavroPro\\Plugin' );

        /**
         * Filter Kavro Pro detection for custom white-label builds.
         *
         * @param bool $active Whether Pro is active.
         */
        return (bool) apply_filters( 'kavro/is_pro_active', $active );
    }

    /**
     * Return the current edition label.
     *
     * @return string
     */
    public static function edition() {
        return self::is_pro_active() ? 'pro' : 'free';
    }
}
