<?php
/**
 * Kavro Framework file: fields/Link/Link.php.
 *
 * This file is part of the Kavro options framework and is intentionally kept
 * focused on one responsibility for easier maintenance and extension.
 *
 * @package Kavro
 */

namespace Kavro\Fields\Link;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Link extends AbstractField {
    public function render() {
        $value = is_array( $this->value ) ? $this->value : array();
        $url = $value['url'] ?? '';
        $text = $value['text'] ?? '';
        $target = $value['target'] ?? '';
        echo '<div class="kavro-link-field kavro-stack">';
        echo '<input type="url" name="' . esc_attr( $this->name . '[url]' ) . '" value="' . esc_attr( $url ) . '" placeholder="https://example.com">';
        echo '<input type="text" name="' . esc_attr( $this->name . '[text]' ) . '" value="' . esc_attr( $text ) . '" placeholder="Link text">';
        echo '<label class="kavro-inline-check"><input type="checkbox" name="' . esc_attr( $this->name . '[target]' ) . '" value="_blank" ' . checked( $target, '_blank', false ) . '> <span>Open in new tab</span></label>';
        echo '</div>';
    }
}
