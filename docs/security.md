# Security Hardening

Kavro uses the same security checklist across options, metaboxes, taxonomy fields, profiles, nav menu fields, widgets, comments, and shortcode tools.

## Save security

Every save endpoint should include:

- Capability check with `current_user_can()` through `Kavro\Security::can()`.
- Nonce verification with a container-specific action.
- Field-schema sanitization through `Kavro\Fields::sanitize_values()`.
- Escaped output when values are rendered back into the admin UI.

## AJAX options saving

The options panel uses AJAX for a no-reload save experience, but keeps the normal WordPress Settings API form as a fallback.

AJAX saves verify:

- Current user capability.
- Screen-specific nonce.
- Known field schema.
- Sanitized value payload before `update_option()`.

## Import security

JSON import checks:

- Capability.
- Nonce.
- JSON extension.
- Upload status.
- Maximum file size, filtered by `kavro/import_max_bytes`.
- Schema sanitization before saving.

## Custom sanitizers

Per-field sanitization can be overridden safely:

```php
array(
    'id'                => 'custom_value',
    'type'              => 'text',
    'title'             => 'Custom Value',
    'sanitize_callback' => function( $value, $field ) {
        return sanitize_text_field( $value );
    },
)
```
