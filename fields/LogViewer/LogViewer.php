<?php
/**
 * LogViewer field.
 *
 * Professional premium field renderer for Kavro Framework.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\LogViewer;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the LogViewer field.
 */
class LogViewer extends AbstractField {
    /**
     * Output the field control markup.
     *
     * @return void
     */
    public function render() {
        $logs = $this->attr( 'logs', array( 'Kavro initialized.', 'Options screen loaded.', 'No critical errors found.' ) );
        echo '<div class="kavro-log-viewer">';
        foreach ( $logs as $line ) { echo '<code>' . esc_html( $line ) . '</code>'; }
        echo '<input type="hidden" name="' . esc_attr( $this->name ) . '" value="1">';
        echo '</div>';
    }
}
