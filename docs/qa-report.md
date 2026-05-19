# Kavro Stability QA Report

This report documents the automated checks performed during the security hardening and stability pass for the current build.

## Automated checks completed

- PHP syntax check completed for every `.php` file in the plugin.
- Confirmed the main plugin bootstrap has no syntax errors.
- Confirmed all class files have no syntax errors.
- Confirmed all example/demo files have no syntax errors.
- Confirmed all field class files have no syntax errors.

## Manual WordPress checks still recommended

Run these inside a WordPress admin environment with `WP_DEBUG` enabled:

1. Activate Kavro Framework.
2. Open the Kavro options panel.
3. Save settings with AJAX enabled.
4. Disable JavaScript and confirm the normal Settings API fallback saves.
5. Test Reset, Export, and Import.
6. Edit a post and save the metabox demo.
7. Edit a category/tag and save taxonomy fields.
8. Edit a user profile and save profile fields.
9. Edit a nav menu item and save menu item fields.
10. Add/edit a Kavro widget.
11. Edit a comment and save comment fields.
12. Open Customizer and confirm Customizer fields save.
13. Open Tools → Kavro shortcode generator and confirm shortcodes render.

## Regression areas to watch

- Complex array fields should not throw `Array to string conversion` warnings.
- Import should reject invalid files and invalid JSON gracefully.
- Pro-tier modules should not initialize when disabled for a free build.
- Heavy assets should load only on Kavro-related admin screens.
