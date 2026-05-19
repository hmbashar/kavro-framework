# Free vs Pro Separation

Kavro includes an extension registry so the free package and a future Pro package can share the same public API.

## Module registry

Each module is registered with a tier:

```php
KAVRO::registerModule( 'custom_module', My_Module::class, array(
    'label' => 'Custom Module',
    'tier'  => 'pro',
) );
```

## Restricting free modules

For a strict WordPress.org free build, define the free module list before Kavro boots:

```php
define( 'KAVRO_FREE_MODULES', array( 'options' ) );
```

Any built-in module not listed becomes Pro-tier. Pro-tier modules are only available when Kavro Pro is active or this filter allows them:

```php
add_filter( 'kavro/allow_pro_module_in_free', function( $allowed, $module, $config ) {
    return false;
}, 10, 3 );
```

## Pro detection

Kavro treats Pro as active when `KAVRO_PRO_VERSION` is defined or `\KavroPro\Plugin` exists. This can be customized:

```php
add_filter( 'kavro/is_pro_active', '__return_true' );
```

## Example loading

Examples are controlled by:

```php
define( 'KAVRO_LOAD_EXAMPLES', true );
```

Set it to `false` before distributing a production build.
