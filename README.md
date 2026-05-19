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
