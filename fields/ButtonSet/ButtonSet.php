<?php
/**
 * Kavro Framework file: fields/ButtonSet/ButtonSet.php.
 *
 * This file is part of the Kavro options framework and is intentionally kept
 * focused on one responsibility for easier maintenance and extension.
 *
 * @package Kavro
 */

namespace Kavro\Fields\ButtonSet;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class ButtonSet extends AbstractField { public function render() { echo '<div class="kavro-button-set">'; foreach ( (array) $this->attr( 'options', array() ) as $option_value => $option_label ) { $checked = checked( $this->value, $option_value, false ); printf( '<label><input type="radio" name="%1$s" value="%2$s" %3$s><span>%4$s</span></label>', esc_attr( $this->name ), esc_attr( $option_value ), $checked, esc_html( $option_label ) ); } echo '</div>'; } }
