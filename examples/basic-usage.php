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
        'subtitle' => 'Basic fields and global settings. Nesting is handled only through the children array.',
        'fields'   => array(
            array( 'type' => 'notice', 'style' => 'info', 'content' => 'Kavro sections do not need a parent key. Add nested sections inside children.' ),
            array( 'id' => 'site_badge', 'type' => 'text', 'title' => 'Site Badge', 'default' => 'Premium' ),
            array( 'id' => 'admin_email', 'type' => 'email', 'title' => 'Admin Email', 'default' => 'admin@example.com' ),
            array( 'id' => 'website_url', 'type' => 'url', 'title' => 'Website URL', 'default' => 'https://example.com' ),
            array( 'id' => 'site_intro', 'type' => 'textarea', 'title' => 'Intro Text', 'default' => 'Build beautiful settings panels with Kavro.' ),
            array( 'id' => 'enable_feature', 'type' => 'switcher', 'title' => 'Enable Feature', 'default' => '1' ),
            array( 'id' => 'layout_style', 'type' => 'select', 'title' => 'Layout Style', 'default' => 'boxed', 'options' => array( 'boxed' => 'Boxed', 'wide' => 'Wide', 'fluid' => 'Fluid' ) ),
            array( 'id' => 'supported_modules', 'type' => 'multicheck', 'title' => 'Supported Modules', 'default' => array( 'admin', 'metabox' ), 'options' => array( 'admin' => 'Admin Options', 'customizer' => 'Customizer', 'metabox' => 'Metabox', 'taxonomy' => 'Taxonomy' ) ),
            array( 'id' => 'button_choice', 'type' => 'button_set', 'title' => 'Button Set', 'default' => 'medium', 'options' => array( 'small' => 'Small', 'medium' => 'Medium', 'large' => 'Large' ) ),
        ),
        'children' => array(
            array(
                'id'       => 'branding',
                'title'    => 'Branding',
                'subtitle' => 'Logo, colors and identity controls.',
                'fields'   => array(
                    array( 'id' => 'brand_logo', 'type' => 'media', 'title' => 'Brand Logo' ),
                    array( 'id' => 'brand_colors', 'type' => 'color_group', 'title' => 'Brand Colors', 'options' => array( 'primary' => 'Primary', 'secondary' => 'Secondary', 'accent' => 'Accent' ), 'default' => array( 'primary' => '#5b5cf6', 'secondary' => '#06b6d4', 'accent' => '#f97316' ) ),
                    array( 'id' => 'brand_palette', 'type' => 'palette', 'title' => 'Palette', 'default' => 'indigo', 'options' => array( 'indigo' => array( '#4f46e5', '#06b6d4', '#111827' ), 'rose' => array( '#e11d48', '#fb7185', '#1f2937' ), 'emerald' => array( '#059669', '#34d399', '#0f172a' ) ) ),
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
                    array( 'id' => 'editor_content', 'type' => 'wysiwyg', 'title' => 'Editor Content', 'default' => '<p>Hello from Kavro.</p>' ),
                ),
            ),
        ),
    ) );

    KAVRO::createSection( $prefix, array(
        'id'       => 'design',
        'title'    => 'Design',
        'subtitle' => 'Modern visual controls.',
        'fields'   => array(
            array( 'type' => 'heading', 'content' => 'Design Controls' ),
            array( 'id' => 'page_background', 'type' => 'background', 'title' => 'Page Background', 'default' => array( 'color' => '#ffffff', 'repeat' => 'no-repeat', 'position' => 'center center' ) ),
            array( 'id' => 'container_spacing', 'type' => 'spacing', 'title' => 'Container Spacing', 'default' => array( 'top' => '40', 'right' => '24', 'bottom' => '40', 'left' => '24' ) ),
            array( 'id' => 'card_border', 'type' => 'border', 'title' => 'Card Border', 'default' => array( 'width' => '1', 'style' => 'solid', 'color' => '#e2e8f0', 'radius' => '20' ) ),
            array( 'id' => 'border_radius', 'type' => 'range', 'title' => 'Border Radius', 'default' => '16', 'min' => '0', 'max' => '60', 'step' => '1' ),
            array( 'id' => 'custom_css', 'type' => 'code', 'title' => 'Custom CSS', 'default' => '.site-header { }' ),
        ),
        'children' => array(
            array(
                'id'     => 'buttons',
                'title'  => 'Buttons',
                'fields' => array(
                    array( 'id' => 'button_size', 'type' => 'button_set', 'title' => 'Button Size', 'default' => 'md', 'options' => array( 'sm' => 'Small', 'md' => 'Medium', 'lg' => 'Large' ) ),
                    array( 'id' => 'button_link', 'type' => 'link', 'title' => 'Button Link', 'default' => array( 'url' => 'https://example.com', 'text' => 'Learn More' ) ),
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
            array( 'id' => 'beta_toggle', 'type' => 'toggle', 'title' => 'Beta Toggle', 'default' => '1' ),
            array( 'id' => 'cta_items', 'type' => 'repeater', 'title' => 'CTA Items', 'fields' => array(
                array( 'id' => 'title', 'type' => 'text', 'title' => 'Title' ),
                array( 'id' => 'url', 'type' => 'url', 'title' => 'URL' ),
            ) ),
        ),
    ) );

    KAVRO::createSection( $prefix, array(
        'id'       => 'social',
        'title'    => 'Social & Contact',
        'subtitle' => 'Configure your social profile links and contact details.',
        'fields'   => array(
            array( 'id' => 'social_facebook', 'type' => 'url', 'title' => 'Facebook URL', 'default' => 'https://facebook.com/' ),
            array( 'id' => 'social_twitter', 'type' => 'url', 'title' => 'Twitter URL', 'default' => 'https://twitter.com/' ),
            array( 'id' => 'social_instagram', 'type' => 'url', 'title' => 'Instagram URL', 'default' => 'https://instagram.com/' ),
            array( 'id' => 'contact_phone', 'type' => 'text', 'title' => 'Phone Number', 'default' => '+1 (555) 000-0000' ),
        ),
    ) );

    KAVRO::createSection( $prefix, array(
        'id'       => 'misc',
        'title'    => 'Additional Demos',
        'subtitle' => 'Demos for other field types.',
        'fields'   => array(
            array( 'id' => 'demo_checkbox', 'type' => 'checkbox', 'title' => 'Single Checkbox', 'label' => 'I agree to the terms and conditions', 'default' => '0' ),
            array( 'id' => 'demo_radio', 'type' => 'radio', 'title' => 'Radio Select', 'default' => 'blue', 'options' => array( 'red' => 'Red', 'blue' => 'Blue', 'green' => 'Green' ) ),
            array( 'id' => 'demo_hidden', 'type' => 'hidden', 'default' => 'hidden_value_123' ),
        ),
    ) );
}
