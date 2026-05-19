# Health Check Field

**Field type:** `health_check`  
**Renderer class:** `HealthCheck`  
**Aliases using the same renderer:** None

## Purpose

Health check status field.

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
| `checks` | array | Health check definitions. |

## Options Framework example

```php
KAVRO::createSection( $prefix, array(
    'title'  => 'Health Check Example',
    'fields' => array(
        array(
            'id' => 'demo_health_check',
            'type' => 'health_check',
            'title' => 'Health Check',
            'subtitle' => 'Health Check field example.',
            'desc' => 'This is a documented health_check field example.',
            'checks' => array(
                'cache' => 'Cache Writable',
                'php' => 'PHP Version',
            ),
        ),
    ),
) );
```

## Metabox example

```php
KAVRO::createSection( $metabox_prefix, array(
    'title'  => 'Health Check Meta',
    'fields' => array(
        array(
            'id' => 'demo_health_check',
            'type' => 'health_check',
            'title' => 'Health Check',
            'subtitle' => 'Health Check field example.',
            'desc' => 'This is a documented health_check field example.',
            'checks' => array(
                'cache' => 'Cache Writable',
                'php' => 'PHP Version',
            ),
        ),
    ),
) );
```

## Get saved value

### From Options Framework

```php
$value = kavro_get_option( $prefix, 'demo_health_check', null );
```

### From Metabox

```php
$value = kavro_get_post_meta( get_the_ID(), $metabox_prefix, 'demo_health_check', null );
```

## Notes

This field is commonly used for display/admin UX. Use it in options pages when possible; metabox usage is supported when the output makes sense for editors.
