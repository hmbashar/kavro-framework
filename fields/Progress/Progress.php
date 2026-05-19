<?php
/**
 * Progress field with a visual meter and range input.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\Progress;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class Progress extends AbstractField {
    public function render() {
        $value = '' === $this->value ? 50 : absint( $this->value );
        $value = max( 0, min( 100, $value ) );
        printf( '<div class="kavro-progress-field"><input type="range" min="0" max="100" name="%1$s" value="%2$d"><div class="kavro-progress-track"><span style="width:%2$d%%"></span></div><strong>%2$d%%</strong></div>', esc_attr( $this->name ), $value );
    }
}
