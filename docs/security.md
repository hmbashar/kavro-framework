# Security

Kavro save actions should always use capability checks, nonces, and field-aware sanitization.

## Recommended checks

- Verify nonces for AJAX and form requests.
- Check capabilities with `current_user_can()`.
- Escape output with `esc_html()`, `esc_attr()`, `esc_url()`, or `wp_kses_post()`.
- Sanitize all saved data.
- Prevent direct file access with `defined( 'ABSPATH' ) || exit;`.
