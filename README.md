# Kavro Framework

Kavro Framework is a modern WordPress option framework for themes and plugins. It provides a clean developer API for creating admin option panels, nested section navigation, and reusable field types.

> Current development version: **1.0.0**. Keep this version until the framework API is stable.

## Plugin Details

- **Plugin Name:** Kavro Framework
- **Plugin URI:** https://github.com/hmbashar/kavro-framework
- **Author:** Md Abul Bashar
- **Author URI:** https://hmbashar.com
- **License:** GPLv2 or later
- **Text Domain:** `kavro-framework`
- **Copyright:** © Md Abul Bashar — https://hmbashar.com — https://facebook.com/hmbashar

## Highlights

- Lightweight OOP architecture
- Composer-ready PSR-4 autoloading
- Codestar-style static API through `KAVRO::createOptions()` and `KAVRO::createSection()`
- Modern premium admin UI
- Click-to-expand nested section menu with smooth animation
- Multi-level section nesting through `children`
- Modular field classes
- WordPress media uploader support
- WordPress color picker support
- Repeater/group support
- Premium field UI for media, gallery, typography, sorter, accordion, tabbed, backup, import/export, and structured fields

## Why there is no `parent` key

Kavro does **not** need a `parent` parameter for sections. Nested menus are created directly with the `children` array.

This is cleaner, easier to maintain, and avoids sync bugs where a child section points to a parent ID that does not exist.

```php
KAVRO::createSection( 'my_options', array(
    'id'       => 'general',
    'title'    => 'General',
    'fields'   => array(),
    'children' => array(
        array(
            'id'     => 'branding',
            'title'  => 'Branding',
            'fields' => array(),
            'children' => array(
                array(
                    'id'     => 'logo',
                    'title'  => 'Logo',
                    'fields' => array(),
                ),
            ),
        ),
    ),
) );
```

## Quick Start

```php
if ( class_exists( 'KAVRO' ) ) {
    $prefix = 'my_kavro_options';

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

## Getting Option Values

```php
$value = kavro_get_option( 'my_kavro_options', 'site_title', 'Default value' );

