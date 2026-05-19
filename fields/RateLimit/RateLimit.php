<?php
/**
 * RateLimit field.
 *
 * Professional premium field renderer for Kavro Framework.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\RateLimit;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the RateLimit field.
 */
class RateLimit extends AbstractField {
    /**
     * Output the field control markup.
     *
     * @return void
     */
    public function render() {
        $value = $this->array_value();
        echo '<div class="kavro-rate-limit"><input type="number" min="1" name="' . esc_attr( $this->name ) . '[requests]" value="' . esc_attr( $value['requests'] ?? '60' ) . '"><span>requests per</span><input type="number" min="1" name="' . esc_attr( $this->name ) . '[minutes]" value="' . esc_attr( $value['minutes'] ?? '1' ) . '"><span>minute(s)</span></div>';
    }
}
