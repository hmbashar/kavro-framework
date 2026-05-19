<?php
/**
 * Premium date and time picker field.
 *
 * @package Kavro\Fields\DateTime
 */

namespace Kavro\Fields\DateTime;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * DateTime field renderer.
 */
class DateTime extends AbstractField {
    /**
     * Render the field control markup.
     *
     * @return void
     */
    public function render() {
        printf(
            '<div class="kavro-picker-field"><input type="text" id="kavro-%1$s" name="%2$s" value="%3$s" placeholder="YYYY-MM-DDTHH:MM" data-kavro-picker="datetime" autocomplete="off"><span class="dashicons dashicons-calendar"></span></div>',
            esc_attr( $this->id ),
            esc_attr( $this->name ),
            esc_attr( $this->value )
        );
    }
}
