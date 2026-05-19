<?php
/**
 * Premium date picker field.
 *
 * Uses Kavro's lightweight JavaScript picker instead of the browser-native
 * date UI so every admin screen keeps a consistent premium appearance.
 *
 * @package Kavro\Fields\Date
 */

namespace Kavro\Fields\Date;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Date field renderer.
 */
class Date extends AbstractField {
    /**
     * Render the field control markup.
     *
     * @return void
     */
    public function render() {
        printf(
            '<div class="kavro-picker-field"><input type="text" id="kavro-%1$s" name="%2$s" value="%3$s" placeholder="YYYY-MM-DD" data-kavro-picker="date" autocomplete="off"><span class="dashicons dashicons-calendar-alt"></span></div>',
            esc_attr( $this->id ),
            esc_attr( $this->name ),
            esc_attr( $this->value )
        );
    }
}
