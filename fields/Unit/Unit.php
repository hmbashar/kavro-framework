<?php
/**
 * Unit field for numeric values with selectable measurement units.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\Unit;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class Unit extends AbstractField {
    public function render() {
        $value = $this->array_value();
        $number = isset( $value['value'] ) ? $value['value'] : '';
        $unit = isset( $value['unit'] ) ? $value['unit'] : $this->attr( 'default_unit', 'px' );
        $units = (array) $this->attr( 'units', array( 'px' => 'px', '%' => '%', 'em' => 'em', 'rem' => 'rem', 'vh' => 'vh', 'vw' => 'vw' ) );
        echo '<div class="kavro-inline kavro-unit-field">';
        printf( '<input type="number" id="kavro-%1$s" name="%2$s[value]" value="%3$s" placeholder="%4$s"%5$s>', esc_attr( $this->id ), esc_attr( $this->name ), esc_attr( $number ), $this->placeholder(), $this->input_attrs() );
        echo '<select name="' . esc_attr( $this->name ) . '[unit]">';
        foreach ( $units as $unit_value => $unit_label ) {
            printf( '<option value="%1$s" %2$s>%3$s</option>', esc_attr( $unit_value ), selected( $unit, $unit_value, false ), esc_html( $unit_label ) );
        }
        echo '</select></div>';
    }
}
