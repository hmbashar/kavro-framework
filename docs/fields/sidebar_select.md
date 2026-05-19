# Sidebar Select Field

**Field type:** `sidebar_select`  
**Renderer class:** `WPSystem`  
**Aliases using the same renderer:** `menu_select`, `role_select`, `template_select`, `user_select`

## Purpose

Registered sidebar selector.

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
| `limit` | int | Maximum items to load/show. |
| `multiple` | bool | Allow selecting more than one value. Saved value becomes an array. |
| `source` | string | WP data source such as `users`, `roles`, `menus`, `sidebars`, or `templates`. |

## Options Framework example

```php
KAVRO::createSection( $prefix, array(
    'title'  => 'Sidebar Select Example',
    'fields' => array(
        array(
            'id' => 'demo_sidebar_select',
            'type' => 'sidebar_select',
            'title' => 'Sidebar Select',
            'subtitle' => 'Sidebar Select field example.',
            'desc' => 'This is a documented sidebar_select field example.',
            'source' => 'sidebars',
            'default' => 'Example value',
        ),
    ),
) );
```

## Metabox example

```php
KAVRO::createSection( $metabox_prefix, array(
    'title'  => 'Sidebar Select Meta',
    'fields' => array(
        array(
            'id' => 'demo_sidebar_select',
            'type' => 'sidebar_select',
            'title' => 'Sidebar Select',
            'subtitle' => 'Sidebar Select field example.',
            'desc' => 'This is a documented sidebar_select field example.',
            'source' => 'sidebars',
            'default' => 'Example value',
        ),
    ),
) );
```

## Get saved value

### From Options Framework

```php
$value = kavro_get_option( $prefix, 'demo_sidebar_select', null );
```

### From Metabox

```php
$value = kavro_get_post_meta( get_the_ID(), $metabox_prefix, 'demo_sidebar_select', null );
```

## Notes

This field queries WordPress data. Keep `limit` reasonable on large sites and prefer AJAX/autocomplete variants for large datasets.
