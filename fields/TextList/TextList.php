<?php
/**
 * Text list field for newline-separated values.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\TextList;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class TextList extends AbstractField {
    public function render() {
        $value = is_array( $this->value ) ? implode( "\n", $this->value ) : $this->value;
        printf( '<textarea id="kavro-%1$s" name="%2$s" rows="6" placeholder="%3$s">%4$s</textarea><p class="kavro-desc kavro-mini-desc">Enter one item per line.</p>', esc_attr( $this->id ), esc_attr( $this->name ), $this->placeholder(), esc_textarea( $value ) );
    }
}
