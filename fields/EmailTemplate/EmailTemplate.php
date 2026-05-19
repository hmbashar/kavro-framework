<?php
/**
 * EmailTemplate field.
 *
 * Professional premium field renderer for Kavro Framework.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\EmailTemplate;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the EmailTemplate field.
 */
class EmailTemplate extends AbstractField {
    /**
     * Output the field control markup.
     *
     * @return void
     */
    public function render() {
        $value = $this->array_value();
        echo '<div class="kavro-email-template">';
        echo '<input type="text" name="' . esc_attr( $this->name ) . '[subject]" value="' . esc_attr( $value['subject'] ?? '' ) . '" placeholder="Email subject">';
        echo '<textarea rows="8" name="' . esc_attr( $this->name ) . '[body]" placeholder="Email body with {{dynamic_tags}}">' . esc_textarea( $value['body'] ?? '' ) . '</textarea>';
        echo '<div class="kavro-template-tokens"><span>{{site_title}}</span><span>{{user_name}}</span><span>{{current_year}}</span></div>';
        echo '</div>';
    }
}
