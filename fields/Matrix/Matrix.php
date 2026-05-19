<?php
/**
 * Matrix field.
 *
 * Premium Kavro control for advanced WordPress option data.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\Matrix;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the Matrix field.
 */
class Matrix extends AbstractField {
    /**
     * Output the field control markup.
     *
     * @return void
     */
    public function render() {
        $value = $this->array_value();
        $rows = $this->attr( 'rows', array( 'Header', 'Body', 'Footer' ) );
        $cols = $this->attr( 'columns', array( 'Desktop', 'Tablet', 'Mobile' ) );
        echo '<div class="kavro-matrix"><table><thead><tr><th></th>';
        foreach ( $cols as $col ) { echo '<th>' . esc_html( $col ) . '</th>'; }
        echo '</tr></thead><tbody>';
        foreach ( $rows as $row_key => $row_label ) {
            $key = is_string( $row_key ) ? $row_key : sanitize_key( $row_label );
            echo '<tr><th>' . esc_html( $row_label ) . '</th>';
            foreach ( $cols as $col_key => $col_label ) {
                $ckey = is_string( $col_key ) ? $col_key : sanitize_key( $col_label );
                echo '<td><input type="text" name="' . esc_attr( $this->name ) . '[' . esc_attr( $key ) . '][' . esc_attr( $ckey ) . ']" value="' . esc_attr( $value[ $key ][ $ckey ] ?? '' ) . '"></td>';
            }
            echo '</tr>';
        }
        echo '</tbody></table></div>';
    }
}
