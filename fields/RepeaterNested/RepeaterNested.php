<?php
/**
 * RepeaterNested field.
 *
 * Provides a polished Kavro control for complex WordPress option data.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\RepeaterNested;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the RepeaterNested field.
 */
class RepeaterNested extends AbstractField {
    /**
     * Output the field control markup.
     *
     * @return void
     */
    public function render() {
        echo '<div class="kavro-builder-card"><p class="kavro-builder-title">Nested Repeater</p><textarea name="' . esc_attr( $this->name ) . '" rows="8" placeholder="Store nested JSON rows here while UI builder matures.">' . esc_textarea( is_scalar( $this->value ) ? $this->value : wp_json_encode( $this->value ) ) . '</textarea><p class="kavro-desc">Supports nested row data. A drag UI can be layered on this data contract later.</p></div>';
    }
}
