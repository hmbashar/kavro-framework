<?php
namespace Kavro\Fields\Textarea;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class Textarea extends AbstractField { public function render() { printf( '<textarea id="kavro-%1$s" name="%2$s" rows="%3$d" placeholder="%4$s">%5$s</textarea>', esc_attr( $this->id ), esc_attr( $this->name ), absint( $this->attr( 'rows', 6 ) ), $this->placeholder(), esc_textarea( $this->value ) ); } }
