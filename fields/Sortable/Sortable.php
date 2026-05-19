<?php
/** Sortable checkbox field for saving enabled items in chosen order. */
namespace Kavro\Fields\Sortable;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Sortable extends AbstractField {
    public function render() {
        $value = is_array( $this->value ) ? $this->value : array_keys( (array) $this->attr( 'options', array() ) );
        $options = (array) $this->attr( 'options', array() );
        $ordered = array_unique( array_merge( $value, array_keys( $options ) ) );
        echo '<ul class="kavro-sortable-list">';
        foreach ( $ordered as $key ) {
            if ( ! isset( $options[ $key ] ) ) { continue; }
            printf( '<li><span class="dashicons dashicons-menu"></span><label><input type="checkbox" name="%1$s[]" value="%2$s" checked> %3$s</label></li>', esc_attr( $this->name ), esc_attr( $key ), esc_html( $options[ $key ] ) );
        }
        echo '</ul>';
    }
}
