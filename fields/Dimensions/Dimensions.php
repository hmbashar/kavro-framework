<?php
/**
 * Kavro Framework file: fields/Dimensions/Dimensions.php.
 *
 * This file is part of the Kavro options framework and is intentionally kept
 * focused on one responsibility for easier maintenance and extension.
 *
 * @package Kavro
 */

namespace Kavro\Fields\Dimensions;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class Dimensions extends AbstractField { public function render() { $v = is_array( $this->value ) ? $this->value : array(); echo '<div class="kavro-multi-input kavro-dimensions">'; foreach ( array( 'width' => 'Width', 'height' => 'Height' ) as $key => $label ) { printf( '<label><span>%1$s</span><input type="number" name="%2$s[%3$s]" value="%4$s"></label>', esc_html( $label ), esc_attr( $this->name ), esc_attr( $key ), esc_attr( $v[ $key ] ?? '' ) ); } echo '</div>'; } }
