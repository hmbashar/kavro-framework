<?php
/**
 * Base field abstraction for Kavro Framework.
 *
 * Every field type extends this class and only implements the render() method.
 * The base class handles common field wrapping, labels, descriptions, naming,
 * and shared helpers so each field class stays small and consistent.
 *
 * @package Kavro\Core
 */

namespace Kavro;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * AbstractField
 *
 * Provides the shared presentation contract for all Kavro fields.
 */
abstract class AbstractField {
    /** @var array Field configuration array passed by the developer. */
    protected $field;

    /** @var mixed Current saved/default field value. */
    protected $value;

    /** @var string Option container key used as the base input name. */
    protected $unique;

    /** @var string Sanitized field ID. */
    protected $id;

    /** @var string HTML input name for the field. */
    protected $name;

    /**
     * Store field context and prepare commonly used values.
     *
     * @param array  $field  Field configuration.
     * @param mixed  $value  Current field value.
     * @param string $unique Option container ID.
     */
    public function __construct( $field, $value, $unique ) {
        $this->field  = is_array( $field ) ? $field : array();
        $this->value  = $value;
        $this->unique = sanitize_key( $unique );
        $this->id     = isset( $field['id'] ) ? sanitize_key( $field['id'] ) : '';
        $this->name   = $this->id ? $this->unique . '[' . $this->id . ']' : '';
    }

    /**
     * Render the complete field row including label, control, and description.
     *
     * Structural fields such as heading/content/notice may intentionally skip a
     * normal label, but still benefit from the same premium card styling.
     *
     * @return void
     */
    public function output() {
        $type = isset( $this->field['type'] ) ? sanitize_key( $this->field['type'] ) : 'text';
        $full_width_types = array( 'content', 'heading', 'notice', 'subheading', 'divider' );
        $is_full_width = in_array( $type, $full_width_types, true );

        echo '<div class="kavro-field kavro-field-' . esc_attr( $type ) . ( $is_full_width ? ' kavro-field-full' : '' ) . '">';

        if ( ! $is_full_width ) {
            echo '<div class="kavro-field-label">';
            if ( ! empty( $this->field['title'] ) ) {
                echo '<label for="kavro-' . esc_attr( $this->id ) . '">' . esc_html( $this->field['title'] ) . '</label>';
            }
            if ( ! empty( $this->field['subtitle'] ) ) {
                echo '<p>' . esc_html( $this->field['subtitle'] ) . '</p>';
            }
            echo '</div>';
        }

        echo '<div class="kavro-field-control">';
        $this->render();

        if ( ! empty( $this->field['desc'] ) ) {
            echo '<p class="kavro-desc">' . wp_kses_post( $this->field['desc'] ) . '</p>';
        }

        echo '</div></div>';
    }

    /**
     * Render only the field control markup.
     *
     * Child field classes should keep sanitization/escaping strict and should not
     * print their own global field row wrapper.
     *
     * @return void
     */
    abstract public function render();

    /**
     * Return a field configuration value with an optional default.
     *
     * @param string $key     Configuration key.
     * @param mixed  $default Fallback value.
     * @return mixed
     */
    protected function attr( $key, $default = '' ) {
        return isset( $this->field[ $key ] ) ? $this->field[ $key ] : $default;
    }

    /**
     * Return an escaped placeholder attribute value.
     *
     * @return string
     */
    protected function placeholder() {
        return esc_attr( $this->attr( 'placeholder', '' ) );
    }

    /**
     * Render common numeric/input attributes supported by many fields.
     *
     * @return string Escaped HTML attributes.
     */
    protected function input_attrs() {
        $attrs = '';

        foreach ( array( 'min', 'max', 'step', 'rows', 'maxlength' ) as $attr ) {
            if ( isset( $this->field[ $attr ] ) ) {
                $attrs .= ' ' . $attr . '="' . esc_attr( $this->field[ $attr ] ) . '"';
            }
        }

        return $attrs;
    }

    /**
     * Normalize array values used by compound fields.
     *
     * @return array
     */
    protected function array_value() {
        return is_array( $this->value ) ? $this->value : array();
    }
}
