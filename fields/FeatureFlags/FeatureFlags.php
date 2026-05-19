<?php
/**
 * FeatureFlags field.
 *
 * Renders a polished grid of checkbox cards for enabling/disabling product or
 * experiment flags. The native checkbox remains accessible but visually hidden,
 * while Kavro draws the premium checkbox and label separately.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\FeatureFlags;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * FeatureFlags field renderer.
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
            $is_checked = in_array( $key, $value, true );
            echo '<label class="kavro-feature-flag-card' . ( $is_checked ? ' is-checked' : '' ) . '">';
            echo '<input type="checkbox" name="' . esc_attr( $this->name ) . '[]" value="' . esc_attr( $key ) . '" ' . checked( $is_checked, true, false ) . '>';
            echo '<span class="kavro-flag-check" aria-hidden="true"></span>';
            echo '<span class="kavro-flag-label">' . esc_html( $label ) . '</span>';
            echo '</label>';
        }
        echo '</div>';
    }
}
