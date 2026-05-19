<?php
/** Backup field with import/export textarea for option payloads. */
namespace Kavro\Fields\Backup;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Backup extends AbstractField {
    public function render() {
        echo '<div class="kavro-backup"><textarea id="kavro-' . esc_attr( $this->id ) . '" name="' . esc_attr( $this->name ) . '" rows="8" placeholder="Paste exported JSON here...">' . esc_textarea( $this->value ) . '</textarea><p>Use this field as a lightweight import/export storage area until the full backup module is implemented.</p></div>';
    }
}
