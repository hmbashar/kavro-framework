# Term Relation Field

**Field type:** `term_relation`  
**Renderer class:** `WPTaxonomy`  
**Aliases using the same renderer:** `taxonomy_checkbox`, `taxonomy_radio`, `taxonomy_select`

## Purpose

Multiple term relationship selector.

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
    'title'  => 'Term Relation Example',
    'fields' => array(
        array(
            'id' => 'demo_term_relation',
            'type' => 'term_relation',
            'title' => 'Term Relation',
            'subtitle' => 'Term Relation field example.',
            'desc' => 'This is a documented term_relation field example.',
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
    'title'  => 'Term Relation Meta',
    'fields' => array(
        array(
            'id' => 'demo_term_relation',
            'type' => 'term_relation',
            'title' => 'Term Relation',
            'subtitle' => 'Term Relation field example.',
            'desc' => 'This is a documented term_relation field example.',
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


## Customizer example

```php
$customize_prefix = 'kavro_customize_demo';

KAVRO::createCustomizeOptions( $customize_prefix, array(
    'title' => 'Kavro Customizer Demo',
) );

KAVRO::createSection( $customize_prefix, array(
    'title'  => 'Term Relation Customizer',
    'fields' => array(
        array(
            'id'       => 'demo_term_relation',
            'type'     => 'term_relation',
            'title'    => 'Term Relation',
            'subtitle' => 'Term Relation field example.',
            'desc'     => 'This example uses the same field configuration in this framework context.',
        ),
    ),
) );
```

## Taxonomy Options example

```php
$taxonomy_prefix = 'kavro_taxonomy_demo';

KAVRO::createTaxonomyOptions( $taxonomy_prefix, array(
    'taxonomy' => array( 'category', 'post_tag' ),
) );

KAVRO::createSection( $taxonomy_prefix, array(
    'title'  => 'Term Relation Term Field',
    'fields' => array(
        array(
            'id'       => 'demo_term_relation',
            'type'     => 'term_relation',
            'title'    => 'Term Relation',
            'subtitle' => 'Term Relation field example.',
            'desc'     => 'This example uses the same field configuration in this framework context.',
        ),
    ),
) );
```

## Profile/User Options example

```php
$profile_prefix = 'kavro_profile_demo';

KAVRO::createProfileOptions( $profile_prefix, array(
    'roles' => array( 'administrator', 'editor' ),
) );

KAVRO::createSection( $profile_prefix, array(
    'title'  => 'Term Relation User Field',
    'fields' => array(
        array(
            'id'       => 'demo_term_relation',
            'type'     => 'term_relation',
            'title'    => 'Term Relation',
            'subtitle' => 'Term Relation field example.',
            'desc'     => 'This example uses the same field configuration in this framework context.',
        ),
    ),
) );
```

## Nav Menu Options example

```php
$nav_menu_prefix = 'kavro_nav_menu_demo';

KAVRO::createNavMenuOptions( $nav_menu_prefix, array(
    'title' => 'Kavro Menu Item Options',
) );

KAVRO::createSection( $nav_menu_prefix, array(
    'title'  => 'Term Relation Menu Item Field',
    'fields' => array(
        array(
            'id'       => 'demo_term_relation',
            'type'     => 'term_relation',
            'title'    => 'Term Relation',
            'subtitle' => 'Term Relation field example.',
            'desc'     => 'This example uses the same field configuration in this framework context.',
        ),
    ),
) );
```

## Widget Options example

```php
$widget_prefix = 'kavro_widget_demo';

KAVRO::createWidgetOptions( $widget_prefix, array(
    'title' => 'Kavro Widget Options',
) );

KAVRO::createSection( $widget_prefix, array(
    'title'  => 'Term Relation Widget Field',
    'fields' => array(
        array(
            'id'       => 'demo_term_relation',
            'type'     => 'term_relation',
            'title'    => 'Term Relation',
            'subtitle' => 'Term Relation field example.',
            'desc'     => 'This example uses the same field configuration in this framework context.',
        ),
    ),
) );
```

## Comment Options example

```php
$comment_prefix = 'kavro_comment_demo';

KAVRO::createCommentOptions( $comment_prefix, array(
    'title' => 'Kavro Comment Options',
) );

KAVRO::createSection( $comment_prefix, array(
    'title'  => 'Term Relation Comment Field',
    'fields' => array(
        array(
            'id'       => 'demo_term_relation',
            'type'     => 'term_relation',
            'title'    => 'Term Relation',
            'subtitle' => 'Term Relation field example.',
            'desc'     => 'This example uses the same field configuration in this framework context.',
        ),
    ),
) );
```

## Shortcode Framework example

```php
KAVRO::createShortcode( 'kavro_demo_shortcode', array(
    'title'  => 'Kavro Demo Shortcode',
    'tag'    => 'kavro_demo',
    'fields' => array(
        array(
            'id'       => 'demo_term_relation',
            'type'     => 'term_relation',
            'title'    => 'Term Relation',
            'subtitle' => 'Term Relation field example.',
            'desc'     => 'This example uses the same field configuration in this framework context.',
        ),
    ),
) );
```

## Get saved value

### From Options Framework

```php
$value = kavro_get_option( $prefix, 'demo_term_relation', null );
```

### From Metabox

```php
$value = kavro_get_post_meta( get_the_ID(), $metabox_prefix, 'demo_term_relation', null );
```


### From Customizer

```php
$value = get_theme_mod( 'demo_term_relation', null );
```

### From Taxonomy Options

```php
$value = kavro_get_term_meta( $term_id, $taxonomy_prefix, 'demo_term_relation', null );
```

### From Profile/User Options

```php
$value = kavro_get_user_meta( $user_id, $profile_prefix, 'demo_term_relation', null );
```

### From Nav Menu Options

```php
$value = kavro_get_nav_menu_item_meta( $menu_item_id, $nav_menu_prefix, 'demo_term_relation', null );
```

### From Widget Options

```php
$value = kavro_get_widget_option( $widget_id, $widget_prefix, 'demo_term_relation', null );
```

### From Comment Options

```php
$value = kavro_get_comment_meta( $comment_id, $comment_prefix, 'demo_term_relation', null );
```

### From Shortcode Framework

Shortcode field values are passed to the shortcode callback as attributes or normalized settings depending on your shortcode registration callback.

```php
$value = isset( $atts['demo_term_relation'] ) ? $atts['demo_term_relation'] : null;
```

## Notes

This field queries WordPress data. Keep `limit` reasonable on large sites and prefer AJAX/autocomplete variants for large datasets.
