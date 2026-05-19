<?php
/**
 * Premium searchable select field.
 *
 * Kavro enhances this select with a local Select2-compatible UI. If a real
 * Select2 implementation is already registered by another plugin/theme, Kavro
 * will not conflict because the saved value still lives in a normal <select>.
 *
 * @package Kavro\Fields
 */

namespace Kavro\Fields\Select2;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Select2 extends AbstractField {
    /** Render a searchable single/multiple select control. */
    public function render() {
        $multiple    = (bool) $this->attr( 'multiple', false );
        $placeholder = $this->attr( 'placeholder', __( 'Select option', 'kavro-framework' ) );
        $selected    = is_array( $this->value ) ? array_map( 'strval', $this->value ) : array( (string) $this->value );
        $name        = $multiple ? $this->name . '[]' : $this->name;
        $classes     = 'kavro-select2';

        printf(
            '<select id="kavro-%1$s" class="%2$s" name="%3$s" data-kavro-select2 data-placeholder="%4$s"%5$s>',
            esc_attr( $this->id ),
            esc_attr( $classes ),
            esc_attr( $name ),
            esc_attr( $placeholder ),
            $multiple ? ' multiple' : ''
        );

        if ( ! $multiple ) {
            printf( '<option value="">%s</option>', esc_html( $placeholder ) );
        }

        foreach ( (array) $this->attr( 'options', array() ) as $option_value => $option_label ) {
            printf(
                '<option value="%1$s" %2$s>%3$s</option>',
                esc_attr( $option_value ),
                selected( in_array( (string) $option_value, $selected, true ), true, false ),
                esc_html( $option_label )
            );
        }

        echo '</select>';
    }
}
