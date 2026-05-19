# Kavro Framework

**Kavro Framework** is a modern, lightweight, developer-first WordPress option framework for building polished admin panels, metaboxes, Customizer controls, taxonomy fields, user profile fields, nav menu item fields, widgets, comment fields, and shortcode generator interfaces.

Kavro is designed for theme and plugin developers who want a clean API, premium-looking UI, reusable field definitions, secure saving, and extensible Free/Pro architecture.

---

## Project Information

| Item | Details |
| --- | --- |
| Plugin Name | Kavro Framework |
| Version | 1.0.0 |
| Author | Md Abul Bashar |
| Author URI | https://hmbashar.com |
| Facebook | https://facebook.com/hmbashar |
| Plugin URI | https://github.com/hmbashar/kavro-framework |
| License | GPLv2 or later |
| Text Domain | `kavro-framework` |

---

## What Kavro Can Build

Kavro provides framework APIs for the most common WordPress developer interfaces:

- **Options Framework** — premium admin option panels with nested sections and AJAX saving.
- **Metabox Framework** — post, page, and custom post type fields.
- **Customizer Framework** — WordPress Customizer panels, sections, and fields.
- **Taxonomy Options** — category, tag, and custom taxonomy term fields.
- **Profile/User Options** — fields on user profile screens with role targeting.
- **Nav Menu Options** — custom fields for individual menu items.
- **Widget Options** — widget configuration fields.
- **Comment Options** — fields on comment edit screens.
- **Shortcode Framework** — shortcode registration and admin generator UI.
- **Free/Pro Architecture** — module registration and gating for commercial extensions.

---

## Core Features

- Clean Codestar-style static API.
- Nested admin sections using `children`.
- Modern premium admin UI.
- Secure AJAX save/reset for options.
- Normal WordPress form fallback.
- Import/export/reset tools.
- Field-aware sanitization.
- Custom sanitizer callback support.
- Conditional field logic.
- Cloneable fields.
- Select2/enhanced select support.
- AJAX select support.
- Media, gallery, file, audio, and video upload fields.
- Date/time picker support.
- Performance-aware asset loading.
- PSR-4 compatible Composer structure.
- Translation-ready text domain.
- WordPress.org-ready demo loading control.

---

## Installation

Upload the plugin folder to your WordPress installation:

```text
wp-content/plugins/kavro-framework/
```

Then activate **Kavro Framework** from:

```text
WordPress Admin → Plugins
```

For local development/testing, you may enable bundled examples by defining:

```php
define( 'KAVRO_LOAD_EXAMPLES', true );
```

Do **not** enable demo loading on production sites unless you intentionally want all demo screens and fields to appear.

---

## Basic Options Example

```php
if ( class_exists( 'KAVRO' ) ) {

    /**
     * Unique option prefix.
     * This is used as the option name in the WordPress options table.
     */
    $prefix = 'my_kavro_options';

    /**
     * Create the admin options panel.
     */
    KAVRO::createOptions( $prefix, array(
        'menu_title' => 'Theme Options',
        'menu_slug'  => 'theme-options',
    ) );

    /**
     * Create a basic section.
     */
    KAVRO::createSection( $prefix, array(
        'title'  => 'General Settings',
        'fields' => array(

            array(
                'id'      => 'site_subtitle',
                'type'    => 'text',
                'title'   => 'Site Subtitle',
                'desc'    => 'Add a short subtitle for your website.',
                'default' => 'Modern WordPress Framework',
            ),

            array(
                'id'      => 'enable_preloader',
                'type'    => 'switcher',
                'title'   => 'Enable Preloader',
                'default' => true,
            ),

        ),
    ) );
}
```

Get saved option values:

```php
$subtitle = kavro_get_option( 'my_kavro_options', 'site_subtitle', 'Default subtitle' );
```

---

## Nested Section Example

Kavro uses `children` for nested sections. You do not need a separate `parent` argument.

