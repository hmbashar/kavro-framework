<?php
namespace Kavro;

if ( ! defined( 'ABSPATH' ) ) { exit; }

abstract class AbstractField {
    protected $field;
    protected $value;
    protected $unique;
    protected $id;
    protected $name;

    public function __construct( $field, $value, $unique ) {
        $this->field  = $field;
        $this->value  = $value;
        $this->unique = $unique;
        $this->id     = isset( $field['id'] ) ? sanitize_key( $field['id'] ) : '';
        $this->name   = $this->id ? $unique . '[' . $this->id . ']' : '';
    }

    public function output() {
        $type = isset( $this->field['type'] ) ? sanitize_key( $this->field['type'] ) : 'text';
        echo '<div class="kavro-field kavro-field-' . esc_attr( $type ) . '">';
        if ( ! empty( $this->field['title'] ) ) {
            echo '<div class="kavro-field-label"><label for="kavro-' . esc_attr( $this->id ) . '">' . esc_html( $this->field['title'] ) . '</label>';
            if ( ! empty( $this->field['subtitle'] ) ) { echo '<p>' . esc_html( $this->field['subtitle'] ) . '</p>'; }
            echo '</div>';
        } else {
            echo '<div class="kavro-field-label"></div>';
        }
        echo '<div class="kavro-field-control">';
        $this->render();
        if ( ! empty( $this->field['desc'] ) ) { echo '<p class="kavro-desc">' . wp_kses_post( $this->field['desc'] ) . '</p>'; }
        echo '</div></div>';
    }

    abstract public function render();

    protected function attr( $key, $default = '' ) { return isset( $this->field[ $key ] ) ? $this->field[ $key ] : $default; }
    protected function placeholder() { return esc_attr( $this->attr( 'placeholder', '' ) ); }
    protected function input_attrs() {
        $attrs = '';
        foreach ( array( 'min', 'max', 'step', 'rows' ) as $attr ) {
            if ( isset( $this->field[ $attr ] ) ) { $attrs .= ' ' . $attr . '="' . esc_attr( $this->field[ $attr ] ) . '"'; }
        }
        return $attrs;
    }
}
