<?php
/**
 * Visual image select field for layout and style choices.
 *
 * @package Kavro\Fields
 */

namespace Kavro\Fields\ImageSelect;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * ImageSelect field renderer.
 */
class ImageSelect extends AbstractField {
    /**
     * Render the field control markup.
     *
     * @return void
     */
    public function render() {
        $options = (array) $this->attr( 'options', array() );
        echo '<div class="kavro-image-select"><div class="kavro-image-select-grid">';
        foreach ( $options as $option_value => $option ) {
            $label = is_array( $option ) ? ( $option['label'] ?? $option_value ) : $option_value;
            $image = is_array( $option ) ? ( $option['image'] ?? '' ) : $option;
            printf(
                '<label><input type="radio" name="%1$s" value="%2$s" %3$s><span class="kavro-image-select-card"><img src="%4$s" alt=""><strong>%5$s</strong></span></label>',
                esc_attr( $this->name ),
                esc_attr( $option_value ),
                checked( $this->value, $option_value, false ),
                esc_url( $image ),
                esc_html( $label )
            );
        }
        echo '</div></div>';
    }

}
