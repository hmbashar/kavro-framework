# Changelog Field

**Field type:** `changelog`  
**Renderer class:** `Changelog`  
**Aliases using the same renderer:** None

## Purpose

Changelog display field.

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
| `items` | array | List of item definitions used by checklist/timeline/changelog/terms fields. |

## Options Framework example

```php
KAVRO::createSection( $prefix, array(
    'title'  => 'Changelog Example',
    'fields' => array(
        array(
            'id' => 'demo_changelog',
            'type' => 'changelog',
            'title' => 'Changelog',
            'subtitle' => 'Changelog field example.',
            'desc' => 'This is a documented changelog field example.',
            'items' => array(
                array(
                    'version' => '1.0.0',
                    'changes' => array(
                        'Initial release',
                    ),
                ),
            ),
        ),
    ),
) );
```

## Metabox example

```php
KAVRO::createSection( $metabox_prefix, array(
    'title'  => 'Changelog Meta',
    'fields' => array(
        array(
            'id' => 'demo_changelog',
            'type' => 'changelog',
            'title' => 'Changelog',
            'subtitle' => 'Changelog field example.',
            'desc' => 'This is a documented changelog field example.',
            'items' => array(
                array(
                    'version' => '1.0.0',
                    'changes' => array(
                        'Initial release',
                    ),
                ),
            ),
        ),
    ),
) );
```

## Get saved value

### From Options Framework

```php
$value = kavro_get_option( $prefix, 'demo_changelog', null );
```

### From Metabox

```php
$value = kavro_get_post_meta( get_the_ID(), $metabox_prefix, 'demo_changelog', null );
```

## Notes

This field is commonly used for display/admin UX. Use it in options pages when possible; metabox usage is supported when the output makes sense for editors.
