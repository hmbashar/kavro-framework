# Subheading Field

**Field type:** `subheading`  
**Renderer class:** `Subheading`  
**Aliases using the same renderer:** None

## Purpose

Smaller section heading.

## Value shape

String unless the field options enable multiple/nested values.

## Supported attributes

### Common attributes

| Attribute | Type | Description |
|---|---:|---|
| `id` | string | Required for data-saving fields. Unique key inside the option/meta array. |
| `type` | string | Required. Field type slug, for example `text`, `select`, or `repeater`. |
| `title` | string | Main field label displayed in the left column. |
| `subtitle` | string | Small helper text below the field title. |
| `desc` | string/html | Description displayed below the control. Limited HTML is allowed. |
| `default` | mixed | Default value used when there is no saved value yet. |
| `placeholder` | string | Placeholder text for input/select-like fields when supported. |
| `dependency` | array | Conditional visibility rules. Example: `[ "field" => "enable", "operator" => "==", "value" => 1 ]`. |
| `sanitize_callback` | callable | Custom sanitizer callback. Receives `$value` and `$field`. |

### Field-specific attributes

| Attribute | Type | Description |
|---|---:|---|
| `content` | string/html | Static content rendered by layout/information fields. |
| `title` | mixed | Field-specific setting used by the `subheading` renderer. |

## Options Framework example

```php
KAVRO::createSection( $prefix, array(
    'title'  => 'Subheading Example',
    'fields' => array(
        array(
            'type' => 'subheading',
            'title' => 'Subheading',
            'subtitle' => 'Subheading field example.',
            'desc' => 'This is a documented subheading field example.',
            'content' => '<strong>Kavro documentation example.</strong>',
        ),
    ),
) );
```

## Metabox example

```php
KAVRO::createSection( $metabox_prefix, array(
    'title'  => 'Subheading Meta',
    'fields' => array(
        array(
            'type' => 'subheading',
            'title' => 'Subheading',
            'subtitle' => 'Subheading field example.',
            'desc' => 'This is a documented subheading field example.',
            'content' => '<strong>Kavro documentation example.</strong>',
        ),
    ),
) );
```

## Saving behavior

This field is primarily structural/display-only and normally does not save a value because it does not require an `id`.

## Notes

This field is commonly used for display/admin UX. Use it in options pages when possible; metabox usage is supported when the output makes sense for editors.
