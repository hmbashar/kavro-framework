<?php
/**
 * RestEndpoint field.
 *
 * Professional premium field renderer for Kavro Framework.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\RestEndpoint;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the RestEndpoint field.
 */
class RestEndpoint extends AbstractField {
    /**
     * Output the field control markup.
     *
     * @return void
     */
    public function render() {
        $value = $this->array_value();
        echo '<div class="kavro-rest-endpoint">';
        echo '<select name="' . esc_attr( $this->name ) . '[method]"><option value="GET" ' . selected( $value['method'] ?? '', 'GET', false ) . '>GET</option><option value="POST" ' . selected( $value['method'] ?? '', 'POST', false ) . '>POST</option><option value="PUT" ' . selected( $value['method'] ?? '', 'PUT', false ) . '>PUT</option><option value="DELETE" ' . selected( $value['method'] ?? '', 'DELETE', false ) . '>DELETE</option></select>';
        echo '<input type="text" name="' . esc_attr( $this->name ) . '[route]" value="' . esc_attr( $value['route'] ?? '' ) . '" placeholder="/kavro/v1/action">';
        echo '</div>';
    }
}
