<?php
namespace Kavro\Fields\Hidden;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class Hidden extends AbstractField { public function output() { $this->render(); } public function render() { printf( '<input type="hidden" id="kavro-%1$s" name="%2$s" value="%3$s">', esc_attr( $this->id ), esc_attr( $this->name ), esc_attr( $this->value ) ); } }
