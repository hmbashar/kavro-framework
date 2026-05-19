# Taxonomy Select Field

**Field type:** `taxonomy_select`  
**Renderer class:** `WPTaxonomy`  
**Aliases using the same renderer:** `taxonomy_checkbox`, `taxonomy_radio`, `term_relation`

## Purpose

Taxonomy or term selector dropdown.

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
| `hide_empty` | bool | Whether to hide empty taxonomy terms. |
| `mode` | string | Field mode/source selection, for example `taxonomies`. |
| `multiple` | bool | Allow selecting more than one value. Saved value becomes an array. |
| `taxonomy` | string|array | Taxonomy slug or list of taxonomy slugs. |
| `variant` | string | Renderer variant, for example `select`, `checkbox`, `radio`, `autocomplete`, or `relation`. |

## Options Framework example

```php
KAVRO::createSection( $prefix, array(
    'title'  => 'Taxonomy Select Example',
    'fields' => array(
        array(
            'id' => 'demo_taxonomy_select',
            'type' => 'taxonomy_select',
            'title' => 'Taxonomy Select',
            'subtitle' => 'Taxonomy Select field example.',
            'desc' => 'This is a documented taxonomy_select field example.',
            'taxonomy' => 'category',
            'hide_empty' => false,
            'default' => 'Example value',
        ),
    ),
) );
```

## Metabox example

```php
KAVRO::createSection( $metabox_prefix, array(
    'title'  => 'Taxonomy Select Meta',
    'fields' => array(
        array(
            'id' => 'demo_taxonomy_select',
            'type' => 'taxonomy_select',
            'title' => 'Taxonomy Select',
            'subtitle' => 'Taxonomy Select field example.',
            'desc' => 'This is a documented taxonomy_select field example.',
            'taxonomy' => 'category',
            'hide_empty' => false,
            'default' => 'Example value',
        ),
    ),
) );
```

## Get saved value

### From Options Framework

```php
$value = kavro_get_option( $prefix, 'demo_taxonomy_select', null );
```

### From Metabox

```php
$value = kavro_get_post_meta( get_the_ID(), $metabox_prefix, 'demo_taxonomy_select', null );
```

## Notes

This field queries WordPress data. Keep `limit` reasonable on large sites and prefer AJAX/autocomplete variants for large datasets.
