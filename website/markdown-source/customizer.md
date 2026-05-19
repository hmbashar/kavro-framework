# Customizer Framework

Customizer panels/sections and live theme settings.

## API

```php
KAVRO::createCustomizeOptions()
```

## Recommended usage

Create a dedicated file in your plugin or theme, for example `examples/customizer-demo.php`, then register fields using normal Kavro field arrays.

## Saving and sanitization

This module uses Kavro's shared field renderer and field-aware sanitization where applicable. Always use unique field IDs and avoid reusing the same option/meta key for unrelated data.
