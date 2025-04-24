<?php
/**
 * REST API
 *
 * @package PRC\Platform\Art_Direction
 */

namespace PRC\Platform\Art_Direction;

use WP_REST_Request;

/**
 * REST API
 *
 * @package PRC\Platform\Art_Direction
 */
class Rest_API {

	/**
	 * Constructor.
	 *
	 * @param \PRC\Platform\Loader $loader The loader.
	 */
	public function __construct( $loader ) {
		$loader->add_action( 'rest_api_init', $this, 'register_art_direction_rest_field' );
		$loader->add_filter( 'prc_api_endpoints', $this, 'register_endpoint' );
	}

	/**
	 * Register a field for artDirection on supported post types in the REST API.
	 *
	 * @hook rest_api_init
	 * @return void
	 */
	public function register_art_direction_rest_field() {
		foreach ( Plugin::get_enabled_post_types() as $post_type ) {
			register_rest_field(
				$post_type,
				'art_direction',
				array(
					'schema'        => null,
					'get_callback'  => array( $this, 'get_art_for_field' ),
					'auth_callback' => function () {
						return current_user_can( 'read' );
					},
				)
			);
		}
	}

	/**
	 * Register the art direction endpoint.
	 *
	 * @hook prc_api_endpoints
	 * @param mixed $endpoints The endpoints.
	 * @return array The endpoints.
	 */
	public function register_endpoint( $endpoints ) {
		array_push(
			$endpoints,
			array(
				'route'               => '/art-direction/get/(?P<post_id>\d+)',
				'methods'             => 'GET',
				'callback'            => array( $this, 'restfully_get_art' ),
				'permission_callback' => function () {
					return true;
				},
			)
		);
		return $endpoints;
	}

	/**
	 * Get the art for the given post ID from the REST API.
	 *
	 * @param \WP_REST_Request $request The request.
	 * @return \WP_REST_Response
	 */
	public function restfully_get_art( WP_REST_Request $request ) {
		$post_id = $request->get_param( 'post_id' );
		$api     = new API( $post_id );
		return $api->get( 'all' );
	}

	/**
	 * Get the art for the given post ID for field.
	 *
	 * @param \WP_REST_Request $request The request.
	 * @return \WP_REST_Response
	 */
	public function get_art_for_field( $object ) {
		$post_id = $object['id'];
		$api     = new API( $post_id );
		return $api->get( 'all' );
	}
}
