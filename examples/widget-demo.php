<?php
/**
 * Kavro Widget Options demo.
 *
 * This file registers a sample WordPress widget using Kavro fields. The demo is
 * intentionally readable and array-by-array so developers can copy only the
 * pieces they need into their own theme or plugin.
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
 * Register a Kavro-powered widget.
 *
 * The widget will appear in Appearance > Widgets and inside the Customizer
 * widget screen. Change the ID and labels to create your own custom widget.
 */
KAVRO::createWidgetOptions(
    'kavro_demo_widget',
    array(
        'title'       => __( 'Kavro Demo Widget', 'kavro-framework' ),
        'description' => __( 'A sample widget powered by Kavro Framework fields.', 'kavro-framework' ),
        'classname'   => 'kavro-demo-widget',

        /**
         * Optional front-end callback.
         *
         * @param array       $args     WordPress sidebar output arguments.
         * @param array       $instance Saved widget values.
         * @param WP_Widget   $widget   Current widget object.
         */
        'callback'    => function( $args, $instance, $widget ) {
            if ( ! empty( $instance['content'] ) ) {
                echo '<div class="kavro-demo-widget-text">' . wp_kses_post( wpautop( $instance['content'] ) ) . '</div>';
            }

            if ( ! empty( $instance['button_text'] ) && ! empty( $instance['button_url'] ) ) {
                printf(
                    '<p><a class="button kavro-demo-widget-button" href="%1$s">%2$s</a></p>',
                    esc_url( $instance['button_url'] ),
                    esc_html( $instance['button_text'] )
                );
            }
        },
    )
);

/**
 * Basic widget content controls.
 */
KAVRO::createSection(
    'kavro_demo_widget',
    array(
        'title'    => __( 'Content', 'kavro-framework' ),
        'subtitle' => __( 'Common fields used by front-end widgets.', 'kavro-framework' ),
        'fields'   => array(
            array(
                'id'      => 'title',
                'type'    => 'text',
                'title'   => __( 'Widget Title', 'kavro-framework' ),
                'default' => __( 'Kavro Widget', 'kavro-framework' ),
            ),
            array(
                'id'      => 'content',
                'type'    => 'textarea',
                'title'   => __( 'Content', 'kavro-framework' ),
                'rows'    => 5,
                'default' => __( 'Build widget settings with the same Kavro field API.', 'kavro-framework' ),
            ),
            array(
                'id'      => 'layout',
                'type'    => 'select',
                'title'   => __( 'Layout', 'kavro-framework' ),
                'options' => array(
                    'stacked' => __( 'Stacked', 'kavro-framework' ),
                    'inline'  => __( 'Inline', 'kavro-framework' ),
                    'card'    => __( 'Card', 'kavro-framework' ),
                ),
                'default' => 'card',
            ),
            array(
                'id'      => 'accent_color',
                'type'    => 'color',
                'title'   => __( 'Accent Color', 'kavro-framework' ),
                'default' => '#5b5cf6',
            ),
        ),
    )
);

/**
 * Media and call-to-action controls.
 */
KAVRO::createSection(
    'kavro_demo_widget',
    array(
        'title'    => __( 'Media & Button', 'kavro-framework' ),
        'subtitle' => __( 'Useful widget fields for marketing/card widgets.', 'kavro-framework' ),
        'fields'   => array(
            array(
                'id'    => 'image',
                'type'  => 'image',
                'title' => __( 'Image', 'kavro-framework' ),
            ),
            array(
                'id'      => 'button_text',
                'type'    => 'text',
                'title'   => __( 'Button Text', 'kavro-framework' ),
                'default' => __( 'Learn More', 'kavro-framework' ),
            ),
            array(
                'id'          => 'button_url',
                'type'        => 'url',
                'title'       => __( 'Button URL', 'kavro-framework' ),
                'placeholder' => 'https://example.com',
            ),
            array(
                'id'      => 'open_new_tab',
                'type'    => 'switcher',
                'title'   => __( 'Open in New Tab', 'kavro-framework' ),
                'default' => false,
            ),
        ),
    )
);

/**
 * Advanced widget controls.
 */
KAVRO::createSection(
    'kavro_demo_widget',
    array(
        'title'    => __( 'Advanced', 'kavro-framework' ),
        'subtitle' => __( 'A small sample of advanced fields that also work inside widgets.', 'kavro-framework' ),
        'fields'   => array(
            array(
                'id'      => 'visibility',
                'type'    => 'button_set',
                'title'   => __( 'Visibility', 'kavro-framework' ),
                'options' => array(
                    'all'      => __( 'All Users', 'kavro-framework' ),
                    'loggedin' => __( 'Logged In', 'kavro-framework' ),
                    'guest'    => __( 'Guests', 'kavro-framework' ),
                ),
                'default' => 'all',
            ),
            array(
                'id'      => 'custom_classes',
                'type'    => 'text',
                'title'   => __( 'Custom CSS Classes', 'kavro-framework' ),
                'default' => '',
            ),
            array(
                'id'      => 'padding',
                'type'    => 'spacing',
                'title'   => __( 'Padding', 'kavro-framework' ),
                'default' => array(
                    'top'    => '24',
                    'right'  => '24',
                    'bottom' => '24',
                    'left'   => '24',
                    'unit'   => 'px',
                ),
            ),
        ),
    )
);
