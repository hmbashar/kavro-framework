<?php
/** Address field. @package Kavro\Fields */
namespace Kavro\Fields\Address;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class Address extends AbstractField {
    public function render() {
        $value = $this->array_value();
        $items = array('line1'=>'Address Line 1','line2'=>'Address Line 2','city'=>'City','state'=>'State / Region','zip'=>'ZIP / Postal Code','country'=>'Country');
        echo '<div class="kavro-address-grid">';
        foreach ($items as $key=>$label) {
            echo '<label><span>'.esc_html($label).'</span><input type="text" name="'.esc_attr($this->name.'['.$key.']').'" value="'.esc_attr($value[$key] ?? '').'" placeholder="'.esc_attr($label).'"></label>';
        }
        echo '</div>';
    }
}
