# Kavro Framework

Kavro Framework is a modern WordPress option, field, metabox, customizer, taxonomy, profile, menu, widget, comment, and shortcode framework by **Md Abul Bashar**.

- **Author:** Md Abul Bashar
- **Website:** https://hmbashar.com
- **Facebook:** https://facebook.com/hmbashar
- **Plugin URI:** https://github.com/hmbashar/kavro-framework
- **Version:** 1.0.0
- **License:** GPLv2 or later

## Included Modules

- Admin options framework
- Metabox framework for posts, pages, and custom post types
- WordPress Customizer framework
- Taxonomy options framework
- User/profile options framework
- Nav menu item options framework
- Widget options framework
- Comment options framework
- Shortcode framework with generator UI
- Shared premium field renderer
- Import/export/reset controls
- Nested section navigation using `children`
- Composer PSR-4 autoload support

## Documentation

- [Options Framework](docs/options.md)
- [Metabox Framework](docs/metabox.md)
- [Customizer Framework](docs/customizer.md)
- [Taxonomy Options](docs/taxonomy.md)
- [Profile Options](docs/profile.md)
- [Nav Menu Options](docs/nav-menu.md)
- [Widget Options](docs/widget.md)
- [Comment Options](docs/comment.md)
- [Shortcode Framework](docs/shortcode.md)
- [Field Reference](docs/fields.md)
- [Developer Notes](docs/developer-notes.md)

## Demo Files

During development, the main plugin file loads:

```php
require_once KAVRO_PATH . 'examples/basic-usage.php';
```

The demo loader includes:

- `examples/field-examples.php`
- `examples/options-demo.php`
- `examples/metabox-demo.php`
- `examples/customizer-demo.php`
- `examples/taxonomy-demo.php`
- `examples/profile-demo.php`
- `examples/nav-menu-demo.php`
- `examples/widget-demo.php`
- `examples/comment-demo.php`
- `examples/shortcode-demo.php`

Remove or comment the demo loader before production release.

## Demo Loading Note

The development build loads `examples/basic-usage.php` on `init` priority 10. Kavro runtime screens are created later on `init` priority 20, so demos register before rendering while avoiding WordPress 6.7+ early translation notices.

## Copyright

Copyright © Md Abul Bashar — https://hmbashar.com — https://facebook.com/hmbashar

Licensed under GPLv2 or later.
