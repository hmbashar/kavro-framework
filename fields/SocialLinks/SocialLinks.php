<?php
/**
 * Social links field for common profile URLs.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\SocialLinks;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class SocialLinks extends AbstractField {
    public function render() {
        $value = $this->array_value();
        $networks = (array) $this->attr( 'networks', array( 'facebook'=>'Facebook', 'x'=>'X/Twitter', 'linkedin'=>'LinkedIn', 'github'=>'GitHub', 'youtube'=>'YouTube' ) );
        echo '<div class="kavro-social-links">';
        foreach ( $networks as $key => $label ) {
            printf( '<label><span>%1$s</span><input type="url" name="%2$s[%3$s]" value="%4$s" placeholder="https://"></label>', esc_html( $label ), esc_attr( $this->name ), esc_attr( $key ), esc_attr( isset( $value[$key] ) ? $value[$key] : '' ) );
        }
        echo '</div>';
    }
}
