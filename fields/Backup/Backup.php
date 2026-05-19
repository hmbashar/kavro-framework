<?php
/**
 * Backup field renderer.
 *
 * Displays a premium textarea with import/export action buttons. In this MVP the
 * export/import logic is handled in assets/js/admin.js so the field stays small
 * and the normal WordPress option save process remains the source of truth.
 *
 * @package Kavro\Fields
 */

namespace Kavro\Fields\Backup;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders a lightweight JSON backup helper field.
 */
class Backup extends AbstractField {
    /**
     * Render the backup control.
     *
     * @return void
     */
    public function render() {
        echo '<div class="kavro-backup">';
        echo '<textarea id="kavro-' . esc_attr( $this->id ) . '" name="' . esc_attr( $this->name ) . '" rows="8" placeholder="Paste exported JSON here...">' . esc_textarea( $this->value ) . '</textarea>';
        echo '<div class="kavro-backup-actions"><button type="button" class="button kavro-backup-export">Export Current Form</button> <button type="button" class="button kavro-backup-import">Import JSON</button></div>';
        echo '<p class="kavro-desc">This helper stores JSON in the option set and offers a quick demo import/export workflow.</p>';
        echo '</div>';
    }
}
