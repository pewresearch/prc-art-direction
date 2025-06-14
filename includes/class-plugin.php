<?php
/**
 * Plugin class.
 *
 * @package    PRC\Platform\Art_Direction
 */

namespace PRC\Platform\Art_Direction;

use WP_Error;

/**
 * Plugin class.
 *
 * @package    PRC\Platform\Art_Direction
 */
class Plugin {
	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Post meta key for art direction data.
	 *
	 * @TODO: change this to snake case art_direction
	 *
	 * @var string
	 */
	public static $post_meta_key = 'artDirection';

	/**
	 * Schema for art direction field properties.
	 *
	 * @var (string|(string|null)[][])[]|(string|(string|null)[][]|(string[]|(string|false)[])[][][])[]
	 */
	public static $field_properties = array(
		'id'       => array(
			'type' => 'integer',
		),
		'rawUrl'   => array(
			'type' => 'string',
		),
		'url'      => array(
			'type' => 'string',
		),
		'width'    => array(
			'type' => 'integer',
		),
		'height'   => array(
			'type' => 'integer',
		),
		// "Chart Art" is a special case where we want art to have a border around it, usually a chart with a white background.
		// @TODO: look into a programattic way to determine contrast ratio when setting the image and then set this to true if the contrast ratio is too low, also, perhaps rename this to "hasBorder" or something a little more descriptive.
		'chartArt' => array(
			'type' => 'boolean',
			// 'default' => false,
		),
		'caption'  => array(
			'type' => 'string',
		),
	);
	/**
	 * Schema for pewresearch.org art direction.
	 * A1, A2, A3, A4, facebook, and twitter are all specific contexts that appear in our blocks and themes. They are not arbitrary. Your mileage may vary.
	 *
	 * @var (string|(string|null)[][])[]|(string|(string|null)[][]|(string[]|(string|false)[])[][][])[]
	 */
	public static $field_schema = array(
		'type'       => 'object',
		'properties' => array(
			'A1'       => array(
				'type'       => 'object',
				'properties' => null,
			),
			'A2'       => array(
				'type'       => 'object',
				'properties' => null,
			),
			'A3'       => array(
				'type'       => 'object',
				'properties' => null,
			),
			'A4'       => array(
				'type'       => 'object',
				'properties' => null,
			),
			'XL'       => array(
				'type'       => 'object',
				'properties' => null,
			),
			'facebook' => array(
				'type'       => 'object',
				'properties' => null,
			),
			'twitter'  => array(
				'type'       => 'object',
				'properties' => null,
			),
		),
	);

	/**
	 * Define the core functionality of the platform as initialized by hooks.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		$this->version     = '1.0.0';
		$this->plugin_name = 'prc-art-direction';

		// Construct schema and field properties for each image size.
		$constructed_schema = self::$field_schema;
		foreach ( $constructed_schema['properties'] as $image_size => $schema ) {
			$constructed_schema['properties'][ $image_size ]['properties'] = self::$field_properties;
		}
		self::$field_schema = $constructed_schema;

		$this->load_dependencies();
		$this->init_dependencies();
	}


	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {
		// Load plugin loading class.
		require_once plugin_dir_path( __DIR__ ) . '/includes/class-loader.php';

		// Initialize the loader.
		$this->loader = new Loader();

		require_once plugin_dir_path( __DIR__ ) . '/includes/class-api.php';
		require_once plugin_dir_path( __DIR__ ) . '/includes/class-rest-api.php';
		require_once plugin_dir_path( __DIR__ ) . '/includes/inspector-sidebar-panel/class-inspector-sidebar-panel.php';
		require_once plugin_dir_path( __DIR__ ) . '/includes/core-post-featured-image/class-core-post-featured-image.php';
	}

	/**
	 * Get the enabled post types.
	 *
	 * @since 1.0.0
	 * @return string[]
	 */
	public static function get_enabled_post_types() {
		return apply_filters( 'prc_platform__art_direction_enabled_post_types', array( 'post' ) );
	}

	/**
	 * Initialize the dependencies.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function init_dependencies() {
		$this->loader->add_action( 'init', $this, 'register_post_meta' );
		$this->loader->add_filter( 'register_post_type_args', $this, 'change_featured_image_label', 100, 2 );
		$this->loader->add_filter( 'wpseo_opengraph_image', $this, 'filter_facebook_image', 10, 1 );
		$this->loader->add_filter( 'wpseo_twitter_image', $this, 'filter_twitter_image', 10, 1 );

		new Rest_API( $this->loader );
		new Inspector_Sidebar_Panel( $this->loader );
		new Core_Post_Featured_Image( $this->loader );
	}

	/**
	 * Register the post meta.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function register_post_meta() {
		// Register artDirection post meta for each enabled post type.
		foreach ( self::get_enabled_post_types() as $post_type ) {
			register_post_meta(
				$post_type,
				self::$post_meta_key,
				array(
					'single'        => true,
					'type'          => 'object',
					'show_in_rest'  => array(
						'schema' => self::$field_schema,
					),
					'auth_callback' => function () {
						return current_user_can( 'edit_posts' );
					},
				)
			);
		}
	}

	/**
	 * Change the featured image label.
	 *
	 * @hook register_post_type_args
	 *
	 * @param array  $args The post type arguments.
	 * @param string $post_type The post type.
	 * @return array The post type arguments.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function change_featured_image_label( $args, $post_type ) {
		if ( ! in_array( $post_type, self::get_enabled_post_types(), true ) ) {
			return $args;
		}
		$new_labels = array();
		if ( array_key_exists( 'labels', $args ) ) {
			$labels                              = $args['labels'];
			$new_labels['featured_image']        = 'Art Direction';
			$new_labels['set_featured_image']    = 'Set art direction image (A1)';
			$new_labels['remove_featured_image'] = 'Remove art direction (A1) image';
			$new_labels['use_featured_image']    = 'Use as art direction (A1) image';
		}
		if ( ! empty( $new_labels ) ) {
			$args['labels'] = array_merge( $labels, $new_labels );
		}
		return $args;
	}

	/**
	 * Filter the facebook image.
	 *
	 * @hook wpseo_opengraph_image
	 * @param string $img The image URL.
	 * @return string The image URL.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function filter_facebook_image( $img ) {
		if ( ! is_singular() ) {
			return $img;
		}
		global $post;
		$api = new API( $post->ID );
		$art = $api->get( 'facebook' );
		if ( false === $art ) {
			return $img;
		}
		return $art['url'];
	}

	/**
	 * Filter the twitter image.
	 *
	 * @hook wpseo_twitter_image
	 * @param string $img The image URL.
	 * @return string The image URL.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function filter_twitter_image( $img ) {
		if ( ! is_singular() ) {
			return $img;
		}
		global $post;
		$api = new API( $post->ID );
		$art = $api->get( 'twitter' );
		if ( false === $art ) {
			return $img;
		}
		return $art['url'];
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    PRC\Platform\Art_Direction\Loader
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}
}
