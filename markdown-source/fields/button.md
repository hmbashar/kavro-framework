# Button Field

**Field type:** `button`  
**Renderer class:** `Button`  
**Aliases using the same renderer:** None

## Purpose

Action/link button display.

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
| `label` | string | Inline label or button text displayed beside/inside the control. |
| `url` | string | Destination URL for button/link-style fields. |

## Options Framework example

```php
KAVRO::createSection( $prefix, array(
    'title'  => 'Button Example',
    'fields' => array(
        array(
            'id' => 'demo_button',
            'type' => 'button',
            'title' => 'Button',
            'subtitle' => 'Button field example.',
            'desc' => 'This is a documented button field example.',
            'label' => 'Open Link',
            'url' => 'https://example.com',
        ),
    ),
) );
```

## Metabox example

```php
KAVRO::createSection( $metabox_prefix, array(
    'title'  => 'Button Meta',
    'fields' => array(
        array(
            'id' => 'demo_button',
            'type' => 'button',
            'title' => 'Button',
            'subtitle' => 'Button field example.',
            'desc' => 'This is a documented button field example.',
            'label' => 'Open Link',
            'url' => 'https://example.com',
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
    'title'  => 'Button Customizer',
    'fields' => array(
        array(
            'id'       => 'demo_button',
            'type'     => 'button',
            'title'    => 'Button',
            'subtitle' => 'Button field example.',
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
    'title'  => 'Button Term Field',
    'fields' => array(
        array(
            'id'       => 'demo_button',
            'type'     => 'button',
            'title'    => 'Button',
            'subtitle' => 'Button field example.',
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
    'title'  => 'Button User Field',
    'fields' => array(
        array(
            'id'       => 'demo_button',
            'type'     => 'button',
            'title'    => 'Button',
            'subtitle' => 'Button field example.',
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
    'title'  => 'Button Menu Item Field',
    'fields' => array(
        array(
            'id'       => 'demo_button',
            'type'     => 'button',
            'title'    => 'Button',
            'subtitle' => 'Button field example.',
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
    'title'  => 'Button Widget Field',
    'fields' => array(
        array(
            'id'       => 'demo_button',
            'type'     => 'button',
            'title'    => 'Button',
            'subtitle' => 'Button field example.',
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
    'title'  => 'Button Comment Field',
    'fields' => array(
        array(
            'id'       => 'demo_button',
            'type'     => 'button',
            'title'    => 'Button',
            'subtitle' => 'Button field example.',
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
            'id'       => 'demo_button',
            'type'     => 'button',
            'title'    => 'Button',
            'subtitle' => 'Button field example.',
            'desc'     => 'This example uses the same field configuration in this framework context.',
        ),
    ),
) );
```

## Get saved value

### From Options Framework

```php
$value = kavro_get_option( $prefix, 'demo_button', null );
```

### From Metabox

```php
$value = kavro_get_post_meta( get_the_ID(), $metabox_prefix, 'demo_button', null );
```


### From Customizer

```php
$value = get_theme_mod( 'demo_button', null );
```

### From Taxonomy Options

```php
$value = kavro_get_term_meta( $term_id, $taxonomy_prefix, 'demo_button', null );
```

### From Profile/User Options

```php
$value = kavro_get_user_meta( $user_id, $profile_prefix, 'demo_button', null );
```

### From Nav Menu Options

```php
$value = kavro_get_nav_menu_item_meta( $menu_item_id, $nav_menu_prefix, 'demo_button', null );
```

### From Widget Options

```php
$value = kavro_get_widget_option( $widget_id, $widget_prefix, 'demo_button', null );
```

### From Comment Options

```php
$value = kavro_get_comment_meta( $comment_id, $comment_prefix, 'demo_button', null );
```

### From Shortcode Framework

Shortcode field values are passed to the shortcode callback as attributes or normalized settings depending on your shortcode registration callback.

```php
$value = isset( $atts['demo_button'] ) ? $atts['demo_button'] : null;
```

## Notes

This field is commonly used for display/admin UX. Use it in options pages when possible; metabox usage is supported when the output makes sense for editors.
