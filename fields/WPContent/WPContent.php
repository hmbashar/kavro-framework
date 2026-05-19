<?php
/**
 * WordPress content selector field.
 *
 * Renders select, checkbox, radio, autocomplete-style, and relationship-style
 * controls populated from WordPress posts, pages, and custom post types.
 *
 * @package Kavro\Fields
 */

namespace Kavro\Fields\WPContent;

use Kavro\AbstractField;
use WP_Query;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class WPContent extends AbstractField {
    /**
     * Render a post/page/CPT selector according to the configured variant.
     *
     * Supported variants: select, checkbox, radio, autocomplete, relation.
     *
     * @return void
     */
    public function render() {
        $variant = sanitize_key( $this->attr( 'variant', 'select' ) );
        $multiple = (bool) $this->attr( 'multiple', in_array( $variant, array( 'checkbox', 'relation' ), true ) );
        $items = $this->get_posts();

        if ( 'checkbox' === $variant ) {
            $this->render_checks( $items );
            return;
        }

        if ( 'radio' === $variant ) {
            $this->render_radios( $items );
            return;
        }

        if ( in_array( $variant, array( 'autocomplete', 'relation' ), true ) ) {
            echo '<div class="kavro-smart-select">';
            printf( '<input type="search" class="kavro-smart-filter" placeholder="%s">', esc_attr__( 'Search items...', 'kavro-framework' ) );
            $this->render_select( $items, $multiple );
            echo '</div>';
            return;
        }

        $this->render_select( $items, $multiple );
    }

    /**
     * Query posts for the selector.
     *
     * @return array<int,string> Map of post IDs to post titles.
     */
    protected function get_posts() {
        $post_type = $this->attr( 'post_type', 'post' );
        $post_type = is_array( $post_type ) ? array_map( 'sanitize_key', $post_type ) : sanitize_key( $post_type );
        $limit = absint( $this->attr( 'limit', 50 ) );

        $query = new WP_Query(
            array(
                'post_type'      => $post_type,
                'post_status'    => $this->attr( 'post_status', 'publish' ),
                'posts_per_page' => $limit ? $limit : 50,
                'orderby'        => $this->attr( 'orderby', 'title' ),
                'order'          => $this->attr( 'order', 'ASC' ),
                'no_found_rows'  => true,
            )
        );

        $items = array();
        foreach ( $query->posts as $post ) {
            $items[ $post->ID ] = $post->post_title ? $post->post_title : sprintf( __( '#%d (no title)', 'kavro-framework' ), $post->ID );
        }

        wp_reset_postdata();

        return $items;
    }

    /**
     * Render select markup.
     *
     * @param array<int,string> $items    Option items.
     * @param bool             $multiple Whether multiple selections are allowed.
     * @return void
     */
    protected function render_select( $items, $multiple = false ) {
        $selected = is_array( $this->value ) ? array_map( 'strval', $this->value ) : array( (string) $this->value );
        $name = $multiple ? $this->name . '[]' : $this->name;

        printf( '<select id="kavro-%1$s" class="kavro-select2" name="%2$s" data-kavro-select2 data-placeholder="%4$s"%3$s>', esc_attr( $this->id ), esc_attr( $name ), $multiple ? ' multiple' : '', esc_attr__( 'Search and select...', 'kavro-framework' ) );

        if ( ! $multiple ) {
            echo '<option value="">' . esc_html__( 'Select an item', 'kavro-framework' ) . '</option>';
        }

        foreach ( $items as $item_id => $title ) {
            printf( '<option value="%1$s" %2$s>%3$s</option>', esc_attr( $item_id ), selected( in_array( (string) $item_id, $selected, true ), true, false ), esc_html( $title ) );
        }

        echo '</select>';
    }

    /**
     * Render checkbox list.
     *
     * @param array<int,string> $items Option items.
     * @return void
     */
    protected function render_checks( $items ) {
        $selected = is_array( $this->value ) ? array_map( 'strval', $this->value ) : array();
        echo '<div class="kavro-check-grid kavro-content-options">';
        foreach ( $items as $item_id => $title ) {
            printf( '<label><input type="checkbox" name="%1$s[]" value="%2$s" %3$s><span>%4$s</span></label>', esc_attr( $this->name ), esc_attr( $item_id ), checked( in_array( (string) $item_id, $selected, true ), true, false ), esc_html( $title ) );
        }
        echo '</div>';
    }

    /**
     * Render radio list.
     *
     * @param array<int,string> $items Option items.
     * @return void
     */
    protected function render_radios( $items ) {
        echo '<div class="kavro-radio-group kavro-content-options">';
        foreach ( $items as $item_id => $title ) {
            printf( '<label><input type="radio" name="%1$s" value="%2$s" %3$s><span>%4$s</span></label>', esc_attr( $this->name ), esc_attr( $item_id ), checked( (string) $this->value, (string) $item_id, false ), esc_html( $title ) );
        }
        echo '</div>';
    }
}
