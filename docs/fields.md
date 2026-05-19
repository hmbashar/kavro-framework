# Kavro Field Documentation

Each field is defined with an array inside a section `fields` list.

```php
array(
    'id'      => 'field_id',
    'type'    => 'text',
    'title'   => 'Field Title',
    'default' => 'Default value',
    'desc'    => 'Optional helper text.',
)
```

## Supported Fields

### text
Simple text input.

```php
array( 'id' => 'site_badge', 'type' => 'text', 'title' => 'Site Badge' )
```

### textarea
Multi-line text input.

```php
array( 'id' => 'intro', 'type' => 'textarea', 'title' => 'Intro Text' )
```

### email / url / password / number / hidden
Specialized input fields.

```php
array( 'id' => 'admin_email', 'type' => 'email', 'title' => 'Admin Email' )
array( 'id' => 'website_url', 'type' => 'url', 'title' => 'Website URL' )
array( 'id' => 'api_key', 'type' => 'password', 'title' => 'API Key' )
array( 'id' => 'items_per_page', 'type' => 'number', 'title' => 'Items Per Page' )
```

### checkbox
Single checkbox.

```php
array( 'id' => 'minify_css', 'type' => 'checkbox', 'title' => 'Minify CSS', 'label' => 'Enable minification' )
```

### multicheck
Multiple checkbox values saved as an array.

```php
array(
    'id'      => 'modules',
    'type'    => 'multicheck',
    'title'   => 'Modules',
    'options' => array(
        'admin'      => 'Admin Options',
        'customizer' => 'Customizer',
        'metabox'    => 'Metabox',
    ),
)
```

### switcher / toggle
Boolean-style switch.

```php
array( 'id' => 'enable_feature', 'type' => 'switcher', 'title' => 'Enable Feature' )
```

### select / radio / button_set
Choice fields.

```php
array(
    'id'      => 'layout',
    'type'    => 'select',
    'title'   => 'Layout',
    'options' => array( 'boxed' => 'Boxed', 'wide' => 'Wide' ),
)
```

### color
WordPress color picker.

```php
array( 'id' => 'brand_color', 'type' => 'color', 'title' => 'Brand Color' )
```

### color_group
Multiple color pickers saved as one array.

```php
array(
    'id'      => 'brand_colors',
    'type'    => 'color_group',
    'title'   => 'Brand Colors',
    'options' => array( 'primary' => 'Primary', 'accent' => 'Accent' ),
)
```

### palette
Preset color palette selector.

```php
array(
    'id'      => 'palette',
    'type'    => 'palette',
    'title'   => 'Palette',
    'options' => array(
        'indigo' => array( '#4f46e5', '#06b6d4', '#111827' ),
    ),
)
```

### date / time
Native date and time inputs.

```php
array( 'id' => 'launch_date', 'type' => 'date', 'title' => 'Launch Date' )
array( 'id' => 'launch_time', 'type' => 'time', 'title' => 'Launch Time' )
```

### range / slider
Range slider with live value.

```php
array( 'id' => 'radius', 'type' => 'range', 'title' => 'Radius', 'min' => 0, 'max' => 60, 'step' => 1 )
```

### media / upload / image
WordPress media uploader URL fields.

```php
array( 'id' => 'logo', 'type' => 'media', 'title' => 'Logo' )
```

### background
Compound background control.

```php
array( 'id' => 'page_background', 'type' => 'background', 'title' => 'Page Background' )
```

### border
Compound border control.

```php
array( 'id' => 'card_border', 'type' => 'border', 'title' => 'Card Border' )
```

### dimensions / spacing
Multi-value size fields.

```php
array( 'id' => 'logo_size', 'type' => 'dimensions', 'title' => 'Logo Size' )
array( 'id' => 'section_padding', 'type' => 'spacing', 'title' => 'Section Padding' )
```

### typography
Basic typography group field.

```php
array( 'id' => 'body_typography', 'type' => 'typography', 'title' => 'Body Typography' )
```

### code
Textarea code field.

```php
array( 'id' => 'custom_css', 'type' => 'code', 'title' => 'Custom CSS' )
```

### wysiwyg / wp_editor
WordPress editor field.

```php
array( 'id' => 'content', 'type' => 'wysiwyg', 'title' => 'Content' )
```

### link
URL, text, and target group field.

```php
array( 'id' => 'cta_link', 'type' => 'link', 'title' => 'CTA Link' )
```

### repeater
Repeatable group field.

```php
array(
    'id'     => 'cta_items',
    'type'   => 'repeater',
    'title'  => 'CTA Items',
    'fields' => array(
        array( 'id' => 'title', 'type' => 'text', 'title' => 'Title' ),
        array( 'id' => 'url', 'type' => 'url', 'title' => 'URL' ),
    ),
)
```

### content / heading / notice
Display-only helper fields.

```php
array( 'type' => 'heading', 'content' => 'Design Settings' )
array( 'type' => 'notice', 'content' => 'This is an informational notice.' )
array( 'type' => 'content', 'content' => '<p>Custom HTML content.</p>' )
```
