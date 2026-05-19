<?php
/**
 * Embed field for iframe/script-safe embed snippets.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\Embed;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class Embed extends AbstractField {
    public function render() {
        printf( '<textarea id="kavro-%1$s" class="kavro-code-textarea" name="%2$s" rows="7" placeholder="Paste embed code">%3$s</textarea>', esc_attr( $this->id ), esc_attr( $this->name ), esc_textarea( $this->value ) );
    }
}
