<?php
/**
 * ColorAlpha field.
 *
 * Provides a polished Kavro control for complex WordPress option data.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\ColorAlpha;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the ColorAlpha field.
 */
class ColorAlpha extends AbstractField {
    /**
     * Output the field control markup.
     *
     * @return void
     */
    public function render() {
        $value = $this->array_value();
        $color = isset( $value['color'] ) ? $value['color'] : '#635bff';
        $alpha = isset( $value['alpha'] ) ? $value['alpha'] : '1';
        echo '<div class="kavro-inline kavro-color-alpha"><input type="color" name="' . esc_attr( $this->name ) . '[color]" value="' . esc_attr( $color ) . '"><input type="range" min="0" max="1" step="0.01" name="' . esc_attr( $this->name ) . '[alpha]" value="' . esc_attr( $alpha ) . '"><span class="kavro-pill">Alpha</span></div>';
    }
}
