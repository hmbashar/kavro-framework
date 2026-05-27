<?php
/**
 * Plugin Name: Kavro Framework
 * Plugin URI: https://github.com/hmbashar/kavro-framework
 * Description: A modern, lightweight WordPress framework for building admin options, metaboxes, Customizer panels, taxonomy options, profile fields, menu item fields, widgets, comments, and shortcode UIs.
 * Version: 1.0.0
 * Requires at least: 5.8
 * Tested up to: 6.7
 * Requires PHP: 7.4
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

if (!defined('KAVRO_VERSION')) {
    define('KAVRO_VERSION', '1.0.0');
}

if (!defined('KAVRO_EDITION')) {
    define('KAVRO_EDITION', 'free');
}

if (!defined('KAVRO_LOAD_EXAMPLES')) {
    /**
     * Examples are disabled by default for production and WordPress.org builds.
     *
     * Developers can enable the bundled demos in wp-config.php while testing:
     * define( 'KAVRO_LOAD_EXAMPLES', true );
     */
    define('KAVRO_LOAD_EXAMPLES', true);
}
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
        public static function registerModule($module, $class, $args = array())
        {
            return \Kavro\Framework::registerModule($module, $class, $args);
        }
        public static function getModules()
        {
            return \Kavro\Framework::getModules();
        }
        public static function isModuleAvailable($module)
        {
            return \Kavro\Framework::isModuleAvailable($module);
        }
        public static function isPro()
        {
            return \Kavro\Framework::isPro();
        }
        public static function edition()
        {
            return \Kavro\Framework::edition();
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
        public static function createTaxonomyOptions($id, $args = array())
        {
            return \Kavro\Framework::createTaxonomyOptions($id, $args);
        }
        public static function createProfileOptions($id, $args = array())
        {
            return \Kavro\Framework::createProfileOptions($id, $args);
        }
        public static function createNavMenuOptions($id, $args = array())
        {
            return \Kavro\Framework::createNavMenuOptions($id, $args);
        }
        public static function createWidgetOptions($id, $args = array())
        {
            return \Kavro\Framework::createWidgetOptions($id, $args);
        }
        public static function createCommentOptions($id, $args = array())
        {
            return \Kavro\Framework::createCommentOptions($id, $args);
        }
        public static function createShortcode($id, $args = array())
        {
            return \Kavro\Framework::createShortcode($id, $args);
        }
    }
}


/**
 * Load plugin translations at init or later.
 *
 * WordPress 6.7+ warns when translations are requested before `init`.
 * Keeping textdomain loading here prevents early just-in-time translation notices.
 *
 * @return void
 */
function kavro_load_textdomain()
{
    load_plugin_textdomain('kavro-framework', false, dirname(plugin_basename(KAVRO_FILE)) . '/languages');
}
add_action('init', 'kavro_load_textdomain', 0);

/**
 * Register the Kavro runtime hooks.
 *
 * The runtime creates option/metabox instances on `init` priority 20. Demo files
 * are loaded on `init` priority 10 below, so they always register their
 * containers and sections before instances are built. This keeps translations
 * safe for WordPress 6.7+ and fixes empty option panels caused by late demos.
 */
add_action('plugins_loaded', array('KAVRO', 'boot'));
