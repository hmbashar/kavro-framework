# Kavro Documentation

Start here:

- [Field Documentation](fields.md)
- [Developer Notes](developer-notes.md)
- [Example Usage](../examples/basic-usage.php)

Kavro uses `children` for nested sections. No `parent` key is required.

## Metabox Framework

Kavro now includes a first-pass metabox module for posts, pages, and custom post types.

```php
KAVRO::createMetabox( 'my_metabox', array(
    'title'     => 'Page Settings',
    'post_type' => array( 'post', 'page', 'portfolio' ),
    'context'   => 'normal',
    'priority'  => 'high',
) );

KAVRO::createSection( 'my_metabox', array(
    'title'  => 'Hero Settings',
    'fields' => array(
        array( 'id' => 'hero_title', 'type' => 'text', 'title' => 'Hero Title' ),
        array( 'id' => 'hero_image', 'type' => 'media', 'title' => 'Hero Image' ),
    ),
) );
```

Saved values are stored as one post meta array using the metabox ID:

```php
$settings = get_post_meta( get_the_ID(), 'my_metabox', true );
echo esc_html( $settings['hero_title'] ?? '' );
```

The development package keeps `require_once KAVRO_PATH . 'examples/basic-usage.php';` enabled in the main plugin file so the demo metabox appears immediately on post and page edit screens.

## Demo Files

The development build now keeps demos separated by module:

- `examples/options-demo.php` — admin options framework demo.
- `examples/metabox-demo.php` — post/page/CPT metabox demo.
- `examples/basic-usage.php` — compatibility loader that includes both demo files.

The main plugin file loads the demos on `init` priority `5`, before Kavro initializes registered modules at priority `20`. This keeps testing simple while avoiding early translation-loading notices in WordPress 6.7+.

Before production release, remove or comment the `kavro_load_development_demos()` callback in `kavro-framework.php`.
