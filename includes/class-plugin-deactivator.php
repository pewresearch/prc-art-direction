<?php
/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    PRC\Platform\Art_Direction
 */
namespace PRC\Platform\Art_Direction;

use DEFAULT_TECHNICAL_CONTACT;

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 */
class Plugin_Deactivator {

	/**
	 * Deactivates the plugin.
	 *
	 * @since 1.0.0
	 */
	public static function deactivate() {
		flush_rewrite_rules();

		wp_mail(
			DEFAULT_TECHNICAL_CONTACT,
			'PRC Art Direction Deactivated',
			'The PRC Art Direction plugin has been deactivated on ' . get_site_url()
		);
	}
}
