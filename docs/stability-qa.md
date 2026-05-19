# Stability QA Checklist

Use this checklist before releasing a Kavro build.

## Syntax and load checks

- Activate the plugin with `WP_DEBUG` enabled.
- Confirm there are no PHP notices on plugin activation.
- Confirm there is no WordPress 6.7+ early textdomain notice.
- Confirm the admin panel loads only on Kavro-related screens.

## Options framework

- Save each basic field type.
- Save each complex array field type.
- Save with AJAX enabled.
- Save with JavaScript disabled to test Settings API fallback.
- Reset settings.
- Export settings.
- Import valid JSON.
- Attempt invalid JSON and confirm a friendly error.

## Meta/context modules

Test each module independently:

- Metabox save/load on posts and pages.
- Taxonomy add/edit save/load.
- Profile save/load.
- Nav menu item save/load.
- Widget save/load.
- Comment edit save/load.
- Customizer preview/save.
- Shortcode generator and shortcode rendering.

## Regression focus

- Array fields should never trigger `Array to string conversion` warnings.
- WYSIWYG/HTML fields should save allowed HTML only.
- Upload/media fields should not enqueue media scripts outside Kavro screens.
- Select2/search fields should still work after dynamic cloning.
- Date/time fields should initialize after dependency or clone actions.
