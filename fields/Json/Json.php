<?php
/**
 * JSON field for structured configuration snippets.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\Json;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class Json extends AbstractField {
    public function render() {
        $placeholder = $this->placeholder() ? $this->placeholder() : '{"key":"value"}';
        printf( '<textarea id="kavro-%1$s" class="kavro-code-textarea" name="%2$s" rows="8" placeholder="%3$s">%4$s</textarea>', esc_attr( $this->id ), esc_attr( $this->name ), $placeholder, esc_textarea( $this->value ) );
    }
}
