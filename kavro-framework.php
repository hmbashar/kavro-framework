<?php
/**
 * Plugin Name: Kavro Framework
 * Plugin URI: https://example.com/kavro-framework
 * Description: A modern lightweight WordPress options, fields, customizer and metabox framework foundation.
 * Version: 0.1.0
 * Author: Kavro
 * Text Domain: kavro-framework
 * Domain Path: /languages
 * License: GPLv2 or later
 */

if (!defined('ABSPATH')) {
    exit;
}

define('KAVRO_VERSION', '0.1.0');
define('KAVRO_FILE', __FILE__);
define('KAVRO_PATH', plugin_dir_path(__FILE__));
define('KAVRO_URL', plugin_dir_url(__FILE__));

require_once KAVRO_PATH . 'includes/class-kavro.php';
require_once KAVRO_PATH . 'includes/class-kavro-fields.php';
require_once KAVRO_PATH . 'includes/class-kavro-admin-options.php';
require_once KAVRO_PATH . 'includes/functions.php';
require_once KAVRO_PATH . 'examples/basic-usage.php';

add_action('plugins_loaded', array('KAVRO', 'boot'));
