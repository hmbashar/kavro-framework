<?php
/**
 * Kavro Framework Customizer demo.
 *
 * This file shows how to register a WordPress Customizer panel using the same
 * Kavro section API used by the options and metabox modules. The demo focuses
 * on native Customizer-friendly fields for a stable first Customizer layer.
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
 * Unique Customizer option key.
 *
 * Values are stored as one option array. Example usage:
 * kavro_get_option( 'kavro_demo_customizer', 'site_accent_color' );
 */
$kavro_customizer = 'kavro_demo_customizer';

/**
 * Register the Customizer panel.
 */
KAVRO::createCustomizeOptions(
    $kavro_customizer,
    array(
        'title'       => 'Kavro Customizer Demo',
        'description' => 'A native WordPress Customizer panel registered with Kavro Framework.',
        'priority'    => 160,
    )
);

/**
 * Section: Brand Settings.
 */
KAVRO::createSection(
    $kavro_customizer,
    array(
        'id'       => 'brand-settings',
        'title'    => 'Brand Settings',
        'subtitle' => 'Common brand controls for theme developers.',
        'fields'   => array(
            array(
                'id'      => 'site_accent_color',
                'type'    => 'color',
                'title'   => 'Accent Color',
                'default' => '#635bff',
            ),
            array(
                'id'      => 'site_layout',
                'type'    => 'select',
                'title'   => 'Site Layout',
                'default' => 'boxed',
                'options' => array(
                    'boxed' => 'Boxed',
                    'wide'  => 'Wide',
                    'fluid' => 'Fluid',
                ),
            ),
            array(
                'id'      => 'enable_hero',
                'type'    => 'switcher',
                'title'   => 'Enable Hero Section',
                'default' => true,
            ),
        ),
    )
);

/**
 * Section: Header Settings.
 */
KAVRO::createSection(
    $kavro_customizer,
    array(
        'id'       => 'header-settings',
        'title'    => 'Header Settings',
        'subtitle' => 'Native Customizer controls registered by Kavro.',
        'fields'   => array(
            array(
                'id'      => 'header_style',
                'type'    => 'radio',
                'title'   => 'Header Style',
                'default' => 'minimal',
                'options' => array(
                    'minimal' => 'Minimal',
                    'classic' => 'Classic',
                    'centered' => 'Centered',
                ),
            ),
            array(
                'id'      => 'announcement_text',
                'type'    => 'textarea',
                'title'   => 'Announcement Text',
                'default' => 'Welcome to our website.',
            ),
        ),
        'children' => array(
            array(
                'id'       => 'header-button',
                'title'    => 'Header Button',
                'subtitle' => 'Nested Kavro sections are flattened inside WordPress Customizer.',
                'fields'   => array(
                    array(
                        'id'      => 'header_button_text',
                        'type'    => 'text',
                        'title'   => 'Button Text',
                        'default' => 'Get Started',
                    ),
                    array(
                        'id'      => 'header_button_url',
                        'type'    => 'url',
                        'title'   => 'Button URL',
                        'default' => home_url( '/' ),
                    ),
                ),
            ),
        ),
    )
);
