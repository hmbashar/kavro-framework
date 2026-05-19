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

## Additional Premium Field Types

Kavro now includes the following extra field types for richer demos and future production use:

| Field Type | Purpose |
|---|---|
| `spinner` | Compact number control with plus/minus buttons. |
| `subheading` | Small visual heading used inside a section. |
| `divider` | Clean separator for large settings groups. |
| `gallery` | Stores multiple image URLs selected from the media library. |
| `icon` | Dashicons picker/input field. |
| `fieldset` | Structured group of simple sub-fields saved as an array. |
| `group` | Alias of repeater for repeatable item groups. |
| `accordion` | Collapsible content/help blocks inside a settings page. |
| `tabbed` | Inline tabbed content/help panels. |
| `sortable` | Ordered list of enabled items. |
| `sorter` | Two-column enabled/available ordering control. |
| `backup` | Import/export textarea placeholder field. |

### Example: Spinner

```php
array(
  'id'      => 'items_per_page',
  'type'    => 'spinner',
  'title'   => 'Items Per Page',
  'default' => 12,
  'min'     => 1,
  'max'     => 100,
  'step'    => 1,
)
```

### Example: Gallery

```php
array(
  'id'    => 'hero_gallery',
  'type'  => 'gallery',
  'title' => 'Hero Gallery',
)
```

### Example: Fieldset

```php
array(
  'id'     => 'social_links',
  'type'   => 'fieldset',
  'title'  => 'Social Links',
  'fields' => array(
    array( 'id' => 'facebook', 'type' => 'url', 'title' => 'Facebook' ),
    array( 'id' => 'twitter',  'type' => 'url', 'title' => 'Twitter / X' ),
  ),
)
```


## Additional Premium Fields

### image_select
Visual radio picker for layout/theme choices.

### link_color
Stores normal, hover, and active link colors in one array.

### datetime
Native `datetime-local` input for combined date/time settings.

### key_value
Repeatable key/value rows for custom variables, labels, or developer settings.


## Demo Coverage

Every built-in Kavro field has at least one working example in `examples/basic-usage.php`. Use that file as the primary field reference when testing the framework in a theme or plugin.

## Settings Import / Export

Import/export tools are rendered automatically by the admin options controller. They are not normal fields because they use secure `admin-post.php` actions for downloading and importing JSON payloads.


## Additional Fields Added

- `tel` - telephone input.
- `month` - month picker.
- `week` - week picker.
- `readonly` - read-only saved value display.
- `copy` - copyable read-only value.
- `button` - URL input with premium preview button.
- `html` - safe HTML preview card.
- `oembed` - oEmbed URL helper field.

## Extended Fields Added

The following premium-style fields were added after the import/export build. Each one has at least one working example in `examples/basic-usage.php` under the **Extended Fields** section.

- `unit` - numeric value with selectable unit suffix such as `px`, `%`, `rem`, `vw`.
- `gradient` - two-color linear gradient builder with direction selector and live preview.
- `box_shadow` - compound shadow builder with x, y, blur, spread, color, and inset option.
- `link_group` - grouped CTA/link control with label, URL, and target.
- `social_links` - profile URL fields for common networks.
- `rating` - premium star rating selector.
- `progress` - range input with live progress meter.
- `map` - latitude, longitude, and zoom coordinate control.
- `text_list` - newline-separated list field.
- `embed` - code-style textarea for embed snippets.
- `json` - code-style textarea for JSON configuration.

### Example: Unit

```php
array(
  'id'      => 'hero_max_width',
  'type'    => 'unit',
  'title'   => 'Hero Max Width',
  'default' => array( 'value' => '1280', 'unit' => 'px' ),
  'units'   => array( 'px' => 'px', '%' => '%', 'rem' => 'rem' ),
)
```

### Example: Gradient

```php
array(
  'id'      => 'brand_gradient',
  'type'    => 'gradient',
  'title'   => 'Brand Gradient',
  'default' => array(
    'from'      => '#6d5dfc',
    'to'        => '#10b6d8',
    'direction' => '135deg',
  ),
)
```

### Example: Box Shadow

```php
array(
  'id'    => 'card_shadow',
  'type'  => 'box_shadow',
  'title' => 'Card Shadow',
)
```

### Example: Social Links

```php
array(
  'id'    => 'profile_links',
  'type'  => 'social_links',
  'title' => 'Social Links',
)
```


## WordPress Content Fields

Kavro includes content-aware selectors for WordPress data. Every field below is demonstrated in `examples/basic-usage.php` under **WP Content Fields**.

