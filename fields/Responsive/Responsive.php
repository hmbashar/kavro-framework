<?php
/**
 * responsive_value field for Kavro Framework.
 *
 * @package Kavro\Fields
 */

namespace Kavro\Fields\Responsive;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the responsive_value field.
 */
class Responsive extends AbstractField {
    /** Render the field control. */
    public function render() {

        $value = $this->array_value();
        $devices = array( 'desktop' => 'Desktop', 'tablet' => 'Tablet', 'mobile' => 'Mobile' );
        echo '<div class="kavro-responsive-field">';
        foreach ( $devices as $device => $label ) {
            echo '<label><span>' . esc_html( $label ) . '</span><input type="text" name="' . esc_attr( $this->name . '[' . $device . ']' ) . '" value="' . esc_attr( isset( $value[ $device ] ) ? $value[ $device ] : '' ) . '" placeholder="0px"></label>';
        }
        echo '</div>';
    }
}
