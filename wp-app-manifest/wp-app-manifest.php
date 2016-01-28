<?php
/*
Plugin Name: Web App Manifest
Plugin URI: https://github.com/marco-c/wp-app-manifest
Description: Generate a Web App Manifest for your website.
Version: 0.0.1
Author: Mozilla
Author URI: https://www.mozilla.org/
License: GPLv2 or later
Text Domain: wpappmanifest
*/

load_plugin_textdomain('wpappmanifest', false, dirname(plugin_basename(__FILE__)) . '/lang');

require_once(plugin_dir_path(__FILE__) . 'wp-app-manifest-main.php');
require_once(plugin_dir_path(__FILE__) . 'wp-app-manifest-db.php');

WebAppManifest_Main::init();

if (is_admin()) {
  require_once(plugin_dir_path(__FILE__) . 'wp-app-manifest-admin.php');
  WebAppManifest_Admin::init();
}

register_activation_hook(__FILE__, array('WebAppManifest_DB', 'on_activate'));
register_deactivation_hook(__FILE__, array('WebAppManifest_DB', 'on_deactivate'));
register_uninstall_hook(__FILE__, array('WebAppManifest_DB', 'on_uninstall'));

?>
