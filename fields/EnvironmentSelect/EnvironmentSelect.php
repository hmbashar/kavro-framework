<?php
/**
 * EnvironmentSelect field.
 *
 * Professional premium field renderer for Kavro Framework.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\EnvironmentSelect;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the EnvironmentSelect field.
 */
class EnvironmentSelect extends AbstractField {
    /**
     * Output the field control markup.
     *
     * @return void
     */
    public function render() {
        $value = (string) $this->value;
        $options = $this->attr( 'options', array( 'local' => 'Local', 'staging' => 'Staging', 'production' => 'Production' ) );
        echo '<div class="kavro-env-select">';
        foreach ( $options as $key => $label ) {
            echo '<label><input type="radio" name="' . esc_attr( $this->name ) . '" value="' . esc_attr( $key ) . '" ' . checked( $value, $key, false ) . '><span>' . esc_html( $label ) . '</span></label>';
        }
        echo '</div>';
    }
}
