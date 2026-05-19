# Permission Matrix Field

**Field type:** `permission_matrix`  
**Renderer class:** `PermissionMatrix`  
**Aliases using the same renderer:** None

## Purpose

Role/capability matrix.

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
| `capabilities` | array | Capability definitions used by permission matrix/capability fields. |
| `roles` | array | Role definitions used by permission matrix fields. |

## Options Framework example

```php
KAVRO::createSection( $prefix, array(
    'title'  => 'Permission Matrix Example',
    'fields' => array(
        array(
            'id' => 'demo_permission_matrix',
            'type' => 'permission_matrix',
            'title' => 'Permission Matrix',
            'subtitle' => 'Permission Matrix field example.',
            'desc' => 'This is a documented permission_matrix field example.',
            'roles' => array(
                'administrator',
                'editor',
            ),
            'capabilities' => array(
                'read',
                'edit_posts',
            ),
            'default' => 'Example value',
        ),
    ),
) );
```

## Metabox example

```php
KAVRO::createSection( $metabox_prefix, array(
    'title'  => 'Permission Matrix Meta',
    'fields' => array(
        array(
            'id' => 'demo_permission_matrix',
            'type' => 'permission_matrix',
            'title' => 'Permission Matrix',
            'subtitle' => 'Permission Matrix field example.',
            'desc' => 'This is a documented permission_matrix field example.',
            'roles' => array(
                'administrator',
                'editor',
            ),
            'capabilities' => array(
                'read',
                'edit_posts',
            ),
            'default' => 'Example value',
        ),
    ),
) );
```

## Get saved value

### From Options Framework

```php
$value = kavro_get_option( $prefix, 'demo_permission_matrix', null );
```

### From Metabox

```php
$value = kavro_get_post_meta( get_the_ID(), $metabox_prefix, 'demo_permission_matrix', null );
```

## Notes

This is a complex field. Treat the saved value as an array and inspect the returned structure before using it in frontend templates.
