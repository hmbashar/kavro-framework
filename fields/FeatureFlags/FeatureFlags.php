<?php
/**
 * FeatureFlags field.
 *
 * Professional premium field renderer for Kavro Framework.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\FeatureFlags;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the FeatureFlags field.
 */
class FeatureFlags extends AbstractField {
    /**
     * Output the field control markup.
     *
     * @return void
     */
    public function render() {
        $value = $this->array_value();
        $flags = $this->attr( 'flags', array( 'beta_ui' => 'Beta UI', 'debug_mode' => 'Debug Mode', 'api_cache' => 'API Cache' ) );
        echo '<div class="kavro-feature-flags">';
        foreach ( $flags as $key => $label ) {
            echo '<label><input type="checkbox" name="' . esc_attr( $this->name ) . '[]" value="' . esc_attr( $key ) . '" ' . checked( in_array( $key, $value, true ), true, false ) . '><span>' . esc_html( $label ) . '</span></label>';
        }
        echo '</div>';
    }
}
