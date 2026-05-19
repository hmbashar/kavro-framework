<?php
/**
 * Kavro Pro/Add-on extension example.
 *
 * This file is a developer reference and is not loaded by default. Copy this
 * pattern into a separate Pro plugin when you want to extend Kavro Free.
 *
 * @package Kavro\Examples
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register a custom add-on module.
 */
add_action( 'kavro/register_modules', function() {
    KAVRO::registerModule(
        'example_pro_module',
        '\\MyCompany\\KavroPro\\ExampleModule',
        array(
            'label'   => 'Example Pro Module',
            'free'    => false,
            'enabled' => true,
        )
    );
} );
