<?php
/** Fieldset field for saving a structured array of simple sub-fields. */
namespace Kavro\Fields\Fieldset;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Fieldset extends AbstractField {
    public function render() {
        $value = $this->array_value();
        echo '<div class="kavro-fieldset">';
        foreach ( (array) $this->attr( 'fields', array() ) as $subfield ) {
            $id = sanitize_key( $subfield['id'] ?? '' );
            if ( ! $id ) { continue; }
            $label = $subfield['title'] ?? $id;
            $type  = in_array( ( $subfield['type'] ?? 'text' ), array( 'number', 'email', 'url', 'date', 'time' ), true ) ? $subfield['type'] : 'text';
            printf( '<label><span>%1$s</span><input type="%2$s" name="%3$s[%4$s]" value="%5$s" placeholder="%6$s"></label>', esc_html( $label ), esc_attr( $type ), esc_attr( $this->name ), esc_attr( $id ), esc_attr( $value[ $id ] ?? ( $subfield['default'] ?? '' ) ), esc_attr( $subfield['placeholder'] ?? '' ) );
        }
        echo '</div>';
    }
}
