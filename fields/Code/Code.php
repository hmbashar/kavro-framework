<?php
/**
 * Kavro Framework file: fields/Code/Code.php.
 *
 * This file is part of the Kavro options framework and is intentionally kept
 * focused on one responsibility for easier maintenance and extension.
 *
 * @package Kavro
 */

namespace Kavro\Fields\Code;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class Code extends AbstractField { public function render() { printf( '<textarea class="kavro-code" id="kavro-%1$s" name="%2$s" rows="%3$d" spellcheck="false">%4$s</textarea>', esc_attr( $this->id ), esc_attr( $this->name ), absint( $this->attr( 'rows', 10 ) ), esc_textarea( $this->value ) ); } }
