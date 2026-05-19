<?php
/**
 * device_preview field for Kavro Framework.
 *
 * @package Kavro\Fields
 */

namespace Kavro\Fields\DevicePreview;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the device_preview field.
 */
class DevicePreview extends AbstractField {
    /** Render the field control. */
    public function render() {

        $value = $this->array_value();
        echo '<div class="kavro-device-preview"><div class="kavro-device-tabs"><button type="button">Desktop</button><button type="button">Tablet</button><button type="button">Mobile</button></div><textarea name="' . esc_attr( $this->name . '[content]' ) . '" rows="5" placeholder="' . esc_attr__( 'Preview content or notes', 'kavro-framework' ) . '">' . esc_textarea( isset( $value['content'] ) ? $value['content'] : '' ) . '</textarea></div>';
    }
}
