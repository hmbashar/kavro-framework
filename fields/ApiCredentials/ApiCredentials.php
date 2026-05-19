<?php
/**
 * ApiCredentials field.
 *
 * Professional premium field renderer for Kavro Framework.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\ApiCredentials;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the ApiCredentials field.
 */
class ApiCredentials extends AbstractField {
    /**
     * Output the field control markup.
     *
     * @return void
     */
    public function render() {
        $value = $this->array_value();
        echo '<div class="kavro-secret-grid">';
        foreach ( array( 'api_key' => 'API Key', 'api_secret' => 'API Secret', 'client_id' => 'Client ID', 'client_secret' => 'Client Secret' ) as $key => $label ) {
            $type = false !== strpos( $key, 'secret' ) ? 'password' : 'text';
            echo '<label><span>' . esc_html( $label ) . '</span><input type="' . esc_attr( $type ) . '" name="' . esc_attr( $this->name ) . '[' . esc_attr( $key ) . ']" value="' . esc_attr( $value[ $key ] ?? '' ) . '" autocomplete="off"></label>';
        }
        echo '</div>';
    }
}
