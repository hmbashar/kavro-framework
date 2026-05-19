<?php
/**
 * NotificationChannels field.
 *
 * Professional premium field renderer for Kavro Framework.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\NotificationChannels;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the NotificationChannels field.
 */
class NotificationChannels extends AbstractField {
    /**
     * Output the field control markup.
     *
     * @return void
     */
    public function render() {
        $value = $this->array_value();
        $channels = $this->attr( 'channels', array( 'email' => 'Email', 'sms' => 'SMS', 'slack' => 'Slack', 'webhook' => 'Webhook' ) );
        echo '<div class="kavro-channel-grid">';
        foreach ( $channels as $key => $label ) {
            $enabled = ! empty( $value[ $key ]['enabled'] );
            echo '<label class="kavro-channel-card">';
            echo '<input type="checkbox" name="' . esc_attr( $this->name ) . '[' . esc_attr( $key ) . '][enabled]" value="1" ' . checked( $enabled, true, false ) . '>';
            echo '<span class="kavro-channel-title">' . esc_html( $label ) . '</span>';
            echo '<input type="text" name="' . esc_attr( $this->name ) . '[' . esc_attr( $key ) . '][target]" value="' . esc_attr( $value[ $key ]['target'] ?? '' ) . '" placeholder="Target / recipient / endpoint">';
            echo '</label>';
        }
        echo '</div>';
    }
}
