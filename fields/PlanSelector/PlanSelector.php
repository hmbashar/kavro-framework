<?php
/** Plan selector field. @package Kavro\Fields */
namespace Kavro\Fields\PlanSelector;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class PlanSelector extends AbstractField {
    public function render() {
        $value = is_string($this->value) ? $this->value : (string) $this->attr('default','pro');
        $plans = $this->attr('plans', array('free'=>array('title'=>'Free','price'=>'$0','desc'=>'Starter tools'),'pro'=>array('title'=>'Pro','price'=>'$49','desc'=>'Premium features'),'agency'=>array('title'=>'Agency','price'=>'$149','desc'=>'Client projects')));
        echo '<div class="kavro-plan-selector">';
        foreach ($plans as $key=>$plan) {
            echo '<label class="'.($value===$key?'is-selected':'').'"><input type="radio" name="'.esc_attr($this->name).'" value="'.esc_attr($key).'" '.checked($value,$key,false).'>';
            echo '<strong>'.esc_html($plan['title'] ?? $key).'</strong><em>'.esc_html($plan['price'] ?? '').'</em><span>'.esc_html($plan['desc'] ?? '').'</span></label>';
        }
        echo '</div>';
    }
}
