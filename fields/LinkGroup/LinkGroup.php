<?php
/**
 * Link group field with label, URL and target controls.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\LinkGroup;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class LinkGroup extends AbstractField {
    public function render() {
        $value = wp_parse_args( $this->array_value(), array( 'label'=>'', 'url'=>'', 'target'=>'_self' ) );
        echo '<div class="kavro-compound kavro-link-group">';
        printf( '<label><span>Label</span><input type="text" name="%1$s[label]" value="%2$s" placeholder="Button label"></label>', esc_attr( $this->name ), esc_attr( $value['label'] ) );
        printf( '<label><span>URL</span><input type="url" name="%1$s[url]" value="%2$s" placeholder="https://example.com"></label>', esc_attr( $this->name ), esc_attr( $value['url'] ) );
        echo '<label><span>Target</span><select name="' . esc_attr( $this->name ) . '[target]">';
        foreach ( array( '_self'=>'Same tab', '_blank'=>'New tab' ) as $target => $label ) {
            printf( '<option value="%1$s" %2$s>%3$s</option>', esc_attr( $target ), selected( $value['target'], $target, false ), esc_html( $label ) );
        }
        echo '</select></label></div>';
    }
}
