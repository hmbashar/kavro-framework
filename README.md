# Kavro Framework

Kavro Framework is a modern, lightweight WordPress framework for building premium admin interfaces and developer-facing option systems.

- **Author:** Md Abul Bashar
- **Website:** https://hmbashar.com
- **Facebook:** https://facebook.com/hmbashar
- **Plugin URI:** https://github.com/hmbashar/kavro-framework
- **Version:** 1.0.0
- **License:** GPLv2 or later
- **Text Domain:** `kavro-framework`

## Features

- Admin options framework
- Metabox framework
- Customizer framework
- Taxonomy options
- User/profile options
- Nav menu item options
- Widget options
- Comment options
- Shortcode framework
- Large premium-style field library
- Conditional logic
- Cloneable fields
- Import/export/reset tools
- Secure AJAX option save/reset
- Field-aware sanitization
- Performance-aware asset loading
- Free/Pro module architecture

## Production Example Loading

Examples are **disabled by default** in this WordPress.org-ready build.

To test the bundled demos locally, add this before Kavro loads, for example in `wp-config.php`:

```php
define( 'KAVRO_LOAD_EXAMPLES', true );
```

The example loader will then include:

```php
require_once KAVRO_PATH . 'examples/basic-usage.php';
```

Do not enable demos on production websites unless you intentionally want the demo option pages, metaboxes, taxonomy fields, profile fields, widget fields, comment fields, nav menu fields, and shortcode examples to appear.

## Documentation

- [Options Framework](docs/options.md)
- [Metabox Framework](docs/metabox.md)
- [Customizer Framework](docs/customizer.md)
- [Taxonomy Options](docs/taxonomy.md)
- [Profile/User Options](docs/profile.md)
- [Nav Menu Options](docs/nav-menu.md)
- [Widget Options](docs/widget.md)
- [Comment Options](docs/comment.md)
- [Shortcode Framework](docs/shortcode.md)
- [Fields Reference](docs/fields.md)
- [Validation & Sanitization](docs/validation.md)
- [Security](docs/security.md)
- [Performance](docs/performance.md)
- [Free vs Pro Architecture](docs/free-pro.md)
- [WordPress.org Readiness](docs/wordpress-org.md)
- [Release Packaging](docs/release-packaging.md)
- [Stability QA](docs/stability-qa.md)

## Basic Usage

```php
if ( class_exists( 'KAVRO' ) ) {

    $prefix = 'my_kavro_options';

    KAVRO::createOptions( $prefix, array(
        'menu_title' => 'Kavro Options',
        'menu_slug'  => 'kavro-options',
    ) );

    KAVRO::createSection( $prefix, array(
        'title'  => 'General',
        'fields' => array(
            array(
                'id'    => 'site_subtitle',
                'type'  => 'text',
                'title' => 'Site Subtitle',
            ),
        ),
    ) );
}
```

## Release Notes

See `readme.txt` for the WordPress.org formatted changelog, upgrade notice, requirements, tags, and installation instructions.

## Copyright

Copyright © Md Abul Bashar — https://hmbashar.com — https://facebook.com/hmbashar

Kavro Framework is licensed under GPLv2 or later.
