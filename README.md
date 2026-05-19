# Kavro Framework

Kavro Framework is a modern WordPress options and metabox framework by **Md Abul Bashar**.

- Author: Md Abul Bashar
- Website: https://hmbashar.com
- Facebook: https://facebook.com/hmbashar
- Plugin URI: https://github.com/hmbashar/kavro-framework
- Version: 1.0.0

## Included modules

- Admin options framework
- Metabox framework for posts, pages, and custom post types
- Shared premium field renderer
- Import/export/reset controls
- Nested section navigation using `children`
- Composer PSR-4 autoload support

## Documentation

- [Options Framework](docs/options.md)
- [Metabox Framework](docs/metabox.md)
- [Field Reference](docs/fields.md)
- [Developer Notes](docs/developer-notes.md)

## Demo files

During development, the main plugin file loads:

```php
require_once KAVRO_PATH . 'examples/basic-usage.php';
```

The demo loader then includes:

- `examples/options-demo.php`
- `examples/metabox-demo.php`
- `examples/field-examples.php`

Remove or comment the demo loader before production release.

## Copyright

Copyright © Md Abul Bashar — https://hmbashar.com — https://facebook.com/hmbashar

Licensed under GPLv2 or later.


## Demo loading note

The development build loads `examples/basic-usage.php` on `init` priority 10. Kavro runtime screens are created later on `init` priority 20, so option and metabox demos are registered before rendering while avoiding WordPress 6.7+ early translation notices. Remove this demo loader before production release.

## Customizer Framework

Kavro now includes an initial Customizer API. See [`docs/customizer.md
- [Taxonomy Options](docs/taxonomy.md)`](docs/customizer.md
- [Taxonomy Options](docs/taxonomy.md)).

- [Profile Options](docs/profile.md)

## Profile Options

Use `KAVRO::createProfileOptions()` to add Kavro fields to WordPress user profile screens.

- [Nav Menu Options](docs/nav-menu.md)

- [Widget Options](docs/widget.md)

- [Comment Options](docs/comment.md)
