# Enhanced Select Field

**Field type:** `enhanced_select`  
**Renderer class:** `Select`  
**Aliases using the same renderer:** `select`, `select2`

## Purpose

Alias of Select2-style enhanced select.

## Value shape

String value, or array when `multiple => true`.

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
| `multiple` | bool | Allow selecting more than one value. Saved value becomes an array. |
| `options` | array | Selectable options as `value => label`, or rich option arrays for visual fields. |
| `placeholder` | string | Placeholder shown before a value is selected or entered. |
| `select2` | bool | Enable Select2-style searchable UI for this select field. |

## Options Framework example

```php
KAVRO::createSection( $prefix, array(
    'title'  => 'Enhanced Select Example',
    'fields' => array(
        array(
            'id' => 'demo_enhanced_select',
            'type' => 'enhanced_select',
            'title' => 'Enhanced Select',
            'subtitle' => 'Enhanced Select field example.',
            'desc' => 'This is a documented enhanced_select field example.',
            'options' => array(
                'one' => 'One',
                'two' => 'Two',
                'three' => 'Three',
            ),
            'multiple' => true,
            'placeholder' => 'Search or choose...',
            'default' => 'Example value',
        ),
    ),
) );
```

## Metabox example

```php
KAVRO::createSection( $metabox_prefix, array(
    'title'  => 'Enhanced Select Meta',
    'fields' => array(
        array(
            'id' => 'demo_enhanced_select',
            'type' => 'enhanced_select',
            'title' => 'Enhanced Select',
            'subtitle' => 'Enhanced Select field example.',
            'desc' => 'This is a documented enhanced_select field example.',
            'options' => array(
                'one' => 'One',
                'two' => 'Two',
                'three' => 'Three',
            ),
            'multiple' => true,
            'placeholder' => 'Search or choose...',
            'default' => 'Example value',
        ),
    ),
) );
```

## Get saved value

### From Options Framework

```php
$value = kavro_get_option( $prefix, 'demo_enhanced_select', null );
```

### From Metabox

```php
$value = kavro_get_post_meta( get_the_ID(), $metabox_prefix, 'demo_enhanced_select', null );
```

## Notes

Use clear field IDs and defaults. Combine with `dependency` when the field should appear only after another setting is enabled.
