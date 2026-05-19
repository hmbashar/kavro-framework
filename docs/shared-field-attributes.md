# Shared Field Attributes

These attributes are available on most Kavro fields. Individual fields may support extra attributes, documented in their dedicated files.

| Attribute | Type | Description |
|---|---:|---|
| `id` | string | Required for data-saving fields. Unique key inside the option/meta array. |
| `type` | string | Required. Field type slug, for example `text`, `select`, or `repeater`. |
| `title` | string | Main field label displayed in the left column. |
| `subtitle` | string | Small helper text below the field title. |
| `desc` | string/html | Description displayed below the control. Limited HTML is allowed. |
| `default` | mixed | Default value used when there is no saved value yet. |
| `placeholder` | string | Placeholder text for input/select-like fields when supported. |
| `class` | string | Optional custom CSS class for custom integrations. |
| `dependency` | array | Conditional visibility rules. Example: `[ "field" => "enable", "operator" => "==", "value" => 1 ]`. |
| `sanitize_callback` | callable | Custom sanitizer callback. Receives `$value` and `$field`. |


## Dependency syntax

Use `dependency` to show/hide a field based on another field value.

```php
array(
    'id'         => 'button_text',
    'type'       => 'text',
    'title'      => 'Button Text',
    'dependency' => array(
        'field'    => 'enable_button',
        'operator' => '==',
        'value'    => 1,
    ),
)
```

Recommended operators: `==`, `!=`, `contains`, `empty`, `not_empty`, `>`, `<`, `>=`, `<=`.

## Custom sanitization

```php
array(
    'id'                => 'tracking_id',
    'type'              => 'text',
    'title'             => 'Tracking ID',
    'sanitize_callback' => function( $value, $field ) {
        return sanitize_text_field( $value );
    },
)
```
