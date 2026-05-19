<?php
namespace Kavro\Fields\Range;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class Range extends AbstractField { public function render() { printf( '<div class="kavro-range"><input type="range" id="kavro-%1$s" name="%2$s" value="%3$s"%4$s><output>%3$s</output></div>', esc_attr( $this->id ), esc_attr( $this->name ), esc_attr( $this->value ), $this->input_attrs() ); } }
