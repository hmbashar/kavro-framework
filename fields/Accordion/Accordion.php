<?php
/** Accordion field used for collapsible documentation/settings blocks. */
namespace Kavro\Fields\Accordion;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Accordion extends AbstractField {
    public function render() {
        echo '<div class="kavro-accordion-field">';
        foreach ( (array) $this->attr( 'accordions', $this->attr( 'items', array() ) ) as $index => $item ) {
            echo '<div class="kavro-accordion-item' . ( 0 === $index ? ' is-open' : '' ) . '">';
            echo '<button type="button" class="kavro-accordion-title">' . esc_html( $item['title'] ?? 'Item' ) . '</button>';
            echo '<div class="kavro-accordion-content">' . wp_kses_post( $item['content'] ?? '' ) . '</div></div>';
        }
        echo '</div>';
    }
}
