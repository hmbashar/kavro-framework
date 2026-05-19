# Kavro Framework

Kavro Framework is a modern WordPress option framework for themes and plugins. It provides a clean developer API for creating admin option panels, nested section navigation, and reusable field types.

> Current development version: **1.0.0**. Keep this version until the framework API is stable.

## Plugin Details

- **Plugin Name:** Kavro Framework
- **Plugin URI:** https://github.com/hmbashar/kavro-framework
- **Author:** Md Abul Bashar
- **Author URI:** https://hmbashar.com
- **License:** GPLv2 or later
- **Text Domain:** `kavro-framework`

## Highlights

- Lightweight OOP architecture
- Composer-ready PSR-4 autoloading
- Codestar-style static API through `KAVRO::createOptions()` and `KAVRO::createSection()`
- Modern premium admin UI
- Click-to-expand nested section menu with smooth animation
- Multi-level section nesting through `children`
- Modular field classes
- WordPress media uploader support
- WordPress color picker support
- Repeater support

## Why there is no `parent` key

Kavro does **not** need a `parent` parameter for sections. Nested menus are created directly with the `children` array.

This is cleaner, easier to maintain, and avoids sync bugs where a child section points to a parent ID that does not exist.

```php
KAVRO::createSection( 'my_options', array(
    'id'       => 'general',
    'title'    => 'General',
    'fields'   => array(),
    'children' => array(
        array(
            'id'     => 'branding',
            'title'  => 'Branding',
            'fields' => array(),
            'children' => array(
                array(
                    'id'     => 'logo',
                    'title'  => 'Logo',
                    'fields' => array(),
                ),
            ),
        ),
    ),
) );
```

## Quick Start

```php
if ( class_exists( 'KAVRO' ) ) {
    $prefix = 'my_kavro_options';

    KAVRO::createOptions( $prefix, array(
        'menu_title' => 'Theme Options',
        'menu_slug'  => 'theme-options',
    ) );

    KAVRO::createSection( $prefix, array(
        'id'     => 'general',
        'title'  => 'General',
        'fields' => array(
            array(
                'id'      => 'site_title',
                'type'    => 'text',
                'title'   => 'Site Title',
                'default' => 'My Website',
            ),
        ),
    ) );
}
```

## Getting Option Values

```php
$value = kavro_get_option( 'my_kavro_options', 'site_title', 'Default value' );

$options = get_option( 'my_kavro_options' );
echo esc_html( $options['site_title'] ?? '' );
```

## Documentation

- [Field Documentation](docs/fields.md)
- [Developer Notes](docs/developer-notes.md)
- [Example Usage](examples/basic-usage.php)

## Composer / PSR-4

```json
{
  "autoload": {
    "psr-4": {
      "Kavro\\\\": "classes/",
      "Kavro\\\\Fields\\\\": "fields/"
    }
  }
}
```

Run:

```bash
composer dump-autoload
```

Kavro also includes a fallback autoloader so it can run without Composer during development.
