<?php
/**
 * Kavro Framework file: fields/Radio/Radio.php.
 *
 * This file is part of the Kavro options framework and is intentionally kept
 * focused on one responsibility for easier maintenance and extension.
 *
 * @package Kavro
 */

namespace Kavro\Fields\Radio;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class Radio extends AbstractField { public function render() { echo '<div class="kavro-radio-group">'; foreach ( (array) $this->attr( 'options', array() ) as $option_value => $option_label ) { printf( '<label><input type="radio" name="%1$s" value="%2$s" %3$s> %4$s</label>', esc_attr( $this->name ), esc_attr( $option_value ), checked( $this->value, $option_value, false ), esc_html( $option_label ) ); } echo '</div>'; } }
