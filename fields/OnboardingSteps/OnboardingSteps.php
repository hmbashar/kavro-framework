<?php
/**
 * OnboardingSteps field.
 *
 * Professional premium field renderer for Kavro Framework.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\OnboardingSteps;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the OnboardingSteps field.
 */
class OnboardingSteps extends AbstractField {
    /**
     * Output the field control markup.
     *
     * @return void
     */
    public function render() {
        $value = $this->array_value();
        $steps = $this->attr( 'steps', array( 'install' => 'Install plugin', 'configure' => 'Configure options', 'publish' => 'Publish settings' ) );
        echo '<div class="kavro-onboarding">';
        foreach ( $steps as $key => $label ) {
            $done = ! empty( $value[ $key ] );
            echo '<label class="' . ( $done ? 'is-done' : '' ) . '"><input type="checkbox" name="' . esc_attr( $this->name ) . '[' . esc_attr( $key ) . ']" value="1" ' . checked( $done, true, false ) . '><span></span><strong>' . esc_html( $label ) . '</strong></label>';
        }
        echo '</div>';
    }
}
