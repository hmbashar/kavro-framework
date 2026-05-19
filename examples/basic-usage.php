<?php
/**
 * Kavro Framework file: examples/basic-usage.php.
 *
 * This file is part of the Kavro options framework and is intentionally kept
 * focused on one responsibility for easier maintenance and extension.
 *
 * @package Kavro
 */

// Paste into a theme functions.php or custom plugin after Kavro Framework is active.
if ( class_exists( 'KAVRO' ) ) {
    $prefix = 'my_kavro_options';

    KAVRO::createOptions( $prefix, array(
        'menu_title' => 'Kavro Demo',
        'menu_slug'  => 'kavro-demo',
        'menu_icon'      => 'dashicons-admin-customizer',
        'footer_credit'  => 'Kavro Framework © Md Abul Bashar · hmbashar.com · facebook.com/hmbashar',
    ) );

    KAVRO::createSection( $prefix, array(
        'id'       => 'general',
        'title'    => 'General',
        'subtitle' => 'Basic fields and global settings. Nesting is handled only through the children array.',
        'fields'   => array(
            array( 'type' => 'notice', 'style' => 'info', 'content' => 'Kavro sections do not need a parent key. Add nested sections inside children.' ),
            array( 'id' => 'internal_token', 'type' => 'hidden', 'default' => 'demo-hidden-value' ),
            array( 'id' => 'site_badge', 'type' => 'text', 'title' => 'Site Badge', 'default' => 'Premium' ),
            array( 'id' => 'admin_email', 'type' => 'email', 'title' => 'Admin Email', 'default' => 'admin@example.com' ),
            array( 'id' => 'website_url', 'type' => 'url', 'title' => 'Website URL', 'default' => 'https://example.com' ),
            array( 'id' => 'site_intro', 'type' => 'textarea', 'title' => 'Intro Text', 'default' => 'Build beautiful settings panels with Kavro.' ),
            array( 'id' => 'enable_feature', 'type' => 'switcher', 'title' => 'Enable Feature', 'default' => '1' ),
            array( 'id' => 'show_toolbar', 'type' => 'checkbox', 'title' => 'Show Toolbar', 'default' => '1' ),
            array( 'id' => 'layout_style', 'type' => 'select', 'title' => 'Layout Style', 'default' => 'boxed', 'options' => array( 'boxed' => 'Boxed', 'wide' => 'Wide', 'fluid' => 'Fluid' ) ),
            array( 'id' => 'sidebar_position', 'type' => 'radio', 'title' => 'Sidebar Position', 'default' => 'right', 'options' => array( 'left' => 'Left', 'right' => 'Right', 'none' => 'None' ) ),
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
                    array( 'id' => 'brand_primary_color', 'type' => 'color', 'title' => 'Primary Color', 'default' => '#5b5cf6' ),
                    array( 'id' => 'brand_colors', 'type' => 'color_group', 'title' => 'Brand Colors', 'options' => array( 'primary' => 'Primary', 'secondary' => 'Secondary', 'accent' => 'Accent' ), 'default' => array( 'primary' => '#5b5cf6', 'secondary' => '#06b6d4', 'accent' => '#f97316' ) ),
                    array( 'id' => 'brand_palette', 'type' => 'palette', 'title' => 'Palette', 'default' => 'indigo', 'options' => array( 'indigo' => array( '#4f46e5', '#06b6d4', '#111827' ), 'rose' => array( '#e11d48', '#fb7185', '#1f2937' ), 'emerald' => array( '#059669', '#34d399', '#0f172a' ) ) ),
                    array( 'id' => 'brand_name', 'type' => 'text', 'title' => 'Brand Name', 'default' => 'Kavro' ),
                    array( 'id' => 'theme_mode_preview', 'type' => 'image_select', 'title' => 'Theme Preview', 'default' => 'light', 'options' => array( 'light' => array( 'label' => 'Light', 'image' => 'https://placehold.co/320x190/f8fafc/111827?text=Light' ), 'dark' => array( 'label' => 'Dark', 'image' => 'https://placehold.co/320x190/111827/f8fafc?text=Dark' ), 'gradient' => array( 'label' => 'Gradient', 'image' => 'https://placehold.co/320x190/635bff/ffffff?text=Gradient' ) ) ),
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
                    array( 'id' => 'footer_editor', 'type' => 'wp_editor', 'title' => 'Footer Editor', 'default' => '<p>© Md Abul Bashar — hmbashar.com — facebook.com/hmbashar</p>' ),
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
            array( 'id' => 'shadow_strength', 'type' => 'slider', 'title' => 'Shadow Strength', 'default' => '24', 'min' => '0', 'max' => '100', 'step' => '1' ),
            array( 'id' => 'custom_css', 'type' => 'code', 'title' => 'Custom CSS', 'default' => '.site-header { }' ),
            array( 'id' => 'link_colors', 'type' => 'link_color', 'title' => 'Link Colors', 'default' => array( 'normal' => '#4f46e5', 'hover' => '#06b6d4', 'active' => '#111827' ) ),
        ),
        'children' => array(
            array(
                'id'     => 'buttons',
                'title'  => 'Buttons',
                'fields' => array(
                    array( 'id' => 'button_size', 'type' => 'button_set', 'title' => 'Button Size', 'default' => 'md', 'options' => array( 'sm' => 'Small', 'md' => 'Medium', 'lg' => 'Large' ) ),
                    array( 'id' => 'button_link', 'type' => 'link', 'title' => 'Button Link', 'default' => array( 'url' => 'https://example.com', 'text' => 'Learn More' ) ),
                    array( 'id' => 'button_radius', 'type' => 'range', 'title' => 'Button Radius', 'default' => '12', 'min' => '0', 'max' => '40' ),
                    array( 'id' => 'button_hover_shadow', 'type' => 'slider', 'title' => 'Hover Shadow', 'default' => '35', 'min' => '0', 'max' => '100' ),
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
            array( 'id' => 'maintenance_until', 'type' => 'datetime', 'title' => 'Maintenance Until' ),
            array( 'id' => 'custom_variables', 'type' => 'key_value', 'title' => 'Custom Variables', 'default' => array( array( 'key' => 'environment', 'value' => 'production' ), array( 'key' => 'cache', 'value' => 'enabled' ) ) ),
            array( 'id' => 'beta_toggle', 'type' => 'toggle', 'title' => 'Beta Toggle', 'default' => '1' ),
            array( 'id' => 'cta_items', 'type' => 'repeater', 'title' => 'CTA Items', 'fields' => array(
                array( 'id' => 'title', 'type' => 'text', 'title' => 'Title' ),
                array( 'id' => 'url', 'type' => 'url', 'title' => 'URL' ),
            ) ),
        ),
    ) );

    KAVRO::createSection( $prefix, array(
        'id'       => 'premium-fields',
        'title'    => 'Premium Fields',
        'subtitle' => 'A larger collection of polished field demos for testing Kavro UI behavior.',
        'fields'   => array(
            array( 'type' => 'subheading', 'content' => 'Interactive Controls' ),
            array( 'id' => 'items_per_page', 'type' => 'spinner', 'title' => 'Items Per Page', 'default' => '12', 'min' => '1', 'max' => '100', 'step' => '1', 'desc' => 'Premium number spinner with plus/minus controls.' ),
            array( 'id' => 'feature_icon', 'type' => 'icon', 'title' => 'Feature Icon', 'default' => 'dashicons-star-filled' ),
            array( 'id' => 'hero_gallery', 'type' => 'gallery', 'title' => 'Hero Gallery', 'desc' => 'Select multiple images from the WordPress media library.' ),
            array( 'type' => 'divider' ),
            array( 'type' => 'subheading', 'content' => 'Structured Data' ),
            array( 'id' => 'social_links', 'type' => 'fieldset', 'title' => 'Social Links', 'fields' => array(
                array( 'id' => 'facebook', 'type' => 'url', 'title' => 'Facebook', 'placeholder' => 'https://facebook.com/...' ),
                array( 'id' => 'twitter', 'type' => 'url', 'title' => 'Twitter / X', 'placeholder' => 'https://x.com/...' ),
                array( 'id' => 'linkedin', 'type' => 'url', 'title' => 'LinkedIn', 'placeholder' => 'https://linkedin.com/...' ),
            ) ),
            array( 'id' => 'team_members', 'type' => 'group', 'title' => 'Team Members', 'fields' => array(
                array( 'id' => 'name', 'type' => 'text', 'title' => 'Name' ),
                array( 'id' => 'role', 'type' => 'text', 'title' => 'Role' ),
                array( 'id' => 'url', 'type' => 'url', 'title' => 'Profile URL' ),
            ) ),
            array( 'type' => 'divider' ),
            array( 'type' => 'subheading', 'content' => 'Layout Helpers' ),
            array( 'id' => 'enabled_blocks', 'type' => 'sortable', 'title' => 'Sortable Blocks', 'default' => array( 'hero', 'features', 'pricing' ), 'options' => array( 'hero' => 'Hero', 'features' => 'Features', 'pricing' => 'Pricing', 'faq' => 'FAQ', 'footer' => 'Footer' ) ),
            array( 'id' => 'homepage_sorter', 'type' => 'sorter', 'title' => 'Homepage Sorter', 'default' => array( 'enabled' => array( 'hero', 'features' ) ), 'options' => array( 'hero' => 'Hero', 'features' => 'Features', 'testimonials' => 'Testimonials', 'pricing' => 'Pricing' ) ),
            array( 'id' => 'help_accordion', 'type' => 'accordion', 'title' => 'Accordion Help', 'items' => array(
                array( 'title' => 'Why Kavro?', 'content' => '<p>Kavro is designed as a modern developer-first options framework.</p>' ),
                array( 'title' => 'Nested menus', 'content' => '<p>Use the children array to create nested section trees.</p>' ),
            ) ),
            array( 'id' => 'docs_tabs', 'type' => 'tabbed', 'title' => 'Tabbed Content', 'tabs' => array(
                array( 'title' => 'Admin', 'content' => '<p>Admin option panels are included in the free core.</p>' ),
                array( 'title' => 'Metabox', 'content' => '<p>Metabox APIs can be built on top of the same field registry.</p>' ),
                array( 'title' => 'Customizer', 'content' => '<p>Customizer support can reuse the same field configuration style.</p>' ),
            ) ),
            array( 'type' => 'divider' ),
            array( 'type' => 'subheading', 'content' => 'Extra Input Types' ),
            array( 'id' => 'support_phone', 'type' => 'tel', 'title' => 'Support Phone', 'default' => '+1 555 0100' ),
            array( 'id' => 'billing_month', 'type' => 'month', 'title' => 'Billing Month', 'default' => '2026-05' ),
            array( 'id' => 'release_week', 'type' => 'week', 'title' => 'Release Week', 'default' => '2026-W21' ),
            array( 'id' => 'license_status', 'type' => 'readonly', 'title' => 'License Status', 'default' => 'Active Demo License' ),
            array( 'id' => 'api_endpoint_copy', 'type' => 'copy', 'title' => 'Copy Endpoint', 'default' => 'https://example.com/wp-json/kavro/v1/options' ),
            array( 'id' => 'preview_button_url', 'type' => 'button', 'title' => 'Button Field', 'label' => 'Preview Link', 'url' => 'https://hmbashar.com', 'default' => 'https://hmbashar.com' ),
            array( 'id' => 'rich_html_preview', 'type' => 'html', 'title' => 'HTML Preview', 'content' => '<strong>Premium preview block</strong><p>This field renders safe HTML with premium card styling.</p>' ),
            array( 'id' => 'video_embed_url', 'type' => 'oembed', 'title' => 'oEmbed URL', 'default' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ' ),
            array( 'id' => 'backup_payload', 'type' => 'backup', 'title' => 'Backup Payload' ),
        ),
    ) );


    KAVRO::createSection( $prefix, array(
        'id'       => 'extended-fields',
        'title'    => 'Extended Fields',
        'subtitle' => 'Additional advanced controls for layout, branding, marketing, and structured data.',
        'fields'   => array(
            array( 'type' => 'subheading', 'content' => 'Visual Design Controls' ),
            array( 'id' => 'hero_max_width', 'type' => 'unit', 'title' => 'Hero Max Width', 'default' => array( 'value' => '1280', 'unit' => 'px' ), 'units' => array( 'px' => 'px', '%' => '%', 'rem' => 'rem', 'vw' => 'vw' ) ),
            array( 'id' => 'brand_gradient', 'type' => 'gradient', 'title' => 'Brand Gradient', 'default' => array( 'from' => '#6d5dfc', 'to' => '#10b6d8', 'direction' => '135deg' ) ),
            array( 'id' => 'card_shadow', 'type' => 'box_shadow', 'title' => 'Card Shadow', 'default' => array( 'x' => '0', 'y' => '24', 'blur' => '60', 'spread' => '0', 'color' => 'rgba(15,23,42,.16)' ) ),
            array( 'id' => 'completion_score', 'type' => 'progress', 'title' => 'Completion Score', 'default' => '72' ),
            array( 'id' => 'quality_rating', 'type' => 'rating', 'title' => 'Quality Rating', 'default' => '5', 'max' => 5 ),
            array( 'type' => 'divider' ),
            array( 'type' => 'subheading', 'content' => 'Marketing & Content' ),
            array( 'id' => 'primary_cta', 'type' => 'link_group', 'title' => 'Primary CTA', 'default' => array( 'label' => 'Get Started', 'url' => 'https://hmbashar.com', 'target' => '_blank' ) ),
            array( 'id' => 'profile_links', 'type' => 'social_links', 'title' => 'Social Links', 'default' => array( 'facebook' => 'https://facebook.com/hmbashar', 'github' => 'https://github.com/hmbashar' ) ),
            array( 'id' => 'feature_bullets', 'type' => 'text_list', 'title' => 'Feature Bullets', 'default' => "Fast setup\nPremium UI\nNested settings" ),
            array( 'id' => 'tracking_embed', 'type' => 'embed', 'title' => 'Tracking Embed Code', 'default' => '<!-- Paste analytics/embed code here -->' ),
            array( 'id' => 'schema_json', 'type' => 'json', 'title' => 'Schema JSON', 'default' => '{"@type":"SoftwareApplication","name":"Kavro Framework"}' ),
            array( 'type' => 'divider' ),
            array( 'type' => 'subheading', 'content' => 'Location Data' ),
            array( 'id' => 'office_location', 'type' => 'map', 'title' => 'Office Coordinates', 'default' => array( 'lat' => '23.8103', 'lng' => '90.4125', 'zoom' => '12' ) ),
        ),
    ) );


    KAVRO::createSection( $prefix, array(
        'id'       => 'wp-content-fields',
        'title'    => 'WP Content Fields',
        'subtitle' => 'Post, page, custom post type, taxonomy, term, user, role, menu, sidebar, and template selectors.',
        'fields'   => array(
            array( 'type' => 'subheading', 'content' => 'Posts & Pages' ),
            array( 'id' => 'demo_post_select', 'type' => 'post_select', 'title' => 'Post Select', 'post_type' => 'post', 'desc' => 'Dropdown populated from published posts.' ),
            array( 'id' => 'demo_post_checkbox', 'type' => 'post_checkbox', 'title' => 'Post Checkbox', 'post_type' => 'post', 'desc' => 'Multiple post selection using premium checkbox cards.' ),
            array( 'id' => 'demo_post_radio', 'type' => 'post_radio', 'title' => 'Post Radio', 'post_type' => 'post', 'desc' => 'Single post selection using radio cards.' ),
            array( 'id' => 'demo_post_autocomplete', 'type' => 'post_autocomplete', 'title' => 'Post Autocomplete', 'post_type' => 'post', 'desc' => 'Searchable post selector.' ),
            array( 'id' => 'demo_post_relation', 'type' => 'post_relation', 'title' => 'Post Relation', 'post_type' => array( 'post', 'page' ), 'desc' => 'Multiple relationship selector across posts and pages.' ),
            array( 'id' => 'demo_page_select', 'type' => 'page_select', 'title' => 'Page Select', 'desc' => 'Dropdown populated from pages.' ),
            array( 'id' => 'demo_cpt_select', 'type' => 'cpt_select', 'title' => 'CPT Select', 'post_type' => array( 'post', 'page' ), 'desc' => 'Select from one or more public post types. Replace with your CPT slug, e.g. portfolio.' ),
            array( 'type' => 'divider' ),
            array( 'type' => 'subheading', 'content' => 'Taxonomies & Terms' ),
            array( 'id' => 'demo_taxonomy_select', 'type' => 'taxonomy_select', 'title' => 'Taxonomy Select', 'desc' => 'Dropdown populated from public taxonomies.' ),
            array( 'id' => 'demo_taxonomy_checkbox', 'type' => 'taxonomy_checkbox', 'title' => 'Taxonomy Checkbox', 'taxonomy' => 'category', 'desc' => 'Multiple term selection from categories.' ),
            array( 'id' => 'demo_taxonomy_radio', 'type' => 'taxonomy_radio', 'title' => 'Taxonomy Radio', 'taxonomy' => 'category', 'desc' => 'Single term selection from categories.' ),
            array( 'id' => 'demo_term_relation', 'type' => 'term_relation', 'title' => 'Term Relation', 'taxonomy' => array( 'category', 'post_tag' ), 'desc' => 'Searchable multiple term relationship selector.' ),
            array( 'type' => 'divider' ),
            array( 'type' => 'subheading', 'content' => 'WordPress System Selectors' ),
            array( 'id' => 'demo_user_select', 'type' => 'user_select', 'title' => 'User Select', 'desc' => 'Dropdown populated from WordPress users.' ),
            array( 'id' => 'demo_role_select', 'type' => 'role_select', 'title' => 'Role Select', 'desc' => 'Dropdown populated from registered WordPress roles.' ),
            array( 'id' => 'demo_menu_select', 'type' => 'menu_select', 'title' => 'Menu Select', 'desc' => 'Dropdown populated from navigation menus.' ),
            array( 'id' => 'demo_sidebar_select', 'type' => 'sidebar_select', 'title' => 'Sidebar Select', 'desc' => 'Dropdown populated from registered sidebars.' ),
            array( 'id' => 'demo_template_select', 'type' => 'template_select', 'title' => 'Template Select', 'desc' => 'Dropdown populated from the active theme page templates.' ),
        ),
    ) );


    KAVRO::createSection( $prefix, array(
        'id'       => 'developer-fields',
        'title'    => 'Developer Fields',
        'subtitle' => 'Custom render callbacks and premium searchable Select2-style controls.',
        'fields'   => array(
            array( 'type' => 'subheading', 'content' => 'Custom Field Rendering' ),
            array(
                'id'    => 'demo_custom_html',
                'type'  => 'custom',
                'title' => 'Custom HTML Field',
                'html'  => '<strong>Custom field output</strong><p>Use html, callback, or kavro_custom_field_{id} action to render custom UI.</p>',
                'desc'  => 'This is useful when a theme/plugin needs a one-off custom control.',
            ),
            array(
                'id'       => 'demo_custom_callback',
                'type'     => 'custom',
                'title'    => 'Custom Callback Field',
                'callback' => function( $field, $value, $unique, $name, $id ) {
                    printf(
                        '<input type="text" id="kavro-%1$s" name="%2$s" value="%3$s" placeholder="Rendered by custom callback">',
                        esc_attr( $id ),
                        esc_attr( $name ),
                        esc_attr( $value )
                    );
                },
                'default'  => 'Callback rendered value',
                'desc'     => 'The callback receives field, value, unique option key, input name, and field id.',
            ),
            array( 'type' => 'divider' ),
            array( 'type' => 'subheading', 'content' => 'Select2-style Searchable Controls' ),
            array(
                'id'          => 'demo_select2_single',
                'type'        => 'select2',
                'title'       => 'Select2 Single',
                'placeholder' => 'Choose a framework area',
                'options'     => array( 'admin' => 'Admin Options', 'customizer' => 'Customizer', 'metabox' => 'Metabox', 'taxonomy' => 'Taxonomy', 'profile' => 'User Profile' ),
                'desc'        => 'Dependency-free Kavro Select2-style searchable select.',
            ),
            array(
                'id'          => 'demo_select2_multiple',
                'type'        => 'select2',
                'title'       => 'Select2 Multiple',
                'multiple'    => true,
                'placeholder' => 'Choose supported modules',
                'options'     => array( 'options' => 'Options', 'fields' => 'Fields', 'backup' => 'Backup', 'import' => 'Import', 'export' => 'Export', 'api' => 'Developer API' ),
                'default'     => array( 'options', 'fields' ),
                'desc'        => 'Multiple values save as an array.',
            ),
            array(
                'id'          => 'demo_select_enhanced',
                'type'        => 'select',
                'title'       => 'Normal Select With Select2 Enabled',
                'select2'     => true,
                'placeholder' => 'Choose UI style',
                'options'     => array( 'glass' => 'Glass UI', 'minimal' => 'Minimal UI', 'premium' => 'Premium Gradient UI' ),
                'desc'        => 'Any normal select can opt into the enhanced UI with select2 => true.',
            ),
        ),
    ) );


    KAVRO::createSection( $prefix, array(
        'id'       => 'advanced-framework-fields',
        'title'    => 'Advanced Framework Fields',
        'subtitle' => 'Conditional logic, cloneable inputs, responsive values, builders, uploads, editors, and dynamic tags.',
        'fields'   => array(
            array( 'type' => 'subheading', 'content' => 'Conditional Logic' ),
            array( 'id' => 'demo_enable_advanced', 'type' => 'switcher', 'title' => 'Enable Advanced Fields', 'default' => true, 'desc' => 'Turn this off to test field dependency hiding.' ),
            array( 'id' => 'demo_dependent_text', 'type' => 'text', 'title' => 'Dependent Text Field', 'dependency' => array( 'field' => 'demo_enable_advanced', 'operator' => '==', 'value' => '1' ), 'default' => 'Visible only when enabled.' ),
            array( 'type' => 'divider' ),
            array( 'type' => 'subheading', 'content' => 'Repeatable & Searchable' ),
            array( 'id' => 'demo_cloneable', 'type' => 'cloneable', 'title' => 'Cloneable Text List', 'placeholder' => 'Add item', 'default' => array( 'Header', 'Footer' ) ),
            array( 'id' => 'demo_ajax_select', 'type' => 'ajax_select', 'title' => 'AJAX-ready Select', 'select2' => true, 'multiple' => true, 'options' => array( 'local-one' => 'Local Option One', 'local-two' => 'Local Option Two' ), 'desc' => 'Prepared for remote results; local options work now.' ),
            array( 'type' => 'divider' ),
            array( 'type' => 'subheading', 'content' => 'Responsive & Builder Fields' ),
            array( 'id' => 'demo_responsive_value', 'type' => 'responsive_value', 'title' => 'Responsive Value', 'default' => array( 'desktop' => '80px', 'tablet' => '48px', 'mobile' => '32px' ) ),
            array( 'id' => 'demo_css_builder', 'type' => 'css_builder', 'title' => 'CSS Builder', 'default' => array( 'selector' => '.site-header', 'property' => 'background-color', 'value' => '#ffffff' ) ),
            array( 'id' => 'demo_device_preview', 'type' => 'device_preview', 'title' => 'Device Preview Notes', 'default' => array( 'content' => 'Preview notes for desktop, tablet, and mobile layouts.' ) ),
            array( 'type' => 'divider' ),
            array( 'type' => 'subheading', 'content' => 'Fonts, Editors & Uploads' ),
            array( 'id' => 'demo_google_fonts', 'type' => 'google_fonts', 'title' => 'Google Font Family', 'default' => 'Inter' ),
            array( 'id' => 'demo_css_editor', 'type' => 'css_editor', 'title' => 'CSS Editor', 'default' => '.kavro-demo { color: #4f46e5; }' ),
            array( 'id' => 'demo_js_editor', 'type' => 'js_editor', 'title' => 'JS Editor', 'default' => 'console.log("Kavro");' ),
            array( 'id' => 'demo_file_upload', 'type' => 'file_upload', 'title' => 'File Upload' ),
            array( 'id' => 'demo_video_upload', 'type' => 'video_upload', 'title' => 'Video Upload' ),
            array( 'id' => 'demo_audio_upload', 'type' => 'audio_upload', 'title' => 'Audio Upload' ),
            array( 'type' => 'divider' ),
            array( 'type' => 'subheading', 'content' => 'Dynamic Tags' ),
            array( 'id' => 'demo_dynamic_tags', 'type' => 'dynamic_tags', 'title' => 'Dynamic Tag Text', 'default' => 'Copyright {{current_year}} {{site_title}}' ),
        ),
    ) );



    KAVRO::createSection( $prefix, array(
        'id'       => 'next-advanced-fields',
        'title'    => 'Next Advanced Fields',
        'subtitle' => 'Builder-style and advanced design controls added for the next development step.',
        'fields'   => array(
            array( 'type' => 'subheading', 'content' => 'Advanced Design Controls' ),
            array( 'id' => 'advanced_radius', 'type' => 'border_radius', 'title' => 'Border Radius Advanced', 'default' => array( 'top_left' => '16px', 'top_right' => '16px', 'bottom_right' => '16px', 'bottom_left' => '16px' ) ),
            array( 'id' => 'advanced_box_model', 'type' => 'box_model', 'title' => 'Box Model', 'default' => array( 'margin' => array( 'top' => '0', 'right' => 'auto', 'bottom' => '24px', 'left' => 'auto' ), 'padding' => array( 'top' => '24px', 'right' => '24px', 'bottom' => '24px', 'left' => '24px' ) ) ),
            array( 'id' => 'advanced_dimensions', 'type' => 'dimensions_advanced', 'title' => 'Advanced Dimensions', 'default' => array( 'width' => '1200px', 'height' => 'auto', 'min_width' => '320px', 'max_width' => '100%' ) ),
            array( 'id' => 'advanced_spacing', 'type' => 'spacing_advanced', 'title' => 'Advanced Spacing', 'default' => array( 'top' => '40px', 'right' => '24px', 'bottom' => '40px', 'left' => '24px' ) ),
            array( 'id' => 'advanced_typography', 'type' => 'typography_advanced', 'title' => 'Advanced Typography', 'default' => array( 'family' => 'Inter', 'size' => '18px', 'weight' => '700', 'line_height' => '1.5', 'letter_spacing' => '-0.01em', 'color' => '#111827' ) ),
            array( 'id' => 'alpha_color', 'type' => 'color_picker_alpha', 'title' => 'Alpha Color Picker', 'default' => array( 'color' => '#635bff', 'alpha' => '0.85' ) ),
            array( 'type' => 'divider' ),
            array( 'type' => 'subheading', 'content' => 'Builder Fields' ),
            array( 'id' => 'conditional_rule', 'type' => 'conditional_group', 'title' => 'Conditional Group Rule', 'default' => array( 'field' => 'enable_feature', 'operator' => '==', 'value' => '1' ) ),
            array( 'id' => 'nested_repeater_schema', 'type' => 'repeater_nested', 'title' => 'Nested Repeater Schema', 'default' => '[{"title":"Parent row","children":[{"title":"Child row"}]}]' ),
            array( 'id' => 'homepage_query', 'type' => 'query_builder', 'title' => 'Query Builder', 'default' => array( 'post_type' => 'post', 'posts_per_page' => '6', 'orderby' => 'date', 'order' => 'DESC' ) ),
            array( 'id' => 'promo_shortcode', 'type' => 'shortcode_builder', 'title' => 'Shortcode Builder', 'default' => array( 'tag' => 'kavro_cta', 'attrs' => '{"style":"primary"}' ) ),
            array( 'id' => 'contact_form_schema', 'type' => 'form_builder', 'title' => 'Form Builder Schema', 'default' => '[{"label":"Name","type":"text"},{"label":"Email","type":"email"}]' ),
            array( 'id' => 'footer_menu_schema', 'type' => 'menu_builder', 'title' => 'Menu Builder Schema', 'default' => '[{"label":"Home","url":"/"},{"label":"Contact","url":"/contact"}]' ),
            array( 'id' => 'page_layout_builder', 'type' => 'layout_builder', 'title' => 'Layout Builder', 'default' => 'sidebar' ),
        ),
    ) );



    KAVRO::createSection( $prefix, array(
        'id'       => 'workflow-utility-fields',
        'title'    => 'Workflow Utility Fields',
        'subtitle' => 'Table, matrix, checklist, SEO, Open Graph, schedule, webhook, and permission helper fields.',
        'fields'   => array(
            array( 'type' => 'subheading', 'content' => 'Data & Layout Utilities' ),
            array( 'id' => 'demo_table', 'type' => 'table', 'title' => 'Simple Table', 'default' => array( 'rows' => array( array( 'label' => 'Starter', 'value' => '$19' ), array( 'label' => 'Pro', 'value' => '$49' ) ) ) ),
            array( 'id' => 'demo_matrix', 'type' => 'matrix', 'title' => 'Responsive Matrix', 'rows' => array( 'header' => 'Header', 'content' => 'Content', 'footer' => 'Footer' ), 'columns' => array( 'desktop' => 'Desktop', 'tablet' => 'Tablet', 'mobile' => 'Mobile' ) ),
            array( 'id' => 'demo_checklist', 'type' => 'checklist', 'title' => 'Launch Checklist', 'options' => array( 'docs' => 'Docs Ready', 'demo' => 'Demo Ready', 'tests' => 'Tests Passed', 'release' => 'Release Notes' ), 'default' => array( 'docs', 'demo' ) ),
            array( 'id' => 'demo_timeline', 'type' => 'timeline', 'title' => 'Roadmap Timeline', 'default' => array( 'items' => array( array( 'date' => 'Q1', 'title' => 'Admin Options', 'desc' => 'Core option framework.' ), array( 'date' => 'Q2', 'title' => 'Metabox', 'desc' => 'Post/page metabox builder.' ) ) ) ),
            array( 'type' => 'divider' ),
            array( 'type' => 'subheading', 'content' => 'SEO & Sharing' ),
            array( 'id' => 'demo_seo_preview', 'type' => 'seo_preview', 'title' => 'SEO Preview', 'default' => array( 'title' => 'Kavro Framework', 'url' => 'https://hmbashar.com/kavro', 'description' => 'A modern WordPress options framework for developers.' ) ),
            array( 'id' => 'demo_open_graph', 'type' => 'open_graph', 'title' => 'Open Graph Card' ),
            array( 'id' => 'demo_schema_markup', 'type' => 'schema_markup', 'title' => 'Schema Markup JSON', 'default' => '{"@context":"https://schema.org","@type":"SoftwareApplication","name":"Kavro Framework"}' ),
            array( 'type' => 'divider' ),
            array( 'type' => 'subheading', 'content' => 'Operations' ),
            array( 'id' => 'demo_business_hours', 'type' => 'business_hours', 'title' => 'Business Hours' ),
            array( 'id' => 'demo_webhook', 'type' => 'webhook', 'title' => 'Webhook Endpoint', 'default' => array( 'method' => 'POST' ) ),
            array( 'id' => 'demo_cron_schedule', 'type' => 'cron_schedule', 'title' => 'Cron Schedule', 'default' => array( 'frequency' => 'daily', 'time' => '09:00' ) ),
            array( 'id' => 'demo_capability_select', 'type' => 'capability_select', 'title' => 'Required Capability', 'default' => 'manage_options' ),
        ),
    ) );

}
