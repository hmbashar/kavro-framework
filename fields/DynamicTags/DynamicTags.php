<?php
/**
 * dynamic_tags field for Kavro Framework.
 *
 * @package Kavro\Fields
 */

namespace Kavro\Fields\DynamicTags;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the dynamic_tags field.
 */
class DynamicTags extends AbstractField {
    /** Render the field control. */
    public function render() {

        $tags = (array) $this->attr( 'options', array( '{{site_title}}' => 'Site Title', '{{site_url}}' => 'Site URL', '{{admin_email}}' => 'Admin Email', '{{current_year}}' => 'Current Year' ) );
        echo '<div class="kavro-dynamic-tags"><input type="text" name="' . esc_attr( $this->name ) . '" value="' . esc_attr( $this->value ) . '" placeholder="' . esc_attr__( 'Use dynamic tags', 'kavro-framework' ) . '"><div class="kavro-tag-list">';
        foreach ( $tags as $tag => $label ) { echo '<button type="button" class="kavro-tag" data-tag="' . esc_attr( $tag ) . '">' . esc_html( $label ) . '</button>'; }
        echo '</div></div>';
    }
}
