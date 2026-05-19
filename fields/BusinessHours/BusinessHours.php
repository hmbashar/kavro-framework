<?php
/**
 * BusinessHours field.
 *
 * Premium Kavro control for advanced WordPress option data.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\BusinessHours;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the BusinessHours field.
 */
class BusinessHours extends AbstractField {
    /**
     * Output the field control markup.
     *
     * @return void
     */
    public function render() {
        $value = $this->array_value();
        $days = array( 'mon'=>'Monday', 'tue'=>'Tuesday', 'wed'=>'Wednesday', 'thu'=>'Thursday', 'fri'=>'Friday', 'sat'=>'Saturday', 'sun'=>'Sunday' );
        echo '<div class="kavro-business-hours">';
        foreach ( $days as $key => $label ) {
            echo '<div class="kavro-hours-row"><strong>' . esc_html( $label ) . '</strong><input type="time" name="' . esc_attr( $this->name ) . '[' . esc_attr( $key ) . '][open]" value="' . esc_attr( $value[ $key ]['open'] ?? '' ) . '"><input type="time" name="' . esc_attr( $this->name ) . '[' . esc_attr( $key ) . '][close]" value="' . esc_attr( $value[ $key ]['close'] ?? '' ) . '"><label><input type="checkbox" name="' . esc_attr( $this->name ) . '[' . esc_attr( $key ) . '][closed]" value="1" ' . checked( ! empty( $value[ $key ]['closed'] ), true, false ) . '> Closed</label></div>';
        }
        echo '</div>';
    }
}
