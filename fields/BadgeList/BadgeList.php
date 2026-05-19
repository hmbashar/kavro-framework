<?php
/** Badge list field. @package Kavro\Fields */
namespace Kavro\Fields\BadgeList;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class BadgeList extends AbstractField {
    public function render() {
        $value = $this->array_value();
        $badges = isset($value['badges']) && is_array($value['badges']) ? $value['badges'] : array('New','Popular','Featured');
        echo '<div class="kavro-badge-list">';
        foreach ($badges as $i=>$badge) {
            echo '<input type="text" name="'.esc_attr($this->name.'[badges]['.$i.']').'" value="'.esc_attr($badge).'" placeholder="Badge text">';
        }
        echo '</div>';
    }
}
