<?php
/**
 * Combined date and time picker field.
 *
 * @package Kavro\Fields
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
            '<div class="kavro-datetime-wrap"><input type="datetime-local" id="kavro-%1$s" name="%2$s" value="%3$s"></div>',
            esc_attr( $this->id ),
            esc_attr( $this->name ),
            esc_attr( $this->value )
        );
    }

}
