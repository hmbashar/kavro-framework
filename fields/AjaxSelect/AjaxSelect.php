<?php
/**
 * ajax_select field for Kavro Framework.
 *
 * @package Kavro\Fields
 */

namespace Kavro\Fields\AjaxSelect;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the ajax_select field.
 */
class AjaxSelect extends AbstractField {
    /** Render the field control. */
    public function render() {

        $multiple = (bool) $this->attr( 'multiple', false );
        $placeholder = $this->attr( 'placeholder', __( 'Search or select', 'kavro-framework' ) );
        $selected = is_array( $this->value ) ? array_map( 'strval', $this->value ) : array( (string) $this->value );
        $name = $multiple ? $this->name . '[]' : $this->name;
        echo '<select id="kavro-' . esc_attr( $this->id ) . '" class="kavro-select2 kavro-ajax-select" name="' . esc_attr( $name ) . '"' . ( $multiple ? ' multiple' : '' ) . ' data-kavro-select2 data-placeholder="' . esc_attr( $placeholder ) . '">';
        if ( ! $multiple ) { echo '<option value="">' . esc_html( $placeholder ) . '</option>'; }
        foreach ( (array) $this->attr( 'options', array() ) as $value => $label ) {
            printf( '<option value="%1$s" %2$s>%3$s</option>', esc_attr( $value ), selected( in_array( (string) $value, $selected, true ), true, false ), esc_html( $label ) );
        }
        echo '</select><p class="kavro-desc">' . esc_html__( 'AJAX-ready searchable select. Connect remote results through future Kavro AJAX hooks or pass local options now.', 'kavro-framework' ) . '</p>';
    }
}
