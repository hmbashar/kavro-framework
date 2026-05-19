<?php
/**
 * Kavro Framework taxonomy options demo.
 *
 * This demo registers Kavro fields on category and post tag add/edit screens.
 * Change the `taxonomy` argument to test your own custom taxonomies, for
 * example: array( 'category', 'post_tag', 'product_cat', 'portfolio_type' ).
 *
 * @package Kavro\Examples
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'KAVRO' ) ) {
    return;
}

/**
 * Unique taxonomy option storage key.
 *
 * Kavro saves all fields as one term meta array. Read values with:
 * kavro_get_term_meta( $term_id, 'kavro_demo_taxonomy' );
 */
$kavro_taxonomy = 'kavro_demo_taxonomy';

/**
 * Register the demo taxonomy option group.
 */
KAVRO::createTaxonomyOptions(
    $kavro_taxonomy,
    array(
        'taxonomy' => array( 'category', 'post_tag' ),
    )
);

/**
 * Section: Visual Settings.
 */
KAVRO::createSection(
    $kavro_taxonomy,
    array(
        'title'    => 'Visual Settings',
        'subtitle' => 'Common taxonomy styling controls for themes and plugins.',
        'fields'   => array(
            array(
                'id'      => 'term_accent_color',
                'type'    => 'color',
                'title'   => 'Accent Color',
                'default' => '#635bff',
            ),
            array(
                'id'      => 'term_badge_text',
                'type'    => 'text',
                'title'   => 'Badge Text',
                'default' => 'Featured',
            ),
            array(
                'id'      => 'term_layout',
                'type'    => 'button_set',
                'title'   => 'Archive Layout',
                'default' => 'grid',
                'options' => array(
                    'grid' => 'Grid',
                    'list' => 'List',
                    'hero' => 'Hero',
                ),
            ),
            array(
                'id'      => 'term_thumbnail',
                'type'    => 'media',
                'title'   => 'Term Thumbnail',
                'desc'    => 'Upload or select an image for taxonomy archive headers.',
            ),
        ),
    )
);

/**
 * Section: Content Settings.
 */
KAVRO::createSection(
    $kavro_taxonomy,
    array(
        'title'    => 'Content Settings',
        'subtitle' => 'Editor-friendly taxonomy content options.',
        'fields'   => array(
            array(
                'id'      => 'term_featured',
                'type'    => 'switcher',
                'title'   => 'Feature This Term',
                'default' => true,
            ),
            array(
                'id'    => 'term_intro',
                'type'  => 'textarea',
                'title' => 'Intro Text',
            ),
            array(
                'id'      => 'term_related_posts',
                'type'    => 'post_relation',
                'title'   => 'Related Posts',
                'post_type' => array( 'post' ),
                'multiple'  => true,
            ),
        ),
    )
);
