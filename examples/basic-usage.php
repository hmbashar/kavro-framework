<?php
// Paste this in a theme functions.php or a custom plugin after Kavro Framework is active.
if ( class_exists( 'KAVRO' ) ) {
    $prefix = 'my_kavro_options';

    KAVRO::createOptions( $prefix, array(
        'menu_title' => 'Kavro Demo',
        'menu_slug'  => 'kavro-demo',
        'menu_icon'  => 'dashicons-admin-customizer',
    ) );

    KAVRO::createSection( $prefix, array(
        'id'       => 'general',
        'title'    => 'General',
        'subtitle' => 'Basic site controls and global toggles.',
        'fields'   => array(
            array( 'id' => 'site_badge', 'type' => 'text', 'title' => 'Site Badge', 'default' => 'Premium', 'desc' => 'Small badge text used in theme UI.' ),
            array( 'id' => 'site_intro', 'type' => 'textarea', 'title' => 'Intro Text', 'default' => 'Build beautiful settings panels with Kavro.', 'desc' => 'Textarea demo field.' ),
            array( 'id' => 'enable_feature', 'type' => 'switcher', 'title' => 'Enable Feature', 'default' => '1' ),
            array( 'id' => 'layout_style', 'type' => 'select', 'title' => 'Layout Style', 'default' => 'boxed', 'options' => array( 'boxed' => 'Boxed', 'wide' => 'Wide', 'fluid' => 'Fluid' ) ),
        ),
        'children' => array(
            array(
                'id'       => 'branding',
                'title'    => 'Branding',
                'subtitle' => 'Logo and brand color controls.',
                'fields'   => array(
                    array( 'id' => 'brand_color', 'type' => 'color', 'title' => 'Brand Color', 'default' => '#4f46e5' ),
                    array( 'id' => 'accent_color', 'type' => 'color', 'title' => 'Accent Color', 'default' => '#06b6d4' ),
                    array( 'id' => 'brand_name', 'type' => 'text', 'title' => 'Brand Name', 'default' => 'Kavro' ),
                ),
                'children' => array(
                    array(
                        'id'       => 'logo_settings',
                        'title'    => 'Logo Settings',
                        'subtitle' => 'Nested child menu test level 3.',
                        'fields'   => array(
                            array( 'id' => 'logo_width', 'type' => 'number', 'title' => 'Logo Width', 'default' => '180' ),
                            array( 'id' => 'logo_height', 'type' => 'number', 'title' => 'Logo Height', 'default' => '60' ),
                            array( 'id' => 'sticky_logo', 'type' => 'switcher', 'title' => 'Use Sticky Logo', 'default' => '1' ),
                        ),
                        'children' => array(
                            array(
                                'id'       => 'mobile_logo',
                                'title'    => 'Mobile Logo',
                                'subtitle' => 'Nested child menu test level 4.',
                                'fields'   => array(
                                    array( 'id' => 'mobile_logo_width', 'type' => 'number', 'title' => 'Mobile Logo Width', 'default' => '140' ),
                                    array( 'id' => 'mobile_logo_position', 'type' => 'select', 'title' => 'Mobile Logo Position', 'default' => 'left', 'options' => array( 'left' => 'Left', 'center' => 'Center', 'right' => 'Right' ) ),
                                    array( 'id' => 'mobile_logo_note', 'type' => 'content', 'title' => 'Note', 'content' => '<strong>Level 4 demo:</strong> this validates deep nested menu expansion.' ),
                                ),
                            ),
                        ),
                    ),
                    array(
                        'id'     => 'colors',
                        'title'  => 'Colors',
                        'fields' => array(
                            array( 'id' => 'body_bg', 'type' => 'color', 'title' => 'Body Background', 'default' => '#ffffff' ),
                            array( 'id' => 'heading_color', 'type' => 'color', 'title' => 'Heading Color', 'default' => '#111827' ),
                            array( 'id' => 'text_color', 'type' => 'color', 'title' => 'Text Color', 'default' => '#334155' ),
                        ),
                    ),
                ),
            ),
            array(
                'id'     => 'performance',
                'title'  => 'Performance',
                'fields' => array(
                    array( 'id' => 'minify_css', 'type' => 'checkbox', 'title' => 'Minify CSS', 'label' => 'Enable CSS minification', 'default' => '1' ),
                    array( 'id' => 'lazy_assets', 'type' => 'switcher', 'title' => 'Lazy Load Assets', 'default' => '1' ),
                    array( 'id' => 'cache_ttl', 'type' => 'number', 'title' => 'Cache TTL', 'default' => '3600', 'desc' => 'Cache duration in seconds.' ),
                ),
            ),
        ),
    ) );

    KAVRO::createSection( $prefix, array(
        'id'       => 'header',
        'title'    => 'Header',
        'subtitle' => 'Header layout and navigation demo fields.',
        'fields'   => array(
            array( 'id' => 'header_style', 'type' => 'select', 'title' => 'Header Style', 'default' => 'standard', 'options' => array( 'standard' => 'Standard', 'transparent' => 'Transparent', 'centered' => 'Centered' ) ),
            array( 'id' => 'show_topbar', 'type' => 'switcher', 'title' => 'Show Topbar', 'default' => '1' ),
            array( 'id' => 'header_height', 'type' => 'number', 'title' => 'Header Height', 'default' => '88' ),
        ),
        'children' => array(
            array(
                'id'     => 'topbar',
                'title'  => 'Topbar',
                'fields' => array(
                    array( 'id' => 'topbar_text', 'type' => 'text', 'title' => 'Topbar Text', 'default' => 'Welcome to our website' ),
                    array( 'id' => 'topbar_bg', 'type' => 'color', 'title' => 'Topbar Background', 'default' => '#0f172a' ),
                    array( 'id' => 'topbar_text_color', 'type' => 'color', 'title' => 'Topbar Text Color', 'default' => '#ffffff' ),
                ),
            ),
            array(
                'id'     => 'navigation',
                'title'  => 'Navigation',
                'fields' => array(
                    array( 'id' => 'nav_dropdown', 'type' => 'switcher', 'title' => 'Enable Dropdown', 'default' => '1' ),
                    array( 'id' => 'nav_animation', 'type' => 'select', 'title' => 'Dropdown Animation', 'default' => 'fade', 'options' => array( 'fade' => 'Fade', 'slide' => 'Slide', 'zoom' => 'Zoom' ) ),
                    array( 'id' => 'nav_spacing', 'type' => 'number', 'title' => 'Menu Item Spacing', 'default' => '18' ),
                ),
            ),
        ),
    ) );

    KAVRO::createSection( $prefix, array(
        'id'       => 'blog',
        'title'    => 'Blog',
        'subtitle' => 'Archive and single post controls.',
        'fields'   => array(
            array( 'id' => 'blog_layout', 'type' => 'select', 'title' => 'Blog Layout', 'default' => 'grid', 'options' => array( 'grid' => 'Grid', 'list' => 'List', 'masonry' => 'Masonry' ) ),
            array( 'id' => 'posts_per_row', 'type' => 'number', 'title' => 'Posts Per Row', 'default' => '3' ),
            array( 'id' => 'show_excerpt', 'type' => 'switcher', 'title' => 'Show Excerpt', 'default' => '1' ),
            array( 'id' => 'excerpt_length', 'type' => 'number', 'title' => 'Excerpt Length', 'default' => '24' ),
        ),
        'children' => array(
            array(
                'id'     => 'single_post',
                'title'  => 'Single Post',
                'fields' => array(
                    array( 'id' => 'show_author_box', 'type' => 'switcher', 'title' => 'Show Author Box', 'default' => '1' ),
                    array( 'id' => 'show_related_posts', 'type' => 'switcher', 'title' => 'Show Related Posts', 'default' => '1' ),
                    array( 'id' => 'related_posts_count', 'type' => 'number', 'title' => 'Related Posts Count', 'default' => '3' ),
                ),
            ),
            array(
                'id'     => 'archive',
                'title'  => 'Archive',
                'fields' => array(
                    array( 'id' => 'archive_title_prefix', 'type' => 'text', 'title' => 'Archive Title Prefix', 'default' => 'Browsing:' ),
                    array( 'id' => 'archive_sidebar', 'type' => 'select', 'title' => 'Archive Sidebar', 'default' => 'right', 'options' => array( 'none' => 'None', 'left' => 'Left', 'right' => 'Right' ) ),
                ),
            ),
        ),
    ) );

    KAVRO::createSection( $prefix, array(
        'id'       => 'footer',
        'title'    => 'Footer',
        'subtitle' => 'Footer layout and copyright settings.',
        'fields'   => array(
            array( 'id' => 'footer_columns', 'type' => 'select', 'title' => 'Footer Columns', 'default' => '4', 'options' => array( '1' => '1 Column', '2' => '2 Columns', '3' => '3 Columns', '4' => '4 Columns' ) ),
            array( 'id' => 'copyright_text', 'type' => 'textarea', 'title' => 'Copyright Text', 'default' => 'Copyright © 2026 Kavro. All rights reserved.' ),
            array( 'id' => 'back_to_top', 'type' => 'switcher', 'title' => 'Back To Top Button', 'default' => '1' ),
        ),
    ) );

    KAVRO::createSection( $prefix, array(
        'id'       => 'advanced',
        'title'    => 'Advanced',
        'subtitle' => 'Developer and debugging controls.',
        'fields'   => array(
            array( 'id' => 'custom_css', 'type' => 'textarea', 'title' => 'Custom CSS', 'placeholder' => '.site-header { ... }' ),
            array( 'id' => 'custom_js', 'type' => 'textarea', 'title' => 'Custom JS', 'placeholder' => 'console.log("Kavro");' ),
            array( 'id' => 'debug_mode', 'type' => 'checkbox', 'title' => 'Debug Mode', 'label' => 'Enable debug output for development' ),
        ),
    ) );
}
