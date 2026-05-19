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

if ( ! defined( 'ABSPATH' ) ) { exit; }

define( 'KAVRO_VERSION', '1.0.0' );
define( 'KAVRO_FILE', __FILE__ );
define( 'KAVRO_PATH', plugin_dir_path( __FILE__ ) );
define( 'KAVRO_URL', plugin_dir_url( __FILE__ ) );

$kavro_autoload = KAVRO_PATH . 'vendor/autoload.php';
if ( file_exists( $kavro_autoload ) ) {
    require_once $kavro_autoload;
} else {
    spl_autoload_register( function( $class ) {
        $maps = array(
            'Kavro\\Fields\\' => KAVRO_PATH . 'fields/',
            'Kavro\\'         => KAVRO_PATH . 'classes/',
        );
        foreach ( $maps as $prefix => $base ) {
            if ( 0 !== strpos( $class, $prefix ) ) { continue; }
            $relative = substr( $class, strlen( $prefix ) );
            $file = $base . str_replace( '\\', '/', $relative ) . '.php';
            if ( file_exists( $file ) ) { require_once $file; }
            return;
        }
    } );
}

require_once KAVRO_PATH . 'includes/functions.php';

if ( ! class_exists( 'KAVRO' ) ) {
    final class KAVRO {
        public static function boot() { return \Kavro\Framework::boot(); }
        public static function createOptions( $id, $args = array() ) { return \Kavro\Framework::createOptions( $id, $args ); }
        public static function createSection( $id, $section ) { return \Kavro\Framework::createSection( $id, $section ); }
        public static function createCustomizeOptions( $id, $args = array() ) { return \Kavro\Framework::createCustomizeOptions( $id, $args ); }
        public static function createMetabox( $id, $args = array() ) { return \Kavro\Framework::createMetabox( $id, $args ); }
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
function kavro_load_textdomain() {
    load_plugin_textdomain( 'kavro-framework', false, dirname( plugin_basename( KAVRO_FILE ) ) . '/languages' );
}
add_action( 'init', 'kavro_load_textdomain', 0 );

/**
 * Load local development demos.
 *
 * These demo files are included only for easy testing while Kavro is under
 * development. Remove or comment this callback before a production release.
 *
 * @return void
 */
function kavro_load_development_demos() {
    require_once KAVRO_PATH . 'examples/options-demo.php';
    require_once KAVRO_PATH . 'examples/metabox-demo.php';
}
add_action( 'init', 'kavro_load_development_demos', 5 );

add_action( 'plugins_loaded', array( 'KAVRO', 'boot' ) );
