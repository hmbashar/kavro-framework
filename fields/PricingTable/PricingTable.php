<?php
/** Pricing table field. @package Kavro\Fields */
namespace Kavro\Fields\PricingTable;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class PricingTable extends AbstractField {
    public function render() {
        $value = $this->array_value();
        $plans = isset($value['plans']) && is_array($value['plans']) ? $value['plans'] : array(array('name'=>'Starter','price'=>'19','features'=>'Basic fields'), array('name'=>'Pro','price'=>'49','features'=>'All fields'));
        echo '<div class="kavro-pricing-table">';
        foreach ($plans as $i=>$plan) {
            echo '<div class="kavro-price-card"><input type="text" name="'.esc_attr($this->name.'[plans]['.$i.'][name]').'" value="'.esc_attr($plan['name'] ?? '').'" placeholder="Plan name">';
            echo '<input type="text" name="'.esc_attr($this->name.'[plans]['.$i.'][price]').'" value="'.esc_attr($plan['price'] ?? '').'" placeholder="Price">';
            echo '<textarea name="'.esc_attr($this->name.'[plans]['.$i.'][features]').'" placeholder="Features">'.esc_textarea($plan['features'] ?? '').'</textarea></div>';
        }
        echo '</div>';
    }
}
