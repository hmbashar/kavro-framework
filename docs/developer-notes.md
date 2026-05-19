# Developer Notes

## Field Architecture

Fields are registered in `classes/Fields.php` and implemented as modular classes under `fields/`.

Each field class extends `Kavro\AbstractField` and implements `render()`.

Example:

```php
namespace Kavro\Fields\Text;

use Kavro\AbstractField;

class Text extends AbstractField {
    public function render() {
        // output field HTML
    }
}
```

## Adding a New Field

1. Create a folder under `fields/`, for example `fields/Icon/Icon.php`.
2. Create a class such as `Kavro\Fields\Icon\Icon`.
3. Extend `Kavro\AbstractField`.
4. Add the field type to the map in `classes/Fields.php`.
5. Add CSS/JS only if needed.

## Nested Menu Behavior

The sidebar uses custom nested panels instead of WordPress native submenu nesting. This avoids core admin-menu limitations and allows 3-4 levels or more. The JavaScript recalculates panel height from deepest open children upward to prevent clipping when many fields/sections exist.

## Current Limitations

- Repeater currently supports simple nested inputs only.
- Media stores the selected URL only.
- Code editor is a styled textarea, not WP CodeMirror yet.
- Customizer and metabox method stubs exist but are not fully implemented.
