# Slider Field

**Field type:** `slider`  
**Renderer class:** `Range`  
**Aliases using the same renderer:** `range`

## Purpose

Alias of range slider input.

## Value shape

Number or numeric string.

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
    'title'  => 'Slider Example',
    'fields' => array(
        array(
            'id' => 'demo_slider',
            'type' => 'slider',
            'title' => 'Slider',
            'subtitle' => 'Slider field example.',
            'desc' => 'This is a documented slider field example.',
            'min' => 0,
            'max' => 100,
            'step' => 1,
            'default' => 50,
        ),
    ),
) );
```

## Metabox example

```php
KAVRO::createSection( $metabox_prefix, array(
    'title'  => 'Slider Meta',
    'fields' => array(
        array(
            'id' => 'demo_slider',
            'type' => 'slider',
            'title' => 'Slider',
            'subtitle' => 'Slider field example.',
            'desc' => 'This is a documented slider field example.',
            'min' => 0,
            'max' => 100,
            'step' => 1,
            'default' => 50,
        ),
    ),
) );
```

## Get saved value

### From Options Framework

```php
$value = kavro_get_option( $prefix, 'demo_slider', null );
```

### From Metabox

```php
$value = kavro_get_post_meta( get_the_ID(), $metabox_prefix, 'demo_slider', null );
```

## Notes

Use clear field IDs and defaults. Combine with `dependency` when the field should appear only after another setting is enabled.
