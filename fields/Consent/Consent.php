<?php
/** Consent field. @package Kavro\Fields */
namespace Kavro\Fields\Consent;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class Consent extends AbstractField {
    public function render() {
        $value = $this->array_value();
        $items = $this->attr('options', array('terms'=>'Terms accepted','privacy'=>'Privacy accepted','marketing'=>'Marketing allowed'));
        echo '<div class="kavro-consent-list">';
        foreach ($items as $key=>$label) {
            echo '<label><input type="checkbox" name="'.esc_attr($this->name.'[]').'" value="'.esc_attr($key).'" '.checked(in_array($key,$value,true), true, false).'><span></span><strong>'.esc_html($label).'</strong></label>';
        }
        echo '</div>';
    }
}
