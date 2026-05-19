<?php
/**
 * Rating field.
 *
 * Renders a premium star rating control while keeping native radio inputs in
 * the markup for reliable form submission, accessibility, and keyboard/browser
 * compatibility. JavaScript only enhances the hover/selected visual state.
 *
 * @package Kavro\Fields
 */

namespace Kavro\Fields\Rating;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Premium star rating selector.
 */
class Rating extends AbstractField {

    /**
     * Render the field markup.
     *
     * @return void
     */
    public function render() {
        $max   = absint( $this->attr( 'max', 5 ) );
        $max   = $max ? $max : 5;
        $value = absint( $this->value );

        echo '<div class="kavro-rating" role="radiogroup" data-kavro-rating>';

        for ( $i = 1; $i <= $max; $i++ ) {
            $classes = array( 'kavro-rating-star' );

            if ( $value && $i <= $value ) {
                $classes[] = 'is-active';
            }

            printf(
                '<label class="%1$s" data-rating="%2$d" aria-label="%2$d out of %3$d"><input type="radio" name="%4$s" value="%2$d" %5$s><span class="dashicons dashicons-star-filled" aria-hidden="true"></span></label>',
                esc_attr( implode( ' ', $classes ) ),
                absint( $i ),
                absint( $max ),
                esc_attr( $this->name ),
                checked( (string) $this->value, (string) $i, false )
            );
        }

        echo '</div>';
    }
}
