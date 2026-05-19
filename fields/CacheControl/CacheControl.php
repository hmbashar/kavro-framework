<?php
/**
 * CacheControl field.
 *
 * Professional premium field renderer for Kavro Framework.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\CacheControl;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the CacheControl field.
 */
class CacheControl extends AbstractField {
    /**
     * Output the field control markup.
     *
     * @return void
     */
    public function render() {
        $value = $this->array_value();
        echo '<div class="kavro-cache-control">';
        echo '<label><span>Enable Cache</span><input type="checkbox" name="' . esc_attr( $this->name ) . '[enabled]" value="1" ' . checked( ! empty( $value['enabled'] ), true, false ) . '></label>';
        echo '<label><span>TTL Seconds</span><input type="number" name="' . esc_attr( $this->name ) . '[ttl]" value="' . esc_attr( $value['ttl'] ?? '3600' ) . '"></label>';
        echo '<label><span>Cache Group</span><input type="text" name="' . esc_attr( $this->name ) . '[group]" value="' . esc_attr( $value['group'] ?? 'kavro' ) . '"></label>';
        echo '</div>';
    }
}
