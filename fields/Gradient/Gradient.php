<?php
/**
 * Gradient field for building simple linear gradients.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\Gradient;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class Gradient extends AbstractField {
    public function render() {
        $value = $this->array_value();
        $from = isset( $value['from'] ) ? $value['from'] : '#6d5dfc';
        $to = isset( $value['to'] ) ? $value['to'] : '#10b6d8';
        $direction = isset( $value['direction'] ) ? $value['direction'] : '135deg';
        echo '<div class="kavro-gradient-field">';
        echo '<div class="kavro-gradient-preview" style="background:linear-gradient(' . esc_attr( $direction ) . ',' . esc_attr( $from ) . ',' . esc_attr( $to ) . ')"></div>';
        echo '<div class="kavro-grid-3">';
        printf( '<label><span>From</span><input type="color" name="%1$s[from]" value="%2$s"></label>', esc_attr( $this->name ), esc_attr( $from ) );
        printf( '<label><span>To</span><input type="color" name="%1$s[to]" value="%2$s"></label>', esc_attr( $this->name ), esc_attr( $to ) );
        printf( '<label><span>Direction</span><select name="%1$s[direction]">', esc_attr( $this->name ) );
        foreach ( array( '90deg'=>'Left to Right', '135deg'=>'Diagonal', '180deg'=>'Top to Bottom', '45deg'=>'Reverse Diagonal' ) as $val => $label ) {
            printf( '<option value="%1$s" %2$s>%3$s</option>', esc_attr( $val ), selected( $direction, $val, false ), esc_html( $label ) );
        }
        echo '</select></label></div></div>';
    }
}
