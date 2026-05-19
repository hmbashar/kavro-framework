<?php
namespace Kavro\Fields\Time;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class Time extends AbstractField { public function render() { printf( '<input type="time" id="kavro-%1$s" name="%2$s" value="%3$s">', esc_attr( $this->id ), esc_attr( $this->name ), esc_attr( $this->value ) ); } }
