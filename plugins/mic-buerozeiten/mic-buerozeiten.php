<?php

/**
 * Mic-Buerozeiten: Let you configure a widget with office opening times.
 *
 * @link              https://github.com/MicMun/wordpress_bauvereinigung_naila/plugins/mic-buerozeiten
 * @since             1.0.0
 * @package           mic-buerozeiten
 *
 * @wordpress-plugin
 * Plugin Name:       Mic Bürozeiten
 * Plugin URI:        https://github.com/MicMun/wordpress_bauvereinigung_naila/plugins/mic-buerozeiten/
 * Description:       Let you configure a widget with office opening times.
 * Version:           1.1.0
 * Author:            Michael Munzert
 * Author URI:        https://github.com/MicMun
 * License:           GPL3
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       mic-buerozeiten
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
define( 'MIC_BUEROZEITEN_VERSION', '1.1.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-mic-buerozeiten-activator.php
 */
function activate_mic_buerozeiten() {
   require_once plugin_dir_path( __FILE__ ) . 'includes/class-mic-buerozeiten-activator.php';
   Mic_Buerozeiten_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-mic-buerozeiten-deactivator.php
 */
function deactivate_mic_buerozeiten() {
   require_once plugin_dir_path( __FILE__ ) . 'includes/class-mic-buerozeiten-deactivator.php';
   Mic_Buerozeiten_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_mic_buerozeiten' );
register_deactivation_hook( __FILE__, 'deactivate_mic_buerozeiten' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-mic-buerozeiten.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_mic_buerozeiten() {

   $plugin = new MicBuerozeiten();
   $plugin->run();

}
run_mic_buerozeiten();

?>
