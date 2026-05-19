<?php
/**
 * Kavro Framework file: examples/metabox-demo.php.
 *
 * This demo registers a post/page metabox using the Kavro field registry.
 * Change the `post_type` array below to test with any custom post type.
 *
 * @package Kavro
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'KAVRO' ) ) {
    return;
}

/**
 * Unique metabox storage key.
 *
 * Kavro saves all fields from this metabox into a single post meta array using
 * this key. You can read it with:
 *
 * $values = get_post_meta( get_the_ID(), 'kavro_demo_metabox', true );
 */
$kavro_metabox = 'kavro_demo_metabox';

/**
 * Register the demo metabox.
 *
 * Developers can change `post_type` to any supported post type, for example:
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
 * Section: Hero Settings.
 */
KAVRO::createSection(
    $kavro_metabox,
    array(
        'title'    => 'Hero Settings',
        'subtitle' => 'Primary page hero controls saved as post meta.',
        'fields'   => array(

            // Toggle the entire hero block.
            array(
                'id'      => 'hero_enabled',
                'type'    => 'switcher',
                'title'   => 'Enable Hero',
                'default' => '1',
            ),

            // Simple text input for the hero headline.
            array(
                'id'      => 'hero_title',
                'type'    => 'text',
                'title'   => 'Hero Title',
                'default' => 'Premium page hero',
            ),

            // Larger textarea for supporting copy.
            array(
                'id'    => 'hero_subtitle',
                'type'  => 'textarea',
                'title' => 'Hero Subtitle',
            ),

            // WordPress media uploader field.
            array(
                'id'    => 'hero_image',
                'type'  => 'media',
                'title' => 'Hero Image',
            ),

            // Button-set layout control.
            array(
                'id'      => 'hero_layout',
                'type'    => 'button_set',
                'title'   => 'Hero Layout',
                'default' => 'center',
                'options' => array(
                    'left'   => 'Left',
                    'center' => 'Center',
                    'split'  => 'Split',
                ),
            ),

            // Color field with alpha-style default value.
            array(
                'id'      => 'hero_accent',
                'type'    => 'color_picker_alpha',
                'title'   => 'Accent Color',
                'default' => 'rgba(91,92,246,.95)',
            ),
        ),
    )
);

/**
 * Section: SEO & Display.
 */
KAVRO::createSection(
    $kavro_metabox,
    array(
        'title'    => 'SEO & Display',
        'subtitle' => 'Search, display, and related content controls.',
        'fields'   => array(

            // Plain text badge shown near post cards or page headers.
            array(
                'id'      => 'featured_badge',
                'type'    => 'text',
                'title'   => 'Featured Badge',
                'default' => 'Editor Pick',
            ),

            // Select2 powered template selector.
            array(
                'id'      => 'display_template',
                'type'    => 'select2',
                'title'   => 'Display Template',
                'default' => 'standard',
                'options' => array(
                    'standard' => 'Standard',
                    'landing'  => 'Landing',
                    'minimal'  => 'Minimal',
                ),
            ),

            // Relationship field for posts/pages.
            array(
                'id'        => 'related_posts',
                'type'      => 'post_relation',
                'title'     => 'Related Posts',
                'post_type' => array( 'post', 'page' ),
            ),

            // Rich text notes field.
            array(
                'id'    => 'seo_notes',
                'type'  => 'wysiwyg',
                'title' => 'SEO Notes',
            ),
        ),
    )
);

/**
 * Section: Advanced Metabox Fields.
 */
KAVRO::createSection(
    $kavro_metabox,
    array(
        'title'    => 'Advanced Metabox Fields',
        'subtitle' => 'A small set of advanced fields to verify metabox support.',
        'fields'   => array(

            // Responsive values saved inside post meta.
            array(
                'id'    => 'hero_responsive_spacing',
                'type'  => 'responsive_value',
                'title' => 'Responsive Spacing',
            ),

            // Dynamic tag picker for template-like usage.
            array(
                'id'    => 'hero_dynamic_tag',
                'type'  => 'dynamic_tags',
                'title' => 'Dynamic Tag',
            ),

            // Cloneable action buttons.
            array(
                'id'     => 'hero_buttons',
                'type'   => 'cloneable',
                'title'  => 'Hero Buttons',
                'fields' => array(
                    array(
                        'id'    => 'label',
                        'type'  => 'text',
                        'title' => 'Button Label',
                    ),
                    array(
                        'id'    => 'url',
                        'type'  => 'url',
                        'title' => 'Button URL',
                    ),
                ),
            ),
        ),
    )
);
