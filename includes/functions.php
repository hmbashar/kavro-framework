<?php
/**
 * Global helper functions for Kavro Framework.
 *
 * Helpers are intentionally prefixed with kavro_ to avoid collisions with
 * themes, plugins, and WordPress core functions.
 *
 * @package Kavro\Includes
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! function_exists( 'kavro_get_option' ) ) {
    /**
     * Retrieve a saved option value from a Kavro option container.
     *
     * @param string $unique  Option container ID passed to KAVRO::createOptions().
     * @param string $key     Optional field ID. Leave empty to return all options.
     * @param mixed  $default Default value when the option/key is missing.
     * @return mixed
     */
    function kavro_get_option( $unique, $key = '', $default = null ) {
        $options = get_option( sanitize_key( $unique ), array() );

        if ( '' === $key ) {
            return $options;
        }

        return isset( $options[ $key ] ) ? $options[ $key ] : $default;
    }
}


if ( ! function_exists( 'kavro_get_post_meta' ) ) {
    /**
     * Retrieve a saved Kavro metabox value from a post meta container.
     *
     * @param int    $post_id Post ID.
     * @param string $unique  Metabox unique ID passed to KAVRO::createMetabox().
     * @param string $key     Optional field ID. Leave empty to return all values.
     * @param mixed  $default Default value when the meta/key is missing.
     * @return mixed
     */
    function kavro_get_post_meta( $post_id, $unique, $key = '', $default = null ) {
        $values = get_post_meta( absint( $post_id ), sanitize_key( $unique ), true );
        $values = is_array( $values ) ? $values : array();

        if ( '' === $key ) {
            return $values;
        }

        return array_key_exists( $key, $values ) ? $values[ $key ] : $default;
    }
}

if ( ! function_exists( 'kavro_get_term_meta' ) ) {
    /**
     * Retrieve a saved Kavro taxonomy option value from a term meta container.
     *
     * @param int    $term_id Term ID.
     * @param string $unique  Taxonomy option unique ID passed to KAVRO::createTaxonomyOptions().
     * @param string $key     Optional field ID. Leave empty to return all values.
     * @param mixed  $default Default value when the meta/key is missing.
     * @return mixed
     */
    function kavro_get_term_meta( $term_id, $unique, $key = '', $default = null ) {
        $values = get_term_meta( absint( $term_id ), sanitize_key( $unique ), true );
        $values = is_array( $values ) ? $values : array();

        if ( '' === $key ) {
            return $values;
        }

        return array_key_exists( $key, $values ) ? $values[ $key ] : $default;
    }
}


if ( ! function_exists( 'kavro_get_user_meta' ) ) {
    /**
     * Retrieve a saved Kavro profile option value from a user meta container.
     *
     * @param int    $user_id User ID.
     * @param string $unique  Profile option unique ID passed to KAVRO::createProfileOptions().
     * @param string $key     Optional field ID. Leave empty to return all values.
     * @param mixed  $default Default value when the meta/key is missing.
     * @return mixed
     */
    function kavro_get_user_meta( $user_id, $unique, $key = '', $default = null ) {
        $values = get_user_meta( absint( $user_id ), sanitize_key( $unique ), true );
        $values = is_array( $values ) ? $values : array();

        if ( '' === $key ) {
            return $values;
        }

        return array_key_exists( $key, $values ) ? $values[ $key ] : $default;
    }
}


if ( ! function_exists( 'kavro_get_nav_menu_item_meta' ) ) {
    /**
     * Retrieve a saved Kavro nav menu item option value.
     *
     * @param int    $menu_item_id Menu item post ID.
     * @param string $unique       Nav menu option unique ID passed to KAVRO::createNavMenuOptions().
     * @param string $key          Optional field ID. Leave empty to return all values.
     * @param mixed  $default      Default value when the meta/key is missing.
     * @return mixed
     */
    function kavro_get_nav_menu_item_meta( $menu_item_id, $unique, $key = '', $default = null ) {
        $values = get_post_meta( absint( $menu_item_id ), sanitize_key( $unique ), true );
        $values = is_array( $values ) ? $values : array();

        if ( '' === $key ) {
            return $values;
        }

        return array_key_exists( $key, $values ) ? $values[ $key ] : $default;
    }
}


if ( ! function_exists( 'kavro_get_widget_option' ) ) {
    /**
     * Retrieve a value from a saved Kavro widget instance array.
     *
     * WordPress widgets store values per sidebar instance, so this helper is
     * intentionally small and works with an instance array received inside a
     * widget callback.
     *
     * @param array  $instance Widget instance values.
     * @param string $key      Optional field ID. Leave empty to return all values.
     * @param mixed  $default  Default value when the key is missing.
     * @return mixed
     */
    function kavro_get_widget_option( $instance, $key = '', $default = null ) {
        $instance = is_array( $instance ) ? $instance : array();

        if ( '' === $key ) {
            return $instance;
        }

        return array_key_exists( $key, $instance ) ? $instance[ $key ] : $default;
    }
}


if ( ! function_exists( 'kavro_get_comment_meta' ) ) {
    /**
     * Retrieve a saved Kavro comment option value from a comment meta container.
     *
     * @param int    $comment_id Comment ID.
     * @param string $unique     Comment option unique ID passed to KAVRO::createCommentOptions().
     * @param string $key        Optional field ID. Leave empty to return all values.
     * @param mixed  $default    Default value when the meta/key is missing.
     * @return mixed
     */
    function kavro_get_comment_meta( $comment_id, $unique, $key = '', $default = null ) {
        $values = get_comment_meta( absint( $comment_id ), sanitize_key( $unique ), true );
        $values = is_array( $values ) ? $values : array();

        if ( '' === $key ) {
            return $values;
        }

        return array_key_exists( $key, $values ) ? $values[ $key ] : $default;
    }
}


if ( ! function_exists( 'kavro_is_pro' ) ) {
    /**
     * Determine whether Kavro Pro or a compatible Pro bridge is active.
     *
     * @return bool
     */
    function kavro_is_pro() {
        return class_exists( 'KAVRO' ) && KAVRO::isPro();
    }
}

if ( ! function_exists( 'kavro_edition' ) ) {
    /**
     * Return the current Kavro edition slug.
     *
     * @return string Either `free` or `pro`.
     */
    function kavro_edition() {
        return class_exists( 'KAVRO' ) ? KAVRO::edition() : 'free';
    }
}

if ( ! function_exists( 'kavro_get_modules' ) ) {
    /**
     * Return registered Kavro modules for diagnostics or add-on UIs.
     *
     * @return array
     */
    function kavro_get_modules() {
        return class_exists( 'KAVRO' ) ? KAVRO::getModules() : array();
    }
}


if ( ! function_exists( 'kavro_is_module_available' ) ) {
    /**
     * Check if a Kavro module is registered and available in the current edition.
     *
     * @param string $module Module key.
     * @return bool
     */
    function kavro_is_module_available( $module ) {
        return class_exists( 'KAVRO' ) ? KAVRO::isModuleAvailable( $module ) : false;
    }
}
