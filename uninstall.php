<?php
/**
 * Kavro Framework uninstall handler.
 *
 * Kavro is a developer framework. It should not delete arbitrary options,
 * post meta, term meta, user meta, comment meta, or widget data created by
 * third-party themes/plugins using Kavro unless the site owner explicitly opts
 * into that behavior from their own product.
 *
 * @package Kavro\Framework
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit;
}

/*
 * Remove only known demo/internal data that Kavro itself may create while the
 * bundled examples are enabled. Production examples are disabled by default.
 */
$kavro_demo_options = array(
    'my_kavro_options',
    'kavro_demo_options',
    'kavro_demo_settings',
);

foreach ( $kavro_demo_options as $option_name ) {
    delete_option( $option_name );
}

/*
 * Do not delete developer-created data by default. This conservative strategy
 * protects real theme/plugin settings that rely on Kavro as a framework.
 */
