<?php
namespace Kavro\Fields\Multicheck;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Multicheck extends AbstractField {
    public function render() {
        $value = is_array( $this->value ) ? $this->value : array();
        echo '<div class="kavro-check-grid">';
        foreach ( (array) $this->attr( 'options', array() ) as $key => $label ) {
            $name = $this->unique . '[' . $this->id . '][]';
            echo '<label><input type="checkbox" name="' . esc_attr( $name ) . '" value="' . esc_attr( $key ) . '" ' . checked( in_array( (string) $key, array_map( 'strval', $value ), true ), true, false ) . '> <span>' . esc_html( $label ) . '</span></label>';
        }
        echo '</div>';
    }
}
