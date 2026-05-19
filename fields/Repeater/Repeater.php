<?php
/**
 * Kavro Framework file: fields/Repeater/Repeater.php.
 *
 * This file is part of the Kavro options framework and is intentionally kept
 * focused on one responsibility for easier maintenance and extension.
 *
 * @package Kavro
 */

namespace Kavro\Fields\Repeater;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class Repeater extends AbstractField { public function render() { $items = is_array( $this->value ) ? $this->value : array(); $fields = (array) $this->attr( 'fields', array() ); echo '<div class="kavro-repeater" data-name="' . esc_attr( $this->name ) . '">'; echo '<div class="kavro-repeater-items">'; if ( empty( $items ) ) { $items = array( array() ); } foreach ( $items as $i => $item ) { $this->render_item( $fields, $item, $i ); } echo '</div><button type="button" class="button kavro-repeater-add">Add Item</button></div>'; } protected function render_item( $fields, $item, $i ) { echo '<div class="kavro-repeater-item"><div class="kavro-repeater-head"><strong>Item</strong><button type="button" class="button-link-delete kavro-repeater-remove">Remove</button></div>'; foreach ( $fields as $field ) { $fid = sanitize_key( $field['id'] ?? '' ); if ( ! $fid ) { continue; } $label = esc_html( $field['title'] ?? $fid ); $type = sanitize_key( $field['type'] ?? 'text' ); $val = $item[ $fid ] ?? ( $field['default'] ?? '' ); echo '<label><span>' . $label . '</span>'; printf( '<input type="%1$s" name="%2$s[%3$d][%4$s]" value="%5$s">', in_array( $type, array( 'number', 'email', 'url' ), true ) ? esc_attr( $type ) : 'text', esc_attr( $this->name ), absint( $i ), esc_attr( $fid ), esc_attr( $val ) ); echo '</label>'; } echo '</div>'; } }
