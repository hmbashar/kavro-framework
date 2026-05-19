<?php
/**
 * Kavro Framework options demo.
 *
 * This file registers a complete admin options panel and includes every Kavro
 * field type through the shared demo field registry. The array formatting is
 * intentionally verbose so developers can copy individual sections easily.
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
 * Unique options key.
 *
 * Kavro saves all fields in this options panel to the WordPress options table
 * under this key. Read values with: kavro_get_option( 'my_kavro_options' ).
 */
$prefix = 'my_kavro_options';

/**
 * Register the admin options panel.
 */
KAVRO::createOptions(
    $prefix,
    array(
        'menu_title'   => 'Kavro Demo',
        'menu_slug'    => 'kavro-demo',
        'menu_icon'    => 'dashicons-admin-customizer',
        'footer_credit' => 'Kavro Framework © Md Abul Bashar · hmbashar.com · facebook.com/hmbashar',
    )
);

/**
 * Section: Nested Menu Demo.
 *
 * This verifies Kavro's child-only nested menu structure. No `parent` key is
 * required; child screens are defined inside the `children` array.
 */
KAVRO::createSection(
    $prefix,
    array(
        'id'       => 'nested-menu-demo',
        'title'    => 'Nested Menu Demo',
        'subtitle' => 'Nested sections are created with children only.',
        'fields'   => array(
            array(
                'type'    => 'notice',
                'style'   => 'info',
                'content' => 'Use the children array to build Main → Child → Child → Child navigation.',
            ),
        ),
        'children' => array(
            array(
                'id'     => 'nested-child-one',
                'title'  => 'Child Level 1',
                'fields' => array(
                    array(
                        'id'      => 'nested_child_one_text',
                        'type'    => 'text',
                        'title'   => 'Child Level 1 Text',
                        'default' => 'First child level',
                    ),
                ),
                'children' => array(
                    array(
                        'id'     => 'nested-child-two',
                        'title'  => 'Child Level 2',
                        'fields' => array(
                            array(
                                'id'      => 'nested_child_two_text',
                                'type'    => 'text',
                                'title'   => 'Child Level 2 Text',
                                'default' => 'Second child level',
                            ),
                        ),
                        'children' => array(
                            array(
                                'id'     => 'nested-child-three',
                                'title'  => 'Child Level 3',
                                'fields' => array(
                                    array(
                                        'id'      => 'nested_child_three_text',
                                        'type'    => 'text',
                                        'title'   => 'Child Level 3 Text',
                                        'default' => 'Third child level',
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    )
);

/**
 * Register every field section for admin options testing.
 */
foreach ( kavro_demo_field_sections( 'options' ) as $section ) {
    KAVRO::createSection( $prefix, $section );
}
