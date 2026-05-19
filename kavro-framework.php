<?php
/**
 * Plugin Name: Kavro Framework
 * Plugin URI: https://github.com/hmbashar/kavro-framework
 * Description: A modern lightweight WordPress options, fields, customizer and metabox framework foundation.
 * Version: 0.1.2
 * Author: Md Abul Bashar
 * Author URI: https://hmbashar.com
 * Text Domain: kavro-framework
 * Domain Path: /languages
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

if (!defined('ABSPATH')) {
    exit;
}

define('KAVRO_VERSION', '0.1.2');
define('KAVRO_FILE', __FILE__);
define('KAVRO_PATH', plugin_dir_path(__FILE__));
define('KAVRO_URL', plugin_dir_url(__FILE__));

$kavro_autoload = KAVRO_PATH . 'vendor/autoload.php';

if (file_exists($kavro_autoload)) {
    require_once $kavro_autoload;
} else {
    spl_autoload_register(function ($class) {
        $prefix = 'Kavro\\';
        $base = KAVRO_PATH . 'src/';

        if (0 !== strpos($class, $prefix)) {
            return;
        }

        $relative = substr($class, strlen($prefix));
        $file = $base . str_replace('\\', '/', $relative) . '.php';

        if (file_exists($file)) {
            require_once $file;
        }
    });

    require_once KAVRO_PATH . 'includes/functions.php';
}

if (!class_exists('KAVRO')) {
    final class KAVRO
    {
        public static function boot()
        {
            return \Kavro\Core\Framework::boot();
        }

        public static function createOptions($id, $args = array())
        {
            return \Kavro\Core\Framework::createOptions($id, $args);
        }

        public static function createSection($id, $section)
        {
            return \Kavro\Core\Framework::createSection($id, $section);
        }

        public static function createCustomizeOptions($id, $args = array())
        {
            return \Kavro\Core\Framework::createCustomizeOptions($id, $args);
        }

        public static function createMetabox($id, $args = array())
        {
            return \Kavro\Core\Framework::createMetabox($id, $args);
        }
    }
}

add_action('plugins_loaded', array('KAVRO', 'boot'));

require_once KAVRO_PATH . 'examples/basic-usage.php';
