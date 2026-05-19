<?php
/**
 * Premium link color group field.
 *
 * @package Kavro\Fields
 */

namespace Kavro\Fields\LinkColor;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * LinkColor field renderer.
 */
class LinkColor extends AbstractField {
    /**
     * Render the field control markup.
     *
     * @return void
     */
    public function render() {
        $value = $this->array_value();
        $normal = $value['normal'] ?? '';
        $hover  = $value['hover'] ?? '';
        $active = $value['active'] ?? '';
        echo '<div class="kavro-link-color">';
        printf('<div class="kavro-link-color-row"><label>Normal</label><input type="color" name="%1$s[normal]" value="%2$s"><input type="text" name="%1$s[normal_text]" value="%2$s"></div>', esc_attr( $this->name ), esc_attr( $normal ) );
        printf('<div class="kavro-link-color-row"><label>Hover</label><input type="color" name="%1$s[hover]" value="%2$s"><input type="text" name="%1$s[hover_text]" value="%2$s"></div>', esc_attr( $this->name ), esc_attr( $hover ) );
        printf('<div class="kavro-link-color-row"><label>Active</label><input type="color" name="%1$s[active]" value="%2$s"><input type="text" name="%1$s[active_text]" value="%2$s"></div>', esc_attr( $this->name ), esc_attr( $active ) );
        echo '</div>';
    }

}
