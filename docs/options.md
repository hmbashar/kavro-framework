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
