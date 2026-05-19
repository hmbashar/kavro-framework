<?php
/**
 * Webhook field.
 *
 * Premium Kavro control for advanced WordPress option data.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\Webhook;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the Webhook field.
 */
class Webhook extends AbstractField {
    /**
     * Output the field control markup.
     *
     * @return void
     */
    public function render() {
        $value = $this->array_value();
        echo '<div class="kavro-webhook"><input type="url" name="' . esc_attr( $this->name ) . '[url]" value="' . esc_attr( $value['url'] ?? '' ) . '" placeholder="https://example.com/webhook"><select name="' . esc_attr( $this->name ) . '[method]"><option value="POST" ' . selected( $value['method'] ?? 'POST', 'POST', false ) . '>POST</option><option value="GET" ' . selected( $value['method'] ?? '', 'GET', false ) . '>GET</option></select><input type="text" name="' . esc_attr( $this->name ) . '[secret]" value="' . esc_attr( $value['secret'] ?? '' ) . '" placeholder="Secret token"></div>';
    }
}
