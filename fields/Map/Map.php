<?php
/**
 * Map coordinate field for latitude, longitude and zoom.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\Map;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class Map extends AbstractField {
    public function render() {
        $value = wp_parse_args( $this->array_value(), array( 'lat'=>'', 'lng'=>'', 'zoom'=>'12' ) );
        echo '<div class="kavro-compound kavro-map-field">';
        printf( '<label><span>Latitude</span><input type="text" name="%1$s[lat]" value="%2$s" placeholder="23.8103"></label>', esc_attr( $this->name ), esc_attr( $value['lat'] ) );
        printf( '<label><span>Longitude</span><input type="text" name="%1$s[lng]" value="%2$s" placeholder="90.4125"></label>', esc_attr( $this->name ), esc_attr( $value['lng'] ) );
        printf( '<label><span>Zoom</span><input type="number" min="1" max="22" name="%1$s[zoom]" value="%2$s"></label>', esc_attr( $this->name ), esc_attr( $value['zoom'] ) );
        echo '</div>';
    }
}