```php
KAVRO::createSection( $prefix, array(
    'title'    => 'Design',
    'icon'     => 'dashicons-admin-customizer',
    'children' => array(

        array(
            'title'  => 'Colors',
            'fields' => array(
                array(
                    'id'      => 'primary_color',
                    'type'    => 'color',
                    'title'   => 'Primary Color',
                    'default' => '#2563eb',
                ),
            ),
        ),

        array(
            'title'    => 'Typography',
            'children' => array(
                array(
                    'title'  => 'Body Font',
                    'fields' => array(
                        array(
                            'id'    => 'body_typography',
                            'type'  => 'typography',
                            'title' => 'Body Typography',
                        ),
                    ),
                ),
            ),
        ),

    ),
) );
```

---

## Supported Framework APIs

### Options Framework

```php
KAVRO::createOptions( $prefix, array(
    'menu_title' => 'Theme Options',
    'menu_slug'  => 'theme-options',
) );

KAVRO::createSection( $prefix, array(
    'title'  => 'General',
    'fields' => array(),
) );
```

Documentation: [`docs/options.md`](docs/options.md)

---

### Metabox Framework

```php
KAVRO::createMetabox( 'kavro_post_options', array(
    'title'     => 'Post Options',
    'post_type' => array( 'post', 'page' ),
) );

KAVRO::createSection( 'kavro_post_options', array(
    'title'  => 'Layout',
    'fields' => array(
        array(
            'id'    => 'custom_layout',
            'type'  => 'select',
            'title' => 'Custom Layout',
            'options' => array(
                'default' => 'Default',
                'full'    => 'Full Width',
            ),
        ),
    ),
) );
```

Documentation: [`docs/metabox.md`](docs/metabox.md)

---

### Customizer Framework

```php
KAVRO::createCustomizeOptions( 'kavro_customizer', array(
    'title' => 'Kavro Customizer',
) );

KAVRO::createSection( 'kavro_customizer', array(
    'title'  => 'Branding',
    'fields' => array(
        array(
            'id'    => 'brand_color',
            'type'  => 'color',
            'title' => 'Brand Color',
        ),
    ),
) );
```

Documentation: [`docs/customizer.md`](docs/customizer.md)

---

### Taxonomy Options

```php
KAVRO::createTaxonomyOptions( 'kavro_category_options', array(
    'taxonomy' => array( 'category', 'post_tag' ),
) );

KAVRO::createSection( 'kavro_category_options', array(
    'title'  => 'Term Design',
    'fields' => array(
        array(
            'id'    => 'term_color',
            'type'  => 'color',
            'title' => 'Term Color',
        ),
    ),
) );
```

Documentation: [`docs/taxonomy.md`](docs/taxonomy.md)

---

### Profile/User Options

```php
KAVRO::createProfileOptions( 'kavro_profile_options', array(
    'roles' => array( 'administrator', 'editor' ),
) );

KAVRO::createSection( 'kavro_profile_options', array(
    'title'  => 'Author Details',
    'fields' => array(
        array(
            'id'    => 'author_tagline',
            'type'  => 'text',
            'title' => 'Author Tagline',
        ),
    ),
) );
```

Documentation: [`docs/profile.md`](docs/profile.md)

---

### Nav Menu Options

```php
KAVRO::createNavMenuOptions( 'kavro_menu_options', array(
    'title' => 'Menu Item Options',
) );

KAVRO::createSection( 'kavro_menu_options', array(
    'fields' => array(
        array(
            'id'    => 'menu_badge',
            'type'  => 'text',
            'title' => 'Menu Badge',
        ),
    ),
) );
```

Documentation: [`docs/nav-menu.md`](docs/nav-menu.md)

---

### Widget Options

```php
KAVRO::createWidgetOptions( 'kavro_widget_options', array(
    'title' => 'Kavro Widget Options',
) );
```

Documentation: [`docs/widget.md`](docs/widget.md)

---

### Comment Options

```php
KAVRO::createCommentOptions( 'kavro_comment_options', array(
    'title' => 'Comment Options',
) );
```

Documentation: [`docs/comment.md`](docs/comment.md)

---

### Shortcode Framework

