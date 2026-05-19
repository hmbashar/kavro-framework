<?php
/**
 * Kavro Framework file: fields/Palette/Palette.php.
 *
 * This file is part of the Kavro options framework and is intentionally kept
 * focused on one responsibility for easier maintenance and extension.
 *
 * @package Kavro
 */

namespace Kavro\Fields\Palette;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Palette extends AbstractField {
    public function render() {
        echo '<div class="kavro-palette">';
        foreach ( (array) $this->attr( 'options', array() ) as $key => $colors ) {
            echo '<label><input type="radio" name="' . esc_attr( $this->name ) . '" value="' . esc_attr( $key ) . '" ' . checked( (string) $this->value, (string) $key, false ) . '><span>';
            foreach ( (array) $colors as $color ) { echo '<i style="background:' . esc_attr( $color ) . '"></i>'; }
            echo '</span></label>';
        }
        echo '</div>';
    }
}
