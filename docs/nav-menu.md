# Nav Menu Options

Fields on nav menu item edit panels.

## API

```php
KAVRO::createNavMenuOptions()
```

## Recommended usage

Create a dedicated file in your plugin or theme, for example `examples/nav-menu-demo.php`, then register fields using normal Kavro field arrays.

## Saving and sanitization

This module uses Kavro's shared field renderer and field-aware sanitization where applicable. Always use unique field IDs and avoid reusing the same option/meta key for unrelated data.
