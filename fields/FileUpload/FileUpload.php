<?php
/**
 * file_upload field for Kavro Framework.
 *
 * @package Kavro\Fields
 */

namespace Kavro\Fields\FileUpload;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the file_upload field.
 */
class FileUpload extends AbstractField {
    /** Render the field control. */
    public function render() {

        echo '<div class="kavro-media kavro-file-upload"><input type="text" id="kavro-' . esc_attr( $this->id ) . '" name="' . esc_attr( $this->name ) . '" value="' . esc_attr( $this->value ) . '" placeholder="' . esc_attr__( 'File URL', 'kavro-framework' ) . '"><button type="button" class="button button-primary kavro-media-upload">' . esc_html__( 'Choose File', 'kavro-framework' ) . '</button><button type="button" class="button kavro-media-remove">' . esc_html__( 'Remove', 'kavro-framework' ) . '</button><div class="kavro-media-preview"></div></div>';
    }
}
