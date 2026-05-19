<?php
namespace Kavro\Core;

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Fields {
    public static function render( $field, $value, $unique ) {
        $type = isset( $field['type'] ) ? sanitize_key( $field['type'] ) : 'text';
        $id   = isset( $field['id'] ) ? sanitize_key( $field['id'] ) : '';

        if ( ! $id && 'content' !== $type ) { return; }

        $name = $unique . '[' . $id . ']';

        echo '<div class="kavro-field kavro-field-' . esc_attr( $type ) . '">';

        if ( ! empty( $field['title'] ) ) {
            echo '<div class="kavro-field-label"><label for="kavro-' . esc_attr( $id ) . '">' . esc_html( $field['title'] ) . '</label></div>';
        }

        echo '<div class="kavro-field-control">';

        switch ( $type ) {
            case 'textarea':
                printf( '<textarea id="kavro-%1$s" name="%2$s" rows="6" placeholder="%3$s">%4$s</textarea>', esc_attr( $id ), esc_attr( $name ), esc_attr( $field['placeholder'] ?? '' ), esc_textarea( $value ) );
                break;
            case 'checkbox':
                printf( '<label class="kavro-check"><input type="hidden" name="%1$s" value="0"><input type="checkbox" id="kavro-%2$s" name="%1$s" value="1" %3$s> <span>%4$s</span></label>', esc_attr( $name ), esc_attr( $id ), checked( $value, '1', false ), esc_html( $field['label'] ?? '' ) );
                break;
            case 'switcher':
                printf( '<label class="kavro-switch"><input type="hidden" name="%1$s" value="0"><input type="checkbox" id="kavro-%2$s" name="%1$s" value="1" %3$s><span></span></label>', esc_attr( $name ), esc_attr( $id ), checked( $value, '1', false ) );
                break;
            case 'select':
                echo '<select id="kavro-' . esc_attr( $id ) . '" name="' . esc_attr( $name ) . '">';
                foreach ( (array) ( $field['options'] ?? array() ) as $option_value => $option_label ) {
                    printf( '<option value="%1$s" %2$s>%3$s</option>', esc_attr( $option_value ), selected( $value, $option_value, false ), esc_html( $option_label ) );
                }
                echo '</select>';
                break;
            case 'color':
                printf( '<input class="kavro-color" type="text" id="kavro-%1$s" name="%2$s" value="%3$s" placeholder="#111827">', esc_attr( $id ), esc_attr( $name ), esc_attr( $value ) );
                break;
            case 'number':
                printf( '<input type="number" id="kavro-%1$s" name="%2$s" value="%3$s" placeholder="%4$s">', esc_attr( $id ), esc_attr( $name ), esc_attr( $value ), esc_attr( $field['placeholder'] ?? '' ) );
                break;
            case 'content':
                echo '<div class="kavro-content">' . wp_kses_post( $field['content'] ?? '' ) . '</div>';
                break;
            case 'text':
            default:
                printf( '<input type="text" id="kavro-%1$s" name="%2$s" value="%3$s" placeholder="%4$s">', esc_attr( $id ), esc_attr( $name ), esc_attr( $value ), esc_attr( $field['placeholder'] ?? '' ) );
                break;
        }

        if ( ! empty( $field['desc'] ) ) {
            echo '<p class="kavro-desc">' . wp_kses_post( $field['desc'] ) . '</p>';
        }

        echo '</div></div>';
    }

    public static function sanitize( $value ) {
        if ( is_array( $value ) ) {
            return array_map( array( __CLASS__, 'sanitize' ), $value );
        }

        return wp_kses_post( wp_unslash( $value ) );
    }
}
