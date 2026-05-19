# Performance and Asset Loading

Kavro keeps the premium admin UI available while avoiding unnecessary WordPress assets on unrelated screens.

## What changed

Kavro now uses `Kavro\Assets` as a central asset resolver. Each module passes its registered section/field schema into the resolver, and Kavro decides which dependencies are needed.

## Conditional dependencies

Kavro always loads:

- `assets/css/admin.css`
- `assets/js/admin.js`
- Dashicons

Kavro conditionally loads:

- WordPress media modal for upload/media/gallery/image/file/audio/video fields.
- WordPress color picker for color, palette, gradient, background, border, typography, and related color fields.
- jQuery UI sortable for sortable, sorter, repeater, group, cloneable, table, matrix, and similar ordering fields.

## JavaScript safety

The admin script now checks whether optional APIs exist before using them:

- `$.fn.wpColorPicker`
- `$.fn.sortable`
- `wp.media`

This prevents JavaScript errors when a screen does not need those dependencies.

## Hooks

Customize the computed asset profile:

```php
add_filter( 'kavro/asset_profile', function( $profile, $types, $sections ) {
    // Example: force media support for a custom field type.
    if ( in_array( 'my_custom_media_field', $types, true ) ) {
        $profile['media'] = true;
    }

    return $profile;
}, 10, 3 );
```

Customize localized admin data:

```php
add_filter( 'kavro/admin_localize_data', function( $data, $sections ) {
    $data['customValue'] = 'example';
    return $data;
}, 10, 2 );
```

## Developer notes

If you create a custom field that requires WordPress media, color picker, sortable, or another dependency, use `kavro/asset_profile` to opt in. This keeps the free core lightweight and lets Pro/add-ons load only what they need.
