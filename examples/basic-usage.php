<?php
/**
 * Kavro Framework demo loader.
 *
 * This file keeps backward compatibility for developers who previously loaded
 * `examples/basic-usage.php` directly. The real demos are split by module so
 * each framework feature is easier to read, copy, and customize.
 *
 * @package Kavro
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once __DIR__ . '/options-demo.php';
require_once __DIR__ . '/metabox-demo.php';
