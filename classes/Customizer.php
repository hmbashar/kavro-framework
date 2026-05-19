<?php
/**
 * WordPress Customizer integration for Kavro Framework.
 *
 * This controller maps Kavro section/field definitions to native WordPress
 * Customizer panels, sections, settings, and controls. It intentionally starts
 * with native Customizer control types for speed and stability, while keeping
 * the public API aligned with the admin options and metabox modules.
 *
 * @package Kavro\Core
 */

namespace Kavro;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Customizer
 *
 * Builds one Customizer panel from a Kavro container definition.
 */
class Customizer {
    /** @var string Unique option container key. */
    protected $unique;

    /** @var array Customizer container arguments. */
    protected $args;

    /** @var array Nested section tree. */
    protected $sections;

    /** @var array Flattened section list for native Customizer sections. */
    protected $flat_sections = array();

    /**
     * Register Customizer hooks.
     *
     * @param string $unique   Unique setting container ID.
     * @param array  $args     Container arguments.
     * @param array  $sections Section configuration.
     */
    public function __construct( $unique, $args, $sections ) {
        $this->unique        = sanitize_key( $unique );
        $this->args          = $args;
        $this->sections      = $this->prepare_sections( $sections );
        $this->flat_sections = $this->flatten_sections( $this->sections );

        add_action( 'customize_register', array( $this, 'register' ) );
    }

    /**
     * Prepare nested sections by assigning stable internal slugs and depth data.
     *
     * @param array  $sections Section tree.
     * @param int    $depth    Current nesting depth.
     * @param string $path     Parent slug path.
     * @return array
     */
    protected function prepare_sections( $sections, $depth = 0, $path = '' ) {
        $prepared = array();

        foreach ( $sections as $index => $section ) {
            $base_slug = isset( $section['id'] ) ? sanitize_key( $section['id'] ) : sanitize_title( $section['title'] ?? 'section-' . $index );
            $slug      = $path ? $path . '/' . $base_slug : $base_slug;

            $section['_slug']  = $slug;
            $section['_depth'] = $depth;

            if ( ! empty( $section['children'] ) && is_array( $section['children'] ) ) {
                $section['children'] = $this->prepare_sections( $section['children'], $depth + 1, $slug );
            }

            $prepared[] = $section;
        }

        return $prepared;
    }

    /**
     * Flatten nested sections for WordPress Customizer registration.
     *
     * WordPress Customizer does not support nested sections natively, so Kavro
     * flattens child sections and prefixes their titles visually.
     *
     * @param array $sections Section tree.
     * @return array
     */
    protected function flatten_sections( $sections ) {
        $flat = array();

        foreach ( $sections as $section ) {
            $flat[ $section['_slug'] ] = $section;

            if ( ! empty( $section['children'] ) && is_array( $section['children'] ) ) {
                $flat = array_merge( $flat, $this->flatten_sections( $section['children'] ) );
            }
        }

        return $flat;
    }

    /**
     * Register the Customizer panel, sections, settings, and controls.
     *
     * @param \WP_Customize_Manager $wp_customize WordPress Customizer manager.
     * @return void
     */
    public function register( $wp_customize ) {
        $panel_id = $this->unique . '_panel';

        $wp_customize->add_panel(
            $panel_id,
            array(
                'title'       => $this->args['title'] ?? $this->args['menu_title'] ?? __( 'Kavro Customizer', 'kavro-framework' ),
                'description' => $this->args['description'] ?? __( 'Customizer settings registered with Kavro Framework.', 'kavro-framework' ),
                'priority'    => isset( $this->args['priority'] ) ? absint( $this->args['priority'] ) : 160,
            )
        );

        foreach ( $this->flat_sections as $slug => $section ) {
            $section_id = $this->section_id( $slug );
            $depth      = isset( $section['_depth'] ) ? absint( $section['_depth'] ) : 0;
            $prefix     = $depth ? str_repeat( '— ', $depth ) : '';

            $wp_customize->add_section(
                $section_id,
                array(
                    'title'       => $prefix . ( $section['title'] ?? __( 'Untitled', 'kavro-framework' ) ),
                    'description' => $section['subtitle'] ?? '',
                    'panel'       => $panel_id,
                    'priority'    => isset( $section['priority'] ) ? absint( $section['priority'] ) : 10,
                )
            );

            if ( empty( $section['fields'] ) || ! is_array( $section['fields'] ) ) {
                continue;
            }

            foreach ( $section['fields'] as $field ) {
                $this->register_field( $wp_customize, $section_id, $field );
            }
        }
    }

