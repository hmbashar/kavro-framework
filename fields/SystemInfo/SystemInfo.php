<?php
/**
 * SystemInfo field.
 *
 * Professional premium field renderer for Kavro Framework.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\SystemInfo;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the SystemInfo field.
 */
class SystemInfo extends AbstractField {
    /**
     * Output the field control markup.
     *
     * @return void
     */
    public function render() {
        $info = array( 'PHP' => PHP_VERSION, 'WordPress' => get_bloginfo( 'version' ), 'Site URL' => home_url(), 'Debug' => defined( 'WP_DEBUG' ) && WP_DEBUG ? 'Enabled' : 'Disabled' );
        echo '<div class="kavro-system-info">';
        foreach ( $info as $label => $data ) { echo '<div><span>' . esc_html( $label ) . '</span><strong>' . esc_html( $data ) . '</strong></div>'; }
        echo '<input type="hidden" name="' . esc_attr( $this->name ) . '" value="1">';
        echo '</div>';
    }
}
