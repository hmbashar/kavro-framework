<?php
/** Month picker field.
 *
 * @package Kavro\Fields\Month
 */
namespace Kavro\Fields\Month;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class Month extends AbstractField { public function render() { printf( '<input type="month" id="kavro-%2$s" name="%1$s" value="%3$s"%4$s>', esc_attr( $this->name ), esc_attr( $this->id ), esc_attr( $this->value ), $this->input_attrs() ); } }
