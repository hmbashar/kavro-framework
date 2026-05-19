<?php
/**
 * QueryBuilder field.
 *
 * Provides a polished Kavro control for complex WordPress option data.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\QueryBuilder;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the QueryBuilder field.
 */
class QueryBuilder extends AbstractField {
    /**
     * Output the field control markup.
     *
     * @return void
     */
    public function render() {
        $value = $this->array_value();
        echo '<div class="kavro-builder-card"><p class="kavro-builder-title">Query Builder</p><div class="kavro-compound-grid">';
        foreach ( array( 'post_type' => 'Post Type', 'posts_per_page' => 'Limit', 'orderby' => 'Order By', 'order' => 'Order' ) as $key => $label ) {
            echo '<label class="kavro-mini-control"><span>' . esc_html( $label ) . '</span><input type="text" name="' . esc_attr( $this->name ) . '[' . esc_attr( $key ) . ']" value="' . esc_attr( isset( $value[$key] ) ? $value[$key] : '' ) . '"></label>';
        }
        echo '</div></div>';
    }
}
