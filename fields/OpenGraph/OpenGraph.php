<?php
/**
 * OpenGraph field.
 *
 * Premium Kavro control for advanced WordPress option data.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\OpenGraph;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the OpenGraph field.
 */
class OpenGraph extends AbstractField {
    /**
     * Output the field control markup.
     *
     * @return void
     */
    public function render() {
        $value = $this->array_value();
        echo '<div class="kavro-og-field"><input type="text" name="' . esc_attr( $this->name ) . '[title]" value="' . esc_attr( $value['title'] ?? '' ) . '" placeholder="Open Graph title"><textarea name="' . esc_attr( $this->name ) . '[description]" placeholder="Open Graph description">' . esc_textarea( $value['description'] ?? '' ) . '</textarea><div class="kavro-media"><input type="text" name="' . esc_attr( $this->name ) . '[image]" value="' . esc_attr( $value['image'] ?? '' ) . '" placeholder="Image URL"><button type="button" class="button kavro-media-upload">Select Image</button><div class="kavro-media-preview">' . ( ! empty( $value['image'] ) ? '<img src="' . esc_url( $value['image'] ) . '" alt="">' : '' ) . '</div></div></div>';
    }
}
