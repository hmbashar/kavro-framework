<?php
/** Copyable text field.
 *
 * @package Kavro\Fields\Copy
 */
namespace Kavro\Fields\Copy;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class Copy extends AbstractField { public function render() { printf( '<div class="kavro-copy-field"><input type="text" id="kavro-%2$s" name="%1$s" value="%3$s" readonly><button type="button" class="button kavro-copy-button" data-kavro-copy="#kavro-%2$s">%4$s</button></div>', esc_attr( $this->name ), esc_attr( $this->id ), esc_attr( $this->value ), esc_html__( 'Copy', 'kavro-framework' ) ); } }
