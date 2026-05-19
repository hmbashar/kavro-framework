<?php
/**
 * Cloneable field for Kavro Framework.
 *
 * This renderer supports both simple cloneable text rows and structured
 * cloneable rows with sub-field definitions. It is intentionally defensive:
 * saved values can be strings, arrays, or legacy payloads without triggering
 * WordPress array-to-string warnings during rendering.
 *
 * @package Kavro\Fields
 */

namespace Kavro\Fields\Cloneable;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders repeatable cloneable rows.
 */
class Cloneable extends AbstractField {
    /**
     * Render the cloneable field control.
     *
     * @return void
     */
    public function render() {
        $sub_fields = isset( $this->field['fields'] ) && is_array( $this->field['fields'] ) ? $this->field['fields'] : array();
        $items      = is_array( $this->value ) ? array_values( $this->value ) : array();

        if ( empty( $items ) ) {
            $items = ! empty( $sub_fields ) ? array( array() ) : array( '' );
        }

        echo '<div class="kavro-cloneable" data-kavro-cloneable>';

        foreach ( $items as $index => $item ) {
            $this->render_row( $index, $item, $sub_fields );
        }

        echo '<button type="button" class="button button-primary kavro-clone-add">' . esc_html__( 'Add Item', 'kavro-framework' ) . '</button>';
        echo '</div>';
    }

    /**
     * Render a single cloneable row.
     *
     * @param int   $index      Row index.
     * @param mixed $item       Saved row value.
     * @param array $sub_fields Optional structured sub-fields.
     * @return void
     */
    protected function render_row( $index, $item, $sub_fields ) {
        echo '<div class="kavro-cloneable-row">';

        if ( ! empty( $sub_fields ) ) {
            $row = is_array( $item ) ? $item : array();

            echo '<div class="kavro-cloneable-grid">';
            foreach ( $sub_fields as $sub_field ) {
                $sub_id    = isset( $sub_field['id'] ) ? sanitize_key( $sub_field['id'] ) : '';
                $sub_title = isset( $sub_field['title'] ) ? $sub_field['title'] : $sub_id;
                $sub_type  = isset( $sub_field['type'] ) ? sanitize_key( $sub_field['type'] ) : 'text';
                $value     = isset( $row[ $sub_id ] ) && is_scalar( $row[ $sub_id ] ) ? (string) $row[ $sub_id ] : '';
                $name      = $this->name . '[' . absint( $index ) . '][' . $sub_id . ']';

                echo '<label class="kavro-cloneable-cell">';
                echo '<span>' . esc_html( $sub_title ) . '</span>';
                echo '<input type="' . esc_attr( in_array( $sub_type, array( 'email', 'url', 'number' ), true ) ? $sub_type : 'text' ) . '" name="' . esc_attr( $name ) . '" value="' . esc_attr( $value ) . '">';
                echo '</label>';
            }
            echo '</div>';
        } else {
            $value = is_scalar( $item ) ? (string) $item : wp_json_encode( $item, JSON_UNESCAPED_SLASHES );
            echo '<input type="text" name="' . esc_attr( $this->name . '[' . absint( $index ) . ']' ) . '" value="' . esc_attr( $value ) . '" placeholder="' . esc_attr( $this->placeholder() ) . '">';
        }

        echo '<button type="button" class="button kavro-clone-remove" aria-label="' . esc_attr__( 'Remove item', 'kavro-framework' ) . '">&times;</button>';
        echo '</div>';
    }
}
