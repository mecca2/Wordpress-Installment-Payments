<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       meccaproduction-nc-coatal
 * @since      1.0.0
 *
 * @package    Meccaproduction_Nc_Coatal
 * @subpackage Meccaproduction_Nc_Coatal/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Meccaproduction_Nc_Coatal
 * @subpackage Meccaproduction_Nc_Coatal/includes
 * @author     Mecca Production  <contact@meccaproduction.com>
 */
class Meccaproduction_Nc_Coatal_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'meccaproduction-nc-coatal',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
