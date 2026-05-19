# Kavro Metabox Framework

The metabox framework adds Kavro fields to post, page, or custom post type edit screens.

## Basic usage

```php
$prefix = 'kavro_demo_metabox';

KAVRO::createMetabox( $prefix, array(
    'title'     => 'Kavro Demo Metabox',
    'post_type' => array( 'post', 'page' ),
    'context'   => 'normal',
    'priority'  => 'high',
) );

KAVRO::createSection( $prefix, array(
    'title'  => 'Hero Settings',
    'fields' => array(
        array(
            'id'    => 'hero_title',
            'type'  => 'text',
            'title' => 'Hero Title',
        ),
    ),
) );
```

## Change post type

```php
'post_type' => array( 'post', 'page', 'product', 'portfolio' ),
```

## Reading values

```php
$value = kavro_get_post_meta( get_the_ID(), 'kavro_demo_metabox', 'hero_title', '' );
```

## Field compatibility

Metaboxes use the same Kavro field renderer as the options framework. The demo
metabox includes every registered field type for compatibility testing.

## Demo file

See [`examples/metabox-demo.php`](../examples/metabox-demo.php).


## Compatibility fix note

Metabox fields use the same renderer as option fields. Complex fields that store arrays must render array data with compound inputs or JSON textareas instead of sending arrays directly to WordPress escaping helpers. The demo includes every field type so these differences can be tested quickly.


## Demo Coverage

The demo loads `examples/field-examples.php`, so every registered Kavro field type has at least one example in both the options panel and metabox demo.
