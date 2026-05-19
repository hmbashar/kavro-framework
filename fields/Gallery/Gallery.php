<?php
/** Gallery field storing a comma-separated list of media URLs. */
namespace Kavro\Fields\Gallery;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Gallery extends AbstractField {
    public function render() {
        $value = is_array( $this->value ) ? implode( ',', $this->value ) : (string) $this->value;
        echo '<div class="kavro-gallery kavro-media">';
        printf( '<input type="text" id="kavro-%1$s" name="%2$s" value="%3$s" placeholder="Image URLs separated by commas">', esc_attr( $this->id ), esc_attr( $this->name ), esc_attr( $value ) );
        echo '<button type="button" class="button kavro-gallery-upload">Add Images</button><button type="button" class="button kavro-media-remove">Clear</button>';
        echo '<div class="kavro-gallery-preview">';
        foreach ( array_filter( array_map( 'trim', explode( ',', $value ) ) ) as $url ) {
            echo '<img src="' . esc_url( $url ) . '" alt="">';
        }
        echo '</div></div>';
    }
}
