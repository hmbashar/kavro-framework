<?php
/**
 * LayoutBuilder field.
 *
 * Provides a polished Kavro control for complex WordPress option data.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\LayoutBuilder;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the LayoutBuilder field.
 */
class LayoutBuilder extends AbstractField {
    /**
     * Output the field control markup.
     *
     * @return void
     */
    public function render() {
        echo '<div class="kavro-layout-builder">';
        $layouts = (array) $this->attr( 'layouts', array( 'one' => '1 Column', 'two' => '2 Columns', 'sidebar' => 'Content + Sidebar' ) );
        $selected = is_scalar( $this->value ) ? (string) $this->value : '';

        foreach ( $layouts as $key => $label ) {
            echo '<label class="kavro-layout-choice"><input type="radio" name="' . esc_attr( $this->name ) . '" value="' . esc_attr( $key ) . '" ' . checked( $selected, (string) $key, false ) . '><span>' . esc_html( $label ) . '</span></label>';
        }
        echo '</div>';
    }
}
