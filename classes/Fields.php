<?php
namespace Kavro;

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Fields {
    protected static $map = array(
        'text'       => '\\Kavro\\Fields\\Text\\Text',
        'textarea'   => '\\Kavro\\Fields\\Textarea\\Textarea',
        'checkbox'   => '\\Kavro\\Fields\\Checkbox\\Checkbox',
        'switcher'   => '\\Kavro\\Fields\\Switcher\\Switcher',
        'select'     => '\\Kavro\\Fields\\Select\\Select',
        'radio'      => '\\Kavro\\Fields\\Radio\\Radio',
        'button_set' => '\\Kavro\\Fields\\ButtonSet\\ButtonSet',
        'color'      => '\\Kavro\\Fields\\Color\\Color',
        'number'     => '\\Kavro\\Fields\\Number\\Number',
        'content'    => '\\Kavro\\Fields\\Content\\Content',
        'heading'    => '\\Kavro\\Fields\\Heading\\Heading',
        'notice'     => '\\Kavro\\Fields\\Notice\\Notice',
        'date'       => '\\Kavro\\Fields\\Date\\Date',
        'time'       => '\\Kavro\\Fields\\Time\\Time',
        'email'      => '\\Kavro\\Fields\\Email\\Email',
        'url'        => '\\Kavro\\Fields\\Url\\Url',
        'password'   => '\\Kavro\\Fields\\Password\\Password',
        'range'      => '\\Kavro\\Fields\\Range\\Range',
        'slider'     => '\\Kavro\\Fields\\Range\\Range',
        'code'       => '\\Kavro\\Fields\\Code\\Code',
        'hidden'     => '\\Kavro\\Fields\\Hidden\\Hidden',
        'media'      => '\\Kavro\\Fields\\Media\\Media',
        'upload'     => '\\Kavro\\Fields\\Upload\\Upload',
        'image'      => '\\Kavro\\Fields\\Image\\Image',
        'dimensions' => '\\Kavro\\Fields\\Dimensions\\Dimensions',
        'spacing'    => '\\Kavro\\Fields\\Spacing\\Spacing',
        'typography' => '\\Kavro\\Fields\\Typography\\Typography',
        'repeater'   => '\\Kavro\\Fields\\Repeater\\Repeater',
    );

    public static function render( $field, $value, $unique ) {
        $type = isset( $field['type'] ) ? sanitize_key( $field['type'] ) : 'text';
        if ( 'hidden' !== $type && empty( $field['id'] ) && ! in_array( $type, array( 'content', 'heading', 'notice' ), true ) ) { return; }
        $class = isset( self::$map[ $type ] ) ? self::$map[ $type ] : self::$map['text'];
        if ( class_exists( $class ) ) {
            $instance = new $class( $field, $value, $unique );
            $instance->output();
        }
    }

    public static function sanitize( $value ) {
        if ( is_array( $value ) ) { return array_map( array( __CLASS__, 'sanitize' ), $value ); }
        return wp_kses_post( wp_unslash( $value ) );
    }
}
