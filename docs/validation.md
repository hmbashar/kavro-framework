# Validation and Sanitization

Kavro sanitizes saved values before they are written to WordPress options, post meta, term meta, user meta, comment meta, nav menu item meta, and widget instances.

## Automatic field-aware sanitization

Kavro now sanitizes values using the registered field schema instead of only using a generic recursive sanitizer.

Examples:

- `email` uses `sanitize_email()`.
- `url` and `oembed` use `esc_url_raw()`.
- `checkbox`, `switcher`, `toggle`, and `consent` save as `1` or `0`.
- `number`, `spinner`, `range`, `slider`, `progress`, and `rating` save numeric values.
- `color` and `color_picker_alpha` allow safe hex, rgba/rgb, and CSS variable color values.
- `wysiwyg`, `wp_editor`, `html`, `content`, and `email_template` allow safe post HTML.
- WordPress relationship fields sanitize IDs with `absint()`.
- Taxonomy, role, and capability values are sanitized with `sanitize_key()`.
- Complex array fields are recursively sanitized.

## Custom sanitizer per field

Every field can define a custom `sanitize_callback`.

```php
array(
    'id'                => 'custom_price',
    'type'              => 'text',
    'title'             => 'Custom Price',
    'sanitize_callback' => function ( $value, $field ) {
        return number_format( (float) $value, 2, '.', '' );
    },
)
```

The callback receives:

1. `$value` - the raw submitted value.
2. `$field` - the complete field configuration array.

## Global filter

Developers can filter all sanitized values before they are saved:

```php
add_filter( 'kavro/sanitize_values', function ( $clean, $raw, $sections ) {
    // Modify sanitized values here.
    return $clean;
}, 10, 3 );
```

## Current scope

This pass focuses on safe persistence and type-aware cleanup. The next validation pass can add UI-level validation messages such as required-field errors, min/max messages, and per-field admin notices.

## Array-safe sanitization patch

Kavro now checks whether a field value is scalar before passing it into WordPress string-only sanitizers such as `wp_kses_post()`, `sanitize_text_field()`, `sanitize_textarea_field()`, and `sanitize_key()`.

Complex field types such as builders, repeaters, groups, feature flags, API credentials, redirect rules, schema markup, responsive values, background, border, spacing, typography, and similar array-based fields are sanitized recursively instead of being treated as plain strings.

This prevents PHP fatal errors like:

```text
str_contains(): Argument #1 ($haystack) must be of type string, array given
```

Developers can still override field sanitization with:

```php
'sanitize_callback' => function( $value, $field ) {
    return $value;
},
```
