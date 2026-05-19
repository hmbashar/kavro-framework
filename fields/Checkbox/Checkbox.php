<?php
/**
 * Kavro Framework file: fields/Checkbox/Checkbox.php.
 *
 * This file is part of the Kavro options framework and is intentionally kept
 * focused on one responsibility for easier maintenance and extension.
 *
 * @package Kavro
 */

namespace Kavro\Fields\Checkbox;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class Checkbox extends AbstractField { public function render() { printf( '<label class="kavro-check"><input type="hidden" name="%1$s" value="0"><input type="checkbox" id="kavro-%2$s" name="%1$s" value="1" %3$s> <span>%4$s</span></label>', esc_attr( $this->name ), esc_attr( $this->id ), checked( $this->value, '1', false ), esc_html( $this->attr( 'label', '' ) ) ); } }
