<?php
/**
 * HealthCheck field.
 *
 * Professional premium field renderer for Kavro Framework.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\HealthCheck;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the HealthCheck field.
 */
class HealthCheck extends AbstractField {
    /**
     * Output the field control markup.
     *
     * @return void
     */
    public function render() {
        $checks = $this->attr( 'checks', array( 'REST API' => true, 'Permalinks' => (bool) get_option( 'permalink_structure' ), 'Debug Mode' => defined( 'WP_DEBUG' ) && WP_DEBUG ) );
        echo '<div class="kavro-health-check">';
        foreach ( $checks as $label => $ok ) { echo '<div class="' . ( $ok ? 'is-ok' : 'is-warning' ) . '"><span></span><strong>' . esc_html( $label ) . '</strong><em>' . esc_html( $ok ? 'Ready' : 'Needs review' ) . '</em></div>'; }
        echo '<input type="hidden" name="' . esc_attr( $this->name ) . '" value="1">';
        echo '</div>';
    }
}
