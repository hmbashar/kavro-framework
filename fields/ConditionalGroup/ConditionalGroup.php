<?php
/**
 * ConditionalGroup field.
 *
 * Provides a polished Kavro control for complex WordPress option data.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\ConditionalGroup;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the ConditionalGroup field.
 */
class ConditionalGroup extends AbstractField {
    /**
     * Output the field control markup.
     *
     * @return void
     */
    public function render() {
        $value = $this->array_value();
        echo '<div class="kavro-builder-card"><p class="kavro-builder-title">Conditional Rules</p>';
        foreach ( array( 'field' => 'Field ID', 'operator' => 'Operator', 'value' => 'Value' ) as $key => $label ) {
            echo '<label class="kavro-mini-control"><span>' . esc_html( $label ) . '</span><input type="text" name="' . esc_attr( $this->name ) . '[' . esc_attr( $key ) . ']" value="' . esc_attr( isset( $value[$key] ) ? $value[$key] : '' ) . '"></label>';
        }
        echo '</div>';
    }
}
