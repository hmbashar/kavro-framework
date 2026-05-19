<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! function_exists( 'kavro_get_option' ) ) {
    function kavro_get_option( $unique, $key = '', $default = null ) {
        $options = get_option( $unique, array() );
        if ( '' === $key ) {
            return $options;
        }
        return isset( $options[ $key ] ) ? $options[ $key ] : $default;
    }
}
