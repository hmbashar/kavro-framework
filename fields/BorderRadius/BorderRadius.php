<?php
/**
 * BorderRadius field.
 *
 * Provides a polished Kavro control for complex WordPress option data.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\BorderRadius;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the BorderRadius field.
 */
class BorderRadius extends AbstractField {
    /**
     * Output the field control markup.
     *
     * @return void
     */
    public function render() {
        $value = $this->array_value();
        $parts = (array) $this->attr( 'options', array( 'top_left' => 'Top Left', 'top_right' => 'Top Right', 'bottom_right' => 'Bottom Right', 'bottom_left' => 'Bottom Left' ) );
        echo '<div class="kavro-compound-grid kavro-premium-grid">';
        foreach ( $parts as $key => $label ) {
            $current = isset( $value[ $key ] ) ? $value[ $key ] : '';
            echo '<label class="kavro-mini-control"><span>' . esc_html( $label ) . '</span><input type="text" name="' . esc_attr( $this->name ) . '[' . esc_attr( $key ) . ']" value="' . esc_attr( $current ) . '" placeholder="0"></label>';
        }
        echo '</div>';
    }
}
