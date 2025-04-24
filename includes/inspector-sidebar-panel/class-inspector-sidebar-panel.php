<?php
/**
 * Inspector Sidebar Panel
 *
 * @package PRC\Platform\Art_Direction
 */
namespace PRC\Platform\Art_Direction;

use WP_Error;

/**
 * Inspector Sidebar Panel
 *
 * @package PRC\Platform\Art_Direction
 */
class Inspector_Sidebar_Panel {

	/**
	 * Handle for the inspector sidebar panel editor assets.
	 *
	 * @var string
	 */
	protected static $handle = 'prc-art-direction-inspector-sidebar-panel';

	/**
	 * Constructor.
	 *
	 * @param \PRC\Platform\Loader $loader The loader.
	 */
	public function __construct( $loader ) {
		$loader->add_action( 'enqueue_block_editor_assets', $this, 'enqueue_block_plugin_assets' );
	}

	/**
	 * Register the block plugin assets.
	 */
	public function register_block_plugin_assets() {
		$asset_file = include plugin_dir_path( __FILE__ ) . 'build/index.asset.php';
		$asset_slug = self::$handle;
		$script_src = PRC_ART_DIRECTION_DIR . '/includes/inspector-sidebar-panel/build/index.js';
		$style_src  = PRC_ART_DIRECTION_DIR . '/includes/inspector-sidebar-panel/build/style-index.css';

		$script = wp_register_script(
			$asset_slug,
			$script_src,
			$asset_file['dependencies'],
			$asset_file['version'],
			true
		);

		$style = wp_register_style(
			$asset_slug,
			$style_src,
			array(),
			$asset_file['version']
		);

		if ( ! $script || ! $style ) {
			return new WP_Error( 'prc-platform-art-direction', 'Failed to register all assets' );
		}

		return true;
	}

	/**
	 * Enqueue the block plugin assets.
	 */
	public function enqueue_block_plugin_assets() {
		$registered       = $this->register_block_plugin_assets();
		$screen_post_type = \PRC\Platform\get_wp_admin_current_post_type();
		if ( ! $screen_post_type || ! in_array( $screen_post_type, Plugin::get_enabled_post_types(), true ) ) {
			return;
		}
		if ( is_admin() && ! is_wp_error( $registered ) ) {
			wp_enqueue_script( self::$handle );
			wp_enqueue_style( self::$handle );
		}
	}
}
