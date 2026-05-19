# Kavro Developer Notes

## Core Files

```text
kavro-framework.php        Main plugin bootstrap
composer.json              Composer metadata and PSR-4 mapping
includes/functions.php     Global helper functions
src/Core/Framework.php     Static registry and boot process
src/Core/AdminOptions.php  Admin option page renderer
src/Core/Fields.php        Field rendering and sanitization
assets/css/admin.css       Admin UI styling
assets/js/admin.js         Navigation and interaction behavior
examples/basic-usage.php   Full demo configuration
```

## Nested Menu Behavior

Native WordPress admin menus support top-level pages and one submenu level. Kavro avoids that limitation by rendering its own nested navigation inside the option page.

The JavaScript recalculates submenu heights from deepest child to parent. This prevents clipping when a parent contains many fields or when a deep child menu expands.

## Version 0.1.2 Changes

- Expanded demo file with many test sections and fields.
- Added 4-level nested demo menu.
- Improved nested menu expand/collapse height calculation.
- Made sidebar scrollable for long navigation lists.
- Added documentation folder.
