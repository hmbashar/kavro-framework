<?php
/**
 * Asset loading helper for Kavro admin screens.
 *
 * The framework has many field types, but most screens only need a small subset
 * of WordPress assets. This helper inspects the registered field schema and
 * enqueues only the dependencies that are required for the current screen.
 *
 * @package Kavro\Core
 */

namespace Kavro;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Assets
 *
 * Centralized admin asset resolver used by options, metaboxes, taxonomy fields,
 * profile fields, nav menu fields, widgets, comments, and shortcode screens.
 */
final class Assets {
    /**
     * Field types that need WordPress media modal support.
     *
     * @var string[]
     */
    protected static $media_fields = array(
        'media',
        'upload',
        'image',
        'gallery',
        'file_upload',
        'video_upload',
        'audio_upload',
        'background',
        'open_graph',
    );

    /**
     * Field types that need WordPress color picker support.
     *
     * @var string[]
     */
    protected static $color_fields = array(
        'color',
        'color_group',
        'link_color',
        'color_picker_alpha',
        'palette',
        'background',
        'border',
        'box_shadow',
        'gradient',
        'typography',
        'typography_advanced',
        'css_builder',
    );

    /**
     * Field types that need jQuery UI sortable.
     *
     * @var string[]
     */
    protected static $sortable_fields = array(
        'sortable',
        'sorter',
        'repeater',
        'repeater_nested',
        'group',
        'cloneable',
        'table',
        'matrix',
        'pricing_table',
        'timeline',
        'onboarding_steps',
    );

    /**
     * Field types that should trigger the lightweight Kavro searchable select UI.
     *
     * Kavro's Select2-like control is implemented in admin.js to avoid shipping a
     * heavy third-party dependency in the free core. This flag is still useful for
     * add-ons and docs because it identifies screens that use enhanced selects.
     *
     * @var string[]
     */
    protected static $enhanced_select_fields = array(
        'select2',
        'enhanced_select',
        'ajax_select',
        'post_select',
        'post_autocomplete',
        'post_relation',
        'page_select',
        'cpt_select',
        'taxonomy_select',
        'term_relation',
        'user_select',
        'role_select',
        'menu_select',
        'sidebar_select',
        'template_select',
    );

    /**
     * Enqueue Kavro admin assets for a specific schema.
     *
     * @param array $sections Registered section tree for the current module.
     * @param array $localize Optional data to expose as the KavroAdmin JS object.
     * @return void
     */
    public static function enqueue( $sections = array(), $localize = array() ) {
        $profile = self::profile( $sections );
        $deps    = array( 'jquery' );
        $styles  = array();

        if ( ! empty( $profile['media'] ) ) {
            wp_enqueue_media();
        }

        if ( ! empty( $profile['color'] ) ) {
            wp_enqueue_style( 'wp-color-picker' );
            $styles[] = 'wp-color-picker';
            $deps[]   = 'wp-color-picker';
        }

        if ( ! empty( $profile['sortable'] ) ) {
            $deps[] = 'jquery-ui-sortable';
        }

        wp_enqueue_style( 'dashicons' );
        wp_enqueue_style( 'kavro-admin', KAVRO_URL . 'assets/css/admin.css', $styles, KAVRO_VERSION );
        wp_enqueue_script( 'kavro-admin', KAVRO_URL . 'assets/js/admin.js', array_values( array_unique( $deps ) ), KAVRO_VERSION, true );

        $base = array(
            'ajaxUrl' => admin_url( 'admin-ajax.php' ),
            'assets'  => $profile,
        );

        /**
         * Filter localized admin data before it is printed.
         *
         * @param array $data     Localized data.
         * @param array $sections Current module section tree.
         */
        $data = apply_filters( 'kavro/admin_localize_data', array_merge( $base, $localize ), $sections );

        wp_localize_script( 'kavro-admin', 'KavroAdmin', $data );
    }

    /**
     * Build an asset profile from field types.
     *
     * @param array $sections Registered section tree.
     * @return array<string,bool>
     */
    public static function profile( $sections = array() ) {
        $types = self::field_types( $sections );

        $profile = array(
            'media'           => (bool) array_intersect( $types, self::$media_fields ),
            'color'           => (bool) array_intersect( $types, self::$color_fields ),
            'sortable'        => (bool) array_intersect( $types, self::$sortable_fields ),
            'enhanced_select' => (bool) array_intersect( $types, self::$enhanced_select_fields ),
            'types'           => array_values( $types ),
        );

        /**
         * Filter the computed asset profile.
         *
         * Custom fields/add-ons can force dependencies by returning true for a
         * profile key or by adding their own custom keys.
         *
         * @param array $profile Computed asset profile.
         * @param array $types   Field types found in this screen.
         * @param array $sections Section tree.
         */
        return apply_filters( 'kavro/asset_profile', $profile, $types, $sections );
    }

    /**
     * Recursively collect field types from sections and nested field structures.
     *
     * @param array $sections Registered section tree.
     * @return string[] Unique field types.
     */
    public static function field_types( $sections ) {
        $types = array();

        foreach ( (array) $sections as $section ) {
            if ( ! empty( $section['fields'] ) && is_array( $section['fields'] ) ) {
                foreach ( $section['fields'] as $field ) {
                    self::collect_field_types( $field, $types );
                }
            }

            if ( ! empty( $section['children'] ) && is_array( $section['children'] ) ) {
                $types = array_merge( $types, self::field_types( $section['children'] ) );
            }
        }

        return array_values( array_unique( array_filter( $types ) ) );
    }

    /**
     * Collect types from one field, including nested sub-fields.
     *
     * @param array $field Field definition.
     * @param array $types Running list of types.
     * @return void
     */
    protected static function collect_field_types( $field, &$types ) {
        if ( ! is_array( $field ) ) {
            return;
        }

        if ( ! empty( $field['type'] ) ) {
            $types[] = sanitize_key( $field['type'] );
        }

        foreach ( array( 'fields', 'subfields', 'tabs', 'items', 'columns' ) as $child_key ) {
            if ( empty( $field[ $child_key ] ) || ! is_array( $field[ $child_key ] ) ) {
                continue;
            }

            foreach ( $field[ $child_key ] as $child ) {
                if ( isset( $child['fields'] ) && is_array( $child['fields'] ) ) {
                    foreach ( $child['fields'] as $nested_field ) {
                        self::collect_field_types( $nested_field, $types );
                    }
                } else {
                    self::collect_field_types( $child, $types );
                }
            }
        }
    }
}
