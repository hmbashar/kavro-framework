<?php
/** Color scheme field. @package Kavro\Fields */
namespace Kavro\Fields\ColorScheme;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class ColorScheme extends AbstractField {
    public function render() {
        $value = $this->array_value();
        $keys = array('primary'=>'Primary','secondary'=>'Secondary','accent'=>'Accent','surface'=>'Surface','text'=>'Text');
        echo '<div class="kavro-color-scheme">';
        foreach ($keys as $key=>$label) {
            echo '<label><span>'.esc_html($label).'</span><input type="color" name="'.esc_attr($this->name.'['.$key.']').'" value="'.esc_attr($value[$key] ?? '#6366f1').'"></label>';
        }
        echo '</div>';
    }
}
