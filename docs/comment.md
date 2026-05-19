# Comment Options

Kavro Comment Options let you attach Kavro fields to the WordPress comment edit screen.
Values are saved as one comment-meta array, using the unique ID from `KAVRO::createCommentOptions()`.

## Basic Usage

```php
$prefix = 'my_comment_options';

KAVRO::createCommentOptions(
    $prefix,
    array(
        'title'      => 'Comment Review Options',
        'capability' => 'edit_comment',
    )
);

KAVRO::createSection(
    $prefix,
    array(
        'title'  => 'Review Details',
        'fields' => array(
            array(
                'id'      => 'review_status',
                'type'    => 'select',
                'title'   => 'Review Status',
                'options' => array(
                    'new'      => 'New',
                    'reviewed' => 'Reviewed',
                    'flagged'  => 'Flagged',
                ),
            ),
            array(
                'id'    => 'internal_note',
                'type'  => 'textarea',
                'title' => 'Internal Note',
            ),
        ),
    )
);
```

## Retrieve Values

```php
$status = kavro_get_comment_meta( $comment_id, 'my_comment_options', 'review_status', 'new' );
$all    = kavro_get_comment_meta( $comment_id, 'my_comment_options' );
```

## Demo File

See:

- `examples/comment-demo.php`

## Notes

- The module renders on `comment.php` using the WordPress comment edit metabox API.
- Values are saved on the `edit_comment` action.
- The default capability is `edit_comment`.
- Most Kavro fields are supported because the module uses the shared field renderer.
