<?php
/**
 * Kavro Framework demo loader.
 *
 * This file intentionally stays small. It loads the shared field examples first,
 * then loads the dedicated options and metabox demos.
 *
 * @package Kavro\Examples
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once __DIR__ . '/field-examples.php';
require_once __DIR__ . '/options-demo.php';
require_once __DIR__ . '/metabox-demo.php';
require_once __DIR__ . '/customizer-demo.php';
require_once __DIR__ . '/taxonomy-demo.php';
require_once __DIR__ . '/profile-demo.php';
