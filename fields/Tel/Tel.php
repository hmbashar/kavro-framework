<?php
/** Telephone input field.
 *
 * @package Kavro\Fields\Tel
 */
namespace Kavro\Fields\Tel;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class Tel extends AbstractField { public function render() { printf( '<input type="tel" id="kavro-%2$s" name="%1$s" value="%3$s" placeholder="%4$s"%5$s>', esc_attr( $this->name ), esc_attr( $this->id ), esc_attr( $this->value ), $this->placeholder(), $this->input_attrs() ); } }
