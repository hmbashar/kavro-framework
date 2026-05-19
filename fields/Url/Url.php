<?php
namespace Kavro\Fields\Url;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class Url extends AbstractField { public function render() { printf( '<input type="url" id="kavro-%1$s" name="%2$s" value="%3$s" placeholder="%4$s">', esc_attr( $this->id ), esc_attr( $this->name ), esc_attr( $this->value ), $this->placeholder() ); } }
