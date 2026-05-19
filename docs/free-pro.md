# Free vs Pro Architecture

Kavro includes a small module registry so the free plugin can remain stable while a Pro plugin or third-party add-on extends the framework.

## Edition Helpers

```php
kavro_is_pro();       // bool
kavro_edition();      // free|pro
kavro_get_modules();  // registered module definitions
```

The global facade also supports:

```php
KAVRO::isPro();
KAVRO::edition();
KAVRO::getModules();
KAVRO::isModuleAvailable( 'metabox' );
```

## Registering a Pro Module

A Pro plugin can register a module on the `kavro/register_modules` action.

```php
add_action( 'kavro/register_modules', function() {
    KAVRO::registerModule(
        'my_pro_module',
        '\\KavroPro\\Modules\\MyProModule',
        array(
            'label'   => 'My Pro Module',
            'free'    => false,
            'enabled' => true,
        )
    );
} );
```

A module controller receives the same constructor signature as Kavro core modules:

```php
public function __construct( $id, $args = array(), $sections = array() ) {}
```

## Overriding a Core Module

A Pro plugin can override a free controller by registering the same module key.

```php
add_action( 'kavro/register_modules', function() {
    KAVRO::registerModule( 'options', '\\KavroPro\\AdminOptionsPro' );
} );
```

## Useful Hooks

```php
do_action( 'kavro/register_modules' );
apply_filters( 'kavro/modules', $modules );
apply_filters( 'kavro/module_available', $enabled, $module, $config );
apply_filters( 'kavro/module_class', $class, $module );
do_action( 'kavro/before_module_init', $module, $id, $args, $sections );
do_action( 'kavro/after_module_init', $instance, $module, $id );
do_action( 'kavro/module_unavailable', $module, $id, $args );
do_action( 'kavro/module_class_missing', $module, $class, $id, $args );
```

## Suggested Product Split

Recommended Free modules:

- Admin Options
- Basic field renderer
- Import/export/reset
- Basic metabox support
- Developer hooks

Recommended Pro modules:

- Advanced Customizer features
- Taxonomy/profile/nav menu/widget/comment options
- Shortcode generator
- Advanced field packs
- White label mode
- License/update system
- Premium templates

You can adjust that split later without changing the public API because modules are registry-driven.
