<?php
/**
 * PRC Art Direction
 *
 * @package           PRC_Art_Direction
 * @author            Seth Rubenstein
 * @copyright         2024 Pew Research Center
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       PRC Art Direction
 * Plugin URI:        https://github.com/pewresearch/prc-art-direction
 * Description:       A featured image takeover for PRC Platform. This replaces the default featured image functionality with a system that allows multiple featured images to be set based on template context.
 * Version:           1.0.0
 * Requires at least: 6.7
 * Requires PHP:      8.2
 * Author:            Seth Rubenstein
 * Author URI:        https://pewresearch.org
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       prc-art-direction
 * Requires Plugins:  prc-platform-core
 */

namespace PRC\Platform\Art_Direction;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'PRC_ART_DIRECTION_FILE', __FILE__ );
define( 'PRC_ART_DIRECTION_DIR', __DIR__ );
define( 'PRC_ART_DIRECTION_URL', plugin_dir_url( __FILE__ ) );
define( 'PRC_ART_DIRECTION_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-activator.php
 */
function activate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-plugin-activator.php';
	Plugin_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-deactivator.php
 */
function deactivate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-plugin-deactivator.php';
	Plugin_Deactivator::deactivate();
}

register_activation_hook( __FILE__, '\PRC\Platform\Art_Direction\activate' );
register_deactivation_hook( __FILE__, '\PRC\Platform\Art_Direction\deactivate' );

/**
 * Helper utilities
 */
require plugin_dir_path( __FILE__ ) . 'includes/utils.php';

/**
 * The core plugin class that is used to define the hooks that initialize the various components.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-plugin.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_prc_art_direction() {
	$plugin = new Plugin();
	$plugin->run();
}
run_prc_art_direction();
