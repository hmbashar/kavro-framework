<?php
namespace Kavro\Fields\Select;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class Select extends AbstractField { public function render() { echo '<select id="kavro-' . esc_attr( $this->id ) . '" name="' . esc_attr( $this->name ) . '">'; foreach ( (array) $this->attr( 'options', array() ) as $option_value => $option_label ) { printf( '<option value="%1$s" %2$s>%3$s</option>', esc_attr( $option_value ), selected( $this->value, $option_value, false ), esc_html( $option_label ) ); } echo '</select>'; } }
