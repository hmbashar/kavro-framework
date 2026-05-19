<?php
// Paste this in a theme functions.php or a custom plugin after Kavro Framework is active.
if ( class_exists( 'KAVRO' ) ) {
    $prefix = 'my_kavro_options';

    KAVRO::createOptions( $prefix, array(
        'menu_title' => 'Theme Options',
        'menu_slug'  => 'theme-options',
        'menu_icon'  => 'dashicons-admin-customizer',
    ) );

    KAVRO::createSection( $prefix, array(
        'id'       => 'general',
        'title'    => 'General',
        'subtitle' => 'Basic site controls.',
        'fields'   => array(
            array( 'id' => 'site_badge', 'type' => 'text', 'title' => 'Site Badge', 'default' => 'Premium' ),
            array( 'id' => 'enable_feature', 'type' => 'switcher', 'title' => 'Enable Feature', 'default' => '1' ),
        ),
        'children' => array(
            array(
                'id'     => 'branding',
                'title'  => 'Branding',
                'fields' => array(
                    array( 'id' => 'brand_color', 'type' => 'color', 'title' => 'Brand Color', 'default' => '#4f46e5' ),
                ),
                'children' => array(
                    array(
                        'id'     => 'logo_settings',
                        'title'  => 'Logo Settings',
                        'fields' => array(
                            array( 'id' => 'logo_width', 'type' => 'number', 'title' => 'Logo Width', 'default' => '180' ),
                        ),
                    ),
                ),
            ),
        ),
    ) );
}
