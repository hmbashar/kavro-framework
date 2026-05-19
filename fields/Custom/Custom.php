<?php
/**
 * Custom developer-defined field renderer.
 *
 * This field lets theme/plugin authors render bespoke controls without editing
 * Kavro core files. Developers can provide either a callable callback, static
 * HTML, or hook into the generated action name.
 *
 * @package Kavro\Fields
 */

namespace Kavro\Fields\Custom;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Custom extends AbstractField {
    /**
     * Render custom markup using callback/html/action fallback.
     *
     * Supported config keys:
     * - callback: callable accepting ($field, $value, $unique, $name, $id).
     * - html: safe static HTML.
     * - action: custom do_action hook name.
     *
     * @return void
     */
    public function render() {
        $callback = $this->attr( 'callback' );

        if ( is_callable( $callback ) ) {
            call_user_func( $callback, $this->field, $this->value, $this->unique, $this->name, $this->id );
            return;
        }

        if ( $this->attr( 'html' ) ) {
            echo '<div class="kavro-custom-html">' . wp_kses_post( $this->attr( 'html' ) ) . '</div>';
            return;
        }

        /**
         * Fires when a Kavro custom field has no callback/html renderer.
         *
         * Hook example: add_action( 'kavro_custom_field_my_field', 'render_fn', 10, 5 );
         */
        do_action( 'kavro_custom_field_' . $this->id, $this->field, $this->value, $this->unique, $this->name, $this->id );
    }
}
