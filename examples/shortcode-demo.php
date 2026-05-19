<?php
/**
 * Kavro Framework shortcode demo.
 *
 * This file demonstrates how to register frontend shortcodes and an admin-side
 * generator screen with KAVRO::createShortcode(). The demo uses simple scalar
 * fields because shortcode attributes are text-based by design.
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
 * Unique shortcode container key.
 *
 * The generated admin page appears under Tools and the frontend shortcode tag is
 * configured with the `tag` argument below.
 */
$prefix = 'kavro_demo_shortcode';

/**
 * Register a shortcode definition.
 *
 * Example usage after activation:
 * [kavro_card title="Hello" style="primary" align="center"]
 */
KAVRO::createShortcode(
    $prefix,
    array(
        'title'       => 'Kavro Card Shortcode',
        'tag'         => 'kavro_card',
        'description' => 'Demo shortcode generator for card-style frontend output.',
        'capability'  => 'manage_options',
        'menu_parent' => 'tools.php',

        /**
         * Optional render callback.
         *
         * @param array       $atts    Shortcode attributes.
         * @param string|null $content Enclosed shortcode content.
         * @param string      $tag     Shortcode tag.
         * @return string Frontend HTML.
         */
        'render'      => function( $atts, $content = null, $tag = '' ) {
            $title   = isset( $atts['title'] ) ? $atts['title'] : '';
            $text    = isset( $atts['text'] ) ? $atts['text'] : '';
            $style   = isset( $atts['style'] ) ? $atts['style'] : 'primary';
            $align   = isset( $atts['align'] ) ? $atts['align'] : 'left';
            $button  = isset( $atts['button_text'] ) ? $atts['button_text'] : '';
            $url     = isset( $atts['button_url'] ) ? $atts['button_url'] : '';

            ob_start();
            ?>
            <div class="kavro-demo-card kavro-demo-card-<?php echo esc_attr( $style ); ?>" style="text-align: <?php echo esc_attr( $align ); ?>; padding: 24px; border: 1px solid #e5e7eb; border-radius: 16px; background: #ffffff;">
                <?php if ( $title ) : ?>
                    <h3><?php echo esc_html( $title ); ?></h3>
                <?php endif; ?>

                <?php if ( $text ) : ?>
                    <p><?php echo esc_html( $text ); ?></p>
                <?php endif; ?>

                <?php if ( $content ) : ?>
                    <div><?php echo wp_kses_post( do_shortcode( $content ) ); ?></div>
                <?php endif; ?>

                <?php if ( $button && $url ) : ?>
                    <p><a href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $button ); ?></a></p>
                <?php endif; ?>
            </div>
            <?php
            return ob_get_clean();
        },
    )
);

/**
 * Section: Card Content.
 */
KAVRO::createSection(
    $prefix,
    array(
        'id'       => 'shortcode-card-content',
        'title'    => 'Card Content',
        'subtitle' => 'Content attributes used by the kavro_card shortcode.',
        'fields'   => array(

            // Attribute: title.
            array(
                'id'      => 'title',
                'type'    => 'text',
                'title'   => 'Title',
                'default' => 'Build Better WordPress Settings',
                'desc'    => 'Generated as the title="" shortcode attribute.',
            ),

            // Attribute: text.
            array(
                'id'      => 'text',
                'type'    => 'textarea',
                'title'   => 'Text',
                'default' => 'Kavro makes it easy to register fields across options, metaboxes, taxonomies, profiles, widgets, comments, and shortcodes.',
                'rows'    => 4,
            ),
        ),
    )
);

/**
 * Section: Appearance.
 */
KAVRO::createSection(
    $prefix,
    array(
        'id'       => 'shortcode-card-appearance',
        'title'    => 'Appearance',
        'subtitle' => 'Simple visual shortcode attributes.',
        'fields'   => array(

            // Attribute: style.
            array(
                'id'      => 'style',
                'type'    => 'button_set',
                'title'   => 'Style',
                'options' => array(
                    'primary' => 'Primary',
                    'light'   => 'Light',
                    'dark'    => 'Dark',
                ),
                'default' => 'primary',
            ),

            // Attribute: align.
            array(
                'id'      => 'align',
                'type'    => 'select',
                'title'   => 'Alignment',
                'options' => array(
                    'left'   => 'Left',
                    'center' => 'Center',
                    'right'  => 'Right',
                ),
                'default' => 'center',
            ),
        ),
    )
);

/**
 * Section: Call To Action.
 */
KAVRO::createSection(
    $prefix,
    array(
        'id'       => 'shortcode-card-cta',
        'title'    => 'Call To Action',
        'subtitle' => 'Optional button attributes for the demo card.',
        'fields'   => array(

            // Attribute: button_text.
            array(
                'id'      => 'button_text',
                'type'    => 'text',
                'title'   => 'Button Text',
                'default' => 'Learn More',
            ),

            // Attribute: button_url.
            array(
                'id'          => 'button_url',
                'type'        => 'url',
                'title'       => 'Button URL',
                'placeholder' => 'https://example.com',
                'default'     => home_url( '/' ),
            ),
        ),
    )
);
