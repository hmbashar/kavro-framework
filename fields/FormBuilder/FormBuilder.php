<?php
/**
 * FormBuilder field.
 *
 * Provides a polished Kavro control for complex WordPress option data.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\FormBuilder;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the FormBuilder field.
 */
class FormBuilder extends AbstractField {
    /**
     * Output the field control markup.
     *
     * @return void
     */
    public function render() {
        echo '<div class="kavro-builder-card"><p class="kavro-builder-title">Form Builder Schema</p><textarea name="' . esc_attr( $this->name ) . '" rows="8" placeholder="[{&quot;label&quot;:&quot;Name&quot;,&quot;type&quot;:&quot;text&quot;}]">' . esc_textarea( is_scalar( $this->value ) ? $this->value : wp_json_encode( $this->value ) ) . '</textarea></div>';
    }
}
