# Widget Options

Kavro Widget Options lets you build WordPress widgets with the same field API used by admin options, metaboxes, taxonomy options, profile options, and nav menu options.

## Basic usage

```php
KAVRO::createWidgetOptions(
    'my_widget',
    array(
        'title'       => 'My Kavro Widget',
        'description' => 'A widget powered by Kavro fields.',
        'classname'   => 'my-kavro-widget',
    )
);

KAVRO::createSection(
    'my_widget',
    array(
        'title'  => 'Content',
        'fields' => array(
            array(
                'id'    => 'title',
                'type'  => 'text',
                'title' => 'Widget Title',
            ),
            array(
                'id'    => 'content',
                'type'  => 'textarea',
                'title' => 'Content',
            ),
        ),
    )
);
```

## Front-end output callback

Pass a `callback` to control the widget front-end output.

```php
KAVRO::createWidgetOptions(
    'my_widget',
    array(
        'title'    => 'My Widget',
        'callback' => function( $args, $instance, $widget ) {
            echo wp_kses_post( wpautop( $instance['content'] ?? '' ) );
        },
    )
);
```

## Demo file

See `examples/widget-demo.php` for a complete, developer-commented example.

## Notes

- Widget field names are adapted to WordPress widget instance names automatically.
- Saved widget data is stored by WordPress in the normal widget option storage.
- Most scalar and compound Kavro fields can be used inside widgets.
- Very large operational/system fields are better suited to admin options than widgets.
