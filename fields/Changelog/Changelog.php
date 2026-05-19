<?php
/**
 * Changelog field.
 *
 * Professional premium field renderer for Kavro Framework.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\Changelog;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the Changelog field.
 */
class Changelog extends AbstractField {
    /**
     * Output the field control markup.
     *
     * @return void
     */
    public function render() {
        $items = $this->attr( 'items', array( array( 'version' => '1.0.0', 'changes' => 'Initial stable framework foundation.' ) ) );
        echo '<div class="kavro-changelog">';
        foreach ( $items as $item ) { echo '<div><strong>' . esc_html( $item['version'] ?? '' ) . '</strong><p>' . esc_html( $item['changes'] ?? '' ) . '</p></div>'; }
        echo '</div>';
    }
}
