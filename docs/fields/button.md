# Button Field

**Field type:** `button`  
**Renderer class:** `Button`  
**Aliases using the same renderer:** None

## Purpose

Action/link button display.

## Value shape

String unless the field options enable multiple/nested values.

## Supported attributes

### Common attributes

| Attribute | Type | Description |
|---|---:|---|
| `id` | string | Required for data-saving fields. Unique key inside the option/meta array. Required for saving. |
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
| `label` | string | Inline label or button text displayed beside/inside the control. |
| `url` | string | Destination URL for button/link-style fields. |

## Options Framework example

```php
KAVRO::createSection( $prefix, array(
    'title'  => 'Button Example',
    'fields' => array(
        array(
            'id' => 'demo_button',
            'type' => 'button',
            'title' => 'Button',
            'subtitle' => 'Button field example.',
            'desc' => 'This is a documented button field example.',
            'label' => 'Open Link',
            'url' => 'https://example.com',
        ),
    ),
) );
```

## Metabox example

```php
KAVRO::createSection( $metabox_prefix, array(
    'title'  => 'Button Meta',
    'fields' => array(
        array(
            'id' => 'demo_button',
            'type' => 'button',
            'title' => 'Button',
            'subtitle' => 'Button field example.',
            'desc' => 'This is a documented button field example.',
            'label' => 'Open Link',
            'url' => 'https://example.com',
        ),
    ),
) );
```

## Get saved value

### From Options Framework

```php
$value = kavro_get_option( $prefix, 'demo_button', null );
```

### From Metabox

```php
$value = kavro_get_post_meta( get_the_ID(), $metabox_prefix, 'demo_button', null );
```

## Notes

This field is commonly used for display/admin UX. Use it in options pages when possible; metabox usage is supported when the output makes sense for editors.
