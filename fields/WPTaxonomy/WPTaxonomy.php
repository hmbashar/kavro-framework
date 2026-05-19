<?php
/**
 * WordPress taxonomy/term selector field.
 *
 * @package Kavro\Fields
 */

namespace Kavro\Fields\WPTaxonomy;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class WPTaxonomy extends AbstractField {
    /** Render taxonomy or term selector. */
    public function render() {
        $mode = sanitize_key( $this->attr( 'mode', 'terms' ) );
        $variant = sanitize_key( $this->attr( 'variant', 'select' ) );
        $multiple = (bool) $this->attr( 'multiple', in_array( $variant, array( 'checkbox', 'relation' ), true ) );
        $items = 'taxonomies' === $mode ? $this->get_taxonomies() : $this->get_terms();

        if ( 'checkbox' === $variant ) { $this->render_checks( $items ); return; }
        if ( 'radio' === $variant ) { $this->render_radios( $items ); return; }
        if ( 'relation' === $variant ) {
            echo '<div class="kavro-smart-select"><input type="search" class="kavro-smart-filter" placeholder="' . esc_attr__( 'Search terms...', 'kavro-framework' ) . '">';
            $this->render_select( $items, true );
            echo '</div>';
            return;
        }
        $this->render_select( $items, $multiple );
    }

    /** @return array<string,string> */
    protected function get_taxonomies() {
        $objects = get_taxonomies( array( 'public' => true ), 'objects' );
        $items = array();
        foreach ( $objects as $name => $object ) { $items[ $name ] = $object->labels->singular_name; }
        return $items;
    }

    /** @return array<int,string> */
    protected function get_terms() {
        $taxonomy = $this->attr( 'taxonomy', 'category' );
        $terms = get_terms( array( 'taxonomy' => $taxonomy, 'hide_empty' => (bool) $this->attr( 'hide_empty', false ) ) );
        $items = array();
        if ( ! is_wp_error( $terms ) ) { foreach ( $terms as $term ) { $items[ $term->term_id ] = $term->name; } }
        return $items;
    }

    protected function render_select( $items, $multiple = false ) {
        $selected = is_array( $this->value ) ? array_map( 'strval', $this->value ) : array( (string) $this->value );
        $name = $multiple ? $this->name . '[]' : $this->name;
        echo '<select id="kavro-' . esc_attr( $this->id ) . '" class="kavro-select2" name="' . esc_attr( $name ) . '" data-kavro-select2 data-placeholder="' . esc_attr__( 'Search and select...', 'kavro-framework' ) . '"' . ( $multiple ? ' multiple' : '' ) . '>';
        if ( ! $multiple ) { echo '<option value="">' . esc_html__( 'Select an item', 'kavro-framework' ) . '</option>'; }
        foreach ( $items as $key => $label ) { printf( '<option value="%1$s" %2$s>%3$s</option>', esc_attr( $key ), selected( in_array( (string) $key, $selected, true ), true, false ), esc_html( $label ) ); }
        echo '</select>';
    }

    protected function render_checks( $items ) {
        $selected = is_array( $this->value ) ? array_map( 'strval', $this->value ) : array();
        echo '<div class="kavro-check-grid kavro-content-options">';
        foreach ( $items as $key => $label ) { printf( '<label><input type="checkbox" name="%1$s[]" value="%2$s" %3$s><span>%4$s</span></label>', esc_attr( $this->name ), esc_attr( $key ), checked( in_array( (string) $key, $selected, true ), true, false ), esc_html( $label ) ); }
        echo '</div>';
    }

    protected function render_radios( $items ) {
        echo '<div class="kavro-radio-group kavro-content-options">';
        foreach ( $items as $key => $label ) { printf( '<label><input type="radio" name="%1$s" value="%2$s" %3$s><span>%4$s</span></label>', esc_attr( $this->name ), esc_attr( $key ), checked( (string) $this->value, (string) $key, false ), esc_html( $label ) ); }
        echo '</div>';
    }
}
