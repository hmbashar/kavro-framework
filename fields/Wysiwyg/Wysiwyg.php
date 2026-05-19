<?php
/**
 * Kavro Framework file: fields/Wysiwyg/Wysiwyg.php.
 *
 * This file is part of the Kavro options framework and is intentionally kept
 * focused on one responsibility for easier maintenance and extension.
 *
 * @package Kavro
 */

namespace Kavro\Fields\Wysiwyg;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Wysiwyg extends AbstractField {
    public function render() {
        $settings = array(
            'textarea_name' => $this->name,
            'textarea_rows' => absint( $this->attr( 'rows', 8 ) ),
            'media_buttons' => (bool) $this->attr( 'media_buttons', true ),
        );
        wp_editor( wp_kses_post( $this->value ), 'kavro-editor-' . esc_attr( $this->id ), $settings );
    }
}
