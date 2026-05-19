<?php
namespace Kavro\Fields\Border;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Border extends AbstractField {
    public function render() {
        $value = is_array( $this->value ) ? $this->value : array();
        $style = $value['style'] ?? 'solid';
        echo '<div class="kavro-compound kavro-border">';
        foreach ( array( 'width'=>'Width', 'radius'=>'Radius' ) as $key => $label ) {
            echo '<label><span>' . esc_html( $label ) . '</span><input type="number" name="' . esc_attr( $this->name . '[' . $key . ']' ) . '" value="' . esc_attr( $value[$key] ?? '' ) . '"></label>';
        }
        echo '<label><span>Style</span><select name="' . esc_attr( $this->name . '[style]' ) . '">';
        foreach ( array( 'solid'=>'Solid', 'dashed'=>'Dashed', 'dotted'=>'Dotted', 'double'=>'Double' ) as $k=>$l ) { echo '<option value="' . esc_attr( $k ) . '" ' . selected( $style, $k, false ) . '>' . esc_html( $l ) . '</option>'; }
        echo '</select></label>';
        echo '<label><span>Color</span><input class="kavro-color" type="text" name="' . esc_attr( $this->name . '[color]' ) . '" value="' . esc_attr( $value['color'] ?? '' ) . '"></label>';
        echo '</div>';
    }
}
