<?php
/**
 * DimensionsAdvanced field.
 *
 * Provides a polished Kavro control for complex WordPress option data.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\DimensionsAdvanced;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the DimensionsAdvanced field.
 */
class DimensionsAdvanced extends AbstractField {
    /**
     * Output the field control markup.
     *
     * @return void
     */
    public function render() {
        $value = $this->array_value();
        $parts = (array) $this->attr( 'options', array( 'width' => 'Width', 'height' => 'Height', 'min_width' => 'Min Width', 'max_width' => 'Max Width' ) );
        echo '<div class="kavro-compound-grid kavro-premium-grid">';
        foreach ( $parts as $key => $label ) {
            $current = isset( $value[ $key ] ) ? $value[ $key ] : '';
            echo '<label class="kavro-mini-control"><span>' . esc_html( $label ) . '</span><input type="text" name="' . esc_attr( $this->name ) . '[' . esc_attr( $key ) . ']" value="' . esc_attr( $current ) . '" placeholder="0"></label>';
        }
        echo '</div>';
    }
}
