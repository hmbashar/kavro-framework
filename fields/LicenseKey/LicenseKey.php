<?php
/**
 * LicenseKey field.
 *
 * Professional premium field renderer for Kavro Framework.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\LicenseKey;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the LicenseKey field.
 */
class LicenseKey extends AbstractField {
    /**
     * Output the field control markup.
     *
     * @return void
     */
    public function render() {
        $value = is_array( $this->value ) ? $this->value : array( 'key' => (string) $this->value, 'status' => 'inactive' );
        $status = sanitize_key( $value['status'] ?? 'inactive' );
        echo '<div class="kavro-license-field">';
        echo '<input type="password" name="' . esc_attr( $this->name ) . '[key]" value="' . esc_attr( $value['key'] ?? '' ) . '" placeholder="XXXX-XXXX-XXXX-XXXX" autocomplete="off">';
        echo '<span class="kavro-license-status is-' . esc_attr( $status ) . '">' . esc_html( ucfirst( $status ) ) . '</span>';
        echo '<input type="hidden" name="' . esc_attr( $this->name ) . '[status]" value="' . esc_attr( $status ) . '">';
        echo '</div>';
    }
}
