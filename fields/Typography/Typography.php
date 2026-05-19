<?php
namespace Kavro\Fields\Typography;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class Typography extends AbstractField { public function render() { $v = is_array( $this->value ) ? $this->value : array(); $families = $this->attr( 'families', array( 'Arial' => 'Arial', 'Inter' => 'Inter', 'Georgia' => 'Georgia', 'Helvetica' => 'Helvetica' ) ); echo '<div class="kavro-typography">'; echo '<select name="' . esc_attr( $this->name ) . '[family]">'; foreach ( $families as $key => $label ) { printf( '<option value="%1$s" %2$s>%3$s</option>', esc_attr( $key ), selected( $v['family'] ?? '', $key, false ), esc_html( $label ) ); } echo '</select>'; printf( '<input type="number" name="%1$s[size]" value="%2$s" placeholder="Size">', esc_attr( $this->name ), esc_attr( $v['size'] ?? '' ) ); printf( '<input class="kavro-color" type="text" name="%1$s[color]" value="%2$s" placeholder="#111827">', esc_attr( $this->name ), esc_attr( $v['color'] ?? '' ) ); echo '</div>'; } }
