<?php
/**
 * PermissionMatrix field.
 *
 * Professional premium field renderer for Kavro Framework.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\PermissionMatrix;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the PermissionMatrix field.
 */
class PermissionMatrix extends AbstractField {
    /**
     * Output the field control markup.
     *
     * @return void
     */
    public function render() {
        $value = $this->array_value();
        $roles = $this->attr( 'roles', array( 'administrator' => 'Administrator', 'editor' => 'Editor', 'author' => 'Author' ) );
        $caps = $this->attr( 'capabilities', array( 'view' => 'View', 'create' => 'Create', 'edit' => 'Edit', 'delete' => 'Delete' ) );
        echo '<div class="kavro-matrix-wrap"><table class="kavro-premium-table"><thead><tr><th>Role</th>';
        foreach ( $caps as $cap => $label ) { echo '<th>' . esc_html( $label ) . '</th>'; }
        echo '</tr></thead><tbody>';
        foreach ( $roles as $role => $role_label ) {
            echo '<tr><th>' . esc_html( $role_label ) . '</th>';
            foreach ( $caps as $cap => $label ) {
                $checked = ! empty( $value[ $role ][ $cap ] );
                echo '<td><label class="kavro-mini-check"><input type="checkbox" name="' . esc_attr( $this->name ) . '[' . esc_attr( $role ) . '][' . esc_attr( $cap ) . ']" value="1" ' . checked( $checked, true, false ) . '><span></span></label></td>';
            }
            echo '</tr>';
        }
        echo '</tbody></table></div>';
    }
}
