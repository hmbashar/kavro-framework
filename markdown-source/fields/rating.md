# Rating Field

**Field type:** `rating`  
**Renderer class:** `Rating`  
**Aliases using the same renderer:** None

## Purpose

Star rating field.

## Value shape

Number or numeric string.

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
| `max` | int/number | Maximum value, or maximum rating stars for rating fields. |

## Options Framework example

```php
KAVRO::createSection( $prefix, array(
    'title'  => 'Rating Example',
    'fields' => array(
        array(
            'id' => 'demo_rating',
            'type' => 'rating',
            'title' => 'Rating',
            'subtitle' => 'Rating field example.',
            'desc' => 'This is a documented rating field example.',
            'max' => 5,
            'default' => 5,
        ),
    ),
) );
```

## Metabox example

```php
KAVRO::createSection( $metabox_prefix, array(
    'title'  => 'Rating Meta',
    'fields' => array(
        array(
            'id' => 'demo_rating',
            'type' => 'rating',
            'title' => 'Rating',
            'subtitle' => 'Rating field example.',
            'desc' => 'This is a documented rating field example.',
            'max' => 5,
            'default' => 5,
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
    'title'  => 'Rating Customizer',
    'fields' => array(
        array(
            'id'       => 'demo_rating',
            'type'     => 'rating',
            'title'    => 'Rating',
            'subtitle' => 'Rating field example.',
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
    'title'  => 'Rating Term Field',
    'fields' => array(
        array(
            'id'       => 'demo_rating',
            'type'     => 'rating',
            'title'    => 'Rating',
            'subtitle' => 'Rating field example.',
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
    'title'  => 'Rating User Field',
    'fields' => array(
        array(
            'id'       => 'demo_rating',
            'type'     => 'rating',
            'title'    => 'Rating',
            'subtitle' => 'Rating field example.',
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
    'title'  => 'Rating Menu Item Field',
    'fields' => array(
        array(
            'id'       => 'demo_rating',
            'type'     => 'rating',
            'title'    => 'Rating',
            'subtitle' => 'Rating field example.',
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
    'title'  => 'Rating Widget Field',
    'fields' => array(
        array(
            'id'       => 'demo_rating',
            'type'     => 'rating',
            'title'    => 'Rating',
            'subtitle' => 'Rating field example.',
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
    'title'  => 'Rating Comment Field',
    'fields' => array(
        array(
            'id'       => 'demo_rating',
            'type'     => 'rating',
            'title'    => 'Rating',
            'subtitle' => 'Rating field example.',
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
            'id'       => 'demo_rating',
            'type'     => 'rating',
            'title'    => 'Rating',
            'subtitle' => 'Rating field example.',
            'desc'     => 'This example uses the same field configuration in this framework context.',
        ),
    ),
) );
```

## Get saved value

### From Options Framework

```php
$value = kavro_get_option( $prefix, 'demo_rating', null );
```

### From Metabox

```php
$value = kavro_get_post_meta( get_the_ID(), $metabox_prefix, 'demo_rating', null );
```


### From Customizer

```php
$value = get_theme_mod( 'demo_rating', null );
```

### From Taxonomy Options

```php
$value = kavro_get_term_meta( $term_id, $taxonomy_prefix, 'demo_rating', null );
```

### From Profile/User Options

```php
$value = kavro_get_user_meta( $user_id, $profile_prefix, 'demo_rating', null );
```

### From Nav Menu Options

```php
$value = kavro_get_nav_menu_item_meta( $menu_item_id, $nav_menu_prefix, 'demo_rating', null );
```

### From Widget Options

```php
$value = kavro_get_widget_option( $widget_id, $widget_prefix, 'demo_rating', null );
```

### From Comment Options

```php
$value = kavro_get_comment_meta( $comment_id, $comment_prefix, 'demo_rating', null );
```

### From Shortcode Framework

Shortcode field values are passed to the shortcode callback as attributes or normalized settings depending on your shortcode registration callback.

```php
$value = isset( $atts['demo_rating'] ) ? $atts['demo_rating'] : null;
```

## Notes

Use clear field IDs and defaults. Combine with `dependency` when the field should appear only after another setting is enabled.
