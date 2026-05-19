<?php
/** Dashicon picker/input field. */
namespace Kavro\Fields\Icon;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Icon extends AbstractField {
    public function render() {
        $icons = (array) $this->attr( 'options', array( 'dashicons-admin-generic', 'dashicons-admin-customizer', 'dashicons-art', 'dashicons-star-filled', 'dashicons-heart', 'dashicons-lightbulb', 'dashicons-performance', 'dashicons-megaphone' ) );
        echo '<div class="kavro-icon-picker">';
        printf( '<input type="text" id="kavro-%1$s" name="%2$s" value="%3$s" placeholder="dashicons-admin-generic">', esc_attr( $this->id ), esc_attr( $this->name ), esc_attr( $this->value ) );
        echo '<div class="kavro-icon-grid">';
        foreach ( $icons as $icon ) {
            $icon = sanitize_html_class( $icon );
            printf( '<button type="button" class="kavro-icon-choice %4$s" data-icon="%1$s" aria-label="%1$s"><span class="dashicons %1$s"></span></button>', esc_attr( $icon ), '', '', selected( $this->value, $icon, false ) ? 'is-selected' : '' );
        }
        echo '</div></div>';
    }
}
