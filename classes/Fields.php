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
        'unit'        => '\\Kavro\\Fields\\Unit\\Unit',
        'gradient'    => '\\Kavro\\Fields\\Gradient\\Gradient',
        'box_shadow'  => '\\Kavro\\Fields\\BoxShadow\\BoxShadow',
        'link_group'  => '\\Kavro\\Fields\\LinkGroup\\LinkGroup',
        'social_links'=> '\\Kavro\\Fields\\SocialLinks\\SocialLinks',
        'rating'      => '\\Kavro\\Fields\\Rating\\Rating',
        'progress'    => '\\Kavro\\Fields\\Progress\\Progress',
        'map'         => '\\Kavro\\Fields\\Map\\Map',
        'text_list'   => '\\Kavro\\Fields\\TextList\\TextList',
        'embed'       => '\\Kavro\\Fields\\Embed\\Embed',
        'json'        => '\\Kavro\\Fields\\Json\\Json',
        'post_select'       => '\\Kavro\\Fields\\WPContent\\WPContent',
        'post_checkbox'     => '\\Kavro\\Fields\\WPContent\\WPContent',
        'post_radio'        => '\\Kavro\\Fields\\WPContent\\WPContent',
        'post_autocomplete' => '\\Kavro\\Fields\\WPContent\\WPContent',
        'post_relation'     => '\\Kavro\\Fields\\WPContent\\WPContent',
        'page_select'       => '\\Kavro\\Fields\\WPContent\\WPContent',
        'cpt_select'        => '\\Kavro\\Fields\\WPContent\\WPContent',
        'taxonomy_select'   => '\\Kavro\\Fields\\WPTaxonomy\\WPTaxonomy',
        'taxonomy_checkbox' => '\\Kavro\\Fields\\WPTaxonomy\\WPTaxonomy',
        'taxonomy_radio'    => '\\Kavro\\Fields\\WPTaxonomy\\WPTaxonomy',
        'term_relation'     => '\\Kavro\\Fields\\WPTaxonomy\\WPTaxonomy',
        'user_select'       => '\\Kavro\\Fields\\WPSystem\\WPSystem',
        'role_select'       => '\\Kavro\\Fields\\WPSystem\\WPSystem',
        'menu_select'       => '\\Kavro\\Fields\\WPSystem\\WPSystem',
        'sidebar_select'    => '\\Kavro\\Fields\\WPSystem\\WPSystem',
        'template_select'   => '\\Kavro\\Fields\\WPSystem\\WPSystem',
        'custom'      => '\\Kavro\\Fields\\Custom\\Custom',
        'select2'     => '\\Kavro\\Fields\\Select\\Select',
        'enhanced_select' => '\\Kavro\\Fields\\Select\\Select',
        'ajax_select' => '\\Kavro\\Fields\\AjaxSelect\\AjaxSelect',
        'cloneable'   => '\\Kavro\\Fields\\Cloneable\\Cloneable',
        'responsive_value' => '\\Kavro\\Fields\\Responsive\\Responsive',
        'css_builder' => '\\Kavro\\Fields\\CssBuilder\\CssBuilder',
        'google_fonts' => '\\Kavro\\Fields\\GoogleFonts\\GoogleFonts',
        'code_editor_advanced' => '\\Kavro\\Fields\\AdvancedCode\\AdvancedCode',
        'css_editor' => '\\Kavro\\Fields\\AdvancedCode\\AdvancedCode',
        'js_editor' => '\\Kavro\\Fields\\AdvancedCode\\AdvancedCode',
        'file_upload' => '\\Kavro\\Fields\\FileUpload\\FileUpload',
        'video_upload' => '\\Kavro\\Fields\\FileUpload\\FileUpload',
        'audio_upload' => '\\Kavro\\Fields\\FileUpload\\FileUpload',
        'device_preview' => '\\Kavro\\Fields\\DevicePreview\\DevicePreview',
        'dynamic_tags' => '\\Kavro\\Fields\\DynamicTags\\DynamicTags',
        'border_radius' => '\\Kavro\\Fields\\BorderRadius\\BorderRadius',
        'box_model' => '\\Kavro\\Fields\\BoxModel\\BoxModel',
        'dimensions_advanced' => '\\Kavro\\Fields\\DimensionsAdvanced\\DimensionsAdvanced',
        'spacing_advanced' => '\\Kavro\\Fields\\SpacingAdvanced\\SpacingAdvanced',
        'typography_advanced' => '\\Kavro\\Fields\\TypographyAdvanced\\TypographyAdvanced',
        'color_picker_alpha' => '\\Kavro\\Fields\\ColorAlpha\\ColorAlpha',
        'conditional_group' => '\\Kavro\\Fields\\ConditionalGroup\\ConditionalGroup',
        'repeater_nested' => '\\Kavro\\Fields\\RepeaterNested\\RepeaterNested',
        'query_builder' => '\\Kavro\\Fields\\QueryBuilder\\QueryBuilder',
        'shortcode_builder' => '\\Kavro\\Fields\\ShortcodeBuilder\\ShortcodeBuilder',
        'form_builder' => '\\Kavro\\Fields\\FormBuilder\\FormBuilder',
        'menu_builder' => '\\Kavro\\Fields\\MenuBuilder\\MenuBuilder',
        'layout_builder' => '\\Kavro\\Fields\\LayoutBuilder\\LayoutBuilder',
        'table' => '\\Kavro\\Fields\\Table\\Table',
        'matrix' => '\\Kavro\\Fields\\Matrix\\Matrix',
        'checklist' => '\\Kavro\\Fields\\Checklist\\Checklist',
        'business_hours' => '\\Kavro\\Fields\\BusinessHours\\BusinessHours',
        'timeline' => '\\Kavro\\Fields\\Timeline\\Timeline',
        'seo_preview' => '\\Kavro\\Fields\\SeoPreview\\SeoPreview',
        'open_graph' => '\\Kavro\\Fields\\OpenGraph\\OpenGraph',
        'schema_markup' => '\\Kavro\\Fields\\SchemaMarkup\\SchemaMarkup',
        'webhook' => '\\Kavro\\Fields\\Webhook\\Webhook',
        'cron_schedule' => '\\Kavro\\Fields\\CronSchedule\\CronSchedule',
        'capability_select' => '\\Kavro\\Fields\\CapabilitySelect\\CapabilitySelect',
        'notification_channels' => '\\Kavro\\Fields\\NotificationChannels\\NotificationChannels',
        'api_credentials' => '\\Kavro\\Fields\\ApiCredentials\\ApiCredentials',
        'license_key' => '\\Kavro\\Fields\\LicenseKey\\LicenseKey',
        'environment_select' => '\\Kavro\\Fields\\EnvironmentSelect\\EnvironmentSelect',
        'feature_flags' => '\\Kavro\\Fields\\FeatureFlags\\FeatureFlags',
        'permission_matrix' => '\\Kavro\\Fields\\PermissionMatrix\\PermissionMatrix',
        'redirect_rules' => '\\Kavro\\Fields\\RedirectRules\\RedirectRules',
        'email_template' => '\\Kavro\\Fields\\EmailTemplate\\EmailTemplate',
        'rest_endpoint' => '\\Kavro\\Fields\\RestEndpoint\\RestEndpoint',
        'rate_limit' => '\\Kavro\\Fields\\RateLimit\\RateLimit',
        'cache_control' => '\\Kavro\\Fields\\CacheControl\\CacheControl',
        'log_viewer' => '\\Kavro\\Fields\\LogViewer\\LogViewer',
        'changelog' => '\\Kavro\\Fields\\Changelog\\Changelog',
        'system_info' => '\\Kavro\\Fields\\SystemInfo\\SystemInfo',
        'health_check' => '\\Kavro\\Fields\\HealthCheck\\HealthCheck',
        'onboarding_steps' => '\\Kavro\\Fields\\OnboardingSteps\\OnboardingSteps',
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

        // If an unknown field type receives an array value, do not pass it to a text input.
        // This prevents WordPress "Array to string conversion" notices while making
        // missing field registrations visible during development.
        if ( ! isset( self::$map[ $type ] ) && is_array( $value ) ) {
            $field['type']    = 'notice';
            $field['style']   = 'warning';
            $field['content'] = sprintf( __( 'Field type "%s" is not registered yet. Please register a renderer before using array values.', 'kavro-framework' ), esc_html( $type ) );
            $class = self::$map['notice'];
        }

        // Content-aware aliases automatically receive sensible query defaults.
        if ( in_array( $type, array( 'post_checkbox', 'post_radio', 'post_autocomplete', 'post_relation' ), true ) ) {
            $field['post_type'] = isset( $field['post_type'] ) ? $field['post_type'] : 'post';
        }
        if ( 'page_select' === $type ) {
            $field['post_type'] = 'page';
        }
        if ( 'cpt_select' === $type ) {
            $field['post_type'] = isset( $field['post_type'] ) ? $field['post_type'] : get_post_types( array( 'public' => true ), 'names' );
        }
        if ( 'post_checkbox' === $type ) { $field['variant'] = 'checkbox'; }
        if ( 'post_radio' === $type ) { $field['variant'] = 'radio'; }
        if ( 'post_autocomplete' === $type ) { $field['variant'] = 'autocomplete'; }
        if ( 'post_relation' === $type ) { $field['variant'] = 'relation'; }
        if ( 'taxonomy_select' === $type ) { $field['mode'] = 'taxonomies'; }
        if ( 'taxonomy_checkbox' === $type ) { $field['variant'] = 'checkbox'; }
        if ( 'taxonomy_radio' === $type ) { $field['variant'] = 'radio'; }
        if ( 'term_relation' === $type ) { $field['variant'] = 'relation'; }
        if ( in_array( $type, array( 'select2', 'enhanced_select' ), true ) ) {
            $field['select2'] = true;
        }
        if ( 'css_editor' === $type ) { $field['language'] = 'css'; }
        if ( 'js_editor' === $type ) { $field['language'] = 'javascript'; }
        if ( in_array( $type, array( 'user_select', 'role_select', 'menu_select', 'sidebar_select', 'template_select' ), true ) ) {
            $source_map = array(
                'user_select'     => 'users',
                'role_select'     => 'roles',
                'menu_select'     => 'menus',
                'sidebar_select'  => 'sidebars',
                'template_select' => 'templates',
            );
            $field['source'] = $source_map[ $type ];
        }

        if ( class_exists( $class ) ) {
            $instance = new $class( $field, $value, $unique );
            $instance->output();
        }
    }

    /**
     * Sanitize a submitted value when no field schema is available.
     *
     * This fallback keeps complex array values safe while remaining flexible for
     * developer-defined custom fields. Schema-aware saving should call
     * sanitize_values() so Kavro can apply type-specific rules.
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

    /**
     * Sanitize a submitted option/meta array using the registered field schema.
     *
     * Fields not present in the schema are still sanitized with the generic
     * fallback so add-ons can post custom values, but known fields receive more
     * appropriate type handling for URLs, email addresses, booleans, integers,
     * code editors, JSON, HTML editors, relationship IDs, and nested builders.
     *
     * @param array $values   Raw submitted values keyed by field ID.
     * @param array $sections Registered section tree.
     * @return array
     */
    public static function sanitize_values( $values, $sections ) {
        $values = is_array( $values ) ? $values : array();
        $fields = self::collect_fields( $sections );
        $clean  = array();

        foreach ( $values as $key => $value ) {
            $field_id = sanitize_key( $key );
            $field    = isset( $fields[ $field_id ] ) ? $fields[ $field_id ] : array();

            $clean[ $field_id ] = $field ? self::sanitize_field_value( $value, $field ) : self::sanitize( $value );
        }

        /**
         * Filter sanitized Kavro values before they are persisted.
         *
         * @param array $clean    Sanitized values.
         * @param array $values   Raw values.
         * @param array $sections Registered section tree.
         */
        return apply_filters( 'kavro/sanitize_values', $clean, $values, $sections );
    }

    /**
     * Collect every field definition from a nested section tree.
     *
     * @param array $sections Section tree.
     * @return array<string,array>
     */
    public static function collect_fields( $sections ) {
        $fields = array();

        foreach ( (array) $sections as $section ) {
            if ( ! empty( $section['fields'] ) && is_array( $section['fields'] ) ) {
                foreach ( $section['fields'] as $field ) {
                    if ( ! empty( $field['id'] ) ) {
                        $fields[ sanitize_key( $field['id'] ) ] = $field;
                    }
                }
            }

            if ( ! empty( $section['children'] ) && is_array( $section['children'] ) ) {
                $fields = array_merge( $fields, self::collect_fields( $section['children'] ) );
            }
        }

        return $fields;
    }

    /**
     * Sanitize one field value according to its declared type.
     *
     * @param mixed $value Raw field value.
     * @param array $field Field definition.
     * @return mixed
     */
    public static function sanitize_field_value( $value, $field ) {
        $type  = isset( $field['type'] ) ? sanitize_key( $field['type'] ) : 'text';
        $value = wp_unslash( $value );

        /** Developers can fully override sanitization for one field. */
        if ( ! empty( $field['sanitize_callback'] ) && is_callable( $field['sanitize_callback'] ) ) {
            return call_user_func( $field['sanitize_callback'], $value, $field );
        }

        switch ( $type ) {
            case 'checkbox':
            case 'switcher':
            case 'toggle':
            case 'consent':
                return empty( $value ) ? 0 : 1;

            case 'email':
                return sanitize_email( $value );

            case 'url':
            case 'oembed':
                return esc_url_raw( $value );

            case 'number':
            case 'spinner':
            case 'range':
            case 'slider':
            case 'progress':
            case 'rating':
                return is_numeric( $value ) ? 0 + $value : 0;

            case 'color':
            case 'color_picker_alpha':
                return self::sanitize_color( $value );

            case 'textarea':
                return is_scalar( $value ) ? sanitize_textarea_field( $value ) : self::sanitize( $value );

            case 'code':
            case 'code_editor_advanced':
            case 'css_editor':
            case 'js_editor':
            case 'json':
            case 'custom':
                return is_scalar( $value ) ? (string) $value : wp_json_encode( self::sanitize( $value ) );

            case 'wysiwyg':
            case 'wp_editor':
            case 'html':
            case 'content':
            case 'email_template':
                return is_scalar( $value ) ? wp_kses_post( (string) $value ) : self::sanitize( $value );

            case 'password':
                return is_scalar( $value ) ? (string) $value : '';

            case 'post_select':
            case 'post_radio':
            case 'page_select':
            case 'user_select':
            case 'menu_select':
            case 'sidebar_select':
            case 'template_select':
                return is_array( $value ) ? array_map( 'absint', $value ) : absint( $value );

            case 'post_checkbox':
            case 'post_relation':
            case 'post_autocomplete':
            case 'taxonomy_checkbox':
            case 'term_relation':
                return array_values( array_filter( array_map( 'absint', (array) $value ) ) );

            case 'taxonomy_select':
            case 'taxonomy_radio':
            case 'role_select':
            case 'capability_select':
                if ( is_array( $value ) ) {
                    return array_values( array_filter( array_map( 'sanitize_key', $value ) ) );
                }
                return is_scalar( $value ) ? sanitize_key( (string) $value ) : '';

            case 'shortcode_builder':
            case 'layout_builder':
            case 'menu_builder':
            case 'form_builder':
            case 'query_builder':
            case 'group':
            case 'repeater':
            case 'repeater_nested':
            case 'fieldset':
            case 'accordion':
            case 'tabbed':
            case 'cloneable':
            case 'dynamic_tags':
            case 'feature_flags':
            case 'api_credentials':
            case 'permission_matrix':
            case 'redirect_rules':
            case 'rest_endpoint':
            case 'rate_limit':
            case 'cache_control':
            case 'open_graph':
            case 'schema_markup':
            case 'webhook':
            case 'cron_schedule':
            case 'notification_channels':
            case 'address':
            case 'pricing_table':
            case 'badge_list':
            case 'kpi_cards':
            case 'notice_builder':
            case 'terms_checklist':
            case 'business_hours':
            case 'timeline':
            case 'table':
            case 'matrix':
            case 'checklist':
            case 'social_links':
            case 'link_group':
            case 'key_value':
            case 'text_list':
            case 'map':
            case 'background':
            case 'border':
            case 'box_shadow':
            case 'typography':
            case 'dimensions':
            case 'spacing':
            case 'responsive_value':
            case 'css_builder':
                return self::sanitize( $value );

            case 'select':
            case 'select2':
            case 'enhanced_select':
            case 'radio':
            case 'button_set':
            case 'environment_select':
                if ( is_array( $value ) ) {
                    return array_map( array( __CLASS__, 'sanitize' ), $value );
                }
                return is_scalar( $value ) ? sanitize_text_field( (string) $value ) : self::sanitize( $value );

            default:
                return self::sanitize( $value );
        }
    }

    /**
     * Sanitize hex, rgba, and css-variable color values.
     *
     * @param mixed $value Raw color value.
     * @return string
     */
    protected static function sanitize_color( $value ) {
        $value = is_scalar( $value ) ? trim( (string) $value ) : '';

        if ( preg_match( '/^#([a-fA-F0-9]{3}|[a-fA-F0-9]{6}|[a-fA-F0-9]{8})$/', $value ) ) {
            return $value;
        }

        if ( preg_match( '/^rgba?\([0-9.,%\s]+\)$/', $value ) ) {
            return $value;
        }

        if ( preg_match( '/^var\(--[a-zA-Z0-9_-]+\)$/', $value ) ) {
            return $value;
        }

        return '';
    }
}
