<?php
/** Terms checklist field. @package Kavro\Fields */
namespace Kavro\Fields\TermsChecklist;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class TermsChecklist extends AbstractField {
    public function render() {
        $value = $this->array_value();
        $items = $this->attr('items', array('security'=>'Security reviewed','performance'=>'Performance checked','accessibility'=>'Accessibility checked'));
        echo '<div class="kavro-terms-checklist">';
        foreach ($items as $key=>$label) {
            echo '<label><input type="checkbox" name="'.esc_attr($this->name.'[]').'" value="'.esc_attr($key).'" '.checked(in_array($key,$value,true), true, false).'><span></span><em>'.esc_html($label).'</em></label>';
        }
        echo '</div>';
    }
}
