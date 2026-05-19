<?php
/**
 * css_builder field for Kavro Framework.
 *
 * @package Kavro\Fields
 */

namespace Kavro\Fields\CssBuilder;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the css_builder field.
 */
class CssBuilder extends AbstractField {
    /** Render the field control. */
    public function render() {

        $value = $this->array_value();
        $parts = array( 'selector' => 'Selector', 'property' => 'Property', 'value' => 'Value' );
        echo '<div class="kavro-css-builder">';
        foreach ( $parts as $key => $label ) {
            echo '<label><span>' . esc_html( $label ) . '</span><input type="text" name="' . esc_attr( $this->name . '[' . $key . ']' ) . '" value="' . esc_attr( isset( $value[ $key ] ) ? $value[ $key ] : '' ) . '"></label>';
        }
        echo '</div>';
    }
}
