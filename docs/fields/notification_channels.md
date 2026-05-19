# Notification Channels Field

**Field type:** `notification_channels`  
**Renderer class:** `NotificationChannels`  
**Aliases using the same renderer:** None

## Purpose

Notification channel settings.

## Value shape

Associative array or nested array, depending on sub-fields.

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
| `channels` | array | Notification channel definitions. |

## Options Framework example

```php
KAVRO::createSection( $prefix, array(
    'title'  => 'Notification Channels Example',
    'fields' => array(
        array(
            'id' => 'demo_notification_channels',
            'type' => 'notification_channels',
            'title' => 'Notification Channels',
            'subtitle' => 'Notification Channels field example.',
            'desc' => 'This is a documented notification_channels field example.',
            'channels' => array(
                'email' => 'Email',
                'slack' => 'Slack',
            ),
            'default' => 'Example value',
        ),
    ),
) );
```

## Metabox example

```php
KAVRO::createSection( $metabox_prefix, array(
    'title'  => 'Notification Channels Meta',
    'fields' => array(
        array(
            'id' => 'demo_notification_channels',
            'type' => 'notification_channels',
            'title' => 'Notification Channels',
            'subtitle' => 'Notification Channels field example.',
            'desc' => 'This is a documented notification_channels field example.',
            'channels' => array(
                'email' => 'Email',
                'slack' => 'Slack',
            ),
            'default' => 'Example value',
        ),
    ),
) );
```

## Get saved value

### From Options Framework

```php
$value = kavro_get_option( $prefix, 'demo_notification_channels', null );
```

### From Metabox

```php
$value = kavro_get_post_meta( get_the_ID(), $metabox_prefix, 'demo_notification_channels', null );
```

## Notes

This is a complex field. Treat the saved value as an array and inspect the returned structure before using it in frontend templates.
