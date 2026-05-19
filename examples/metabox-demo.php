<?php
/**
 * Kavro Framework metabox demo.
 *
 * This demo registers Kavro fields on the WordPress post/page edit screen.
 * Every supported field type is included through the shared demo field registry
 * so you can test field rendering and post-meta saving in one place.
 *
 * @package Kavro\Examples
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'KAVRO' ) || ! function_exists( 'kavro_demo_field_sections' ) ) {
    return;
}

/**
 * Unique metabox storage key.
 *
 * Kavro saves all fields in this metabox as one post meta array. You can read
 * values with: kavro_get_post_meta( get_the_ID(), 'kavro_demo_metabox' );
 */
$kavro_metabox = 'kavro_demo_metabox';

/**
 * Register the demo metabox.
 *
 * Change `post_type` to test with your own custom post type, for example:
 * array( 'post', 'page', 'product', 'portfolio' )
 */
KAVRO::createMetabox(
    $kavro_metabox,
    array(
        'title'     => 'Kavro Demo Metabox',
        'post_type' => array( 'post', 'page' ),
        'context'   => 'normal',
        'priority'  => 'high',
    )
);

/**
 * Register every field section for metabox compatibility testing.
 */
foreach ( kavro_demo_field_sections( 'metabox' ) as $section ) {
    KAVRO::createSection( $kavro_metabox, $section );
}
