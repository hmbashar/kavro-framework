<?php
/**
 * Widget options framework controller for Kavro Framework.
 *
 * This module registers a WordPress widget from a Kavro field definition. It
 * reuses the same field renderer as options, metaboxes, taxonomy, profile, and
 * nav menu modules, but adapts field input names to WordPress widget instance
 * naming rules.
 *
 * @package Kavro\Core
 */

namespace Kavro;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Widget
 *
 * Adds Codestar-style widget option support through KAVRO::createWidgetOptions().
 */
class Widget extends \WP_Widget {
    /** @var string Unique widget container ID. */
    protected $unique;

    /** @var array Widget arguments. */
    protected $args;

    /** @var array Field sections assigned to this widget. */
    protected $sections;

    /**
     * Create a Kavro-powered WordPress widget instance.
     *
     * @param string $unique   Unique widget ID passed to KAVRO::createWidgetOptions().
     * @param array  $args     Widget registration arguments.
     * @param array  $sections Field sections for the widget form.
     */
    public function __construct( $unique = 'kavro_widget', $args = array(), $sections = array() ) {
        $this->unique   = sanitize_key( $unique );
        $this->args     = wp_parse_args(
            $args,
            array(
                'title'       => 'Kavro Widget',
                'description' => 'A widget powered by Kavro Framework fields.',
                'classname'   => 'kavro-widget',
            )
        );
        $this->sections = is_array( $sections ) ? $sections : array();

        parent::__construct(
            $this->unique,
            $this->args['title'],
            array(
                'classname'                   => sanitize_html_class( $this->args['classname'] ),
                'description'                 => $this->args['description'],
                'customize_selective_refresh' => true,
            )
        );

        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_assets' ) );
    }

    /**
     * Register this configured widget with WordPress.
     *
     * register_widget() only accepts class names, while Kavro widgets are built
     * from runtime configuration arrays. Registering the object directly in the
     * widget factory keeps the public API clean and allows multiple Kavro widget
     * definitions to coexist.
     *
     * @return void
     */
    public function register() {
        global $wp_widget_factory;

        if ( ! isset( $wp_widget_factory ) || ! is_object( $wp_widget_factory ) ) {
            return;
        }

        $wp_widget_factory->widgets[ get_class( $this ) . '_' . $this->unique ] = $this;
    }

    /**
     * Enqueue Kavro admin assets for the Widgets and Customizer screens.
     *
     * @param string $hook Current admin hook name.
     * @return void
     */
    public function enqueue_assets( $hook ) {
        if ( ! in_array( $hook, array( 'widgets.php', 'customize.php' ), true ) ) {
            return;
        }

        wp_enqueue_media();
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_style( 'dashicons' );
        wp_enqueue_style( 'kavro-admin', KAVRO_URL . 'assets/css/admin.css', array( 'wp-color-picker' ), KAVRO_VERSION );
        wp_enqueue_script( 'kavro-admin', KAVRO_URL . 'assets/js/admin.js', array( 'jquery', 'wp-color-picker', 'jquery-ui-sortable' ), KAVRO_VERSION, true );
    }

    /**
     * Render the widget output on the front end.
     *
     * Developers may pass a `callback` callable in createWidgetOptions() for
     * fully custom output. Without a callback, Kavro prints a simple title and
     * content fallback so the demo widget works immediately.
     *
     * @param array $args     WordPress sidebar display arguments.
     * @param array $instance Saved widget values.
     * @return void
     */
    public function widget( $args, $instance ) {
        $instance = is_array( $instance ) ? $instance : array();

        echo isset( $args['before_widget'] ) ? $args['before_widget'] : '';

        if ( ! empty( $instance['title'] ) ) {
            echo isset( $args['before_title'] ) ? $args['before_title'] : '';
            echo esc_html( $instance['title'] );
            echo isset( $args['after_title'] ) ? $args['after_title'] : '';
        }

        if ( ! empty( $this->args['callback'] ) && is_callable( $this->args['callback'] ) ) {
            call_user_func( $this->args['callback'], $args, $instance, $this );
        } elseif ( ! empty( $instance['content'] ) ) {
            echo '<div class="kavro-widget-content">' . wp_kses_post( wpautop( $instance['content'] ) ) . '</div>';
        }

        echo isset( $args['after_widget'] ) ? $args['after_widget'] : '';
    }

    /**
     * Render widget admin form fields.
     *
     * @param array $instance Saved widget instance values.
     * @return void
     */
    public function form( $instance ) {
        $instance = is_array( $instance ) ? $instance : array();

        echo '<div class="kavro-widget-form kavro-card">';

        foreach ( $this->sections as $section ) {
            echo '<div class="kavro-widget-section">';

            if ( ! empty( $section['title'] ) ) {
                echo '<div class="kavro-metabox-heading kavro-widget-heading"><h3>' . esc_html( $section['title'] ) . '</h3>';
                if ( ! empty( $section['subtitle'] ) ) {
                    echo '<p>' . esc_html( $section['subtitle'] ) . '</p>';
                }
                echo '</div>';
            }

            if ( ! empty( $section['fields'] ) && is_array( $section['fields'] ) ) {
                foreach ( $section['fields'] as $field ) {
                    $field_id = isset( $field['id'] ) ? sanitize_key( $field['id'] ) : '';
                    $value    = $field_id && array_key_exists( $field_id, $instance ) ? $instance[ $field_id ] : ( $field['default'] ?? '' );

                    if ( $field_id ) {
                        $field['_name'] = $this->get_field_name( $field_id );
                    }

                    Fields::render( $field, $value, $this->unique );
                }
            }

            echo '</div>';
        }

        echo '</div>';
    }

    /**
     * Sanitize and save widget instance values.
     *
     * @param array $new_instance Submitted values.
     * @param array $old_instance Previous values.
     * @return array
     */
    public function update( $new_instance, $old_instance ) {
        $new_instance = is_array( $new_instance ) ? $new_instance : array();
        return Fields::sanitize_values( $new_instance, $this->sections );
    }
}
