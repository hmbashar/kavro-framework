<?php
namespace Kavro\Fields\ColorGroup;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) { exit; }

class ColorGroup extends AbstractField {
    public function render() {
        $value = is_array( $this->value ) ? $this->value : array();
        echo '<div class="kavro-compound kavro-color-group">';
        foreach ( (array) $this->attr( 'options', array() ) as $key => $label ) {
            echo '<label><span>' . esc_html( $label ) . '</span><input class="kavro-color" type="text" name="' . esc_attr( $this->name . '[' . sanitize_key( $key ) . ']' ) . '" value="' . esc_attr( $value[$key] ?? '' ) . '"></label>';
        }
        echo '</div>';
    }
}
