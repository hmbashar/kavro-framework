<?php
/**
 * BoxModel field.
 *
 * Provides a polished Kavro control for complex WordPress option data.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\BoxModel;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the BoxModel field.
 */
class BoxModel extends AbstractField {
    /**
     * Output the field control markup.
     *
     * @return void
     */
    public function render() {
        $value = $this->array_value();
        $groups = array( 'margin' => 'Margin', 'padding' => 'Padding' );
        foreach ( $groups as $group => $title ) {
            echo '<div class="kavro-box-model"><strong>' . esc_html( $title ) . '</strong><div class="kavro-compound-grid">';
            foreach ( array( 'top', 'right', 'bottom', 'left' ) as $side ) {
                $current = isset( $value[ $group ][ $side ] ) ? $value[ $group ][ $side ] : '';
                echo '<label class="kavro-mini-control"><span>' . esc_html( ucfirst( $side ) ) . '</span><input type="text" name="' . esc_attr( $this->name ) . '[' . esc_attr( $group ) . '][' . esc_attr( $side ) . ']" value="' . esc_attr( $current ) . '" placeholder="0px"></label>';
            }
            echo '</div></div>';
        }
    }
}
