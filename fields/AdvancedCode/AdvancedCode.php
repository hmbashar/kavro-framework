<?php
/**
 * code_editor_advanced field for Kavro Framework.
 *
 * @package Kavro\Fields
 */

namespace Kavro\Fields\AdvancedCode;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the code_editor_advanced field.
 */
class AdvancedCode extends AbstractField {
    /** Render the field control. */
    public function render() {

        $lang = sanitize_key( $this->attr( 'language', 'css' ) );
        echo '<div class="kavro-advanced-code"><div class="kavro-code-toolbar"><span>' . esc_html( strtoupper( $lang ) ) . '</span></div><textarea id="kavro-' . esc_attr( $this->id ) . '" name="' . esc_attr( $this->name ) . '" rows="10" spellcheck="false">' . esc_textarea( $this->value ) . '</textarea></div>';
    }
}
