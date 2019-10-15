<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           Flexi_WP_Ajax_Aid
 *
 * @wordpress-plugin
 * Plugin Name:       Flexi WP Ajax Aid
 * Plugin URI:        #
 * Description:       This plugin helps you setup page content with enhanced ajax loading support through shortcodes.
 * Version:           1.0.0
 * Author:            Eldorjon Juraev
 * Author URI:        #
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       flexi-wp-ajax-aid
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'Flexi_WP_Ajax_Aid_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-flexi-wp-ajax-aid-activator.php
 */
function activate_Flexi_WP_Ajax_Aid() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-flexi-wp-ajax-aid-activator.php';
	Flexi_WP_Ajax_Aid_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-flexi-wp-ajax-aid-deactivator.php
 */
function deactivate_Flexi_WP_Ajax_Aid() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-flexi-wp-ajax-aid-deactivator.php';
	Flexi_WP_Ajax_Aid_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_Flexi_WP_Ajax_Aid' );
register_deactivation_hook( __FILE__, 'deactivate_Flexi_WP_Ajax_Aid' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-flexi-wp-ajax-aid.php';

/**
 * The core plugin functions
 */
require plugin_dir_path( __FILE__ ) . 'includes/flexi-wp-ajax-aid-functions.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_Flexi_WP_Ajax_Aid() {

	$plugin = new Flexi_WP_Ajax_Aid();
	$plugin->run();

}
run_Flexi_WP_Ajax_Aid();
