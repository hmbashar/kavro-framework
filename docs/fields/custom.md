# Custom Field

**Field type:** `custom`  
**Renderer class:** `Custom`  
**Aliases using the same renderer:** None

## Purpose

Developer-defined custom renderer field.

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
| `callback` | callable | Callback used to render custom output. Receives the field array and value. |
| `html` | string/html | Raw HTML markup rendered by the field. |

## Options Framework example

```php
KAVRO::createSection( $prefix, array(
    'title'  => 'Custom Example',
    'fields' => array(
        array(
            'id' => 'demo_custom',
            'type' => 'custom',
            'title' => 'Custom',
            'subtitle' => 'Custom field example.',
            'desc' => 'This is a documented custom field example.',
            'html' => '<div class="kavro-custom-preview">Custom HTML output.</div>',
            'default' => 'Example value',
        ),
    ),
) );
```

## Metabox example

```php
KAVRO::createSection( $metabox_prefix, array(
    'title'  => 'Custom Meta',
    'fields' => array(
        array(
            'id' => 'demo_custom',
            'type' => 'custom',
            'title' => 'Custom',
            'subtitle' => 'Custom field example.',
            'desc' => 'This is a documented custom field example.',
            'html' => '<div class="kavro-custom-preview">Custom HTML output.</div>',
            'default' => 'Example value',
        ),
    ),
) );
```

## Get saved value

### From Options Framework

```php
$value = kavro_get_option( $prefix, 'demo_custom', null );
```

### From Metabox

```php
$value = kavro_get_post_meta( get_the_ID(), $metabox_prefix, 'demo_custom', null );
```

## Notes

Use clear field IDs and defaults. Combine with `dependency` when the field should appear only after another setting is enabled.
