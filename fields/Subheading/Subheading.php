<?php
/** Subheading field for visually grouping related controls. */
namespace Kavro\Fields\Subheading;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Subheading extends AbstractField {
    public function render() {
        echo '<div class="kavro-subheading"><span>' . esc_html( $this->attr( 'content', $this->attr( 'title', '' ) ) ) . '</span></div>';
    }
}
