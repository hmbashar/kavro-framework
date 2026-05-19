<?php
/**
 * Spinner field.
 *
 * Provides a compact premium numeric control with increment/decrement buttons.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\Spinner;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Spinner extends AbstractField {
    public function render() {
        printf(
            '<div class="kavro-spinner"><button type="button" class="kavro-step" data-step="down">-</button><input type="number" id="kavro-%1$s" name="%2$s" value="%3$s" placeholder="%4$s"%5$s><button type="button" class="kavro-step" data-step="up">+</button></div>',
            esc_attr( $this->id ),
            esc_attr( $this->name ),
            esc_attr( $this->value ),
            $this->placeholder(),
            $this->input_attrs()
        );
    }
}
