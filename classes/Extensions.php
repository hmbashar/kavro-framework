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

        $free_modules = self::free_modules();

        self::register_module( 'options', 'Kavro\\AdminOptions', array( 'label' => 'Options Framework', 'tier' => self::module_default_tier( 'options', $free_modules ) ) );
        self::register_module( 'metabox', 'Kavro\\Metabox', array( 'label' => 'Metabox Framework', 'tier' => self::module_default_tier( 'metabox', $free_modules ) ) );
        self::register_module( 'customizer', 'Kavro\\Customizer', array( 'label' => 'Customizer Framework', 'tier' => self::module_default_tier( 'customizer', $free_modules ) ) );
        self::register_module( 'taxonomy', 'Kavro\\Taxonomy', array( 'label' => 'Taxonomy Options', 'tier' => self::module_default_tier( 'taxonomy', $free_modules ) ) );
        self::register_module( 'profile', 'Kavro\\Profile', array( 'label' => 'Profile Options', 'tier' => self::module_default_tier( 'profile', $free_modules ) ) );
        self::register_module( 'nav_menu', 'Kavro\\NavMenu', array( 'label' => 'Nav Menu Options', 'tier' => self::module_default_tier( 'nav_menu', $free_modules ) ) );
        self::register_module( 'widget', 'Kavro\\Widget', array( 'label' => 'Widget Options', 'tier' => self::module_default_tier( 'widget', $free_modules ) ) );
        self::register_module( 'comment', 'Kavro\\Comment', array( 'label' => 'Comment Options', 'tier' => self::module_default_tier( 'comment', $free_modules ) ) );
        self::register_module( 'shortcode', 'Kavro\\Shortcode', array( 'label' => 'Shortcode Framework', 'tier' => self::module_default_tier( 'shortcode', $free_modules ) ) );

        /**
         * Fires after Kavro has registered built-in module definitions.
         *
         * Pro plugins should register or override modules here:
         * `Kavro\Extensions::register_module( 'module_id', My_Module::class );`
         */
        do_action( 'kavro/register_modules' );
    }


    /**
     * Return the built-in module list that ships with the free package by default.
     *
     * Developers preparing a strict WordPress.org build can define
     * `KAVRO_FREE_MODULES` before Kavro loads, for example:
     * `define( 'KAVRO_FREE_MODULES', array( 'options' ) );`
     * Any built-in module not in that list becomes a Pro-tier module and will be
     * unavailable unless a Pro bridge is active or a filter enables it.
     *
     * @return string[]
     */
    protected static function free_modules() {
        $default = array( 'options', 'metabox', 'customizer', 'taxonomy', 'profile', 'nav_menu', 'widget', 'comment', 'shortcode' );
        $modules = defined( 'KAVRO_FREE_MODULES' ) && is_array( KAVRO_FREE_MODULES ) ? KAVRO_FREE_MODULES : $default;

        return array_values( array_filter( array_map( 'sanitize_key', $modules ) ) );
    }

    /**
     * Determine the default tier for a module.
     *
     * @param string   $module       Module key.
     * @param string[] $free_modules Free module keys.
     * @return string `free` or `pro`.
     */
    protected static function module_default_tier( $module, $free_modules ) {
        return in_array( sanitize_key( $module ), $free_modules, true ) ? 'free' : 'pro';
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

        $args = wp_parse_args( $args, array( 'tier' => 'pro' ) );
        $args['tier'] = 'free' === sanitize_key( $args['tier'] ) ? 'free' : 'pro';
        $args['free'] = 'free' === $args['tier'];

        self::$modules[ $module ] = wp_parse_args(
            $args,
            array(
                'class'   => ltrim( $class, '\\' ),
                'label'   => ucwords( str_replace( '_', ' ', $module ) ),
                'tier'    => 'pro',
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
        $tier    = isset( $modules[ $module ]['tier'] ) ? sanitize_key( $modules[ $module ]['tier'] ) : 'pro';

        if ( 'pro' === $tier && ! self::is_pro_active() ) {
            $enabled = (bool) apply_filters( 'kavro/allow_pro_module_in_free', false, $module, $modules[ $module ] );
        }

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
