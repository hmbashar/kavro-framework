<?php
/**
 * MenuBuilder field.
 *
 * Provides a polished Kavro control for complex WordPress option data.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\MenuBuilder;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the MenuBuilder field.
 */
class MenuBuilder extends AbstractField {
    /**
     * Output the field control markup.
     *
     * @return void
     */
    public function render() {
        echo '<div class="kavro-builder-card"><p class="kavro-builder-title">Menu Builder Schema</p><textarea name="' . esc_attr( $this->name ) . '" rows="8" placeholder="JSON menu tree">' . esc_textarea( is_scalar( $this->value ) ? $this->value : wp_json_encode( $this->value ) ) . '</textarea></div>';
    }
}
