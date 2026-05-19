# Rating Field

**Field type:** `rating`  
**Renderer class:** `Rating`  
**Aliases using the same renderer:** None

## Purpose

Star rating field.

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

| Attribute | Type | Description |
|---|---:|---|
| `max` | int/number | Maximum value, or maximum rating stars for rating fields. |

## Options Framework example

```php
KAVRO::createSection( $prefix, array(
    'title'  => 'Rating Example',
    'fields' => array(
        array(
            'id' => 'demo_rating',
            'type' => 'rating',
            'title' => 'Rating',
            'subtitle' => 'Rating field example.',
            'desc' => 'This is a documented rating field example.',
            'max' => 5,
            'default' => 5,
        ),
    ),
) );
```

## Metabox example

```php
KAVRO::createSection( $metabox_prefix, array(
    'title'  => 'Rating Meta',
    'fields' => array(
        array(
            'id' => 'demo_rating',
            'type' => 'rating',
            'title' => 'Rating',
            'subtitle' => 'Rating field example.',
            'desc' => 'This is a documented rating field example.',
            'max' => 5,
            'default' => 5,
        ),
    ),
) );
```

## Get saved value

### From Options Framework

```php
$value = kavro_get_option( $prefix, 'demo_rating', null );
```

### From Metabox

```php
$value = kavro_get_post_meta( get_the_ID(), $metabox_prefix, 'demo_rating', null );
```

## Notes

Use clear field IDs and defaults. Combine with `dependency` when the field should appear only after another setting is enabled.
