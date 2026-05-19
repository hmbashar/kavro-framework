# Notice Field

**Field type:** `notice`  
**Renderer class:** `Notice`  
**Aliases using the same renderer:** None

## Purpose

Styled notice/callout field.

## Value shape

String unless the field options enable multiple/nested values.

## Supported attributes

### Common attributes

| Attribute | Type | Description |
|---|---:|---|
| `id` | string | Required for data-saving fields. Unique key inside the option/meta array. |
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
| `content` | string/html | Static content rendered by layout/information fields. |
| `style` | string | Notice style such as `info`, `success`, `warning`, or `danger`. |

## Options Framework example

```php
KAVRO::createSection( $prefix, array(
    'title'  => 'Notice Example',
    'fields' => array(
        array(
            'type' => 'notice',
            'title' => 'Notice',
            'subtitle' => 'Notice field example.',
            'desc' => 'This is a documented notice field example.',
            'content' => '<strong>Kavro documentation example.</strong>',
            'style' => 'info',
        ),
    ),
) );
```

## Metabox example

```php
KAVRO::createSection( $metabox_prefix, array(
    'title'  => 'Notice Meta',
    'fields' => array(
        array(
            'type' => 'notice',
            'title' => 'Notice',
            'subtitle' => 'Notice field example.',
            'desc' => 'This is a documented notice field example.',
            'content' => '<strong>Kavro documentation example.</strong>',
            'style' => 'info',
        ),
    ),
) );
```

## Saving behavior

This field is primarily structural/display-only and normally does not save a value because it does not require an `id`.


### From Customizer

```php
$value = get_theme_mod( 'demo_notice', null );
```

### From Taxonomy Options

```php
$value = kavro_get_term_meta( $term_id, $taxonomy_prefix, 'demo_notice', null );
```

### From Profile/User Options

```php
$value = kavro_get_user_meta( $user_id, $profile_prefix, 'demo_notice', null );
```

### From Nav Menu Options

```php
$value = kavro_get_nav_menu_item_meta( $menu_item_id, $nav_menu_prefix, 'demo_notice', null );
```

### From Widget Options

```php
$value = kavro_get_widget_option( $widget_id, $widget_prefix, 'demo_notice', null );
```

### From Comment Options

```php
$value = kavro_get_comment_meta( $comment_id, $comment_prefix, 'demo_notice', null );
```

### From Shortcode Framework

Shortcode field values are passed to the shortcode callback as attributes or normalized settings depending on your shortcode registration callback.

```php
$value = isset( $atts['demo_notice'] ) ? $atts['demo_notice'] : null;
```

## Notes

This field is commonly used for display/admin UX. Use it in options pages when possible; metabox usage is supported when the output makes sense for editors.
