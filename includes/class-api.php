<?php
/**
 * API
 *
 * @package PRC\Platform\Art_Direction
 */
namespace PRC\Platform\Art_Direction;

/**
 * API
 *
 * @package PRC\Platform\Art_Direction
 */
class API {
	/**
	 * Post ID.
	 *
	 * @var int
	 */
	protected $post_id;

	/**
	 * Art direction data.
	 *
	 * @var array|false
	 */
	protected $art_direction_data = false;

	/**
	 * Constructor.
	 *
	 * @param int $post_id The post ID.
	 */
	public function __construct( $post_id ) {
		$this->post_id = $post_id;
		if ( ! is_int( $this->post_id ) ) {
			return;
		}
		
		// Get the post type.
		$post_type = get_post_type( $this->post_id );
		
		// Quick check to make sure we're only utilizing this on allowed post types.
		if ( ! in_array( $post_type, Plugin::get_enabled_post_types() ) ) {
			return;
		}

		// If this is a child post then we'll set the ID property to the parent post ID.
		$parent_post_id = wp_get_post_parent_id( $this->post_id );
		if ( 0 !== $parent_post_id ) {
			$this->post_id = $parent_post_id;
		}
		
		// Check for new post meta key artDirection.
		$all_art = get_post_meta( $this->post_id, Plugin::$post_meta_key, true );
		if ( ! $all_art ) {
			// Check for fallback image, fallback_to_featured_image will return false explicitly.
			$all_art = $this->get_fallback_featured_image();
		}

		if ( false === $all_art ) {
			return;
		}

		$this->art_direction_data = $all_art;
	}

	/**
	 * Constructs a image array based off the art direction data schema for featured images (fallback).
	 *
	 * @param int    $post_thumbnail_id The post thumbnail ID.
	 * @param string $image_size The image size.
	 * @param array  $full The full image.
	 * @return array
	 */
	private function get_fallback_img( $post_thumbnail_id, $image_size, $full ) {
		$img = wp_get_attachment_image_src( $post_thumbnail_id, $image_size );
		return array(
			'id'       => $post_thumbnail_id,
			'rawUrl'   => $full[0],
			'url'      => $img[0],
			'width'    => $img[1],
			'height'   => $img[2],
			'chartArt' => false,
		);
	}

	/**
	 * Get the fallback art.
	 *
	 * @return array
	 */
	private function get_fallback_art() {
		$post_thumbnail_id = get_post_meta( $this->post_id, '_thumbnail_id', true );
		if ( ! $post_thumbnail_id ) {
			return false;
		}
		$full = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
		return array(
			'A1'       => $this->get_fallback_img( $post_thumbnail_id, 'A1', $full ),
			'A2'       => $this->get_fallback_img( $post_thumbnail_id, 'A2', $full ),
			'A3'       => $this->get_fallback_img( $post_thumbnail_id, 'A3', $full ),
			'A4'       => $this->get_fallback_img( $post_thumbnail_id, 'A4', $full ),
			'XL'       => $this->get_fallback_img( $post_thumbnail_id, 'XL', $full ),
			'facebook' => $this->get_fallback_img( $post_thumbnail_id, 'facebook', $full ),
			'twitter'  => $this->get_fallback_img( $post_thumbnail_id, 'twitter', $full ),
		);
	}

	/**
	 * Get the fallback featured image.
	 *
	 * @return array
	 */
	private function get_fallback_featured_image() {
		return $this->get_fallback_art();
	}

	/**
	 * Gets art direction asset(s) for a post.
	 *
	 * @param string $size either 'all', 'A1', 'A2', 'A3', 'A4', 'XL', 'facebook', or 'twitter' (default: 'all').
	 * @return array|false Returns the art direction data or false if the size is not allowed or no data is found.
	 */
	public function get( $size = 'all' ) {
		// Check the size being retrieved is allowed.
		if ( ! in_array( $size, array( 'all', 'A1', 'A2', 'A3', 'A4', 'XL', 'facebook', 'twitter' ) ) ) {
			return;
		}

		if ( 'all' === $size ) {
			return $this->art_direction_data;
		} elseif ( is_array( $this->art_direction_data ) && array_key_exists( $size, $this->art_direction_data ) ) {
			return $this->art_direction_data[ $size ];
		} else {
			return false;
		}
	}
}
