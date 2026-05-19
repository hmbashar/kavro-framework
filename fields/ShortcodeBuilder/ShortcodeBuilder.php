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
        $tag   = isset( $value['tag'] ) && is_scalar( $value['tag'] ) ? (string) $value['tag'] : '';
        $attrs = isset( $value['attrs'] ) ? $value['attrs'] : '';

        /*
         * Attributes may be saved as an array in demo/default data. Convert them
         * to readable JSON before printing inside a textarea to avoid
         * htmlspecialchars()/esc_textarea() array type errors.
         */
        if ( is_array( $attrs ) ) {
            $attrs = wp_json_encode( $attrs, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES );
        } elseif ( ! is_scalar( $attrs ) ) {
            $attrs = '';
        }

        echo '<div class="kavro-builder-card">';
        echo '<p class="kavro-builder-title">Shortcode Builder</p>';
        echo '<input type="text" name="' . esc_attr( $this->name ) . '[tag]" value="' . esc_attr( $tag ) . '" placeholder="shortcode_tag">';
        echo '<textarea name="' . esc_attr( $this->name ) . '[attrs]" rows="5" placeholder="JSON attributes">' . esc_textarea( (string) $attrs ) . '</textarea>';
        echo '</div>';
    }
}
