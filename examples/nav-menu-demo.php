<?php
/**
 * Kavro Framework nav menu options demo.
 *
 * This file demonstrates KAVRO::createNavMenuOptions() for Appearance -> Menus.
 * Values are saved per menu item as post meta and can be retrieved with
 * kavro_get_nav_menu_item_meta().
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
 * Unique post-meta key used for every menu item option array.
 */
$nav_menu_prefix = 'kavro_demo_nav_menu';

/**
 * Register nav menu item options.
 */
KAVRO::createNavMenuOptions(
    $nav_menu_prefix,
    array(
        'title'      => 'Kavro Menu Item Options',
        'capability' => 'edit_theme_options',
    )
);

/**
 * Section: Visual Settings.
 *
 * These fields are safe and practical for menu items. Very large fields such as
 * full page builders are intentionally not used here because a menu screen can
 * contain many menu items at once.
 */
KAVRO::createSection(
    $nav_menu_prefix,
    array(
        'title'  => 'Visual Settings',
        'fields' => array(
            array(
                'id'      => 'menu_badge',
                'type'    => 'text',
                'title'   => 'Menu Badge',
                'default' => '',
                'desc'    => 'Example: New, Hot, Sale.',
            ),
            array(
                'id'      => 'menu_icon',
                'type'    => 'icon',
                'title'   => 'Menu Icon',
                'default' => 'dashicons-star-filled',
                'desc'    => 'Dashicons class for this menu item.',
            ),
            array(
                'id'      => 'menu_color',
                'type'    => 'color',
                'title'   => 'Text Color',
                'default' => '#2563eb',
                'desc'    => 'Optional custom text color.',
            ),
            array(
                'id'      => 'highlight_item',
                'type'    => 'switcher',
                'title'   => 'Highlight Item',
                'default' => '0',
                'desc'    => 'Mark this menu item as highlighted.',
            ),
        ),
    )
);

/**
 * Section: Behavior Settings.
 */
KAVRO::createSection(
    $nav_menu_prefix,
    array(
        'title'  => 'Behavior Settings',
        'fields' => array(
            array(
                'id'      => 'open_behavior',
                'type'    => 'select',
                'title'   => 'Open Behavior',
                'default' => 'same',
                'options' => array(
                    'same'  => 'Same Window',
                    'blank' => 'New Window',
                    'modal' => 'Modal Trigger',
                ),
            ),
            array(
                'id'      => 'mega_menu',
                'type'    => 'checkbox',
                'title'   => 'Enable Mega Menu',
                'default' => '0',
                'desc'    => 'Example boolean flag for theme mega-menu logic.',
            ),
            array(
                'id'      => 'mega_columns',
                'type'    => 'spinner',
                'title'   => 'Mega Columns',
                'default' => '3',
                'min'     => 1,
                'max'     => 6,
                'desc'    => 'Number of columns used by your theme.',
            ),
        ),
    )
);
