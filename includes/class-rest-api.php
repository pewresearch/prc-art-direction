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
					'schema'          => Plugin::$field_schema,
					'get_callback'    => array( $this, 'get_art_for_field' ),
					'update_callback' => array( $this, 'update_art_for_field' ),
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
	 * Migrates legacy facebook/twitter keys to social on read so the editor
	 * displays the correct state.
	 *
	 * @param array $object The post object array.
	 * @return array|false The art direction data or false if not found.
	 */
	public function get_art_for_field( $object ) {
		$post_id       = $object['id'];
		$api           = new API( $post_id );
		$art_direction = $api->get( 'all' );

		// Migrate legacy keys on read so the editor sees the correct state.
		if ( is_array( $art_direction ) ) {
			$art_direction = $this->migrate_social_keys( $art_direction );
		}

		return $art_direction;
	}

	/**
	 * Sanitize an individual image slot value.
	 *
	 * @param array $slot The image slot data.
	 * @return array The sanitized slot data.
	 */
	private function sanitize_image_slot( $slot ) {
		return array(
			'id'       => isset( $slot['id'] ) ? absint( $slot['id'] ) : 0,
			'rawUrl'   => isset( $slot['rawUrl'] ) ? esc_url_raw( $slot['rawUrl'] ) : '',
			'url'      => isset( $slot['url'] ) ? esc_url_raw( $slot['url'] ) : '',
			'width'    => isset( $slot['width'] ) ? absint( $slot['width'] ) : 0,
			'height'   => isset( $slot['height'] ) ? absint( $slot['height'] ) : 0,
			'chartArt' => isset( $slot['chartArt'] ) ? (bool) $slot['chartArt'] : false,
			'caption'  => isset( $slot['caption'] ) ? sanitize_text_field( $slot['caption'] ) : '',
		);
	}

	/**
	 * Migrate legacy facebook/twitter keys to social.
	 *
	 * If the data has 'facebook' or 'twitter' but no 'social', migrate 'facebook' to 'social'.
	 * Then remove the legacy keys.
	 *
	 * @param array $value The art direction data.
	 * @return array The migrated data.
	 */
	private function migrate_social_keys( $value ) {
		if ( ! is_array( $value ) ) {
			return $value;
		}

		// If 'social' doesn't exist but 'facebook' does, migrate it.
		if ( ! isset( $value['social'] ) && isset( $value['facebook'] ) && is_array( $value['facebook'] ) ) {
			$value['social'] = $value['facebook'];
		}

		// Remove legacy keys.
		unset( $value['facebook'], $value['twitter'] );

		return $value;
	}

	/**
	 * Update the art direction for the given post.
	 *
	 * @param array    $value   The art direction data to save.
	 * @param \WP_Post $post    The post object.
	 * @param string   $field   The field name.
	 * @return int|bool Meta ID on success, true if no change, false on failure.
	 */
	public function update_art_for_field( $value, $post, $field ) {
		if ( ! current_user_can( 'edit_post', $post->ID ) ) {
			return false;
		}

		// Migrate legacy facebook/twitter keys to social.
		$value = $this->migrate_social_keys( $value );

		// Sanitize the value - ensure it's an array with valid keys.
		$allowed_keys = array( 'A1', 'A2', 'A3', 'A4', 'XL', 'social' );
		$sanitized    = array();

		if ( is_array( $value ) ) {
			foreach ( $allowed_keys as $key ) {
				if ( isset( $value[ $key ] ) && is_array( $value[ $key ] ) ) {
					$sanitized[ $key ] = $this->sanitize_image_slot( $value[ $key ] );
				}
			}
		}

		return update_post_meta( $post->ID, Plugin::$post_meta_key, $sanitized );
	}
}