    /**
     * Register one Kavro field as a native Customizer setting/control pair.
     *
     * @param \WP_Customize_Manager $wp_customize WordPress Customizer manager.
     * @param string                $section_id   Native Customizer section ID.
     * @param array                 $field        Kavro field configuration.
     * @return void
     */
    protected function register_field( $wp_customize, $section_id, $field ) {
        if ( empty( $field['id'] ) || empty( $field['type'] ) ) {
            return;
        }

        $type       = sanitize_key( $field['type'] );
        $field_id   = sanitize_key( $field['id'] );
        $setting_id = $this->unique . '[' . $field_id . ']';
        $control_id = $this->unique . '_' . $field_id;
        $default    = isset( $field['default'] ) ? $field['default'] : '';

        $wp_customize->add_setting(
            $setting_id,
            array(
                'type'              => 'option',
                'default'           => $default,
                'transport'         => $field['transport'] ?? 'refresh',
                'sanitize_callback' => array( Fields::class, 'sanitize' ),
            )
        );

        $label       = $field['title'] ?? $field_id;
        $description = $field['desc'] ?? $field['subtitle'] ?? '';
        $choices     = isset( $field['options'] ) && is_array( $field['options'] ) ? $field['options'] : array();

        if ( 'color' === $type || 'color_picker_alpha' === $type ) {
            $wp_customize->add_control(
                new \WP_Customize_Color_Control(
                    $wp_customize,
                    $control_id,
                    array(
                        'label'       => $label,
                        'description' => $description,
                        'section'     => $section_id,
                        'settings'    => $setting_id,
                    )
                )
            );
            return;
        }

        $control_type = $this->map_control_type( $type );

        $args = array(
            'label'       => $label,
            'description' => $description,
            'section'     => $section_id,
            'settings'    => $setting_id,
            'type'        => $control_type,
        );

        if ( ! empty( $choices ) && in_array( $control_type, array( 'select', 'radio' ), true ) ) {
            $args['choices'] = $choices;
        }

        $wp_customize->add_control( $control_id, $args );
    }

    /**
     * Convert Kavro field types into native Customizer control types.
     *
     * Complex Kavro-only fields are represented as textarea controls in the
     * Customizer until a richer custom control layer is introduced.
     *
     * @param string $type Kavro field type.
     * @return string Native Customizer control type.
     */
    protected function map_control_type( $type ) {
        $map = array(
            'text'      => 'text',
            'email'     => 'email',
            'url'       => 'url',
            'number'    => 'number',
            'range'     => 'range',
            'slider'    => 'range',
            'checkbox'  => 'checkbox',
            'switcher'  => 'checkbox',
            'toggle'    => 'checkbox',
            'textarea'  => 'textarea',
            'code'      => 'textarea',
            'css_editor'=> 'textarea',
            'js_editor' => 'textarea',
            'select'    => 'select',
            'select2'   => 'select',
            'radio'     => 'radio',
            'button_set'=> 'radio',
            'date'      => 'date',
            'time'      => 'time',
        );

        return isset( $map[ $type ] ) ? $map[ $type ] : 'textarea';
    }

    /**
     * Convert a Kavro nested section slug into a Customizer-safe ID.
     *
     * @param string $slug Section slug.
     * @return string
     */
    protected function section_id( $slug ) {
        return $this->unique . '_' . sanitize_key( str_replace( '/', '_', $slug ) );
    }
}
