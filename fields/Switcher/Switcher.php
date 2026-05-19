<?php
namespace Kavro\Fields\Switcher;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class Switcher extends AbstractField { public function render() { printf( '<label class="kavro-switch"><input type="hidden" name="%1$s" value="0"><input type="checkbox" id="kavro-%2$s" name="%1$s" value="1" %3$s><span></span></label>', esc_attr( $this->name ), esc_attr( $this->id ), checked( $this->value, '1', false ) ); } }
