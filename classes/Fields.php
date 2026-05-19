<?php
/**
 * Field manager and field registry.
 *
 * This class maps public field type names to field renderer classes. New fields
 * can be added internally by registering a class here, or later through a public
 * filter once extension APIs are finalized.
 *
 * @package Kavro\Core
 */

namespace Kavro;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Fields
 *
 * Resolves field types, renders field classes, and sanitizes option payloads.
 */
class Fields {
    /**
     * Built-in field type map.
     *
     * @var array<string,string>
     */
    protected static $map = array(
        'text'        => '\\Kavro\\Fields\\Text\\Text',
        'textarea'    => '\\Kavro\\Fields\\Textarea\\Textarea',
        'checkbox'    => '\\Kavro\\Fields\\Checkbox\\Checkbox',
        'switcher'    => '\\Kavro\\Fields\\Switcher\\Switcher',
        'toggle'      => '\\Kavro\\Fields\\Toggle\\Toggle',
        'select'      => '\\Kavro\\Fields\\Select\\Select',
        'radio'       => '\\Kavro\\Fields\\Radio\\Radio',
        'button_set'  => '\\Kavro\\Fields\\ButtonSet\\ButtonSet',
        'color'       => '\\Kavro\\Fields\\Color\\Color',
        'number'      => '\\Kavro\\Fields\\Number\\Number',
        'spinner'     => '\\Kavro\\Fields\\Spinner\\Spinner',
        'content'     => '\\Kavro\\Fields\\Content\\Content',
        'heading'     => '\\Kavro\\Fields\\Heading\\Heading',
        'subheading'  => '\\Kavro\\Fields\\Subheading\\Subheading',
        'divider'     => '\\Kavro\\Fields\\Divider\\Divider',
        'notice'      => '\\Kavro\\Fields\\Notice\\Notice',
        'date'        => '\\Kavro\\Fields\\Date\\Date',
        'time'        => '\\Kavro\\Fields\\Time\\Time',
        'email'       => '\\Kavro\\Fields\\Email\\Email',
        'url'         => '\\Kavro\\Fields\\Url\\Url',
        'password'    => '\\Kavro\\Fields\\Password\\Password',
        'range'       => '\\Kavro\\Fields\\Range\\Range',
        'slider'      => '\\Kavro\\Fields\\Range\\Range',
        'code'        => '\\Kavro\\Fields\\Code\\Code',
        'hidden'      => '\\Kavro\\Fields\\Hidden\\Hidden',
        'media'       => '\\Kavro\\Fields\\Media\\Media',
        'upload'      => '\\Kavro\\Fields\\Upload\\Upload',
        'image'       => '\\Kavro\\Fields\\Image\\Image',
        'gallery'     => '\\Kavro\\Fields\\Gallery\\Gallery',
        'dimensions'  => '\\Kavro\\Fields\\Dimensions\\Dimensions',
        'spacing'     => '\\Kavro\\Fields\\Spacing\\Spacing',
        'typography'  => '\\Kavro\\Fields\\Typography\\Typography',
        'repeater'    => '\\Kavro\\Fields\\Repeater\\Repeater',
        'group'       => '\\Kavro\\Fields\\Group\\Group',
        'fieldset'    => '\\Kavro\\Fields\\Fieldset\\Fieldset',
        'accordion'   => '\\Kavro\\Fields\\Accordion\\Accordion',
        'tabbed'      => '\\Kavro\\Fields\\Tabbed\\Tabbed',
        'sortable'    => '\\Kavro\\Fields\\Sortable\\Sortable',
        'sorter'      => '\\Kavro\\Fields\\Sorter\\Sorter',
        'multicheck'  => '\\Kavro\\Fields\\Multicheck\\Multicheck',
        'wysiwyg'     => '\\Kavro\\Fields\\Wysiwyg\\Wysiwyg',
        'wp_editor'   => '\\Kavro\\Fields\\Wysiwyg\\Wysiwyg',
        'link'        => '\\Kavro\\Fields\\Link\\Link',
        'icon'        => '\\Kavro\\Fields\\Icon\\Icon',
        'palette'     => '\\Kavro\\Fields\\Palette\\Palette',
        'background'  => '\\Kavro\\Fields\\Background\\Background',
        'border'      => '\\Kavro\\Fields\\Border\\Border',
        'color_group' => '\\Kavro\\Fields\\ColorGroup\\ColorGroup',
        'backup'      => '\\Kavro\\Fields\\Backup\\Backup',
        'datetime'    => '\\Kavro\\Fields\\DateTime\\DateTime',
        'image_select'=> '\\Kavro\\Fields\\ImageSelect\\ImageSelect',
        'link_color'  => '\\Kavro\\Fields\\LinkColor\\LinkColor',
        'key_value'   => '\\Kavro\\Fields\\KeyValue\\KeyValue',
        'tel'         => '\\Kavro\\Fields\\Tel\\Tel',
        'month'       => '\\Kavro\\Fields\\Month\\Month',
        'week'        => '\\Kavro\\Fields\\Week\\Week',
        'readonly'    => '\\Kavro\\Fields\\Readonly\\KavroReadonly',
        'copy'        => '\\Kavro\\Fields\\Copy\\Copy',
        'button'      => '\\Kavro\\Fields\\Button\\Button',
        'html'        => '\\Kavro\\Fields\\Html\\Html',
        'oembed'      => '\\Kavro\\Fields\\Oembed\\Oembed',
    );

    /**
     * Render a single field by resolving its configured type.
     *
     * @param array  $field  Field configuration.
     * @param mixed  $value  Current field value.
     * @param string $unique Option container ID.
     * @return void
     */
    public static function render( $field, $value, $unique ) {
        $type = isset( $field['type'] ) ? sanitize_key( $field['type'] ) : 'text';

        if ( 'hidden' !== $type && empty( $field['id'] ) && ! in_array( $type, array( 'content', 'heading', 'subheading', 'divider', 'notice', 'html' ), true ) ) {
            return;
        }

        $class = isset( self::$map[ $type ] ) ? self::$map[ $type ] : self::$map['text'];

        if ( class_exists( $class ) ) {
            $instance = new $class( $field, $value, $unique );
            $instance->output();
        }
    }

    /**
     * Recursively sanitize saved option data.
     *
     * This default sanitizer is intentionally permissive enough for framework
     * settings while still removing unsafe tags. Field-specific sanitizers can be
     * introduced later for stricter validation.
     *
     * @param mixed $value Raw submitted value.
     * @return mixed Sanitized value.
     */
    public static function sanitize( $value ) {
        if ( is_array( $value ) ) {
            return array_map( array( __CLASS__, 'sanitize' ), $value );
        }

        return wp_kses_post( wp_unslash( $value ) );
    }
}
