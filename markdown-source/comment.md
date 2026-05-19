# Comment Options

Fields on comment edit screens.

## API

```php
KAVRO::createCommentOptions()
```

## Recommended usage

Create a dedicated file in your plugin or theme, for example `examples/comment-demo.php`, then register fields using normal Kavro field arrays.

## Saving and sanitization

This module uses Kavro's shared field renderer and field-aware sanitization where applicable. Always use unique field IDs and avoid reusing the same option/meta key for unrelated data.
