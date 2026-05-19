# Fieldset Field

**Field type:** `fieldset`  
**Renderer class:** `Fieldset`  
**Aliases using the same renderer:** None

## Purpose

Inline grouped child fields.

## Value shape

Associative array or nested array, depending on sub-fields.

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
| `fields` | array | Nested child field definitions used by group/repeater/fieldset/cloneable fields. |

## Options Framework example

```php
KAVRO::createSection( $prefix, array(
    'title'  => 'Fieldset Example',
    'fields' => array(
        array(
            'id' => 'demo_fieldset',
            'type' => 'fieldset',
            'title' => 'Fieldset',
            'subtitle' => 'Fieldset field example.',
            'desc' => 'This is a documented fieldset field example.',
            'fields' => array(
                array(
                    'id' => 'item_title',
                    'type' => 'text',
                    'title' => 'Item Title',
                ),
                array(
                    'id' => 'item_enabled',
                    'type' => 'switcher',
                    'title' => 'Enabled',
                ),
            ),
            'default' => array(),
        ),
    ),
) );
```

## Metabox example

```php
KAVRO::createSection( $metabox_prefix, array(
    'title'  => 'Fieldset Meta',
    'fields' => array(
        array(
            'id' => 'demo_fieldset',
            'type' => 'fieldset',
            'title' => 'Fieldset',
            'subtitle' => 'Fieldset field example.',
            'desc' => 'This is a documented fieldset field example.',
            'fields' => array(
                array(
                    'id' => 'item_title',
                    'type' => 'text',
                    'title' => 'Item Title',
                ),
                array(
                    'id' => 'item_enabled',
                    'type' => 'switcher',
                    'title' => 'Enabled',
                ),
            ),
            'default' => array(),
        ),
    ),
) );
```

## Get saved value

### From Options Framework

```php
$value = kavro_get_option( $prefix, 'demo_fieldset', null );
```

### From Metabox

```php
$value = kavro_get_post_meta( get_the_ID(), $metabox_prefix, 'demo_fieldset', null );
```

## Notes

This is a complex field. Treat the saved value as an array and inspect the returned structure before using it in frontend templates.
