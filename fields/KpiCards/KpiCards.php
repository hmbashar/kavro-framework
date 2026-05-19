<?php
/** KPI cards field. @package Kavro\Fields */
namespace Kavro\Fields\KpiCards;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class KpiCards extends AbstractField {
    public function render() {
        $value = $this->array_value();
        $cards = isset($value['cards']) && is_array($value['cards']) ? $value['cards'] : array(array('label'=>'Revenue','value'=>'$12k'), array('label'=>'Users','value'=>'1,240'), array('label'=>'Growth','value'=>'18%'));
        echo '<div class="kavro-kpi-cards">';
        foreach ($cards as $i=>$card) {
            echo '<div><input type="text" name="'.esc_attr($this->name.'[cards]['.$i.'][label]').'" value="'.esc_attr($card['label'] ?? '').'" placeholder="Label"><input type="text" name="'.esc_attr($this->name.'[cards]['.$i.'][value]').'" value="'.esc_attr($card['value'] ?? '').'" placeholder="Value"></div>';
        }
        echo '</div>';
    }
}
