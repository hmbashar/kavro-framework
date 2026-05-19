# Kavro Customizer Framework

Kavro includes an initial WordPress Customizer layer through `KAVRO::createCustomizeOptions()`.

Customizer containers use the same section API as options and metaboxes:

```php
$prefix = 'my_theme_customizer';

KAVRO::createCustomizeOptions(
    $prefix,
    array(
        'title'       => 'Theme Customizer',
        'description' => 'Theme controls registered with Kavro.',
        'priority'    => 160,
    )
);

KAVRO::createSection(
    $prefix,
    array(
        'id'     => 'brand-settings',
        'title'  => 'Brand Settings',
        'fields' => array(
            array(
                'id'      => 'accent_color',
                'type'    => 'color',
                'title'   => 'Accent Color',
                'default' => '#635bff',
            ),
        ),
    )
);
```

## Storage

Customizer values are stored as a single WordPress option array using the Customizer container ID.

```php
$accent = kavro_get_option( 'my_theme_customizer', 'accent_color', '#635bff' );
```

## Supported Native Controls

The first Customizer layer uses native WordPress controls for performance and compatibility:

- `text`
- `textarea`
- `email`
- `url`
- `number`
- `range` / `slider`
- `checkbox`
- `switcher` / `toggle`
- `select`
- `select2` as a native select fallback
- `radio`
- `button_set` as a native radio fallback
- `color`
- `date`
- `time`
- code/editor fields as textarea fallback

Complex Kavro-only fields are currently rendered as textarea controls in the Customizer until richer custom controls are added.

## Nested Sections

WordPress Customizer does not support true nested sections by default. Kavro flattens nested `children` sections and prefixes child section titles with dashes.

