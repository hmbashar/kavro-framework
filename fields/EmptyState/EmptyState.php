<?php
/** Empty state field. @package Kavro\Fields */
namespace Kavro\Fields\EmptyState;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class EmptyState extends AbstractField {
    public function render() {
        $value = $this->array_value();
        echo '<div class="kavro-empty-state-builder">';
        echo '<input type="text" name="'.esc_attr($this->name.'[title]').'" value="'.esc_attr($value['title'] ?? 'Nothing here yet').'" placeholder="Title">';
        echo '<textarea name="'.esc_attr($this->name.'[message]').'" placeholder="Message">'.esc_textarea($value['message'] ?? 'Create your first item to get started.').'</textarea>';
        echo '<input type="text" name="'.esc_attr($this->name.'[button]').'" value="'.esc_attr($value['button'] ?? 'Create New').'" placeholder="Button label">';
        echo '</div>';
    }
}
