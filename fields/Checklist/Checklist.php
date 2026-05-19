<?php
/**
 * Checklist field.
 *
 * Premium Kavro control for advanced WordPress option data.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\Checklist;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the Checklist field.
 */
class Checklist extends AbstractField {
    /**
     * Output the field control markup.
     *
     * @return void
     */
    public function render() {
        $value = $this->array_value();
        $options = $this->attr( 'options', array() );
        echo '<div class="kavro-checklist">';
        foreach ( $options as $key => $label ) {
            echo '<label><input type="checkbox" name="' . esc_attr( $this->name ) . '[]" value="' . esc_attr( $key ) . '" ' . checked( in_array( (string) $key, array_map( 'strval', $value ), true ), true, false ) . '><span>' . esc_html( $label ) . '</span></label>';
        }
        echo '</div>';
    }
}
