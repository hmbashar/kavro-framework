<?php
/**
 * Plugin Name: Kavro Framework
 * Plugin URI: https://github.com/hmbashar/kavro-framework
 * Description: A modern lightweight WordPress options, fields, customizer and metabox framework foundation.
 * Version: 1.0.0
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

define('KAVRO_VERSION', '1.0.0');
define('KAVRO_FILE', __FILE__);
define('KAVRO_PATH', plugin_dir_path(__FILE__));
define('KAVRO_URL', plugin_dir_url(__FILE__));

$kavro_autoload = KAVRO_PATH . 'vendor/autoload.php';
if (file_exists($kavro_autoload)) {
    require_once $kavro_autoload;
} else {
    spl_autoload_register(function ($class) {
        $maps = array(
            'Kavro\\Fields\\' => KAVRO_PATH . 'fields/',
            'Kavro\\' => KAVRO_PATH . 'classes/',
        );
        foreach ($maps as $prefix => $base) {
            if (0 !== strpos($class, $prefix)) {
                continue;
            }
            $relative = substr($class, strlen($prefix));
            $file = $base . str_replace('\\', '/', $relative) . '.php';
            if (file_exists($file)) {
                require_once $file;
            }
            return;
        }
    });
}

require_once KAVRO_PATH . 'includes/functions.php';

if (!class_exists('KAVRO')) {
    final class KAVRO
    {
        public static function boot()
        {
            return \Kavro\Framework::boot();
        }
        public static function createOptions($id, $args = array())
        {
            return \Kavro\Framework::createOptions($id, $args);
        }
        public static function createSection($id, $section)
        {
            return \Kavro\Framework::createSection($id, $section);
        }
        public static function createCustomizeOptions($id, $args = array())
        {
            return \Kavro\Framework::createCustomizeOptions($id, $args);
        }
        public static function createMetabox($id, $args = array())
        {
            return \Kavro\Framework::createMetabox($id, $args);
        }
    }
}

add_action('plugins_loaded', array('KAVRO', 'boot'));


require_once KAVRO_PATH . 'examples/basic-usage.php';
