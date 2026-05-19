<?php
namespace Kavro\Fields\Background;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Background extends AbstractField {
    public function render() {
        $value = is_array( $this->value ) ? $this->value : array();
        $color = $value['color'] ?? '';
        $image = $value['image'] ?? '';
        $repeat = $value['repeat'] ?? 'no-repeat';
        $position = $value['position'] ?? 'center center';
        echo '<div class="kavro-background kavro-stack">';
        echo '<input class="kavro-color" type="text" name="' . esc_attr( $this->name . '[color]' ) . '" value="' . esc_attr( $color ) . '" placeholder="#ffffff">';
        echo '<div class="kavro-media"><input type="text" name="' . esc_attr( $this->name . '[image]' ) . '" value="' . esc_attr( $image ) . '" placeholder="Background image URL"><button class="button kavro-media-upload">Upload</button><button class="button kavro-media-remove">Remove</button><div class="kavro-media-preview">' . ( $image ? '<img src="' . esc_url( $image ) . '" alt="">' : '' ) . '</div></div>';
        echo '<select name="' . esc_attr( $this->name . '[repeat]' ) . '">';
        foreach ( array( 'no-repeat'=>'No Repeat', 'repeat'=>'Repeat', 'repeat-x'=>'Repeat X', 'repeat-y'=>'Repeat Y' ) as $k=>$l ) { echo '<option value="' . esc_attr( $k ) . '" ' . selected( $repeat, $k, false ) . '>' . esc_html( $l ) . '</option>'; }
        echo '</select>';
        echo '<input type="text" name="' . esc_attr( $this->name . '[position]' ) . '" value="' . esc_attr( $position ) . '" placeholder="center center">';
        echo '</div>';
    }
}
