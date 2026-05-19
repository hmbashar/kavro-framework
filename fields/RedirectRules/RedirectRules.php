<?php
/**
 * RedirectRules field.
 *
 * Professional premium field renderer for Kavro Framework.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\RedirectRules;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the RedirectRules field.
 */
class RedirectRules extends AbstractField {
    /**
     * Output the field control markup.
     *
     * @return void
     */
    public function render() {
        $value = $this->array_value();
        $rows = isset( $value['rules'] ) && is_array( $value['rules'] ) ? $value['rules'] : array( array( 'from' => '', 'to' => '', 'status' => '301' ) );
        echo '<div class="kavro-redirect-rules">';
        foreach ( $rows as $i => $row ) {
            echo '<div class="kavro-rule-row"><input type="text" name="' . esc_attr( $this->name ) . '[rules][' . absint( $i ) . '][from]" value="' . esc_attr( $row['from'] ?? '' ) . '" placeholder="/old-url"><input type="text" name="' . esc_attr( $this->name ) . '[rules][' . absint( $i ) . '][to]" value="' . esc_attr( $row['to'] ?? '' ) . '" placeholder="/new-url"><select name="' . esc_attr( $this->name ) . '[rules][' . absint( $i ) . '][status]"><option value="301" ' . selected( $row['status'] ?? '301', '301', false ) . '>301</option><option value="302" ' . selected( $row['status'] ?? '', '302', false ) . '>302</option></select></div>';
        }
        echo '</div>';
    }
}
