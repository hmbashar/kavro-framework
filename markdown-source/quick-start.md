# Quick Start

## Enable examples during development

In the main plugin file, or in `wp-config.php` during local testing:

```php
define( 'KAVRO_LOAD_EXAMPLES', true );
```

Do not enable examples on production sites.

## Create an options page

```php
$prefix = 'my_kavro_options';

KAVRO::createOptions( $prefix, array(
    'menu_title' => 'Theme Options',
    'menu_slug'  => 'theme-options',
) );

KAVRO::createSection( $prefix, array(
    'title'  => 'General',
    'fields' => array(
        array(
            'id'    => 'brand_color',
            'type'  => 'color',
            'title' => 'Brand Color',
        ),
    ),
) );
```

## Create a metabox

```php
$prefix = 'my_kavro_meta';

KAVRO::createMetabox( $prefix, array(
    'title'     => 'Page Settings',
    'post_type' => array( 'page' ),
) );

KAVRO::createSection( $prefix, array(
    'title'  => 'Hero',
    'fields' => array(
        array(
            'id'    => 'hero_title',
            'type'  => 'text',
            'title' => 'Hero Title',
        ),
    ),
) );
```
