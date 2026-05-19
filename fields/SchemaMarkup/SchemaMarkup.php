<?php
/**
 * SchemaMarkup field.
 *
 * Premium Kavro control for advanced WordPress option data.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\SchemaMarkup;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the SchemaMarkup field.
 */
class SchemaMarkup extends AbstractField {
    /**
     * Output the field control markup.
     *
     * @return void
     */
    public function render() {
        $current = is_array( $this->value ) ? wp_json_encode( $this->value, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES ) : (string) $this->value;
        echo '<textarea class="kavro-code kavro-json" name="' . esc_attr( $this->name ) . '" rows="10" placeholder="{ }">' . esc_textarea( $current ) . '</textarea>';
    }
}
