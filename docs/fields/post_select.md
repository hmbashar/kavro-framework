# Post Select Field

**Field type:** `post_select`  
**Renderer class:** `WPContent`  
**Aliases using the same renderer:** `cpt_select`, `page_select`, `post_autocomplete`, `post_checkbox`, `post_radio`, `post_relation`

## Purpose

Post selector dropdown.

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
| `order` | string | `ASC` or `DESC`. |
| `orderby` | string | Post query orderby value such as `date`, `title`, or `menu_order`. |
| `post_status` | string|array | Post status filter. Usually `publish`. |
| `post_type` | string|array | Post type or list of post types to query. |
| `variant` | string | Renderer variant, for example `select`, `checkbox`, `radio`, `autocomplete`, or `relation`. |

## Options Framework example

```php
KAVRO::createSection( $prefix, array(
    'title'  => 'Post Select Example',
    'fields' => array(
        array(
            'id' => 'demo_post_select',
            'type' => 'post_select',
            'title' => 'Post Select',
            'subtitle' => 'Post Select field example.',
            'desc' => 'This is a documented post_select field example.',
            'post_type' => 'post',
            'post_status' => 'publish',
            'limit' => 20,
            'default' => 'Example value',
        ),
    ),
) );
```

## Metabox example

```php
KAVRO::createSection( $metabox_prefix, array(
    'title'  => 'Post Select Meta',
    'fields' => array(
        array(
            'id' => 'demo_post_select',
            'type' => 'post_select',
            'title' => 'Post Select',
            'subtitle' => 'Post Select field example.',
            'desc' => 'This is a documented post_select field example.',
            'post_type' => 'post',
            'post_status' => 'publish',
            'limit' => 20,
            'default' => 'Example value',
        ),
    ),
) );
```

## Get saved value

### From Options Framework

```php
$value = kavro_get_option( $prefix, 'demo_post_select', null );
```

### From Metabox

```php
$value = kavro_get_post_meta( get_the_ID(), $metabox_prefix, 'demo_post_select', null );
```

## Notes

This field queries WordPress data. Keep `limit` reasonable on large sites and prefer AJAX/autocomplete variants for large datasets.
