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
