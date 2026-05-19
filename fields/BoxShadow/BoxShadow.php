<?php
/**
 * Box shadow field for premium visual controls.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\BoxShadow;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class BoxShadow extends AbstractField {
    public function render() {
        $value = wp_parse_args( $this->array_value(), array( 'x'=>'0', 'y'=>'18', 'blur'=>'45', 'spread'=>'0', 'color'=>'rgba(15,23,42,.18)', 'inset'=>'' ) );
        echo '<div class="kavro-compound kavro-shadow-field">';
        foreach ( array( 'x'=>'X', 'y'=>'Y', 'blur'=>'Blur', 'spread'=>'Spread' ) as $key => $label ) {
            printf( '<label><span>%1$s</span><input type="number" name="%2$s[%3$s]" value="%4$s"></label>', esc_html( $label ), esc_attr( $this->name ), esc_attr( $key ), esc_attr( $value[$key] ) );
        }
        printf( '<label><span>Color</span><input type="text" name="%1$s[color]" value="%2$s" placeholder="rgba(15,23,42,.18)"></label>', esc_attr( $this->name ), esc_attr( $value['color'] ) );
        printf( '<label class="kavro-checkbox-inline"><input type="checkbox" name="%1$s[inset]" value="1" %2$s><span></span> Inset</label>', esc_attr( $this->name ), checked( $value['inset'], '1', false ) );
        echo '</div>';
    }
}
