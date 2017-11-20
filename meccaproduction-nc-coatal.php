<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              meccaproduction-nc-coatal
 * @since             1.0.0
 * @package           Meccaproduction_Nc_Coatal
 *
 * @wordpress-plugin
 * Plugin Name:       Mecca Production - NC Coastal
 * Plugin URI:        meccaproduction-nc-coatal
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Mecca Production 
 * Author URI:        meccaproduction-nc-coatal
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       meccaproduction-nc-coatal
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-meccaproduction-nc-coatal-activator.php
 */
function activate_meccaproduction_nc_coatal() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-meccaproduction-nc-coatal-activator.php';
	Meccaproduction_Nc_Coatal_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-meccaproduction-nc-coatal-deactivator.php
 */
function deactivate_meccaproduction_nc_coatal() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-meccaproduction-nc-coatal-deactivator.php';
	Meccaproduction_Nc_Coatal_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_meccaproduction_nc_coatal' );
register_deactivation_hook( __FILE__, 'deactivate_meccaproduction_nc_coatal' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-meccaproduction-nc-coatal.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_meccaproduction_nc_coatal() {

	$plugin = new Meccaproduction_Nc_Coatal();
	$plugin->run();

}
run_meccaproduction_nc_coatal();
