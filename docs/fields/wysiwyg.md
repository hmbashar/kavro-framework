# Wysiwyg Field

**Field type:** `wysiwyg`  
**Renderer class:** `Wysiwyg`  
**Aliases using the same renderer:** `wp_editor`

## Purpose

WordPress editor field.

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

| Attribute | Type | Description |
|---|---:|---|
| `media_buttons` | mixed | Field-specific setting used by the `wysiwyg` renderer. |
| `rows` | array|int | Row definitions or row count, depending on field type. |

## Options Framework example

```php
KAVRO::createSection( $prefix, array(
    'title'  => 'Wysiwyg Example',
    'fields' => array(
        array(
            'id' => 'demo_wysiwyg',
            'type' => 'wysiwyg',
            'title' => 'Wysiwyg',
            'subtitle' => 'Wysiwyg field example.',
            'desc' => 'This is a documented wysiwyg field example.',
            'default' => 'Example value',
        ),
    ),
) );
```

## Metabox example

```php
KAVRO::createSection( $metabox_prefix, array(
    'title'  => 'Wysiwyg Meta',
    'fields' => array(
        array(
            'id' => 'demo_wysiwyg',
            'type' => 'wysiwyg',
            'title' => 'Wysiwyg',
            'subtitle' => 'Wysiwyg field example.',
            'desc' => 'This is a documented wysiwyg field example.',
            'default' => 'Example value',
        ),
    ),
) );
```

## Get saved value

### From Options Framework

```php
$value = kavro_get_option( $prefix, 'demo_wysiwyg', null );
```

### From Metabox

```php
$value = kavro_get_post_meta( get_the_ID(), $metabox_prefix, 'demo_wysiwyg', null );
```

## Notes

Use clear field IDs and defaults. Combine with `dependency` when the field should appear only after another setting is enabled.
