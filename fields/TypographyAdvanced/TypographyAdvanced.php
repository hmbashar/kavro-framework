<?php
/**
 * TypographyAdvanced field.
 *
 * Provides a polished Kavro control for complex WordPress option data.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\TypographyAdvanced;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the TypographyAdvanced field.
 */
class TypographyAdvanced extends AbstractField {
    /**
     * Output the field control markup.
     *
     * @return void
     */
    public function render() {
        $value = $this->array_value();
        $families = (array) $this->attr( 'families', array( 'Inter' => 'Inter', 'Roboto' => 'Roboto', 'Poppins' => 'Poppins', 'System UI' => 'System UI' ) );
        echo '<div class="kavro-typography-advanced kavro-premium-stack">';
        echo '<select name="' . esc_attr( $this->name ) . '[family]">';
        foreach ( $families as $family => $label ) { echo '<option value="' . esc_attr( $family ) . '" ' . selected( isset( $value['family'] ) ? $value['family'] : '', $family, false ) . '>' . esc_html( $label ) . '</option>'; }
        echo '</select><div class="kavro-compound-grid">';
        foreach ( array( 'size' => 'Size', 'weight' => 'Weight', 'line_height' => 'Line Height', 'letter_spacing' => 'Letter Spacing' ) as $key => $label ) {
            echo '<label class="kavro-mini-control"><span>' . esc_html( $label ) . '</span><input type="text" name="' . esc_attr( $this->name ) . '[' . esc_attr( $key ) . ']" value="' . esc_attr( isset( $value[$key] ) ? $value[$key] : '' ) . '"></label>';
        }
        echo '</div><input type="color" name="' . esc_attr( $this->name ) . '[color]" value="' . esc_attr( isset( $value['color'] ) ? $value['color'] : '#111827' ) . '"></div>';
    }
}
