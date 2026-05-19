<?php
// Paste into a theme functions.php or custom plugin after Kavro Framework is active.
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
            array( 'type' => 'notice', 'style' => 'info', 'content' => 'This section demonstrates common basic fields.' ),
            array( 'id' => 'site_badge', 'type' => 'text', 'title' => 'Site Badge', 'default' => 'Premium' ),
            array( 'id' => 'admin_email', 'type' => 'email', 'title' => 'Admin Email', 'default' => 'admin@example.com' ),
            array( 'id' => 'website_url', 'type' => 'url', 'title' => 'Website URL', 'default' => 'https://example.com' ),
            array( 'id' => 'site_intro', 'type' => 'textarea', 'title' => 'Intro Text', 'default' => 'Build beautiful settings panels with Kavro.' ),
            array( 'id' => 'enable_feature', 'type' => 'switcher', 'title' => 'Enable Feature', 'default' => '1' ),
            array( 'id' => 'layout_style', 'type' => 'select', 'title' => 'Layout Style', 'default' => 'boxed', 'options' => array( 'boxed' => 'Boxed', 'wide' => 'Wide', 'fluid' => 'Fluid' ) ),
            array( 'id' => 'layout_radio', 'type' => 'radio', 'title' => 'Layout Radio', 'default' => 'left', 'options' => array( 'left' => 'Left', 'center' => 'Center', 'right' => 'Right' ) ),
            array( 'id' => 'button_choice', 'type' => 'button_set', 'title' => 'Button Set', 'default' => 'medium', 'options' => array( 'small' => 'Small', 'medium' => 'Medium', 'large' => 'Large' ) ),
        ),
        'children' => array(
            array(
                'id'       => 'branding',
                'title'    => 'Branding',
                'subtitle' => 'Logo, colors and identity controls.',
                'fields'   => array(
                    array( 'id' => 'brand_logo', 'type' => 'media', 'title' => 'Brand Logo' ),
                    array( 'id' => 'brand_color', 'type' => 'color', 'title' => 'Brand Color', 'default' => '#4f46e5' ),
                    array( 'id' => 'accent_color', 'type' => 'color', 'title' => 'Accent Color', 'default' => '#06b6d4' ),
                    array( 'id' => 'brand_name', 'type' => 'text', 'title' => 'Brand Name', 'default' => 'Kavro' ),
                ),
                'children' => array(
                    array(
                        'id'     => 'logo-settings',
                        'title'  => 'Logo Settings',
                        'fields' => array(
                            array( 'id' => 'logo_width', 'type' => 'number', 'title' => 'Logo Width', 'default' => '160' ),
                            array( 'id' => 'logo_dimensions', 'type' => 'dimensions', 'title' => 'Logo Dimensions', 'default' => array( 'width' => '160', 'height' => '60' ) ),
                            array( 'id' => 'sticky_logo', 'type' => 'upload', 'title' => 'Sticky Logo' ),
                        ),
                        'children' => array(
                            array(
                                'id'     => 'retina-logo',
                                'title'  => 'Retina Logo',
                                'fields' => array(
                                    array( 'id' => 'retina_logo', 'type' => 'image', 'title' => '2x Logo' ),
                                    array( 'id' => 'retina_notice', 'type' => 'content', 'content' => '<p>Use a double-size image for sharper screens.</p>' ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'id'     => 'typography',
                'title'  => 'Typography',
                'fields' => array(
                    array( 'id' => 'body_typography', 'type' => 'typography', 'title' => 'Body Typography', 'default' => array( 'family' => 'Inter', 'size' => '16', 'color' => '#334155' ) ),
                    array( 'id' => 'heading_typography', 'type' => 'typography', 'title' => 'Heading Typography', 'default' => array( 'family' => 'Inter', 'size' => '32', 'color' => '#111827' ) ),
                ),
            ),
            array(
                'id'     => 'performance',
                'title'  => 'Performance',
                'fields' => array(
                    array( 'id' => 'minify_css', 'type' => 'checkbox', 'title' => 'Minify CSS', 'label' => 'Enable CSS minification', 'default' => '1' ),
                    array( 'id' => 'lazy_assets', 'type' => 'switcher', 'title' => 'Lazy Load Assets', 'default' => '1' ),
                    array( 'id' => 'cache_ttl', 'type' => 'number', 'title' => 'Cache TTL', 'default' => '3600' ),
                ),
            ),
        ),
    ) );

    KAVRO::createSection( $prefix, array(
        'id'       => 'design',
        'title'    => 'Design',
        'subtitle' => 'Visual style controls.',
        'fields'   => array(
            array( 'type' => 'heading', 'content' => 'Design Controls' ),
            array( 'id' => 'body_bg', 'type' => 'color', 'title' => 'Body Background', 'default' => '#ffffff' ),
            array( 'id' => 'container_spacing', 'type' => 'spacing', 'title' => 'Container Spacing', 'default' => array( 'top' => '40', 'right' => '24', 'bottom' => '40', 'left' => '24' ) ),
            array( 'id' => 'border_radius', 'type' => 'range', 'title' => 'Border Radius', 'default' => '16', 'min' => '0', 'max' => '60', 'step' => '1' ),
            array( 'id' => 'custom_css', 'type' => 'code', 'title' => 'Custom CSS', 'default' => '.site-header { }' ),
        ),
        'children' => array(
            array(
                'id'     => 'cards',
                'title'  => 'Cards',
                'fields' => array(
                    array( 'id' => 'card_radius', 'type' => 'number', 'title' => 'Card Radius', 'default' => '20' ),
                    array( 'id' => 'card_shadow', 'type' => 'switcher', 'title' => 'Card Shadow', 'default' => '1' ),
                ),
            ),
            array(
                'id'     => 'buttons',
                'title'  => 'Buttons',
                'fields' => array(
                    array( 'id' => 'button_size', 'type' => 'button_set', 'title' => 'Button Size', 'default' => 'md', 'options' => array( 'sm' => 'Small', 'md' => 'Medium', 'lg' => 'Large' ) ),
                    array( 'id' => 'button_radius', 'type' => 'range', 'title' => 'Button Radius', 'default' => '12', 'min' => '0', 'max' => '40' ),
                ),
            ),
        ),
    ) );

    KAVRO::createSection( $prefix, array(
        'id'       => 'advanced',
        'title'    => 'Advanced',
        'subtitle' => 'Developer and repeatable controls.',
        'fields'   => array(
            array( 'id' => 'api_key', 'type' => 'password', 'title' => 'API Key' ),
            array( 'id' => 'launch_date', 'type' => 'date', 'title' => 'Launch Date' ),
            array( 'id' => 'launch_time', 'type' => 'time', 'title' => 'Launch Time' ),
            array( 'id' => 'cta_items', 'type' => 'repeater', 'title' => 'CTA Items', 'fields' => array(
                array( 'id' => 'title', 'type' => 'text', 'title' => 'Title' ),
                array( 'id' => 'url', 'type' => 'url', 'title' => 'URL' ),
            ) ),
        ),
    ) );
}
