<?php
/**
 * Premium time picker field.
 *
 * @package Kavro\Fields\Time
 */

namespace Kavro\Fields\Time;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Time field renderer.
 */
class Time extends AbstractField {
    /**
     * Render the field control markup.
     *
     * @return void
     */
    public function render() {
        printf(
            '<div class="kavro-picker-field"><input type="text" id="kavro-%1$s" name="%2$s" value="%3$s" placeholder="HH:MM" data-kavro-picker="time" autocomplete="off"><span class="dashicons dashicons-clock"></span></div>',
            esc_attr( $this->id ),
            esc_attr( $this->name ),
            esc_attr( $this->value )
        );
    }
}
