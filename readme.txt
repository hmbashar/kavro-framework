=== Kavro Framework ===
Contributors: hmbashar
Tags: options framework, metabox, customizer, fields, settings, developer framework
Requires at least: 5.8
Tested up to: 6.7
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A modern, lightweight WordPress framework for admin options, metaboxes, Customizer panels, taxonomy options, profile fields, widgets, comments, nav menu fields, and shortcode UIs.

== Description ==

Kavro Framework is a developer-focused WordPress option framework created by Md Abul Bashar. It helps theme and plugin developers build clean admin interfaces using declarative PHP arrays.

The framework includes admin options, metaboxes, Customizer options, taxonomy options, user/profile fields, nav menu item options, widget options, comment options, shortcode tools, conditional logic, cloneable fields, AJAX saving, import/export, reset tools, field-aware sanitization, and performance-aware asset loading.

Examples are bundled for developers but disabled by default in production. To enable the local demos for testing, define `KAVRO_LOAD_EXAMPLES` as `true` before the plugin loads.

= Framework Modules =

* Admin Options Framework
* Metabox Framework
* Customizer Framework
* Taxonomy Options
* Profile/User Options
* Nav Menu Options
* Widget Options
* Comment Options
* Shortcode Framework
* Free/Pro module architecture

= Developer Notes =

Kavro uses the text domain `kavro-framework`, follows GPLv2-or-later licensing, and does not load remote/CDN assets in the production build.

== Installation ==

1. Upload the `kavro-framework` folder to `/wp-content/plugins/` or install the plugin ZIP from the WordPress admin.
2. Activate **Kavro Framework** from the Plugins screen.
3. Add your Kavro configuration from your theme or plugin.
4. For local demo testing only, define `KAVRO_LOAD_EXAMPLES` as `true` before the plugin loads.

== Frequently Asked Questions ==

= Are the demo pages enabled by default? =

No. Demos are disabled by default for production and WordPress.org readiness. Enable demos only on local/testing websites with `define( 'KAVRO_LOAD_EXAMPLES', true );`.

= Does Kavro remove user-created option data on uninstall? =

No. Kavro is a developer framework and does not delete arbitrary theme/plugin options by default. The included `uninstall.php` only removes known Kavro demo/internal data when safe to do so.

= Does Kavro load assets from a CDN? =

No. Production assets are bundled locally and loaded only when needed on Kavro-related admin screens.

= Can Kavro Pro or addons extend the free version? =

Yes. Kavro includes module registry hooks and tier-aware helpers so Pro/addon modules can extend the free framework cleanly.

== Screenshots ==

1. Modern options panel UI.
2. Nested sidebar sections.
3. Premium-style fields.
4. Metabox fields.
5. Customizer, taxonomy, profile, nav menu, widget, comment, and shortcode integrations.

== Changelog ==

= 1.0.0 =
* Initial WordPress.org-ready framework build.
* Added admin options, metabox, Customizer, taxonomy, profile, nav menu, widget, comment, and shortcode modules.
* Added AJAX save/reset with fallback support.
* Added field-aware sanitization and security helpers.
* Added performance-aware asset loading.
* Added Free/Pro architecture support.
* Examples are disabled by default and can be enabled with `KAVRO_LOAD_EXAMPLES`.

== Upgrade Notice ==

= 1.0.0 =
Initial stable framework release. Examples are disabled by default for production readiness.
