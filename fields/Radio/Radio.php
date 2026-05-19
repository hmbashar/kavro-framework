<?php
/**
 * Radio field renderer.
 *
 * Uses real radio inputs for reliable form submission while hiding the native
 * browser/WordPress control behind a custom premium Kavro indicator.
 *
 * @package Kavro
 */

namespace Kavro\Fields\Radio;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Radio extends AbstractField {
    /**
     * Render the radio choices.
     *
     * @return void
     */
    public function render() {
        echo '<div class="kavro-radio-group">';

        foreach ( (array) $this->attr( 'options', array() ) as $option_value => $option_label ) {
            printf(
                '<label><input type="radio" name="%1$s" value="%2$s" %3$s><span>%4$s</span></label>',
                esc_attr( $this->name ),
                esc_attr( $option_value ),
                checked( $this->value, $option_value, false ),
                esc_html( $option_label )
            );
        }

        echo '</div>';
    }
}
