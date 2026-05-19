# Shortcode Framework

Kavro includes a shortcode framework for registering frontend shortcodes and a matching admin generator UI.

## Basic Usage

```php
KAVRO::createShortcode(
    'my_shortcode',
    array(
        'title'       => 'My Shortcode',
        'tag'         => 'my_shortcode',
        'description' => 'Generate a shortcode from Kavro fields.',
        'capability'  => 'manage_options',
        'menu_parent' => 'tools.php',
        'render'      => function( $atts, $content = null, $tag = '' ) {
            return '<div>' . esc_html( $atts['title'] ?? '' ) . '</div>';
        },
    )
);

KAVRO::createSection(
    'my_shortcode',
    array(
        'title'  => 'Shortcode Attributes',
        'fields' => array(
            array(
                'id'      => 'title',
                'type'    => 'text',
                'title'   => 'Title',
                'default' => 'Hello World',
            ),
        ),
    )
);
```

## Arguments

| Argument | Description |
| --- | --- |
| `title` | Admin page title for the shortcode generator. |
| `tag` | Actual frontend shortcode tag. |
| `description` | Optional admin page description. |
| `capability` | Capability required to access the generator. |
| `menu_parent` | Parent admin menu slug. Defaults to `tools.php`. |
| `render` | Optional callback used to render frontend shortcode output. |

## Render Callback

The render callback receives three arguments:

```php
function( $atts, $content = null, $tag = '' ) {
    return '';
}
```

- `$atts` contains sanitized shortcode attributes.
- `$content` contains enclosed shortcode content.
- `$tag` contains the shortcode tag.

## Recommended Field Types

Shortcode attributes are text-based, so simple scalar fields are recommended:

- `text`
- `textarea`
- `select`
- `radio`
- `button_set`
- `checkbox`
- `color`
- `number`
- `url`

Complex fields can still be used in the generator, but their generated attribute values may need custom parsing in your render callback.

## Demo File

See:

```txt
examples/shortcode-demo.php
```
