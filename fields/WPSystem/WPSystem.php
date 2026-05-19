<?php
/**
 * WordPress system selector field.
 *
 * Populates select controls for users, roles, menus, sidebars, and templates.
 *
 * @package Kavro\Fields
 */

namespace Kavro\Fields\WPSystem;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) { exit; }

class WPSystem extends AbstractField {
    /** Render the configured system selector. */
    public function render() {
        $source = sanitize_key( $this->attr( 'source', 'roles' ) );
        $items = $this->get_items( $source );
        $multiple = (bool) $this->attr( 'multiple', false );
        $selected = is_array( $this->value ) ? array_map( 'strval', $this->value ) : array( (string) $this->value );
        $name = $multiple ? $this->name . '[]' : $this->name;

        printf( '<select id="kavro-%1$s" class="kavro-select2" name="%2$s" data-kavro-select2 data-placeholder="%4$s"%3$s>', esc_attr( $this->id ), esc_attr( $name ), $multiple ? ' multiple' : '', esc_attr__( 'Search and select...', 'kavro-framework' ) );
        if ( ! $multiple ) { echo '<option value="">' . esc_html__( 'Select an item', 'kavro-framework' ) . '</option>'; }
        foreach ( $items as $key => $label ) { printf( '<option value="%1$s" %2$s>%3$s</option>', esc_attr( $key ), selected( in_array( (string) $key, $selected, true ), true, false ), esc_html( $label ) ); }
        echo '</select>';
    }

    /** @param string $source Source name. @return array<string,string> */
    protected function get_items( $source ) {
        switch ( $source ) {
            case 'users':
                $items = array();
                foreach ( get_users( array( 'number' => absint( $this->attr( 'limit', 50 ) ) ?: 50 ) ) as $user ) { $items[ $user->ID ] = $user->display_name . ' (' . $user->user_login . ')'; }
                return $items;
            case 'roles':
                global $wp_roles;
                return is_object( $wp_roles ) ? $wp_roles->get_names() : array();
            case 'menus':
                $items = array();
                foreach ( wp_get_nav_menus() as $menu ) { $items[ $menu->term_id ] = $menu->name; }
                return $items;
            case 'sidebars':
                global $wp_registered_sidebars;
                $items = array();
                foreach ( (array) $wp_registered_sidebars as $id => $sidebar ) { $items[ $id ] = isset( $sidebar['name'] ) ? $sidebar['name'] : $id; }
                return $items;
            case 'templates':
                $theme = wp_get_theme();
                $templates = $theme->get_page_templates();
                return array_merge( array( 'default' => __( 'Default Template', 'kavro-framework' ) ), $templates );
        }
        return array();
    }
}
