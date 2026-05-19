# Kavro Framework

Kavro Framework is a lightweight WordPress options framework for themes and plugins. It is inspired by the developer workflow of Codestar Framework, but the internal structure is organized around PSR-4 autoloading and modular field classes.

## Folder Structure

```text
kavro-framework/
├── assets/
│   ├── css/admin.css
│   └── js/admin.js
├── classes/
│   ├── AbstractField.php
│   ├── AdminOptions.php
│   ├── Fields.php
│   └── Framework.php
├── fields/
│   ├── Text/Text.php
│   ├── Textarea/Textarea.php
│   ├── Media/Media.php
│   └── ...
├── includes/functions.php
├── examples/basic-usage.php
├── docs/
├── languages/
├── composer.json
└── kavro-framework.php
```

## Composer / PSR-4

```json
{
  "autoload": {
    "psr-4": {
      "Kavro\\": "classes/",
      "Kavro\\Fields\\": "fields/"
    }
  }
}
```

Run this when using Composer:

```bash
composer dump-autoload
```

Kavro also includes a fallback autoloader, so it works without Composer during development.

## Basic Usage

```php
if ( class_exists( 'KAVRO' ) ) {
    $prefix = 'my_options';

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

## Nested Sections

Kavro supports nested sections inside the option page sidebar. WordPress admin menus are limited, so Kavro renders deep navigation inside its own dashboard UI.

```php
KAVRO::createSection( $prefix, array(
    'id' => 'parent',
    'title' => 'Parent',
    'children' => array(
        array(
            'id' => 'child',
            'title' => 'Child',
            'children' => array(
                array(
                    'id' => 'grandchild',
                    'title' => 'Grandchild',
                ),
            ),
        ),
    ),
) );
```

## Supported Fields in v0.1.3

- text
- textarea
- checkbox
- switcher
- select
- radio
- button_set
- color
- number
- content
- heading
- notice
- date
- time
- email
- url
- password
- range / slider
- code
- hidden
- media
- upload
- image
- dimensions
- spacing
- typography
- repeater

## Getting Option Values

```php
$value = kavro_get_option( 'my_options', 'site_title', 'Default value' );
$all_options = kavro_get_option( 'my_options' );
```

## Notes

This is still an MVP foundation. The next recommended modules are metaboxes, taxonomy fields, profile fields, customizer integration, dependency conditions, validation callbacks, and import/export backup fields.
