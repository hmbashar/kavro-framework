# Kavro Framework Documentation

Kavro Framework is a lightweight WordPress developer framework for building modern admin option panels, nested option navigation, and reusable field-based settings.

Current version: `0.1.2`.

> This is an early MVP foundation. Admin options are working. Customizer and metabox APIs are reserved in the public API and should be implemented in future development steps.

## Installation

1. Upload the `kavro-framework` folder to `wp-content/plugins/`.
2. Activate **Kavro Framework** from **Plugins** in WordPress admin.
3. Add your option configuration in a theme `functions.php` file or another plugin.

## Basic Usage

```php
if ( class_exists( 'KAVRO' ) ) {
    $prefix = 'my_kavro_options';

    KAVRO::createOptions( $prefix, array(
        'menu_title' => 'Theme Options',
        'menu_slug'  => 'theme-options',
        'menu_icon'  => 'dashicons-admin-customizer',
    ) );

    KAVRO::createSection( $prefix, array(
        'id'       => 'general',
        'title'    => 'General',
        'subtitle' => 'Basic settings.',
        'fields'   => array(
            array(
                'id'      => 'site_badge',
                'type'    => 'text',
                'title'   => 'Site Badge',
                'default' => 'Premium',
            ),
        ),
    ) );
}
```

## Getting Option Values

```php
$options = get_option( 'my_kavro_options' );

echo isset( $options['site_badge'] ) ? esc_html( $options['site_badge'] ) : '';
```

You can also use the helper:

```php
echo kavro_get_option( 'my_kavro_options', 'site_badge', 'Default value' );
```

## Nested Sections

Kavro supports nested navigation through the `children` key. The admin sidebar is rendered inside one WordPress admin page, which allows deeper levels than the native WordPress menu system.

```php
KAVRO::createSection( $prefix, array(
    'id'     => 'general',
    'title'  => 'General',
    'fields' => array(),
    'children' => array(
        array(
            'id'     => 'branding',
            'title'  => 'Branding',
            'fields' => array(),
            'children' => array(
                array(
                    'id'     => 'logo_settings',
                    'title'  => 'Logo Settings',
                    'fields' => array(),
                ),
            ),
        ),
    ),
) );
```

### Nesting Recommendation

Kavro can technically render deeper nested arrays, but for usability and performance, keep admin navigation to 3–4 levels. Very deep admin trees become hard for users to scan.

## Supported Fields in MVP

| Type | Description |
| --- | --- |
| `text` | Single-line text input |
| `textarea` | Multi-line text input |
| `checkbox` | Checkbox with hidden fallback value |
| `switcher` | Modern on/off toggle |
| `select` | Dropdown select |
| `color` | WordPress color picker |
| `number` | Number input |
| `content` | Static HTML/content block |

## Field Example

```php
array(
    'id'      => 'brand_color',
    'type'    => 'color',
    'title'   => 'Brand Color',
    'default' => '#4f46e5',
    'desc'    => 'Used as the primary theme color.',
)
```

## Composer / PSR-4

Kavro includes a `composer.json` file with PSR-4 autoloading:

```json
{
  "autoload": {
    "psr-4": {
      "Kavro\\": "src/"
    },
    "files": [
      "includes/functions.php"
    ]
  }
}
```

Run this inside the plugin folder if you want Composer-generated autoload files:

```bash
composer dump-autoload
```

If `vendor/autoload.php` does not exist, Kavro falls back to its built-in PSR-4 autoloader.

## Demo Configuration

See:

```text
examples/basic-usage.php
```

The demo includes multiple sections, many field types, and nested child menus up to 4 levels for testing expand/collapse behavior.

## Current Public API

```php
KAVRO::createOptions( $id, $args = array() );
KAVRO::createSection( $id, $section = array() );
KAVRO::createCustomizeOptions( $id, $args = array() ); // reserved
KAVRO::createMetabox( $id, $args = array() );          // reserved
```

## Recommended Next Development Steps

1. Add field dependency/conditional logic.
2. Add more field types: media, upload, icon, typography, spacing, border, radio, button set, repeater, group.
3. Build metabox framework.
4. Build Customizer framework.
5. Add import/export/backup feature.
6. Add sanitization callbacks per field type.
7. Add translations and a POT file.

## Plugin Metadata

- Plugin Name: Kavro Framework
- Author: Md Abul Bashar
- Author URI: https://hmbashar.com
- Plugin URI: https://github.com/hmbashar/kavro-framework
- License: GPLv2 or later
