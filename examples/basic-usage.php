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

    // Header Section
    KAVRO::createSection( $prefix, array(
        'id'       => 'header',
        'title'    => 'Header',
        'subtitle' => 'Header layout and settings.',
        'icon'     => 'dashicons-heading',
        'fields'   => array(
            array( 'id' => 'header_layout', 'type' => 'select', 'title' => 'Header Layout', 'options' => array( 'layout-1' => 'Layout 1', 'layout-2' => 'Layout 2' ), 'default' => 'layout-1' ),
            array( 'id' => 'sticky_header', 'type' => 'switcher', 'title' => 'Sticky Header', 'default' => '1' ),
            array( 'id' => 'header_bg_color', 'type' => 'color', 'title' => 'Background Color', 'default' => '#ffffff' ),
        ),
    ) );

    // Footer Section
    KAVRO::createSection( $prefix, array(
        'id'       => 'footer',
        'title'    => 'Footer',
        'subtitle' => 'Footer layout and settings.',
        'icon'     => 'dashicons-editor-insertmore',
        'fields'   => array(
            array( 'id' => 'footer_columns', 'type' => 'number', 'title' => 'Footer Columns', 'default' => '4' ),
            array( 'id' => 'footer_copyright', 'type' => 'textarea', 'title' => 'Copyright Text', 'default' => '© ' . date('Y') . ' Your Site. All rights reserved.' ),
        ),
    ) );

    // Typography Section
    KAVRO::createSection( $prefix, array(
        'id'       => 'typography',
        'title'    => 'Typography',
        'subtitle' => 'Site wide typography settings.',
        'icon'     => 'dashicons-editor-textcolor',
        'fields'   => array(
            array( 'id' => 'body_font', 'type' => 'text', 'title' => 'Body Font Family', 'default' => 'Inter, sans-serif' ),
            array( 'id' => 'heading_font', 'type' => 'text', 'title' => 'Heading Font Family', 'default' => 'Inter, sans-serif' ),
            array( 'id' => 'base_font_size', 'type' => 'text', 'title' => 'Base Font Size', 'default' => '16px' ),
        ),
    ) );

}
