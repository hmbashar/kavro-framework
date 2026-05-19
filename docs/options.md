# Kavro Options Framework

The options framework creates a premium WordPress admin settings page.

## Basic usage

```php
$prefix = 'my_kavro_options';

KAVRO::createOptions( $prefix, array(
    'menu_title' => 'Kavro Demo',
    'menu_slug'  => 'kavro-demo',
) );

KAVRO::createSection( $prefix, array(
    'title'  => 'General',
    'fields' => array(
        array(
            'id'    => 'site_title',
            'type'  => 'text',
            'title' => 'Site Title',
        ),
    ),
) );
```

## Nested sections

Kavro does not require a `parent` key. Add child screens with `children`.

```php
KAVRO::createSection( $prefix, array(
    'title'    => 'Main',
    'children' => array(
        array(
            'title' => 'Child',
            'fields' => array(),
        ),
    ),
) );
```

## Reading values

```php
$value = kavro_get_option( 'my_kavro_options', 'site_title', 'Default' );
```

## Demo file

See [`examples/options-demo.php`](../examples/options-demo.php).


## Demo registration timing

For local testing, the options demo is loaded from `examples/basic-usage.php` on `init` priority 10. This is intentionally before Kavro builds option screens on priority 20, which ensures all demo sections appear in the admin panel.


## Demo Coverage

The demo loads `examples/field-examples.php`, so every registered Kavro field type has at least one example in both the options panel and metabox demo.


## AJAX Save

Kavro option panels support non-reload AJAX saving by default. The normal WordPress Settings API form remains in place as a fallback when JavaScript is unavailable. The AJAX endpoint verifies the current user capability, validates a screen-specific nonce, sanitizes values through the registered Kavro field schema, and then updates the option value.

Reset also supports AJAX and uses the same capability and nonce verification.