```php
KAVRO::createShortcode( 'kavro_button', array(
    'title'  => 'Kavro Button',
    'fields' => array(
        array(
            'id'    => 'label',
            'type'  => 'text',
            'title' => 'Button Label',
        ),
        array(
            'id'    => 'url',
            'type'  => 'url',
            'title' => 'Button URL',
        ),
    ),
) );
```

Documentation: [`docs/shortcode.md`](docs/shortcode.md)

---

## Field Documentation

The full field documentation is available in the `docs/fields/` directory.

Start here:

- [`docs/fields.md`](docs/fields.md)
- [`docs/fields/index.md`](docs/fields/index.md)
- [`docs/shared-field-attributes.md`](docs/shared-field-attributes.md)

Each dedicated field document includes:

- Purpose
- Value shape
- Common attributes
- Field-specific attributes
- Options example
- Metabox example
- Customizer example
- Taxonomy example
- Profile/User example
- Nav Menu example
- Widget example
- Comment example
- Shortcode example
- Saved value usage
- Developer notes

---

## Field Attribute Example

Most fields share a common array structure:

```php
array(
    'id'         => 'example_field',
    'type'       => 'text',
    'title'      => 'Example Field',
    'subtitle'   => 'Optional short helper text.',
    'desc'       => 'Longer description shown below the field.',
    'default'    => 'Default value',
    'dependency' => array( 'another_field', '==', 'enabled' ),
)
```

See [`docs/shared-field-attributes.md`](docs/shared-field-attributes.md) for the complete shared attribute reference.

---

## Important Field Features

### Conditional Logic

```php
array(
    'id'      => 'enable_banner',
    'type'    => 'switcher',
    'title'   => 'Enable Banner',
    'default' => false,
),

array(
    'id'         => 'banner_text',
    'type'       => 'text',
    'title'      => 'Banner Text',
    'dependency' => array( 'enable_banner', '==', true ),
),
```

Documentation: [`docs/validation.md`](docs/validation.md)

---

### Custom Sanitization

```php
array(
    'id'                => 'custom_value',
    'type'              => 'text',
    'title'             => 'Custom Value',
    'sanitize_callback' => function( $value, $field ) {
        return sanitize_text_field( $value );
    },
),
```

Documentation: [`docs/validation.md`](docs/validation.md)

---

### Cloneable Fields

```php
array(
    'id'        => 'social_profiles',
    'type'      => 'cloneable',
    'title'     => 'Social Profiles',
    'fields'    => array(
        array(
            'id'    => 'label',
            'type'  => 'text',
            'title' => 'Label',
        ),
        array(
            'id'    => 'url',
            'type'  => 'url',
            'title' => 'URL',
        ),
    ),
),
```

---

## Helper Functions

Kavro includes helper functions for retrieving saved values from different contexts.

```php
kavro_get_option( $option_name, $field_id, $default = null );
kavro_get_post_meta( $post_id, $field_id, $default = null );
kavro_get_term_meta( $term_id, $field_id, $default = null );
kavro_get_user_meta( $user_id, $field_id, $default = null );
kavro_get_comment_meta( $comment_id, $field_id, $default = null );
kavro_get_nav_menu_item_meta( $menu_item_id, $field_id, $default = null );
kavro_get_widget_option( $widget_id, $field_id, $default = null );
```

---

## Documentation Index

### Getting Started

- [`docs/README.md`](docs/README.md)
- [`docs/quick-start.md`](docs/quick-start.md)
- [`docs/shared-field-attributes.md`](docs/shared-field-attributes.md)

### Framework Modules

- [`docs/options.md`](docs/options.md)
- [`docs/metabox.md`](docs/metabox.md)
- [`docs/customizer.md`](docs/customizer.md)
- [`docs/taxonomy.md`](docs/taxonomy.md)
- [`docs/profile.md`](docs/profile.md)
- [`docs/nav-menu.md`](docs/nav-menu.md)
- [`docs/widget.md`](docs/widget.md)
- [`docs/comment.md`](docs/comment.md)
- [`docs/shortcode.md`](docs/shortcode.md)

