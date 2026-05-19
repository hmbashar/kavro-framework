<?php
/**
 * Key/value table field for developer settings and custom variables.
 *
 * @package Kavro\Fields
 */

namespace Kavro\Fields\KeyValue;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * KeyValue field renderer.
 */
class KeyValue extends AbstractField {
    /**
     * Render the field control markup.
     *
     * @return void
     */
    public function render() {
        $rows = $this->array_value();
        if ( empty( $rows ) ) {
            $rows = array( array( 'key' => '', 'value' => '' ) );
        }
        echo '<div class="kavro-key-value" data-kavro-key-value>'; $index = 0;
        foreach ( $rows as $row ) {
            $key = is_array( $row ) ? ( $row['key'] ?? '' ) : '';
            $val = is_array( $row ) ? ( $row['value'] ?? '' ) : '';
            printf('<div class="kavro-key-value-row"><input type="text" name="%1$s[%2$d][key]" value="%3$s" placeholder="Key"><input type="text" name="%1$s[%2$d][value]" value="%4$s" placeholder="Value"><button type="button" class="button kavro-kv-remove">Remove</button></div>', esc_attr( $this->name ), absint( $index ), esc_attr( $key ), esc_attr( $val ) );
            $index++;
        }
        echo '<button type="button" class="button kavro-kv-add">Add Row</button></div>';
    }

}
