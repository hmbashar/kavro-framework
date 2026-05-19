<?php
/** Notice builder field. @package Kavro\Fields */
namespace Kavro\Fields\NoticeBuilder;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class NoticeBuilder extends AbstractField {
    public function render() {
        $value = $this->array_value();
        echo '<div class="kavro-notice-builder">';
        echo '<select name="'.esc_attr($this->name.'[type]').'"><option value="info" '.selected($value['type'] ?? '', 'info', false).'>Info</option><option value="success" '.selected($value['type'] ?? '', 'success', false).'>Success</option><option value="warning" '.selected($value['type'] ?? '', 'warning', false).'>Warning</option></select>';
        echo '<input type="text" name="'.esc_attr($this->name.'[title]').'" value="'.esc_attr($value['title'] ?? 'Important notice').'" placeholder="Title">';
        echo '<textarea name="'.esc_attr($this->name.'[message]').'" placeholder="Notice message">'.esc_textarea($value['message'] ?? '').'</textarea>';
        echo '</div>';
    }
}
