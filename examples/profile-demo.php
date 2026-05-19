<?php
/**
 * Kavro Framework profile options demo.
 *
 * This file demonstrates KAVRO::createProfileOptions() on WordPress user profile
 * screens. The demo uses the shared field registry so every Kavro field can be
 * tested in the user-meta context as well as options, metaboxes, and taxonomy.
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
 * Unique user-meta key.
 *
 * Kavro saves this profile group as one user-meta array. Read values with:
 * kavro_get_user_meta( $user_id, 'kavro_demo_profile', 'field_id' ).
 */
$profile_prefix = 'kavro_demo_profile';

/**
 * Register profile options for user edit screens.
 *
 * Leave `roles` empty to show for all users. To limit the fields, pass roles
 * such as array( 'administrator', 'editor' ).
 */
KAVRO::createProfileOptions(
    $profile_prefix,
    array(
        'title' => 'Kavro Profile Options',
        'roles' => array(),
    )
);

/**
 * Section: Profile Basics.
 *
 * A small practical section appears first before the full field compatibility
 * demo, making the profile screen easier to understand during testing.
 */
KAVRO::createSection(
    $profile_prefix,
    array(
        'title'    => 'Profile Basics',
        'subtitle' => 'Common profile settings saved with Kavro user meta.',
        'fields'   => array(
            array(
                'id'      => 'profile_headline',
                'type'    => 'text',
                'title'   => 'Profile Headline',
                'default' => 'WordPress Developer',
                'desc'    => 'Short headline displayed by your theme or plugin.',
            ),
            array(
                'id'      => 'profile_featured',
                'type'    => 'switcher',
                'title'   => 'Featured User',
                'default' => '1',
                'desc'    => 'Example boolean user preference.',
            ),
            array(
                'id'      => 'profile_social_links',
                'type'    => 'social_links',
                'title'   => 'Social Links',
                'default' => array(
                    'facebook' => 'https://facebook.com/hmbashar',
                    'website'  => 'https://hmbashar.com',
                ),
                'desc'    => 'Example array-based profile field.',
            ),
        ),
    )
);

/**
 * Register every field section for profile/user-meta compatibility testing.
 */
foreach ( kavro_demo_field_sections( 'profile' ) as $section ) {
    KAVRO::createSection( $profile_prefix, $section );
}
