# Kavro Profile Options

Kavro profile options add Kavro fields to WordPress user profile screens and save values as user meta.

## Create a profile option group

```php
$prefix = 'my_profile_options';

KAVRO::createProfileOptions(
    $prefix,
    array(
        'title' => 'Profile Extra Settings',
        'roles' => array(), // Empty means all roles.
    )
);
```

## Add fields

```php
KAVRO::createSection(
    $prefix,
    array(
        'title'  => 'Author Details',
        'fields' => array(
            array(
                'id'    => 'author_tagline',
                'type'  => 'text',
                'title' => 'Author Tagline',
            ),
            array(
                'id'    => 'featured_author',
                'type'  => 'switcher',
                'title' => 'Featured Author',
            ),
        ),
    )
);
```

## Limit by role

```php
KAVRO::createProfileOptions(
    'editor_profile_options',
    array(
        'title' => 'Editor Profile Options',
        'roles' => array( 'administrator', 'editor' ),
    )
);
```

## Get saved values

```php
$tagline = kavro_get_user_meta( get_current_user_id(), 'my_profile_options', 'author_tagline' );
$all     = kavro_get_user_meta( get_current_user_id(), 'my_profile_options' );
```

## Demo file

See `examples/profile-demo.php` for a complete developer-friendly example.
