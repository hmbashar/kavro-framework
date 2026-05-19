<?php
/**
 * SeoPreview field.
 *
 * Premium Kavro control for advanced WordPress option data.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\SeoPreview;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the SeoPreview field.
 */
class SeoPreview extends AbstractField {
    /**
     * Output the field control markup.
     *
     * @return void
     */
    public function render() {
        $value = $this->array_value();
        echo '<div class="kavro-seo-preview"><input type="text" name="' . esc_attr( $this->name ) . '[title]" value="' . esc_attr( $value['title'] ?? '' ) . '" placeholder="SEO title"><input type="text" name="' . esc_attr( $this->name ) . '[url]" value="' . esc_attr( $value['url'] ?? home_url( '/' ) ) . '" placeholder="URL"><textarea name="' . esc_attr( $this->name ) . '[description]" placeholder="Meta description">' . esc_textarea( $value['description'] ?? '' ) . '</textarea><div class="kavro-google-card"><span>' . esc_html( $value['url'] ?? home_url( '/' ) ) . '</span><strong>' . esc_html( $value['title'] ?? 'SEO Preview Title' ) . '</strong><p>' . esc_html( $value['description'] ?? 'Meta description preview will appear here.' ) . '</p></div></div>';
    }
}
