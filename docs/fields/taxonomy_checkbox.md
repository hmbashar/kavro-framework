# Taxonomy Checkbox Field

**Field type:** `taxonomy_checkbox`  
**Renderer class:** `WPTaxonomy`  
**Aliases using the same renderer:** `taxonomy_radio`, `taxonomy_select`, `term_relation`

## Purpose

Taxonomy term checkbox list.

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
| `hide_empty` | bool | Whether to hide empty taxonomy terms. |
| `mode` | string | Field mode/source selection, for example `taxonomies`. |
| `multiple` | bool | Allow selecting more than one value. Saved value becomes an array. |
| `taxonomy` | string|array | Taxonomy slug or list of taxonomy slugs. |
| `variant` | string | Renderer variant, for example `select`, `checkbox`, `radio`, `autocomplete`, or `relation`. |

## Options Framework example

```php
KAVRO::createSection( $prefix, array(
    'title'  => 'Taxonomy Checkbox Example',
    'fields' => array(
        array(
            'id' => 'demo_taxonomy_checkbox',
            'type' => 'taxonomy_checkbox',
            'title' => 'Taxonomy Checkbox',
            'subtitle' => 'Taxonomy Checkbox field example.',
            'desc' => 'This is a documented taxonomy_checkbox field example.',
            'taxonomy' => 'category',
            'hide_empty' => false,
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
    'title'  => 'Taxonomy Checkbox Meta',
    'fields' => array(
        array(
            'id' => 'demo_taxonomy_checkbox',
            'type' => 'taxonomy_checkbox',
            'title' => 'Taxonomy Checkbox',
            'subtitle' => 'Taxonomy Checkbox field example.',
            'desc' => 'This is a documented taxonomy_checkbox field example.',
            'taxonomy' => 'category',
            'hide_empty' => false,
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
$value = kavro_get_option( $prefix, 'demo_taxonomy_checkbox', null );
```

### From Metabox

```php
$value = kavro_get_post_meta( get_the_ID(), $metabox_prefix, 'demo_taxonomy_checkbox', null );
```

## Notes

This field queries WordPress data. Keep `limit` reasonable on large sites and prefer AJAX/autocomplete variants for large datasets.
