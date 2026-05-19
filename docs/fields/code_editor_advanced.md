# Code Editor Advanced Field

**Field type:** `code_editor_advanced`  
**Renderer class:** `AdvancedCode`  
**Aliases using the same renderer:** `css_editor`, `js_editor`

## Purpose

Advanced code editor field.

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
| `language` | string | Code language/mode such as `css`, `javascript`, `php`, `json`, or `html`. |

## Options Framework example

```php
KAVRO::createSection( $prefix, array(
    'title'  => 'Code Editor Advanced Example',
    'fields' => array(
        array(
            'id' => 'demo_code_editor_advanced',
            'type' => 'code_editor_advanced',
            'title' => 'Code Editor Advanced',
            'subtitle' => 'Code Editor Advanced field example.',
            'desc' => 'This is a documented code_editor_advanced field example.',
            'placeholder' => 'Enter code editor advanced',
            'default' => 'Example value',
        ),
    ),
) );
```

## Metabox example

```php
KAVRO::createSection( $metabox_prefix, array(
    'title'  => 'Code Editor Advanced Meta',
    'fields' => array(
        array(
            'id' => 'demo_code_editor_advanced',
            'type' => 'code_editor_advanced',
            'title' => 'Code Editor Advanced',
            'subtitle' => 'Code Editor Advanced field example.',
            'desc' => 'This is a documented code_editor_advanced field example.',
            'placeholder' => 'Enter code editor advanced',
            'default' => 'Example value',
        ),
    ),
) );
```

## Get saved value

### From Options Framework

```php
$value = kavro_get_option( $prefix, 'demo_code_editor_advanced', null );
```

### From Metabox

```php
$value = kavro_get_post_meta( get_the_ID(), $metabox_prefix, 'demo_code_editor_advanced', null );
```

## Notes

Use clear field IDs and defaults. Combine with `dependency` when the field should appear only after another setting is enabled.
