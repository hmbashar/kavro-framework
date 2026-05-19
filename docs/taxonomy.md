# Taxonomy Options

Kavro taxonomy options let you attach Kavro fields to taxonomy add/edit screens such as categories, tags, or custom taxonomies.

## Basic usage

```php
$prefix = 'my_taxonomy_options';

KAVRO::createTaxonomyOptions(
    $prefix,
    array(
        'taxonomy' => array( 'category', 'post_tag' ),
    )
);

KAVRO::createSection(
    $prefix,
    array(
        'title'  => 'Term Settings',
        'fields' => array(
            array(
                'id'    => 'accent_color',
                'type'  => 'color',
                'title' => 'Accent Color',
            ),
            array(
                'id'    => 'term_intro',
                'type'  => 'textarea',
                'title' => 'Intro Text',
            ),
        ),
    )
);
```

## Reading values

```php
$accent = kavro_get_term_meta( $term_id, 'my_taxonomy_options', 'accent_color', '#635bff' );
```

## Notes

- Values are stored as a single term-meta array using the unique taxonomy option ID.
- The demo file is located at `examples/taxonomy-demo.php`.
- Use `taxonomy` to target custom taxonomies.
- Most Kavro fields work in taxonomy screens, but very large builder fields should be used carefully because taxonomy edit screens have less space than the main options panel.