- `post_select` — dropdown for posts or configured post types.
- `post_checkbox` — multi-select posts with checkbox cards.
- `post_radio` — single post selection with radio cards.
- `post_autocomplete` — searchable post selector.
- `post_relation` — multiple post/page/CPT relationship selector.
- `page_select` — dropdown for pages.
- `cpt_select` — dropdown for one or more custom post types.
- `taxonomy_select` — dropdown of public taxonomies.
- `taxonomy_checkbox` — multi-select terms with checkbox cards.
- `taxonomy_radio` — single term selection with radio cards.
- `term_relation` — searchable multiple term relationship selector.
- `user_select` — dropdown of WordPress users.
- `role_select` — dropdown of registered roles.
- `menu_select` — dropdown of nav menus.
- `sidebar_select` — dropdown of registered sidebars.
- `template_select` — dropdown of theme page templates.

Example:

```php
array(
    'id'        => 'featured_posts',
    'type'      => 'post_relation',
    'title'     => 'Featured Posts',
    'post_type' => array( 'post', 'page' ),
)
```


### Custom and Select2 Fields

- `custom` — render developer-defined field markup using `html`, a PHP `callback`, or the `kavro_custom_field_{field_id}` action.
- `select2` / `enhanced_select` — premium searchable select field. Supports `options`, `placeholder`, and `multiple`.
- Any normal `select` can use the enhanced UI by adding `'select2' => true`.

Example:

```php
array(
  'id'       => 'modules',
  'type'     => 'select2',
  'title'    => 'Modules',
  'multiple' => true,
  'options'  => array(
    'admin'   => 'Admin Options',
    'metabox' => 'Metabox',
  ),
)
```

## Advanced Framework Fields

These fields were added for premium framework workflows:

- `ajax_select` — searchable select prepared for AJAX/remote data workflows, while also supporting local `options`.
- `cloneable` — repeatable text rows for simple lists.
- `responsive_value` — desktop/tablet/mobile value storage.
- `css_builder` — selector/property/value CSS rule builder.
- `google_fonts` — font family selector with searchable UI.
- `code_editor_advanced` — premium code textarea wrapper.
- `css_editor` — alias of advanced code editor with CSS language label.
- `js_editor` — alias of advanced code editor with JavaScript language label.
- `file_upload` — WordPress media-powered file selector.
- `video_upload` — WordPress media-powered video selector.
- `audio_upload` — WordPress media-powered audio selector.
- `device_preview` — device-focused preview notes/control field.
- `dynamic_tags` — inserts common template tokens such as `{{site_title}}` and `{{current_year}}`.

### Conditional Logic

Any normal field can include a `dependency` array:

```php
array(
    'id'         => 'advanced_text',
    'type'       => 'text',
    'title'      => 'Advanced Text',
    'dependency' => array(
        'field'    => 'enable_advanced',
        'operator' => '==',
        'value'    => '1',
    ),
)
```

Supported operators: `==`, `!=`, `contains`, `empty`, and `not_empty`.


## Next Advanced Fields

- `border_radius` - corner radius control.
- `box_model` - margin and padding control.
- `dimensions_advanced` - width, height, min and max dimensions.
- `spacing_advanced` - advanced spacing control.
- `typography_advanced` - extended typography control.
- `color_picker_alpha` - color with opacity.
- `conditional_group` - stores conditional display rules.
- `repeater_nested` - stores nested repeater data.
- `query_builder` - post query configuration.
- `shortcode_builder` - shortcode tag and attributes.
- `form_builder` - form schema builder field.
- `menu_builder` - menu tree schema field.
- `layout_builder` - visual layout choice field.


## Added in this build

- Reset button in the top action bar and footer.
- Reset is nonce-protected and returns to the same active Kavro section.
- New fields: `table`, `matrix`, `checklist`, `business_hours`, `timeline`, `seo_preview`, `open_graph`, `schema_markup`, `webhook`, `cron_schedule`, `capability_select`.
- Each new field has at least one example in `examples/basic-usage.php`.


## Operations Pro Fields

These fields are useful for premium plugin/theme dashboards, API integrations, SaaS controls, support tooling, and diagnostic screens.

| Field Type | Purpose |
|---|---|
| `notification_channels` | Configure email/SMS/Slack/webhook notification targets. |
| `api_credentials` | Store API key, secret, client ID, and client secret style values. |
| `license_key` | Render a premium license key input with visual status. |
| `environment_select` | Select local/staging/production mode. |
| `feature_flags` | Enable or disable internal feature flags. |
| `permission_matrix` | Manage role/capability-style permission matrices. |
| `redirect_rules` | Configure simple redirect from/to/status rules. |
| `email_template` | Subject/body template field with token hints. |
| `rest_endpoint` | Configure REST method and route values. |
| `rate_limit` | Define request limits by time window. |
| `cache_control` | Manage cache enabled state, TTL, and group. |
| `log_viewer` | Display diagnostic log lines in a premium console style. |
| `changelog` | Display version/change history inside settings. |
| `system_info` | Display current WP/PHP/site/debug details. |
| `health_check` | Display pass/warning diagnostic checks. |
| `onboarding_steps` | Render checklist-style onboarding progress. |

Example usage is included in `examples/basic-usage.php` under **Operations Pro Fields**.
