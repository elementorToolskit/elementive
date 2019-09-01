<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://dimative.com
 * @since             1.0.0
 * @package           Elementive
 *
 * @wordpress-plugin
 * Plugin Name:       Elementive
 * Plugin URI:        https://dimative.com/elementive
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Dimative
 * Author URI:        https://dimative.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       elementive
 * Domain Path:       /languages
 */

namespace Elementive;

use Elementive\Includes\Elementive;
use Elementive\Includes\Elementive_Activator;
use Elementive\Includes\Elementive_Deactivator;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once plugin_dir_path( __FILE__ ) . 'lib/autoload.php';


/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'ELEMENTIVE_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-elementive-activator.php
 */
function activate_elementive() {
	Elementive_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-elementive-deactivator.php
 */
function deactivate_elementive() {
	Elementive_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_elementive' );
register_deactivation_hook( __FILE__, 'deactivate_elementive' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_elementive() {

	$plugin = new Elementive();
	$plugin->run();

}
run_elementive();
