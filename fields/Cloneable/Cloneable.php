<?php
/**
 * cloneable field for Kavro Framework.
 *
 * @package Kavro\Fields
 */

namespace Kavro\Fields\Cloneable;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the cloneable field.
 */
class Cloneable extends AbstractField {
    /** Render the field control. */
    public function render() {

        $items = is_array( $this->value ) ? $this->value : ( $this->value !== '' ? array( $this->value ) : array( '' ) );
        echo '<div class="kavro-cloneable" data-kavro-cloneable>';
        foreach ( $items as $index => $item ) {
            echo '<div class="kavro-cloneable-row"><input type="text" name="' . esc_attr( $this->name . '[' . $index . ']' ) . '" value="' . esc_attr( $item ) . '" placeholder="' . esc_attr( $this->placeholder() ) . '"><button type="button" class="button kavro-clone-remove">&times;</button></div>';
        }
        echo '<button type="button" class="button button-primary kavro-clone-add">' . esc_html__( 'Add Item', 'kavro-framework' ) . '</button></div>';
    }
}
