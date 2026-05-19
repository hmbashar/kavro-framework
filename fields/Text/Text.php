<?php
/**
 * Kavro Framework file: fields/Text/Text.php.
 *
 * This file is part of the Kavro options framework and is intentionally kept
 * focused on one responsibility for easier maintenance and extension.
 *
 * @package Kavro
 */

namespace Kavro\Fields\Text;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class Text extends AbstractField { public function render() { printf( '<input type="text" id="kavro-%1$s" name="%2$s" value="%3$s" placeholder="%4$s">', esc_attr( $this->id ), esc_attr( $this->name ), esc_attr( $this->value ), $this->placeholder() ); } }
