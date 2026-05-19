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
