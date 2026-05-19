<?php
/**
 * Timeline field.
 *
 * Premium Kavro control for advanced WordPress option data.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\Timeline;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the Timeline field.
 */
class Timeline extends AbstractField {
    /**
     * Output the field control markup.
     *
     * @return void
     */
    public function render() {
        $value = $this->array_value();
        $items = isset( $value['items'] ) && is_array( $value['items'] ) ? $value['items'] : array( array( 'date'=>'', 'title'=>'', 'desc'=>'' ) );
        echo '<div class="kavro-timeline-field">';
        foreach ( $items as $i => $item ) {
            echo '<div class="kavro-timeline-item"><input type="text" name="' . esc_attr( $this->name ) . '[items][' . absint( $i ) . '][date]" value="' . esc_attr( $item['date'] ?? '' ) . '" placeholder="Date"><input type="text" name="' . esc_attr( $this->name ) . '[items][' . absint( $i ) . '][title]" value="' . esc_attr( $item['title'] ?? '' ) . '" placeholder="Title"><textarea name="' . esc_attr( $this->name ) . '[items][' . absint( $i ) . '][desc]" placeholder="Description">' . esc_textarea( $item['desc'] ?? '' ) . '</textarea></div>';
        }
        echo '</div>';
    }
}
