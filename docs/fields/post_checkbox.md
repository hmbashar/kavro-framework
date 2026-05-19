# Post Checkbox Field

**Field type:** `post_checkbox`  
**Renderer class:** `WPContent`  
**Aliases using the same renderer:** `cpt_select`, `page_select`, `post_autocomplete`, `post_radio`, `post_relation`, `post_select`

## Purpose

Post checkbox list.

## Value shape

Array of selected values/IDs.

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
    'title'  => 'Post Checkbox Example',
    'fields' => array(
        array(
            'id' => 'demo_post_checkbox',
            'type' => 'post_checkbox',
            'title' => 'Post Checkbox',
            'subtitle' => 'Post Checkbox field example.',
            'desc' => 'This is a documented post_checkbox field example.',
            'post_type' => 'post',
            'post_status' => 'publish',
            'limit' => 20,
            'default' => array(
                'one',
                'two',
            ),
        ),
    ),
) );
```

## Metabox example

```php
KAVRO::createSection( $metabox_prefix, array(
    'title'  => 'Post Checkbox Meta',
    'fields' => array(
        array(
            'id' => 'demo_post_checkbox',
            'type' => 'post_checkbox',
            'title' => 'Post Checkbox',
            'subtitle' => 'Post Checkbox field example.',
            'desc' => 'This is a documented post_checkbox field example.',
            'post_type' => 'post',
            'post_status' => 'publish',
            'limit' => 20,
            'default' => array(
                'one',
                'two',
            ),
        ),
    ),
) );
```

## Get saved value

### From Options Framework

```php
$value = kavro_get_option( $prefix, 'demo_post_checkbox', null );
```

### From Metabox

```php
$value = kavro_get_post_meta( get_the_ID(), $metabox_prefix, 'demo_post_checkbox', null );
```

## Notes

This field queries WordPress data. Keep `limit` reasonable on large sites and prefer AJAX/autocomplete variants for large datasets.
