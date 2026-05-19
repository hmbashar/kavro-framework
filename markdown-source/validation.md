# Validation and Sanitization

Kavro sanitizes saved values by field type. Scalar fields use WordPress sanitizers such as `sanitize_text_field()`, `sanitize_email()`, and `esc_url_raw()`. Complex fields are sanitized recursively.

## Custom sanitizer

```php
array(
    'id'                => 'custom_code',
    'type'              => 'textarea',
    'title'             => 'Custom Code',
    'sanitize_callback' => function( $value, $field ) {
        return wp_kses_post( $value );
    },
)
```

## Global filter

```php
add_filter( 'kavro/sanitize_values', function( $clean, $raw, $sections ) {
    return $clean;
}, 10, 3 );
```
