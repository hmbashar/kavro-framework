# Metabox Framework

The Metabox Framework adds Kavro fields to post, page, or custom post type edit screens.

## Basic setup

```php
if ( class_exists( 'KAVRO' ) ) {

    $prefix = 'my_kavro_meta';

    KAVRO::createMetabox( $prefix, array(
        'title'     => 'Kavro Post Settings',
        'post_type' => array( 'post', 'page' ),
        'context'   => 'normal',
        'priority'  => 'default',
    ) );

    KAVRO::createSection( $prefix, array(
        'title'  => 'Post Design',
        'fields' => array(
            array(
                'id'    => 'hero_title',
                'type'  => 'text',
                'title' => 'Hero Title',
            ),
        ),
    ) );
}
```

## Get saved post meta

```php
$value = kavro_get_post_meta( get_the_ID(), 'my_kavro_meta', 'hero_title', '' );
```

## Field compatibility

Metaboxes use the same field renderer as the Options Framework. Most fields work the same way in options and metaboxes. Fields that represent admin-only actions, such as backup/import/export, should usually stay in the Options Framework.
