<?php
/** Button preview/link field.
 *
 * @package Kavro\Fields\Button
 */
namespace Kavro\Fields\Button;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class Button extends AbstractField { public function render() { $label = $this->attr( 'label', __( 'Button Preview', 'kavro-framework' ) ); $url = $this->attr( 'url', '#' ); printf( '<div class="kavro-button-field"><input type="text" id="kavro-%2$s" name="%1$s" value="%3$s" placeholder="%4$s"><a class="kavro-button-preview" href="%5$s" target="_blank" rel="noopener">%6$s</a></div>', esc_attr( $this->name ), esc_attr( $this->id ), esc_attr( $this->value ), $this->placeholder(), esc_url( $url ), esc_html( $label ) ); } }
