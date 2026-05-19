<?php
namespace Kavro\Fields\Color;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class Color extends AbstractField { public function render() { printf( '<input class="kavro-color" type="text" id="kavro-%1$s" name="%2$s" value="%3$s" placeholder="#111827">', esc_attr( $this->id ), esc_attr( $this->name ), esc_attr( $this->value ) ); } }
