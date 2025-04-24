<?php
/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    PRC\Platform\Art_Direction
 */
namespace PRC\Platform\Art_Direction;

use DEFAULT_TECHNICAL_CONTACT;

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 */
class Plugin_Activator {

	/**
	 * Activates the plugin.
	 *
	 * @since 1.0.0
	 */
	public static function activate() {
		flush_rewrite_rules();

		wp_mail(
			DEFAULT_TECHNICAL_CONTACT,
			'PRC Art Direction Activated',
			'The PRC Art Direction plugin has been activated on ' . get_site_url()
		);
	}
}