### Fields

- [`docs/fields.md`](docs/fields.md)
- [`docs/fields/index.md`](docs/fields/index.md)

### Development, Security, and Release

- [`docs/security.md`](docs/security.md)
- [`docs/validation.md`](docs/validation.md)
- [`docs/performance.md`](docs/performance.md)
- [`docs/free-pro.md`](docs/free-pro.md)
- [`docs/release-separation.md`](docs/release-separation.md)
- [`docs/wordpress-org.md`](docs/wordpress-org.md)
- [`docs/release-packaging.md`](docs/release-packaging.md)
- [`docs/stability-qa.md`](docs/stability-qa.md)
- [`docs/qa-report.md`](docs/qa-report.md)

---

## Composer / PSR-4

Kavro includes Composer-compatible PSR-4 autoloading.

```json
{
    "autoload": {
        "psr-4": {
            "Kavro\\": "classes/"
        }
    }
}
```

Run:

```bash
composer dump-autoload
```

Kavro also includes its own internal loader so Composer is optional for normal plugin use.

---

## Asset Loading and Performance

Kavro detects field types and loads heavier assets only when needed.

Examples:

- Media scripts load for upload/media/gallery/image/file/audio/video fields.
- Color picker assets load for color-related fields.
- Sortable assets load for sortable/repeater/group/table-style fields.
- Select2/enhanced select assets load for enhanced content selectors.
- Date/time picker assets load for date, time, and datetime fields.

Documentation: [`docs/performance.md`](docs/performance.md)

---

## Security Notes

Kavro includes:

- Capability checks.
- Nonce verification.
- Field-aware sanitization.
- Safer import validation.
- AJAX save/reset protection.
- Direct file access protection.
- Escaped output patterns.

Documentation: [`docs/security.md`](docs/security.md)

---

## Free vs Pro Architecture

Kavro includes a module registry so premium modules or add-ons can extend the free plugin cleanly.

```php
KAVRO::registerModule( 'custom-module', array(
    'title' => 'Custom Module',
    'tier'  => 'pro',
    'class' => 'Vendor\\Plugin\\CustomModule',
) );
```

Useful helpers:

```php
kavro_is_pro();
kavro_edition();
kavro_get_modules();
```

Documentation: [`docs/free-pro.md`](docs/free-pro.md)

---

## WordPress.org Readiness

Examples are disabled by default. The plugin is structured for WordPress.org-friendly distribution and includes:

- `readme.txt`
- `uninstall.php`
- GPL-compatible licensing notes
- No required remote CDN assets
- Translation-ready text domain
- Release packaging documentation

Documentation:

- [`docs/wordpress-org.md`](docs/wordpress-org.md)
- [`docs/release-packaging.md`](docs/release-packaging.md)

---

## Development Examples

Bundled demo files live in the `examples/` directory and are only loaded when:

```php
define( 'KAVRO_LOAD_EXAMPLES', true );
```

Example files include:

- `examples/basic-usage.php`
- `examples/options-demo.php`
- `examples/metabox-demo.php`
- `examples/customizer-demo.php`
- `examples/taxonomy-demo.php`
- `examples/profile-demo.php`
- `examples/nav-menu-demo.php`
- `examples/widget-demo.php`
- `examples/comment-demo.php`
- `examples/shortcode-demo.php`
- `examples/field-examples.php`
- `examples/pro-extension-demo.php`

---

## Recommended Development Flow

1. Create your option/metabox/customizer/module prefix.
2. Register the framework module with `KAVRO::create...()`.
3. Add sections with `KAVRO::createSection()`.
4. Add fields using documented field attributes.
5. Retrieve saved values with Kavro helper functions.
6. Add custom sanitizers for special values.
7. Disable demo loading before production release.

---

## License

Kavro Framework is licensed under the GPLv2 or later.

---

## Copyright

Copyright © Md Abul Bashar  
Website: https://hmbashar.com  
Facebook: https://facebook.com/hmbashar
