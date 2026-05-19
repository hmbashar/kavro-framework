# Nav Menu Options

Kavro supports custom fields on WordPress menu items with `KAVRO::createNavMenuOptions()`.

## Basic Usage

```php
$prefix = 'my_menu_options';

KAVRO::createNavMenuOptions(
    $prefix,
    array(
        'title'      => 'Menu Item Options',
        'capability' => 'edit_theme_options',
    )
);

KAVRO::createSection(
    $prefix,
    array(
        'title'  => 'Visual Settings',
        'fields' => array(
            array(
                'id'    => 'badge',
                'type'  => 'text',
                'title' => 'Badge Text',
            ),
            array(
                'id'    => 'icon',
                'type'  => 'icon',
                'title' => 'Icon',
            ),
        ),
    )
);
```

## Retrieve Values

```php
$badge = kavro_get_nav_menu_item_meta( $menu_item_id, 'my_menu_options', 'badge' );
$all   = kavro_get_nav_menu_item_meta( $menu_item_id, 'my_menu_options' );
```

## Notes

- Values are stored as one post-meta array on each `nav_menu_item` post.
- Use practical/lightweight fields on menu screens, because a menu can contain many items.
- Heavy builder fields are better suited for theme options, metaboxes, or taxonomy/profile screens.
