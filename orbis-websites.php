<?php
/*
Plugin Name: Orbis Websites
Plugin URI: https://www.pronamic.eu/plugins/orbis-websites/
Description: The Orbis Websites plugin extends your Orbis environment with the option to manage websites.

Version: 1.0.0
Requires at least: 3.5

Author: Pronamic
Author URI: https://www.pronamic.eu/

Text Domain: orbis-websites
Domain Path: /languages/

License: Copyright (c) Pronamic

GitHub URI: https://github.com/wp-orbis/wp-orbis-websites
*/

function orbis_websites_bootstrap() {
	// Classes
	require_once 'classes/orbis-websites-plugin.php';

	// Initialize
	global $orbis_websites_plugin;

	$orbis_websites_plugin = new Orbis_Websites_Plugin( __FILE__ );
}

add_action( 'orbis_bootstrap', 'orbis_websites_bootstrap' );
