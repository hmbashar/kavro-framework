# Matrix Field

**Field type:** `matrix`  
**Renderer class:** `Matrix`  
**Aliases using the same renderer:** None

## Purpose

Matrix/grid choice control.

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
| `columns` | array | Column definitions for table/matrix fields. |
| `rows` | array|int | Row definitions or row count, depending on field type. |

## Options Framework example

```php
KAVRO::createSection( $prefix, array(
    'title'  => 'Matrix Example',
    'fields' => array(
        array(
            'id' => 'demo_matrix',
            'type' => 'matrix',
            'title' => 'Matrix',
            'subtitle' => 'Matrix field example.',
            'desc' => 'This is a documented matrix field example.',
            'rows' => array(
                'Small',
                'Large',
            ),
            'columns' => array(
                'Enabled',
                'Featured',
            ),
            'default' => 'Example value',
        ),
    ),
) );
```

## Metabox example

```php
KAVRO::createSection( $metabox_prefix, array(
    'title'  => 'Matrix Meta',
    'fields' => array(
        array(
            'id' => 'demo_matrix',
            'type' => 'matrix',
            'title' => 'Matrix',
            'subtitle' => 'Matrix field example.',
            'desc' => 'This is a documented matrix field example.',
            'rows' => array(
                'Small',
                'Large',
            ),
            'columns' => array(
                'Enabled',
                'Featured',
            ),
            'default' => 'Example value',
        ),
    ),
) );
```

## Get saved value

### From Options Framework

```php
$value = kavro_get_option( $prefix, 'demo_matrix', null );
```

### From Metabox

```php
$value = kavro_get_post_meta( get_the_ID(), $metabox_prefix, 'demo_matrix', null );
```

## Notes

This is a complex field. Treat the saved value as an array and inspect the returned structure before using it in frontend templates.
