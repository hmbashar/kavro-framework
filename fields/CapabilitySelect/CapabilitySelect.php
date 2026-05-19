<?php
/**
 * CapabilitySelect field.
 *
 * Premium Kavro control for advanced WordPress option data.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\CapabilitySelect;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the CapabilitySelect field.
 */
class CapabilitySelect extends AbstractField {
    /**
     * Output the field control markup.
     *
     * @return void
     */
    public function render() {
        global $wp_roles;
        $roles = $wp_roles ? $wp_roles->roles : array();
        $caps = array();
        foreach ( $roles as $role ) { if ( ! empty( $role['capabilities'] ) ) { $caps = array_merge( $caps, array_keys( $role['capabilities'] ) ); } }
        $caps = array_unique( $caps ); sort( $caps );
        echo '<select class="kavro-enhanced-select" name="' . esc_attr( $this->name ) . '">';
        foreach ( $caps as $cap ) { echo '<option value="' . esc_attr( $cap ) . '" ' . selected( $this->value, $cap, false ) . '>' . esc_html( $cap ) . '</option>'; }
        echo '</select>';
    }
}
