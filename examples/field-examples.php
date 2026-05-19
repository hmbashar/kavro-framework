<?php
/**
 * Kavro Framework shared demo field examples.
 *
 * This file returns clean, developer-friendly field examples used by both the
 * options demo and metabox demo. Keeping the examples in one place makes it
 * easier to confirm that each Kavro field type works in both storage contexts.
 *
 * @package Kavro\Examples
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! function_exists( 'kavro_demo_field_sections' ) ) {
    /**
     * Return grouped field examples for demo screens.
     *
     * @param string $context Demo context. Accepts `options` or `metabox`.
     * @return array[] Section arrays with field examples.
     */
    function kavro_demo_field_sections( $context = 'options' ) {
        $context = sanitize_key( $context );

        return array(

            // Section: Basic Input Fields.
            array(
                'title'    => 'Basic Input Fields',
                'subtitle' => 'Complete basic input fields examples for the ' . $context . ' demo.',
                'fields'   => array(

                    // Field: text.
                    array(
                                            'id' => 'demo_text',
                                            'type' => 'text',
                                            'title' => 'Text',
                                            'default' => 'Demo Text',
                                            'desc' => 'Demo example for the text field.',
                                        ),

                    // Field: textarea.
                    array(
                                            'id' => 'demo_textarea',
                                            'type' => 'textarea',
                                            'title' => 'Textarea',
                                            'default' => 'Example content',
                                            'desc' => 'Demo example for the textarea field.',
                                        ),

                    // Field: checkbox.
                    array(
                                            'id' => 'demo_checkbox',
                                            'type' => 'checkbox',
                                            'title' => 'Checkbox',
                                            'default' => '1',
                                            'desc' => 'Demo example for the checkbox field.',
                                        ),

                    // Field: switcher.
                    array(
                                            'id' => 'demo_switcher',
                                            'type' => 'switcher',
                                            'title' => 'Switcher',
                                            'default' => '1',
                                            'desc' => 'Demo example for the switcher field.',
                                        ),

                    // Field: toggle.
                    array(
                                            'id' => 'demo_toggle',
                                            'type' => 'toggle',
                                            'title' => 'Toggle',
                                            'default' => '1',
                                            'desc' => 'Demo example for the toggle field.',
                                        ),

                    // Field: select.
                    array(
                                            'id' => 'demo_select',
                                            'type' => 'select',
                                            'title' => 'Select',
                                            'options' => array(
                                                'one' => 'One',
                                                'two' => 'Two',
                                                'three' => 'Three',
                                            ),
                                            'default' => 'two',
                                            'desc' => 'Demo example for the select field.',
                                        ),

                    // Field: radio.
                    array(
                                            'id' => 'demo_radio',
                                            'type' => 'radio',
                                            'title' => 'Radio',
                                            'options' => array(
                                                'one' => 'One',
                                                'two' => 'Two',
                                                'three' => 'Three',
                                            ),
                                            'default' => 'two',
                                            'desc' => 'Demo example for the radio field.',
                                        ),

                    // Field: button_set.
                    array(
                                            'id' => 'demo_button_set',
                                            'type' => 'button_set',
                                            'title' => 'Button Set',
                                            'options' => array(
                                                'one' => 'One',
                                                'two' => 'Two',
                                                'three' => 'Three',
                                            ),
                                            'default' => 'two',
                                            'desc' => 'Demo example for the button_set field.',
                                        ),

                    // Field: color.
                    array(
                                            'id' => 'demo_color',
                                            'type' => 'color',
                                            'title' => 'Color',
                                            'default' => '#5b5cf6',
                                            'desc' => 'Demo example for the color field.',
                                        ),

                    // Field: number.
                    array(
                                            'id' => 'demo_number',
                                            'type' => 'number',
                                            'title' => 'Number',
                                            'default' => '5',
                                            'min' => '0',
                                            'max' => '10',
                                            'step' => '1',
                                            'desc' => 'Demo example for the number field.',
                                        ),

                    // Field: spinner.
                    array(
                                            'id' => 'demo_spinner',
                                            'type' => 'spinner',
                                            'title' => 'Spinner',
                                            'default' => '5',
                                            'min' => '0',
                                            'max' => '10',
                                            'step' => '1',
                                            'desc' => 'Demo example for the spinner field.',
                                        ),

                    // Field: content.
                    array(
                                            'type' => 'content',
                                            'content' => '<p>This content block is rendered by Kavro.</p>',
                                        ),

                    // Field: heading.
                    array(
                                            'type' => 'heading',
                                            'content' => 'Heading Example',
                                        ),

                    // Field: subheading.
                    array(
                                            'type' => 'subheading',
                                            'content' => 'Subheading Example',
                                        ),

                    // Field: divider.
                    array(
                                            'type' => 'divider',
                                            'content' => 'Divider Example',
                                        ),

                    // Field: notice.
                    array(
                                            'type' => 'notice',
                                            'style' => 'info',
                                            'content' => 'This is a Kavro notice field.',
                                        ),

                    // Field: date.
                    array(
                                            'id' => 'demo_date',
                                            'type' => 'date',
                                            'title' => 'Date',
                                            'default' => '2026-05-19',
                                            'desc' => 'Demo example for the date field.',
                                        ),

                    // Field: time.
                    array(
                                            'id' => 'demo_time',
                                            'type' => 'time',
                                            'title' => 'Time',
                                            'default' => '10:30',
                                            'desc' => 'Demo example for the time field.',
                                        ),

                    // Field: email.
                    array(
                                            'id' => 'demo_email',
                                            'type' => 'email',
                                            'title' => 'Email',
                                            'default' => 'hello@example.com',
                                            'desc' => 'Demo example for the email field.',
                                        ),

                    // Field: url.
                    array(
                                            'id' => 'demo_url',
                                            'type' => 'url',
                                            'title' => 'Url',
                                            'default' => 'https://example.com',
                                            'desc' => 'Demo example for the url field.',
                                        ),

                    // Field: password.
                    array(
                                            'id' => 'demo_password',
                                            'type' => 'password',
                                            'title' => 'Password',
                                            'default' => 'secret',
                                            'desc' => 'Demo example for the password field.',
                                        ),

                    // Field: range.
                    array(
                                            'id' => 'demo_range',
                                            'type' => 'range',
                                            'title' => 'Range',
                                            'default' => '5',
                                            'min' => '0',
                                            'max' => '10',
                                            'step' => '1',
                                            'desc' => 'Demo example for the range field.',
                                        ),

                    // Field: slider.
                    array(
                                            'id' => 'demo_slider',
                                            'type' => 'slider',
                                            'title' => 'Slider',
                                            'default' => '5',
                                            'min' => '0',
                                            'max' => '10',
                                            'step' => '1',
                                            'desc' => 'Demo example for the slider field.',
                                        ),

                    // Field: code.
                    array(
                                            'id' => 'demo_code',
                                            'type' => 'code',
                                            'title' => 'Code',
                                            'default' => 'Example content',
                                            'desc' => 'Demo example for the code field.',
                                        ),

                    // Field: hidden.
                    array(
                                            'id' => 'demo_hidden',
                                            'type' => 'hidden',
                                            'title' => 'Hidden',
                                            'default' => 'hidden-value',
                                            'desc' => 'Demo example for the hidden field.',
                                        ),
                ),
            ),

            // Section: Media And Design Fields.
            array(
                'title'    => 'Media And Design Fields',
                'subtitle' => 'Complete media and design fields examples for the ' . $context . ' demo.',
                'fields'   => array(

                    // Field: media.
                    array(
                                            'id' => 'demo_media',
                                            'type' => 'media',
                                            'title' => 'Media',
                                            'default' => '',
                                            'desc' => 'Demo example for the media field.',
                                        ),

                    // Field: upload.
                    array(
                                            'id' => 'demo_upload',
                                            'type' => 'upload',
                                            'title' => 'Upload',
                                            'default' => '',
                                            'desc' => 'Demo example for the upload field.',
                                        ),

                    // Field: image.
                    array(
                                            'id' => 'demo_image',
                                            'type' => 'image',
                                            'title' => 'Image',
                                            'default' => '',
                                            'desc' => 'Demo example for the image field.',
                                        ),

                    // Field: gallery.
                    array(
                                            'id' => 'demo_gallery',
                                            'type' => 'gallery',
                                            'title' => 'Gallery',
                                            'default' => '',
                                            'desc' => 'Demo example for the gallery field.',
                                        ),

                    // Field: dimensions.
                    array(
                                            'id' => 'demo_dimensions',
                                            'type' => 'dimensions',
                                            'title' => 'Dimensions',
                                            'default' => array(
                                                'top' => '10',
                                                'right' => '20',
                                                'bottom' => '10',
                                                'left' => '20',
                                                'unit' => 'px',
                                                'width' => '120',
                                                'height' => '80',
                                            ),
                                            'desc' => 'Demo example for the dimensions field.',
                                        ),

                    // Field: spacing.
                    array(
                                            'id' => 'demo_spacing',
                                            'type' => 'spacing',
                                            'title' => 'Spacing',
                                            'default' => array(
                                                'top' => '10',
                                                'right' => '20',
                                                'bottom' => '10',
                                                'left' => '20',
                                                'unit' => 'px',
                                                'width' => '120',
                                                'height' => '80',
                                            ),
                                            'desc' => 'Demo example for the spacing field.',
                                        ),

                    // Field: typography.
                    array(
                                            'id' => 'demo_typography',
                                            'type' => 'typography',
                                            'title' => 'Typography',
                                            'default' => array(
                                                'family' => 'Inter',
                                                'size' => '16',
                                                'weight' => '600',
                                                'color' => '#111827',
                                            ),
                                            'desc' => 'Demo example for the typography field.',
                                        ),

                    // Field: wysiwyg.
                    array(
                                            'id' => 'demo_wysiwyg',
                                            'type' => 'wysiwyg',
                                            'title' => 'Wysiwyg',
                                            'default' => 'Demo Wysiwyg',
                                            'desc' => 'Demo example for the wysiwyg field.',
                                        ),

                    // Field: wp_editor.
                    array(
                                            'id' => 'demo_wp_editor',
                                            'type' => 'wp_editor',
                                            'title' => 'Wp Editor',
                                            'default' => 'Demo Wp Editor',
                                            'desc' => 'Demo example for the wp_editor field.',
                                        ),

                    // Field: link.
                    array(
                                            'id' => 'demo_link',
                                            'type' => 'link',
                                            'title' => 'Link',
                                            'default' => array(
                                                'url' => 'https://example.com',
                                                'text' => 'Example',
                                                'target' => '_blank',
                                            ),
                                            'desc' => 'Demo example for the link field.',
                                        ),

                    // Field: icon.
                    array(
                                            'id' => 'demo_icon',
                                            'type' => 'icon',
                                            'title' => 'Icon',
                                            'default' => 'dashicons-star-filled',
                                            'desc' => 'Demo example for the icon field.',
                                        ),

                    // Field: palette.
                    array(
                                            'id' => 'demo_palette',
                                            'type' => 'palette',
                                            'title' => 'Palette',
                                            'options' => array(
                                                'indigo' => array(
                                                    '#4f46e5',
                                                    '#06b6d4',
                                                    '#111827',
                                                ),
                                                'rose' => array(
                                                    '#e11d48',
                                                    '#fb7185',
                                                    '#1f2937',
                                                ),
                                            ),
                                            'default' => 'indigo',
                                            'desc' => 'Demo example for the palette field.',
                                        ),

                    // Field: background.
                    array(
                                            'id' => 'demo_background',
                                            'type' => 'background',
                                            'title' => 'Background',
                                            'default' => array(
                                                'color' => '#f8fafc',
                                                'image' => '',
                                                'repeat' => 'no-repeat',
                                                'position' => 'center center',
                                                'size' => 'cover',
                                            ),
                                            'desc' => 'Demo example for the background field.',
                                        ),

                    // Field: border.
                    array(
                                            'id' => 'demo_border',
                                            'type' => 'border',
                                            'title' => 'Border',
                                            'default' => array(
                                                'width' => '1',
                                                'style' => 'solid',
                                                'color' => '#e5e7eb',
                                            ),
                                            'desc' => 'Demo example for the border field.',
                                        ),

                    // Field: color_group.
                    array(
                                            'id' => 'demo_color_group',
                                            'type' => 'color_group',
                                            'title' => 'Color Group',
                                            'options' => array(
                                                'primary' => 'Primary',
                                                'secondary' => 'Secondary',
                                                'accent' => 'Accent',
                                            ),
                                            'default' => array(
                                                'primary' => '#5b5cf6',
                                                'secondary' => '#06b6d4',
                                                'accent' => '#f97316',
                                            ),
                                            'desc' => 'Demo example for the color_group field.',
                                        ),

                    // Field: datetime.
                    array(
                                            'id' => 'demo_datetime',
                                            'type' => 'datetime',
                                            'title' => 'Datetime',
                                            'default' => '2026-05-19 10:30',
                                            'desc' => 'Demo example for the datetime field.',
                                        ),

                    // Field: image_select.
                    array(
                                            'id' => 'demo_image_select',
                                            'type' => 'image_select',
                                            'title' => 'Image Select',
                                            'options' => array(
                                                'light' => array(
                                                    'label' => 'Light',
                                                    'image' => 'https://placehold.co/240x140/f8fafc/111827?text=Light',
                                                ),
                                                'dark' => array(
                                                    'label' => 'Dark',
                                                    'image' => 'https://placehold.co/240x140/111827/f8fafc?text=Dark',
                                                ),
                                            ),
                                            'default' => 'light',
                                            'desc' => 'Demo example for the image_select field.',
                                        ),

                    // Field: link_color.
                    array(
                                            'id' => 'demo_link_color',
                                            'type' => 'link_color',
                                            'title' => 'Link Color',
                                            'default' => array(
                                                'regular' => '#2563eb',
                                                'hover' => '#1d4ed8',
                                                'active' => '#1e40af',
                                            ),
                                            'desc' => 'Demo example for the link_color field.',
                                        ),

                    // Field: unit.
                    array(
                                            'id' => 'demo_unit',
                                            'type' => 'unit',
                                            'title' => 'Unit',
                                            'default' => array(
                                                'value' => '24',
                                                'unit' => 'px',
                                            ),
                                            'desc' => 'Demo example for the unit field.',
                                        ),

                    // Field: gradient.
                    array(
                                            'id' => 'demo_gradient',
                                            'type' => 'gradient',
                                            'title' => 'Gradient',
                                            'default' => array(
                                                'from' => '#5b5cf6',
                                                'to' => '#06b6d4',
                                                'direction' => '135deg',
                                            ),
                                            'desc' => 'Demo example for the gradient field.',
                                        ),

                    // Field: box_shadow.
                    array(
                                            'id' => 'demo_box_shadow',
                                            'type' => 'box_shadow',
                                            'title' => 'Box Shadow',
                                            'default' => array(
                                                'x' => '0',
                                                'y' => '12',
                                                'blur' => '35',
                                                'spread' => '0',
                                                'color' => 'rgba(15,23,42,.16)',
                                            ),
                                            'desc' => 'Demo example for the box_shadow field.',
                                        ),

                    // Field: map.
                    array(
                                            'id' => 'demo_map',
                                            'type' => 'map',
                                            'title' => 'Map',
                                            'default' => array(
                                                'address' => 'Dhaka, Bangladesh',
                                                'lat' => '23.8103',
                                                'lng' => '90.4125',
                                            ),
                                            'desc' => 'Demo example for the map field.',
                                        ),
                ),
            ),

            // Section: Compound And Builder Fields.
            array(
                'title'    => 'Compound And Builder Fields',
                'subtitle' => 'Complete compound and builder fields examples for the ' . $context . ' demo.',
                'fields'   => array(

                    // Field: repeater.
                    array(
                                            'id' => 'demo_repeater',
                                            'type' => 'repeater',
                                            'title' => 'Repeater',
                                            'fields' => array(
                                                array(
                                                    'id' => 'label',
                                                    'type' => 'text',
                                                    'title' => 'Label',
                                                ),
                                                array(
                                                    'id' => 'value',
                                                    'type' => 'text',
                                                    'title' => 'Value',
                                                ),
                                            ),
                                            'default' => array(
                                                array(
                                                    'label' => 'First',
                                                    'value' => 'one',
                                                ),
                                            ),
                                            'desc' => 'Demo example for the repeater field.',
                                        ),

                    // Field: group.
                    array(
                                            'id' => 'demo_group',
                                            'type' => 'group',
                                            'title' => 'Group',
                                            'fields' => array(
                                                array(
                                                    'id' => 'label',
                                                    'type' => 'text',
                                                    'title' => 'Label',
                                                ),
                                                array(
                                                    'id' => 'value',
                                                    'type' => 'text',
                                                    'title' => 'Value',
                                                ),
                                            ),
                                            'default' => array(
                                                'label' => 'First',
                                                'value' => 'one',
                                            ),
                                            'desc' => 'Demo example for the group field.',
                                        ),

                    // Field: fieldset.
                    array(
                                            'id' => 'demo_fieldset',
                                            'type' => 'fieldset',
                                            'title' => 'Fieldset',
                                            'fields' => array(
                                                array(
                                                    'id' => 'label',
                                                    'type' => 'text',
                                                    'title' => 'Label',
                                                ),
                                                array(
                                                    'id' => 'value',
                                                    'type' => 'text',
                                                    'title' => 'Value',
                                                ),
                                            ),
                                            'default' => array(
                                                'label' => 'First',
                                                'value' => 'one',
                                            ),
                                            'desc' => 'Demo example for the fieldset field.',
                                        ),

                    // Field: accordion.
                    array(
                                            'id' => 'demo_accordion',
                                            'type' => 'accordion',
                                            'title' => 'Accordion',
                                            'fields' => array(
                                                array(
                                                    'id' => 'label',
                                                    'type' => 'text',
                                                    'title' => 'Label',
                                                ),
                                                array(
                                                    'id' => 'value',
                                                    'type' => 'text',
                                                    'title' => 'Value',
                                                ),
                                            ),
                                            'default' => array(
                                                'label' => 'First',
                                                'value' => 'one',
                                            ),
                                            'desc' => 'Demo example for the accordion field.',
                                        ),

                    // Field: tabbed.
                    array(
                                            'id' => 'demo_tabbed',
                                            'type' => 'tabbed',
                                            'title' => 'Tabbed',
                                            'fields' => array(
                                                array(
                                                    'id' => 'label',
                                                    'type' => 'text',
                                                    'title' => 'Label',
                                                ),
                                                array(
                                                    'id' => 'value',
                                                    'type' => 'text',
                                                    'title' => 'Value',
                                                ),
                                            ),
                                            'default' => array(
                                                'label' => 'First',
                                                'value' => 'one',
                                            ),
                                            'desc' => 'Demo example for the tabbed field.',
                                        ),

                    // Field: sortable.
                    array(
                                            'id' => 'demo_sortable',
                                            'type' => 'sortable',
                                            'title' => 'Sortable',
                                            'options' => array(
                                                'one' => 'One',
                                                'two' => 'Two',
                                                'three' => 'Three',
                                            ),
                                            'default' => array(
                                                'one',
                                                'three',
                                            ),
                                            'desc' => 'Demo example for the sortable field.',
                                        ),

                    // Field: sorter.
                    array(
                                            'id' => 'demo_sorter',
                                            'type' => 'sorter',
                                            'title' => 'Sorter',
                                            'default' => array(
                                                'enabled' => array(
                                                    'one' => 'One',
                                                    'two' => 'Two',
                                                ),
                                                'disabled' => array(
                                                    'three' => 'Three',
                                                ),
                                            ),
                                            'desc' => 'Demo example for the sorter field.',
                                        ),

                    // Field: multicheck.
                    array(
                                            'id' => 'demo_multicheck',
                                            'type' => 'multicheck',
                                            'title' => 'Multicheck',
                                            'options' => array(
                                                'one' => 'One',
                                                'two' => 'Two',
                                                'three' => 'Three',
                                            ),
                                            'default' => array(
                                                'one',
                                                'three',
                                            ),
                                            'desc' => 'Demo example for the multicheck field.',
                                        ),

                    // Field: key_value.
                    array(
                                            'id' => 'demo_key_value',
                                            'type' => 'key_value',
                                            'title' => 'Key Value',
                                            'default' => array(
                                                'label' => 'Example',
                                                'value' => 'demo',
                                            ),
                                            'desc' => 'Demo example for the key_value field.',
                                        ),

                    // Field: link_group.
                    array(
                                            'id' => 'demo_link_group',
                                            'type' => 'link_group',
                                            'title' => 'Link Group',
                                            'default' => array(
                                                'label' => 'Example',
                                                'value' => 'demo',
                                            ),
                                            'desc' => 'Demo example for the link_group field.',
                                        ),

                    // Field: social_links.
                    array(
                                            'id' => 'demo_social_links',
                                            'type' => 'social_links',
                                            'title' => 'Social Links',
                                            'default' => array(
                                                'label' => 'Example',
                                                'value' => 'demo',
                                            ),
                                            'desc' => 'Demo example for the social_links field.',
                                        ),

                    // Field: text_list.
                    array(
                                            'id' => 'demo_text_list',
                                            'type' => 'text_list',
                                            'title' => 'Text List',
                                            'default' => array(
                                                'label' => 'Example',
                                                'value' => 'demo',
                                            ),
                                            'desc' => 'Demo example for the text_list field.',
                                        ),

                    // Field: cloneable.
                    array(
                                            'id' => 'demo_cloneable',
                                            'type' => 'cloneable',
                                            'title' => 'Cloneable',
                                            'fields' => array(
                                                array(
                                                    'id' => 'label',
                                                    'type' => 'text',
                                                    'title' => 'Label',
                                                ),
                                                array(
                                                    'id' => 'value',
                                                    'type' => 'text',
                                                    'title' => 'Value',
                                                ),
                                            ),
                                            'default' => array(
                                                array(
                                                    'label' => 'First',
                                                    'value' => 'one',
                                                ),
                                            ),
                                            'desc' => 'Demo example for the cloneable field.',
                                        ),

                    // Field: responsive_value.
                    array(
                                            'id' => 'demo_responsive_value',
                                            'type' => 'responsive_value',
                                            'title' => 'Responsive Value',
                                            'default' => array(
                                                'desktop' => '40',
                                                'tablet' => '28',
                                                'mobile' => '18',
                                                'unit' => 'px',
                                            ),
                                            'desc' => 'Demo example for the responsive_value field.',
                                        ),

                    // Field: css_builder.
                    array(
                                            'id' => 'demo_css_builder',
                                            'type' => 'css_builder',
                                            'title' => 'Css Builder',
                                            'default' => array(
                                                'selector' => '.hero',
                                                'property' => 'padding',
                                                'value' => '40px',
                                            ),
                                            'desc' => 'Demo example for the css_builder field.',
                                        ),

                    // Field: google_fonts.
                    array(
                                            'id' => 'demo_google_fonts',
                                            'type' => 'google_fonts',
                                            'title' => 'Google Fonts',
                                            'default' => array(
                                                'family' => 'Inter',
                                                'size' => '16',
                                                'weight' => '600',
                                                'color' => '#111827',
                                            ),
                                            'desc' => 'Demo example for the google_fonts field.',
                                        ),

                    // Field: border_radius.
                    array(
                                            'id' => 'demo_border_radius',
                                            'type' => 'border_radius',
                                            'title' => 'Border Radius',
                                            'default' => array(
                                                'top' => '10',
                                                'right' => '20',
                                                'bottom' => '10',
                                                'left' => '20',
                                                'unit' => 'px',
                                                'width' => '120',
                                                'height' => '80',
                                            ),
                                            'desc' => 'Demo example for the border_radius field.',
                                        ),

                    // Field: box_model.
                    array(
                                            'id' => 'demo_box_model',
                                            'type' => 'box_model',
                                            'title' => 'Box Model',
                                            'default' => array(
                                                'top' => '10',
                                                'right' => '20',
                                                'bottom' => '10',
                                                'left' => '20',
                                                'unit' => 'px',
                                                'width' => '120',
                                                'height' => '80',
                                            ),
                                            'desc' => 'Demo example for the box_model field.',
                                        ),

                    // Field: dimensions_advanced.
                    array(
                                            'id' => 'demo_dimensions_advanced',
                                            'type' => 'dimensions_advanced',
                                            'title' => 'Dimensions Advanced',
                                            'default' => array(
                                                'top' => '10',
                                                'right' => '20',
                                                'bottom' => '10',
                                                'left' => '20',
                                                'unit' => 'px',
                                                'width' => '120',
                                                'height' => '80',
                                            ),
                                            'desc' => 'Demo example for the dimensions_advanced field.',
                                        ),

                    // Field: spacing_advanced.
                    array(
                                            'id' => 'demo_spacing_advanced',
                                            'type' => 'spacing_advanced',
                                            'title' => 'Spacing Advanced',
                                            'default' => array(
                                                'top' => '10',
                                                'right' => '20',
                                                'bottom' => '10',
                                                'left' => '20',
                                                'unit' => 'px',
                                                'width' => '120',
                                                'height' => '80',
                                            ),
                                            'desc' => 'Demo example for the spacing_advanced field.',
                                        ),

                    // Field: typography_advanced.
                    array(
                                            'id' => 'demo_typography_advanced',
                                            'type' => 'typography_advanced',
                                            'title' => 'Typography Advanced',
                                            'default' => array(
                                                'family' => 'Inter',
                                                'size' => '16',
                                                'weight' => '600',
                                                'color' => '#111827',
                                            ),
                                            'desc' => 'Demo example for the typography_advanced field.',
                                        ),

                    // Field: conditional_group.
                    array(
                                            'id' => 'demo_conditional_group',
                                            'type' => 'conditional_group',
                                            'title' => 'Conditional Group',
                                            'fields' => array(
                                                array(
                                                    'id' => 'label',
                                                    'type' => 'text',
                                                    'title' => 'Label',
                                                ),
                                                array(
                                                    'id' => 'value',
                                                    'type' => 'text',
                                                    'title' => 'Value',
                                                ),
                                            ),
                                            'default' => array(
                                                'label' => 'First',
                                                'value' => 'one',
                                            ),
                                            'desc' => 'Demo example for the conditional_group field.',
                                        ),

                    // Field: repeater_nested.
                    array(
                                            'id' => 'demo_repeater_nested',
                                            'type' => 'repeater_nested',
                                            'title' => 'Repeater Nested',
                                            'fields' => array(
                                                array(
                                                    'id' => 'label',
                                                    'type' => 'text',
                                                    'title' => 'Label',
                                                ),
                                                array(
                                                    'id' => 'value',
                                                    'type' => 'text',
                                                    'title' => 'Value',
                                                ),
                                            ),
                                            'default' => array(
                                                array(
                                                    'label' => 'First',
                                                    'value' => 'one',
                                                ),
                                            ),
                                            'desc' => 'Demo example for the repeater_nested field.',
                                        ),

                    // Field: query_builder.
                    array(
                                            'id' => 'demo_query_builder',
                                            'type' => 'query_builder',
                                            'title' => 'Query Builder',
                                            'default' => array(
                                                'post_type' => 'post',
                                                'posts_per_page' => '6',
                                                'orderby' => 'date',
                                            ),
                                            'desc' => 'Demo example for the query_builder field.',
                                        ),

                    // Field: shortcode_builder.
                    array(
                                            'id' => 'demo_shortcode_builder',
                                            'type' => 'shortcode_builder',
                                            'title' => 'Shortcode Builder',
                                            'default' => array(
                                                'tag' => 'gallery',
                                                'attrs' => array(
                                                    'ids' => '1,2,3',
                                                ),
                                            ),
                                            'desc' => 'Demo example for the shortcode_builder field.',
                                        ),

                    // Field: form_builder.
                    array(
                                            'id' => 'demo_form_builder',
                                            'type' => 'form_builder',
                                            'title' => 'Form Builder',
                                            'default' => array(
                                                array(
                                                    'label' => 'Example block',
                                                    'type' => 'text',
                                                ),
                                            ),
                                            'desc' => 'Demo example for the form_builder field.',
                                        ),

                    // Field: menu_builder.
                    array(
                                            'id' => 'demo_menu_builder',
                                            'type' => 'menu_builder',
                                            'title' => 'Menu Builder',
                                            'default' => array(
                                                array(
                                                    'label' => 'Example block',
                                                    'type' => 'text',
                                                ),
                                            ),
                                            'desc' => 'Demo example for the menu_builder field.',
                                        ),

                    // Field: layout_builder.
                    array(
                                            'id' => 'demo_layout_builder',
                                            'type' => 'layout_builder',
                                            'title' => 'Layout Builder',
                                            'default' => array(
                                                array(
                                                    'label' => 'Example block',
                                                    'type' => 'text',
                                                ),
                                            ),
                                            'desc' => 'Demo example for the layout_builder field.',
                                        ),
                ),
            ),

            // Section: WordPress Content Fields.
            array(
                'title'    => 'WordPress Content Fields',
                'subtitle' => 'Complete wordpress content fields examples for the ' . $context . ' demo.',
                'fields'   => array(

                    // Field: post_select.
                    array(
                                            'id' => 'demo_post_select',
                                            'type' => 'post_select',
                                            'title' => 'Post Select',
                                            'post_type' => array(
                                                'post',
                                                'page',
                                            ),
                                            'multiple' => false,
                                            'desc' => 'Demo example for the post_select field.',
                                        ),

                    // Field: post_checkbox.
                    array(
                                            'id' => 'demo_post_checkbox',
                                            'type' => 'post_checkbox',
                                            'title' => 'Post Checkbox',
                                            'post_type' => array(
                                                'post',
                                                'page',
                                            ),
                                            'multiple' => true,
                                            'desc' => 'Demo example for the post_checkbox field.',
                                        ),

                    // Field: post_radio.
                    array(
                                            'id' => 'demo_post_radio',
                                            'type' => 'post_radio',
                                            'title' => 'Post Radio',
                                            'post_type' => array(
                                                'post',
                                                'page',
                                            ),
                                            'multiple' => false,
                                            'desc' => 'Demo example for the post_radio field.',
                                        ),

                    // Field: post_autocomplete.
                    array(
                                            'id' => 'demo_post_autocomplete',
                                            'type' => 'post_autocomplete',
                                            'title' => 'Post Autocomplete',
                                            'post_type' => array(
                                                'post',
                                                'page',
                                            ),
                                            'multiple' => false,
                                            'desc' => 'Demo example for the post_autocomplete field.',
                                        ),

                    // Field: post_relation.
                    array(
                                            'id' => 'demo_post_relation',
                                            'type' => 'post_relation',
                                            'title' => 'Post Relation',
                                            'post_type' => array(
                                                'post',
                                                'page',
                                            ),
                                            'multiple' => true,
                                            'desc' => 'Demo example for the post_relation field.',
                                        ),

                    // Field: page_select.
                    array(
                                            'id' => 'demo_page_select',
                                            'type' => 'page_select',
                                            'title' => 'Page Select',
                                            'post_type' => 'page',
                                            'desc' => 'Demo example for the page_select field.',
                                        ),

                    // Field: cpt_select.
                    array(
                                            'id' => 'demo_cpt_select',
                                            'type' => 'cpt_select',
                                            'title' => 'Cpt Select',
                                            'post_type' => array(
                                                'post',
                                                'page',
                                            ),
                                            'desc' => 'Demo example for the cpt_select field.',
                                        ),

                    // Field: taxonomy_select.
                    array(
                                            'id' => 'demo_taxonomy_select',
                                            'type' => 'taxonomy_select',
                                            'title' => 'Taxonomy Select',
                                            'taxonomy' => array(
                                                'category',
                                                'post_tag',
                                            ),
                                            'multiple' => false,
                                            'desc' => 'Demo example for the taxonomy_select field.',
                                        ),

                    // Field: taxonomy_checkbox.
                    array(
                                            'id' => 'demo_taxonomy_checkbox',
                                            'type' => 'taxonomy_checkbox',
                                            'title' => 'Taxonomy Checkbox',
                                            'taxonomy' => array(
                                                'category',
                                                'post_tag',
                                            ),
                                            'multiple' => true,
                                            'desc' => 'Demo example for the taxonomy_checkbox field.',
                                        ),

                    // Field: taxonomy_radio.
                    array(
                                            'id' => 'demo_taxonomy_radio',
                                            'type' => 'taxonomy_radio',
                                            'title' => 'Taxonomy Radio',
                                            'taxonomy' => array(
                                                'category',
                                                'post_tag',
                                            ),
                                            'multiple' => false,
                                            'desc' => 'Demo example for the taxonomy_radio field.',
                                        ),

                    // Field: term_relation.
                    array(
                                            'id' => 'demo_term_relation',
                                            'type' => 'term_relation',
                                            'title' => 'Term Relation',
                                            'taxonomy' => array(
                                                'category',
                                                'post_tag',
                                            ),
                                            'multiple' => true,
                                            'desc' => 'Demo example for the term_relation field.',
                                        ),

                    // Field: user_select.
                    array(
                                            'id' => 'demo_user_select',
                                            'type' => 'user_select',
                                            'title' => 'User Select',
                                            'default' => '',
                                            'desc' => 'Demo example for the user_select field.',
                                        ),

                    // Field: role_select.
                    array(
                                            'id' => 'demo_role_select',
                                            'type' => 'role_select',
                                            'title' => 'Role Select',
                                            'default' => '',
                                            'desc' => 'Demo example for the role_select field.',
                                        ),

                    // Field: menu_select.
                    array(
                                            'id' => 'demo_menu_select',
                                            'type' => 'menu_select',
                                            'title' => 'Menu Select',
                                            'default' => '',
                                            'desc' => 'Demo example for the menu_select field.',
                                        ),

                    // Field: sidebar_select.
                    array(
                                            'id' => 'demo_sidebar_select',
                                            'type' => 'sidebar_select',
                                            'title' => 'Sidebar Select',
                                            'default' => '',
                                            'desc' => 'Demo example for the sidebar_select field.',
                                        ),

                    // Field: template_select.
                    array(
                                            'id' => 'demo_template_select',
                                            'type' => 'template_select',
                                            'title' => 'Template Select',
                                            'default' => '',
                                            'desc' => 'Demo example for the template_select field.',
                                        ),

                    // Field: capability_select.
                    array(
                                            'id' => 'demo_capability_select',
                                            'type' => 'capability_select',
                                            'title' => 'Capability Select',
                                            'default' => '',
                                            'desc' => 'Demo example for the capability_select field.',
                                        ),
                ),
            ),

            // Section: Premium Utility Fields.
            array(
                'title'    => 'Premium Utility Fields',
                'subtitle' => 'Complete premium utility fields examples for the ' . $context . ' demo.',
                'fields'   => array(

                    // Field: backup.
                    array(
                                            'id' => 'demo_backup',
                                            'type' => 'backup',
                                            'title' => 'Backup',
                                            'default' => '',
                                            'desc' => 'Demo example for the backup field.',
                                        ),

                    // Field: readonly.
                    array(
                                            'id' => 'demo_readonly',
                                            'type' => 'readonly',
                                            'title' => 'Readonly',
                                            'default' => 'Copy this Kavro value',
                                            'desc' => 'Demo example for the readonly field.',
                                        ),

                    // Field: copy.
                    array(
                                            'id' => 'demo_copy',
                                            'type' => 'copy',
                                            'title' => 'Copy',
                                            'default' => 'Copy this Kavro value',
                                            'desc' => 'Demo example for the copy field.',
                                        ),

                    // Field: button.
                    array(
                                            'id' => 'demo_button',
                                            'type' => 'button',
                                            'title' => 'Button',
                                            'label' => 'Demo Action',
                                            'url' => '#',
                                            'desc' => 'Demo example for the button field.',
                                        ),

                    // Field: html.
                    array(
                                            'id' => 'demo_html',
                                            'type' => 'html',
                                            'title' => 'Html',
                                            'html' => '<strong>Custom HTML output.</strong>',
                                        ),

                    // Field: oembed.
                    array(
                                            'id' => 'demo_oembed',
                                            'type' => 'oembed',
                                            'title' => 'Oembed',
                                            'default' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                                            'desc' => 'Demo example for the oembed field.',
                                        ),

                    // Field: embed.
                    array(
                                            'id' => 'demo_embed',
                                            'type' => 'embed',
                                            'title' => 'Embed',
                                            'default' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                                            'desc' => 'Demo example for the embed field.',
                                        ),

                    // Field: json.
                    array(
                                            'id' => 'demo_json',
                                            'type' => 'json',
                                            'title' => 'Json',
                                            'default' => 'console.log("Kavro");',
                                            'desc' => 'Demo example for the json field.',
                                        ),

                    // Field: custom.
                    array(
                                            'id' => 'demo_custom',
                                            'type' => 'custom',
                                            'title' => 'Custom',
                                            'html' => '<div class="kavro-demo-custom">Custom field HTML from the demo file.</div>',
                                            'desc' => 'Demo example for the custom field.',
                                        ),

                    // Field: select2.
                    array(
                                            'id' => 'demo_select2',
                                            'type' => 'select2',
                                            'title' => 'Select2',
                                            'options' => array(
                                                'one' => 'One',
                                                'two' => 'Two',
                                                'three' => 'Three',
                                            ),
                                            'default' => 'two',
                                            'desc' => 'Demo example for the select2 field.',
                                        ),

                    // Field: enhanced_select.
                    array(
                                            'id' => 'demo_enhanced_select',
                                            'type' => 'enhanced_select',
                                            'title' => 'Enhanced Select',
                                            'options' => array(
                                                'one' => 'One',
                                                'two' => 'Two',
                                                'three' => 'Three',
                                            ),
                                            'default' => 'two',
                                            'desc' => 'Demo example for the enhanced_select field.',
                                        ),

                    // Field: ajax_select.
                    array(
                                            'id' => 'demo_ajax_select',
                                            'type' => 'ajax_select',
                                            'title' => 'Ajax Select',
                                            'options' => array(
                                                'one' => 'One',
                                                'two' => 'Two',
                                                'three' => 'Three',
                                            ),
                                            'default' => 'one',
                                            'placeholder' => 'Search demo choices',
                                            'desc' => 'Demo example for the ajax_select field.',
                                        ),

                    // Field: code_editor_advanced.
                    array(
                                            'id' => 'demo_code_editor_advanced',
                                            'type' => 'code_editor_advanced',
                                            'title' => 'Code Editor Advanced',
                                            'default' => 'Example content',
                                            'desc' => 'Demo example for the code_editor_advanced field.',
                                        ),

                    // Field: css_editor.
                    array(
                                            'id' => 'demo_css_editor',
                                            'type' => 'css_editor',
                                            'title' => 'Css Editor',
                                            'default' => 'body { color: #111827; }',
                                            'desc' => 'Demo example for the css_editor field.',
                                        ),

                    // Field: js_editor.
                    array(
                                            'id' => 'demo_js_editor',
                                            'type' => 'js_editor',
                                            'title' => 'Js Editor',
                                            'default' => 'console.log("Kavro");',
                                            'desc' => 'Demo example for the js_editor field.',
                                        ),

                    // Field: file_upload.
                    array(
                                            'id' => 'demo_file_upload',
                                            'type' => 'file_upload',
                                            'title' => 'File Upload',
                                            'default' => '',
                                            'desc' => 'Demo example for the file_upload field.',
                                        ),

                    // Field: video_upload.
                    array(
                                            'id' => 'demo_video_upload',
                                            'type' => 'video_upload',
                                            'title' => 'Video Upload',
                                            'default' => '',
                                            'desc' => 'Demo example for the video_upload field.',
                                        ),

                    // Field: audio_upload.
                    array(
                                            'id' => 'demo_audio_upload',
                                            'type' => 'audio_upload',
                                            'title' => 'Audio Upload',
                                            'default' => '',
                                            'desc' => 'Demo example for the audio_upload field.',
                                        ),

                    // Field: device_preview.
                    array(
                                            'id' => 'demo_device_preview',
                                            'type' => 'device_preview',
                                            'title' => 'Device Preview',
                                            'default' => array(
                                                'desktop' => 'Preview on desktop',
                                                'tablet' => 'Preview on tablet',
                                                'mobile' => 'Preview on mobile',
                                            ),
                                            'desc' => 'Demo example for the device_preview field.',
                                        ),

                    // Field: dynamic_tags.
                    array(
                                            'id' => 'demo_dynamic_tags',
                                            'type' => 'dynamic_tags',
                                            'title' => 'Dynamic Tags',
                                            'options' => array(
                                                'post_title' => 'Post Title',
                                                'site_title' => 'Site Title',
                                                'current_year' => 'Current Year',
                                            ),
                                            'default' => 'post_title',
                                            'desc' => 'Demo example for the dynamic_tags field.',
                                        ),

                    // Field: table.
                    array(
                                            'id' => 'demo_table',
                                            'type' => 'table',
                                            'title' => 'Table',
                                            'default' => array(
                                                'label' => 'Example',
                                                'value' => 'demo',
                                            ),
                                            'desc' => 'Demo example for the table field.',
                                        ),

                    // Field: matrix.
                    array(
                                            'id' => 'demo_matrix',
                                            'type' => 'matrix',
                                            'title' => 'Matrix',
                                            'default' => array(
                                                'label' => 'Example',
                                                'value' => 'demo',
                                            ),
                                            'desc' => 'Demo example for the matrix field.',
                                        ),

                    // Field: checklist.
                    array(
                                            'id' => 'demo_checklist',
                                            'type' => 'checklist',
                                            'title' => 'Checklist',
                                            'default' => array(
                                                'label' => 'Example',
                                                'value' => 'demo',
                                            ),
                                            'desc' => 'Demo example for the checklist field.',
                                        ),

                    // Field: business_hours.
                    array(
                                            'id' => 'demo_business_hours',
                                            'type' => 'business_hours',
                                            'title' => 'Business Hours',
                                            'default' => array(
                                                'label' => 'Example',
                                                'value' => 'demo',
                                            ),
                                            'desc' => 'Demo example for the business_hours field.',
                                        ),

                    // Field: timeline.
                    array(
                                            'id' => 'demo_timeline',
                                            'type' => 'timeline',
                                            'title' => 'Timeline',
                                            'default' => array(
                                                array(
                                                    'title' => 'Started',
                                                    'date' => '2026-05-19',
                                                    'content' => 'Initial milestone',
                                                ),
                                            ),
                                            'desc' => 'Demo example for the timeline field.',
                                        ),

                    // Field: seo_preview.
                    array(
                                            'id' => 'demo_seo_preview',
                                            'type' => 'seo_preview',
                                            'title' => 'Seo Preview',
                                            'default' => array(
                                                'title' => 'Kavro SEO Title',
                                                'description' => 'SEO preview description',
                                                'url' => 'https://example.com',
                                            ),
                                            'desc' => 'Demo example for the seo_preview field.',
                                        ),

                    // Field: open_graph.
                    array(
                                            'id' => 'demo_open_graph',
                                            'type' => 'open_graph',
                                            'title' => 'Open Graph',
                                            'default' => array(
                                                'label' => 'Example',
                                                'value' => 'demo',
                                            ),
                                            'desc' => 'Demo example for the open_graph field.',
                                        ),

                    // Field: schema_markup.
                    array(
                                            'id' => 'demo_schema_markup',
                                            'type' => 'schema_markup',
                                            'title' => 'Schema Markup',
                                            'default' => '{"kavro":true}',
                                            'desc' => 'Demo example for the schema_markup field.',
                                        ),

                    // Field: webhook.
                    array(
                                            'id' => 'demo_webhook',
                                            'type' => 'webhook',
                                            'title' => 'Webhook',
                                            'default' => array(
                                                'label' => 'Example',
                                                'value' => 'demo',
                                            ),
                                            'desc' => 'Demo example for the webhook field.',
                                        ),

                    // Field: cron_schedule.
                    array(
                                            'id' => 'demo_cron_schedule',
                                            'type' => 'cron_schedule',
                                            'title' => 'Cron Schedule',
                                            'default' => array(
                                                'recurrence' => 'daily',
                                                'time' => '09:00',
                                            ),
                                            'desc' => 'Demo example for the cron_schedule field.',
                                        ),
                ),
            ),

            // Section: Operations Pro Fields.
            array(
                'title'    => 'Operations Pro Fields',
                'subtitle' => 'Complete operations pro fields examples for the ' . $context . ' demo.',
                'fields'   => array(

                    // Field: notification_channels.
                    array(
                                            'id' => 'demo_notification_channels',
                                            'type' => 'notification_channels',
                                            'title' => 'Notification Channels',
                                            'default' => array(
                                                'label' => 'Example',
                                                'value' => 'demo',
                                            ),
                                            'desc' => 'Demo example for the notification_channels field.',
                                        ),

                    // Field: api_credentials.
                    array(
                                            'id' => 'demo_api_credentials',
                                            'type' => 'api_credentials',
                                            'title' => 'Api Credentials',
                                            'default' => array(
                                                'label' => 'Example',
                                                'value' => 'demo',
                                            ),
                                            'desc' => 'Demo example for the api_credentials field.',
                                        ),

                    // Field: license_key.
                    array(
                                            'id' => 'demo_license_key',
                                            'type' => 'license_key',
                                            'title' => 'License Key',
                                            'default' => 'KAVRO-XXXX-XXXX',
                                            'desc' => 'Demo example for the license_key field.',
                                        ),

                    // Field: environment_select.
                    array(
                                            'id' => 'demo_environment_select',
                                            'type' => 'environment_select',
                                            'title' => 'Environment Select',
                                            'options' => array(
                                                'one' => 'One',
                                                'two' => 'Two',
                                                'three' => 'Three',
                                            ),
                                            'default' => 'two',
                                            'desc' => 'Demo example for the environment_select field.',
                                        ),

                    // Field: feature_flags.
                    array(
                                            'id' => 'demo_feature_flags',
                                            'type' => 'feature_flags',
                                            'title' => 'Feature Flags',
                                            'default' => array(
                                                'label' => 'Example',
                                                'value' => 'demo',
                                            ),
                                            'desc' => 'Demo example for the feature_flags field.',
                                        ),

                    // Field: permission_matrix.
                    array(
                                            'id' => 'demo_permission_matrix',
                                            'type' => 'permission_matrix',
                                            'title' => 'Permission Matrix',
                                            'default' => array(
                                                'label' => 'Example',
                                                'value' => 'demo',
                                            ),
                                            'desc' => 'Demo example for the permission_matrix field.',
                                        ),

                    // Field: redirect_rules.
                    array(
                                            'id' => 'demo_redirect_rules',
                                            'type' => 'redirect_rules',
                                            'title' => 'Redirect Rules',
                                            'default' => array(
                                                'label' => 'Example',
                                                'value' => 'demo',
                                            ),
                                            'desc' => 'Demo example for the redirect_rules field.',
                                        ),

                    // Field: email_template.
                    array(
                                            'id' => 'demo_email_template',
                                            'type' => 'email_template',
                                            'title' => 'Email Template',
                                            'default' => array(
                                                'label' => 'Example',
                                                'value' => 'demo',
                                            ),
                                            'desc' => 'Demo example for the email_template field.',
                                        ),

                    // Field: rest_endpoint.
                    array(
                                            'id' => 'demo_rest_endpoint',
                                            'type' => 'rest_endpoint',
                                            'title' => 'Rest Endpoint',
                                            'default' => array(
                                                'label' => 'Example',
                                                'value' => 'demo',
                                            ),
                                            'desc' => 'Demo example for the rest_endpoint field.',
                                        ),

                    // Field: rate_limit.
                    array(
                                            'id' => 'demo_rate_limit',
                                            'type' => 'rate_limit',
                                            'title' => 'Rate Limit',
                                            'default' => array(
                                                'label' => 'Example',
                                                'value' => 'demo',
                                            ),
                                            'desc' => 'Demo example for the rate_limit field.',
                                        ),

                    // Field: cache_control.
                    array(
                                            'id' => 'demo_cache_control',
                                            'type' => 'cache_control',
                                            'title' => 'Cache Control',
                                            'default' => array(
                                                'label' => 'Example',
                                                'value' => 'demo',
                                            ),
                                            'desc' => 'Demo example for the cache_control field.',
                                        ),

                    // Field: log_viewer.
                    array(
                                            'id' => 'demo_log_viewer',
                                            'type' => 'log_viewer',
                                            'title' => 'Log Viewer',
                                            'default' => '',
                                            'desc' => 'Demo example for the log_viewer field.',
                                        ),

                    // Field: changelog.
                    array(
                                            'id' => 'demo_changelog',
                                            'type' => 'changelog',
                                            'title' => 'Changelog',
                                            'default' => '',
                                            'desc' => 'Demo example for the changelog field.',
                                        ),

                    // Field: system_info.
                    array(
                                            'id' => 'demo_system_info',
                                            'type' => 'system_info',
                                            'title' => 'System Info',
                                            'default' => '',
                                            'desc' => 'Demo example for the system_info field.',
                                        ),

                    // Field: health_check.
                    array(
                                            'id' => 'demo_health_check',
                                            'type' => 'health_check',
                                            'title' => 'Health Check',
                                            'default' => '',
                                            'desc' => 'Demo example for the health_check field.',
                                        ),

                    // Field: onboarding_steps.
                    array(
                                            'id' => 'demo_onboarding_steps',
                                            'type' => 'onboarding_steps',
                                            'title' => 'Onboarding Steps',
                                            'default' => array(
                                                'label' => 'Example',
                                                'value' => 'demo',
                                            ),
                                            'desc' => 'Demo example for the onboarding_steps field.',
                                        ),

                    // Field: progress.
                    array(
                                            'id' => 'demo_progress',
                                            'type' => 'progress',
                                            'title' => 'Progress',
                                            'default' => '5',
                                            'min' => '0',
                                            'max' => '10',
                                            'step' => '1',
                                            'desc' => 'Demo example for the progress field.',
                                        ),

                    // Field: rating.
                    array(
                                            'id' => 'demo_rating',
                                            'type' => 'rating',
                                            'title' => 'Rating',
                                            'default' => '5',
                                            'min' => '0',
                                            'max' => '10',
                                            'step' => '1',
                                            'desc' => 'Demo example for the rating field.',
                                        ),
                ),
            ),

        );
    }
}
