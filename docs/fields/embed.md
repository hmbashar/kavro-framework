# Embed Field

**Field type:** `embed`  
**Renderer class:** `Embed`  
**Aliases using the same renderer:** None

## Purpose

Embed URL/code field.

## Value shape

String unless the field options enable multiple/nested values.

## Supported attributes

### Common attributes

| Attribute | Type | Description |
|---|---:|---|
| `id` | string | Required for data-saving fields. Unique key inside the option/meta array. Required for saving. |
| `type` | string | Required. Field type slug, for example `text`, `select`, or `repeater`. |
| `title` | string | Main field label displayed in the left column. |
| `subtitle` | string | Small helper text below the field title. |
| `desc` | string/html | Description displayed below the control. Limited HTML is allowed. |
| `default` | mixed | Default value used when there is no saved value yet. |
| `placeholder` | string | Placeholder text for input/select-like fields when supported. |
| `dependency` | array | Conditional visibility rules. Example: `[ "field" => "enable", "operator" => "==", "value" => 1 ]`. |
| `sanitize_callback` | callable | Custom sanitizer callback. Receives `$value` and `$field`. |

### Field-specific attributes

This field does not require special attributes beyond the common field attributes.

## Options Framework example

```php
KAVRO::createSection( $prefix, array(
    'title'  => 'Embed Example',
    'fields' => array(
        array(
            'id' => 'demo_embed',
            'type' => 'embed',
            'title' => 'Embed',
            'subtitle' => 'Embed field example.',
            'desc' => 'This is a documented embed field example.',
            'default' => 'https://example.com',
        ),
    ),
) );
```

## Metabox example

```php
KAVRO::createSection( $metabox_prefix, array(
    'title'  => 'Embed Meta',
    'fields' => array(
        array(
            'id' => 'demo_embed',
            'type' => 'embed',
            'title' => 'Embed',
            'subtitle' => 'Embed field example.',
            'desc' => 'This is a documented embed field example.',
            'default' => 'https://example.com',
        ),
    ),
) );
```

## Get saved value

### From Options Framework

```php
$value = kavro_get_option( $prefix, 'demo_embed', null );
```

### From Metabox

```php
$value = kavro_get_post_meta( get_the_ID(), $metabox_prefix, 'demo_embed', null );
```

## Notes

Use clear field IDs and defaults. Combine with `dependency` when the field should appear only after another setting is enabled.
