# Gradient Field

**Field type:** `gradient`  
**Renderer class:** `Gradient`  
**Aliases using the same renderer:** None

## Purpose

Gradient builder.

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
    'title'  => 'Gradient Example',
    'fields' => array(
        array(
            'id' => 'demo_gradient',
            'type' => 'gradient',
            'title' => 'Gradient',
            'subtitle' => 'Gradient field example.',
            'desc' => 'This is a documented gradient field example.',
            'default' => array(
                'from' => '#6366f1',
                'to' => '#06b6d4',
                'direction' => '135deg',
            ),
        ),
    ),
) );
```

## Metabox example

```php
KAVRO::createSection( $metabox_prefix, array(
    'title'  => 'Gradient Meta',
    'fields' => array(
        array(
            'id' => 'demo_gradient',
            'type' => 'gradient',
            'title' => 'Gradient',
            'subtitle' => 'Gradient field example.',
            'desc' => 'This is a documented gradient field example.',
            'default' => array(
                'from' => '#6366f1',
                'to' => '#06b6d4',
                'direction' => '135deg',
            ),
        ),
    ),
) );
```

## Get saved value

### From Options Framework

```php
$value = kavro_get_option( $prefix, 'demo_gradient', null );
```

### From Metabox

```php
$value = kavro_get_post_meta( get_the_ID(), $metabox_prefix, 'demo_gradient', null );
```

## Notes

Use clear field IDs and defaults. Combine with `dependency` when the field should appear only after another setting is enabled.
