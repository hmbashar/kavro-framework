# Palette Field

**Field type:** `palette`  
**Renderer class:** `Palette`  
**Aliases using the same renderer:** None

## Purpose

Color palette choice selector.

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
| `options` | array | Selectable options as `value => label`, or rich option arrays for visual fields. |

## Options Framework example

```php
KAVRO::createSection( $prefix, array(
    'title'  => 'Palette Example',
    'fields' => array(
        array(
            'id' => 'demo_palette',
            'type' => 'palette',
            'title' => 'Palette',
            'subtitle' => 'Palette field example.',
            'desc' => 'This is a documented palette field example.',
            'options' => array(
                'one' => 'One',
                'two' => 'Two',
                'three' => 'Three',
            ),
            'default' => 'one',
        ),
    ),
) );
```

## Metabox example

```php
KAVRO::createSection( $metabox_prefix, array(
    'title'  => 'Palette Meta',
    'fields' => array(
        array(
            'id' => 'demo_palette',
            'type' => 'palette',
            'title' => 'Palette',
            'subtitle' => 'Palette field example.',
            'desc' => 'This is a documented palette field example.',
            'options' => array(
                'one' => 'One',
                'two' => 'Two',
                'three' => 'Three',
            ),
            'default' => 'one',
        ),
    ),
) );
```

## Get saved value

### From Options Framework

```php
$value = kavro_get_option( $prefix, 'demo_palette', null );
```

### From Metabox

```php
$value = kavro_get_post_meta( get_the_ID(), $metabox_prefix, 'demo_palette', null );
```

## Notes

Use clear field IDs and defaults. Combine with `dependency` when the field should appear only after another setting is enabled.