$options = get_option( 'my_kavro_options' );
echo esc_html( $options['site_title'] ?? '' );
```

## Documentation

- [Field Documentation](docs/fields.md)
- [Developer Notes](docs/developer-notes.md)
- [Example Usage](examples/basic-usage.php)

## Composer / PSR-4

```json
{
  "autoload": {
    "psr-4": {
      "Kavro\\\\": "classes/",
      "Kavro\\\\Fields\\\\": "fields/"
    }
  }
}
```

Run:

```bash
composer dump-autoload
```

Kavro also includes a fallback autoloader so it can run without Composer during development.


## Field Documentation

Field usage examples and supported field types are documented in:

- [`docs/fields.md`](docs/fields.md)
- [`docs/developer-notes.md`](docs/developer-notes.md)

## Current Built-in Fields

`text`, `textarea`, `checkbox`, `switcher`, `toggle`, `select`, `radio`, `button_set`, `color`, `color_group`, `number`, `spinner`, `date`, `time`, `email`, `url`, `password`, `range`, `slider`, `code`, `hidden`, `media`, `upload`, `image`, `gallery`, `dimensions`, `spacing`, `typography`, `repeater`, `group`, `fieldset`, `multicheck`, `wysiwyg`, `wp_editor`, `link`, `icon`, `palette`, `background`, `border`, `sortable`, `sorter`, `accordion`, `tabbed`, `backup`, `notice`, `heading`, `subheading`, `divider`, and `content`.

## Developer Notes

All core PHP, JavaScript, and CSS files include professional inline comments/docblocks. The public API remains intentionally small:

```php
KAVRO::createOptions( $prefix, $args );
KAVRO::createSection( $prefix, $section );
kavro_get_option( $prefix, $key, $default );
```


## Saving & Premium UI QA

Kavro saves option values through the native WordPress Settings API using `register_setting()` and `options.php`. Most fields post into one option array, for example `my_kavro_options[site_badge]`. Boolean fields include hidden fallback inputs so turning a switch off is saved correctly.

The admin interface includes a premium refinement CSS layer that intentionally overrides WordPress default admin button/input styles inside `.kavro-field-control`, so media buttons, upload buttons, backup buttons, and compound fields keep a consistent Kavro look.

## Field Documentation

See [`docs/fields.md`](docs/fields.md) for field examples and supported field types.


## Import / Export

Kavro includes secure settings import/export tools inside each options dashboard. Export downloads the current option array as JSON. Import accepts either a `.json` file or pasted JSON and replaces the current saved values after nonce and capability checks.

## Demo Coverage

The demo file at [`examples/basic-usage.php`](examples/basic-usage.php) includes at least one example for every built-in field registered in `classes/Fields.php`.

## Copyright

Copyright © Md Abul Bashar. Website: https://hmbashar.com. Facebook: https://facebook.com/hmbashar.


## Preserve Active Section

Kavro keeps the current nested section hash during save, so users return to the same panel after WordPress reloads the settings page.

## Latest Field Expansion

This build adds more premium field controls: `unit`, `gradient`, `box_shadow`, `link_group`, `social_links`, `rating`, `progress`, `map`, `text_list`, `embed`, and `json`.

See the full field reference in [`docs/fields.md`](docs/fields.md) and working examples in [`examples/basic-usage.php`](examples/basic-usage.php).


## WP Content Fields

The demo includes post, page, CPT, taxonomy, term, user, role, menu, sidebar, and template selectors. See `docs/fields.md` and `examples/basic-usage.php`.


### Custom and Select2 Fields

- `custom` — render developer-defined field markup using `html`, a PHP `callback`, or the `kavro_custom_field_{field_id}` action.
- `select2` / `enhanced_select` — premium searchable select field. Supports `options`, `placeholder`, and `multiple`.
- Any normal `select` can use the enhanced UI by adding `'select2' => true`.

Example:

```php
array(
  'id'       => 'modules',
  'type'     => 'select2',
  'title'    => 'Modules',
  'multiple' => true,
  'options'  => array(
    'admin'   => 'Admin Options',
    'metabox' => 'Metabox',
  ),
)
```

### Newly Added Advanced Fields

Kavro now includes advanced field support for conditional dependencies, cloneable rows, AJAX-ready selects, responsive values, CSS/device builders, Google font selection, advanced code editors, media uploads, and dynamic tags.

See [`docs/fields.md`](docs/fields.md) for usage examples and configuration notes.


## Next Advanced Fields

This build includes additional builder-style fields: `border_radius`, `box_model`, `dimensions_advanced`, `spacing_advanced`, `typography_advanced`, `color_picker_alpha`, `conditional_group`, `repeater_nested`, `query_builder`, `shortcode_builder`, `form_builder`, `menu_builder`, and `layout_builder`. The plugin currently loads `examples/basic-usage.php` from the main file for easy testing. Remove that require before production distribution.


## Added in this build

- Reset button in the top action bar and footer.
- Reset is nonce-protected and returns to the same active Kavro section.
- New fields: `table`, `matrix`, `checklist`, `business_hours`, `timeline`, `seo_preview`, `open_graph`, `schema_markup`, `webhook`, `cron_schedule`, `capability_select`.
- Each new field has at least one example in `examples/basic-usage.php`.


### Latest additions

Kavro now includes an **Operations Pro Fields** demo section with API credentials, license key, environment selector, feature flags, permission matrix, redirect rules, email templates, REST endpoint, rate limit, cache control, log viewer, changelog, system info, health check, and onboarding steps.

See [`docs/fields.md`](docs/fields.md) for field documentation and `examples/basic-usage.php` for working examples.
