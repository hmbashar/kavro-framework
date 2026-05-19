<?php
/** Tabbed content field for organizing inline help/settings previews. */
namespace Kavro\Fields\Tabbed;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Tabbed extends AbstractField {
    public function render() {
        $tabs = (array) $this->attr( 'tabs', array() );
        echo '<div class="kavro-tabs-field"><div class="kavro-tabs-nav">';
        foreach ( $tabs as $index => $tab ) {
            echo '<button type="button" class="kavro-tab-button' . ( 0 === $index ? ' is-active' : '' ) . '" data-kavro-inline-tab="' . esc_attr( $index ) . '">' . esc_html( $tab['title'] ?? 'Tab' ) . '</button>';
        }
        echo '</div><div class="kavro-tabs-panels">';
        foreach ( $tabs as $index => $tab ) {
            echo '<div class="kavro-tab-panel' . ( 0 === $index ? ' is-active' : '' ) . '" data-kavro-inline-panel="' . esc_attr( $index ) . '">' . wp_kses_post( $tab['content'] ?? '' ) . '</div>';
        }
        echo '</div></div>';
    }
}
