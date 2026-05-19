<?php
/**
 * Table field.
 *
 * Premium Kavro control for advanced WordPress option data.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\Table;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the Table field.
 */
class Table extends AbstractField {
    /**
     * Output the field control markup.
     *
     * @return void
     */
    public function render() {
        $value = $this->array_value();
        $rows = isset( $value['rows'] ) && is_array( $value['rows'] ) ? $value['rows'] : array( array( 'label' => '', 'value' => '' ) );
        echo '<div class="kavro-table-field">';
        foreach ( $rows as $i => $row ) {
            echo '<div class="kavro-table-row"><input type="text" name="' . esc_attr( $this->name ) . '[rows][' . absint( $i ) . '][label]" value="' . esc_attr( $row['label'] ?? '' ) . '" placeholder="Label"><input type="text" name="' . esc_attr( $this->name ) . '[rows][' . absint( $i ) . '][value]" value="' . esc_attr( $row['value'] ?? '' ) . '" placeholder="Value"></div>';
        }
        echo '<button type="button" class="button kavro-small-action kavro-add-row">Add Row</button></div>';
    }
}
