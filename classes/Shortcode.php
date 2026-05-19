<?php
/**
 * Shortcode framework controller.
 *
 * This module registers frontend shortcodes and provides a small admin-side
 * generator UI so developers and site owners can build shortcode strings from
 * the same Kavro field configuration style used in options, metaboxes, and
 * other modules.
 *
 * @package Kavro\Core
 */

namespace Kavro;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Shortcode
 *
 * Registers a single shortcode definition and optional generator screen.
 */
class Shortcode {
    /** @var string Unique shortcode container key. */
    protected $unique;

    /** @var array Shortcode configuration arguments. */
    protected $args;

    /** @var array Section definitions containing shortcode attributes. */
    protected $sections;

    /**
     * Register WordPress hooks for this shortcode definition.
     *
     * @param string $unique   Unique shortcode container key.
     * @param array  $args     Shortcode arguments.
     * @param array  $sections Section/field definitions.
     */
    public function __construct( $unique, $args, $sections ) {
        $this->unique   = sanitize_key( $unique );
        $this->args     = $args;
        $this->sections = is_array( $sections ) ? $sections : array();

        add_action( 'init', array( $this, 'register_shortcode' ), 30 );
        add_action( 'admin_menu', array( $this, 'add_generator_page' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_assets' ) );
    }

    /**
     * Register the frontend shortcode tag.
     *
     * @return void
     */
    public function register_shortcode() {
        $tag = $this->get_tag();

        if ( $tag ) {
            add_shortcode( $tag, array( $this, 'render_shortcode' ) );
        }
    }

    /**
     * Add an admin generator page for the shortcode.
     *
     * @return void
     */
    public function add_generator_page() {
        $capability = isset( $this->args['capability'] ) ? $this->args['capability'] : 'manage_options';
        $parent     = isset( $this->args['menu_parent'] ) ? $this->args['menu_parent'] : 'tools.php';
        $title      = isset( $this->args['title'] ) ? $this->args['title'] : 'Kavro Shortcode';

        add_submenu_page(
            $parent,
            $title,
            $title,
            $capability,
            'kavro-shortcode-' . $this->unique,
            array( $this, 'render_generator_page' )
        );
    }

    /**
     * Enqueue Kavro admin assets for shortcode generator screens only.
     *
     * @param string $hook Current admin hook suffix.
     * @return void
     */
    public function enqueue_assets( $hook ) {
        if ( false === strpos( $hook, 'kavro-shortcode-' . $this->unique ) ) {
            return;
        }

        Assets::enqueue( $this->sections );
    }

    /**
     * Render the admin shortcode generator page.
     *
     * @return void
     */
    public function render_generator_page() {
        $tag = $this->get_tag();

        echo '<div class="wrap kavro-shortcode-wrap">';
        echo '<h1>' . esc_html( $this->args['title'] ?? 'Kavro Shortcode' ) . '</h1>';

        if ( ! empty( $this->args['description'] ) ) {
            echo '<p class="description">' . esc_html( $this->args['description'] ) . '</p>';
        }

        echo '<div class="kavro-shortcode-generator" data-kavro-shortcode-tag="' . esc_attr( $tag ) . '">';
        echo '<div class="kavro-shortcode-grid">';
        echo '<div class="kavro-shortcode-fields">';

        foreach ( $this->sections as $section ) {
            echo '<div class="kavro-panel-section is-active">';

            if ( ! empty( $section['title'] ) ) {
                echo '<div class="kavro-section-heading">';
                echo '<h2>' . esc_html( $section['title'] ) . '</h2>';

                if ( ! empty( $section['subtitle'] ) ) {
                    echo '<p>' . esc_html( $section['subtitle'] ) . '</p>';
                }

                echo '</div>';
            }

            if ( ! empty( $section['fields'] ) && is_array( $section['fields'] ) ) {
                foreach ( $section['fields'] as $field ) {
                    $value = isset( $field['default'] ) ? $field['default'] : '';
                    Fields::render( $field, $value, 'kavro_shortcode_' . $this->unique );
                }
            }

            echo '</div>';
        }

        echo '</div>';
        echo '<div class="kavro-shortcode-output">';
        echo '<h2>' . esc_html__( 'Generated Shortcode', 'kavro-framework' ) . '</h2>';
        echo '<textarea class="large-text code kavro-shortcode-result" rows="6" readonly>[' . esc_html( $tag ) . ']</textarea>';
        echo '<p><button type="button" class="button button-primary kavro-generate-shortcode">' . esc_html__( 'Generate Shortcode', 'kavro-framework' ) . '</button> ';
        echo '<button type="button" class="button kavro-copy-shortcode">' . esc_html__( 'Copy', 'kavro-framework' ) . '</button></p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

        $this->print_generator_script();

        echo '</div>';
    }

    /**
     * Render the frontend shortcode output.
     *
     * @param array|string $atts    Shortcode attributes.
     * @param string|null  $content Enclosed shortcode content.
     * @return string
     */
    public function render_shortcode( $atts = array(), $content = null ) {
        $atts = shortcode_atts( $this->get_default_atts(), (array) $atts, $this->get_tag() );

        if ( ! empty( $this->args['render'] ) && is_callable( $this->args['render'] ) ) {
            return (string) call_user_func( $this->args['render'], $atts, $content, $this->get_tag() );
        }

        ob_start();
        echo '<div class="kavro-shortcode kavro-shortcode-' . esc_attr( $this->unique ) . '">';

        if ( ! empty( $atts['title'] ) ) {
            echo '<h3>' . esc_html( $atts['title'] ) . '</h3>';
        }

        if ( null !== $content && '' !== $content ) {
            echo '<div class="kavro-shortcode-content">' . wp_kses_post( do_shortcode( $content ) ) . '</div>';
        }

        echo '<pre>' . esc_html( wp_json_encode( $atts, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES ) ) . '</pre>';
        echo '</div>';

        return ob_get_clean();
    }

    /**
     * Return the configured shortcode tag.
     *
     * @return string
     */
    protected function get_tag() {
        return sanitize_key( $this->args['tag'] ?? $this->unique );
    }

    /**
     * Build default shortcode attributes from field defaults.
     *
     * @return array
     */
    protected function get_default_atts() {
        $defaults = array();

        foreach ( $this->sections as $section ) {
            if ( empty( $section['fields'] ) || ! is_array( $section['fields'] ) ) {
                continue;
            }

            foreach ( $section['fields'] as $field ) {
                if ( empty( $field['id'] ) ) {
                    continue;
                }

                $defaults[ sanitize_key( $field['id'] ) ] = isset( $field['default'] ) && is_scalar( $field['default'] ) ? (string) $field['default'] : '';
            }
        }

        return $defaults;
    }

    /**
     * Print small generator behavior inline to avoid another asset file for MVP.
     *
     * @return void
     */
    protected function print_generator_script() {
        ?>
        <script>
        (function($){
            'use strict';

            function kavroShortcodeValue($field) {
                var type = ($field.attr('type') || '').toLowerCase();

                if ('checkbox' === type) {
                    return $field.is(':checked') ? ($field.val() || '1') : '';
                }

                if ('radio' === type) {
                    var name = $field.attr('name');
                    return $('[name="' + name.replace(/([\\[\\]])/g, '\\$1') + '"]:checked').val() || '';
                }

                return $field.val() || '';
            }

            $('.kavro-generate-shortcode').on('click', function(){
                var $wrap = $(this).closest('.kavro-shortcode-generator');
                var tag = $wrap.data('kavro-shortcode-tag');
                var parts = [];

                $wrap.find(':input[name^="kavro_shortcode_"]').each(function(){
                    var $field = $(this);
                    var name = $field.attr('name') || '';
                    var match = name.match(/\[([^\[\]]+)\]$/);
                    var key = match ? match[1] : '';
                    var value = kavroShortcodeValue($field);

                    if (!key || '' === value || $field.is(':button, button, [type="hidden"]')) {
                        return;
                    }

                    parts.push(key + '="' + String(value).replace(/"/g, '&quot;') + '"');
                });

                $wrap.find('.kavro-shortcode-result').val('[' + tag + (parts.length ? ' ' + parts.join(' ') : '') + ']');
            });

            $('.kavro-copy-shortcode').on('click', function(){
                var $textarea = $(this).closest('.kavro-shortcode-output').find('.kavro-shortcode-result');
                $textarea.trigger('select');
                document.execCommand('copy');
            });
        })(jQuery);
        </script>
        <?php
    }
}
