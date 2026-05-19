<?php
/** Two-column enabled/disabled sorter field. */
namespace Kavro\Fields\Sorter;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Sorter extends AbstractField {
    public function render() {
        $options = (array) $this->attr( 'options', array() );
        $enabled = is_array( $this->value ) && isset( $this->value['enabled'] ) ? (array) $this->value['enabled'] : array();
        echo '<div class="kavro-sorter"><div><strong>Enabled</strong><ul class="kavro-sorter-list">';
        foreach ( $enabled as $key ) { if ( isset( $options[ $key ] ) ) { printf( '<li><input type="hidden" name="%1$s[enabled][]" value="%2$s">%3$s</li>', esc_attr( $this->name ), esc_attr( $key ), esc_html( $options[ $key ] ) ); unset( $options[ $key ] ); } }
        echo '</ul></div><div><strong>Available</strong><ul class="kavro-sorter-list">';
        foreach ( $options as $key => $label ) { printf( '<li><input type="hidden" name="%1$s[disabled][]" value="%2$s">%3$s</li>', esc_attr( $this->name ), esc_attr( $key ), esc_html( $label ) ); }
        echo '</ul></div></div>';
    }
}
