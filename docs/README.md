# Kavro Framework Documentation

This folder contains the complete developer documentation for Kavro Framework.

## Main guides

- [Options Framework](options.md)
- [Metabox Framework](metabox.md)
- [Customizer Framework](customizer.md)
- [Taxonomy Options](taxonomy.md)
- [Profile/User Options](profile.md)
- [Nav Menu Options](nav-menu.md)
- [Widget Options](widget.md)
- [Comment Options](comment.md)
- [Shortcode Framework](shortcode.md)
- [Validation & Sanitization](validation.md)
- [Security](security.md)
- [Performance](performance.md)
- [Free vs Pro Architecture](free-pro.md)

## Field documentation

- [Field index](fields.md)
- [Shared field attributes](shared-field-attributes.md)
- [Dedicated field docs](fields/index.md)

Each supported field has its own Markdown file in `docs/fields/`.

## Supported field count

This documentation covers **144 public field type slugs**, including aliases such as `slider`, `wp_editor`, `enhanced_select`, `css_editor`, and `js_editor`.

## Field documentation coverage

Every dedicated field document in `docs/fields/` now includes examples for all Kavro contexts where a field may be used:

- Options Framework
- Metabox Framework
- Customizer Framework
- Taxonomy Options
- Profile/User Options
- Nav Menu Options
- Widget Options
- Comment Options
- Shortcode Framework

Some highly contextual fields may require additional production tuning depending on where they are used, but the documented examples show the expected configuration shape for each framework.
