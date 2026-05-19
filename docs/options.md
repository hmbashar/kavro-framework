# Options Framework

The Options Framework creates a premium admin settings page and stores values in one WordPress option array.

## Basic setup

```php
if ( class_exists( 'KAVRO' ) ) {

    $prefix = 'my_kavro_options';

    KAVRO::createOptions( $prefix, array(
        'menu_title' => 'Kavro Options',
        'menu_slug'  => 'kavro-options',
        'menu_icon'  => 'dashicons-admin-generic',
        'capability' => 'manage_options',
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
}
```

## Nested sections

Kavro uses `children` for nested admin navigation. You do not need a `parent` attribute.

```php
KAVRO::createSection( $prefix, array(
    'title'    => 'Design',
    'children' => array(
        array(
            'title'  => 'Header',
            'fields' => array(
                array(
                    'id'    => 'header_logo',
                    'type'  => 'image',
                    'title' => 'Logo',
                ),
            ),
        ),
    ),
) );
```

## Get saved value

```php
$options = get_option( 'my_kavro_options', array() );
$value   = isset( $options['site_title'] ) ? $options['site_title'] : '';
```

Or use the helper:

```php
$value = kavro_get_option( 'my_kavro_options', 'site_title', '' );
```

## AJAX save

Options support secure AJAX saving with normal WordPress form submission as fallback. Saving uses nonce, capability checks, and field-aware sanitization.
