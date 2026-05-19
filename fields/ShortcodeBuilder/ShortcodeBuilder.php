<?php
/**
 * ShortcodeBuilder field.
 *
 * Provides a polished Kavro control for complex WordPress option data.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\ShortcodeBuilder;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the ShortcodeBuilder field.
 */
class ShortcodeBuilder extends AbstractField {
    /**
     * Output the field control markup.
     *
     * @return void
     */
    public function render() {
        $value = $this->array_value();
        echo '<div class="kavro-builder-card"><p class="kavro-builder-title">Shortcode Builder</p><input type="text" name="' . esc_attr( $this->name ) . '[tag]" value="' . esc_attr( isset( $value['tag'] ) ? $value['tag'] : '' ) . '" placeholder="shortcode_tag"><textarea name="' . esc_attr( $this->name ) . '[attrs]" rows="5" placeholder="JSON attributes">' . esc_textarea( isset( $value['attrs'] ) ? $value['attrs'] : '' ) . '</textarea></div>';
    }
}
