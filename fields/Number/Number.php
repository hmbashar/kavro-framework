<?php
namespace Kavro\Fields\Number;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class Number extends AbstractField { public function render() { printf( '<input type="number" id="kavro-%1$s" name="%2$s" value="%3$s" placeholder="%4$s"%5$s>', esc_attr( $this->id ), esc_attr( $this->name ), esc_attr( $this->value ), $this->placeholder(), $this->input_attrs() ); } }
