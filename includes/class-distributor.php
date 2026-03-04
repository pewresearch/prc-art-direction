<?php
/**
 * Distributor Integration
 *
 * Provides Distributor support for art direction, enabling automatic remapping
 * of attachment IDs and URLs when content is distributed.
 *
 * @package PRC\Platform\Art_Direction
 */

declare(strict_types=1);

namespace PRC\Platform\Art_Direction;

use WP_Error;

/**
 * Distributor Integration class.
 *
 * Handles ID remapping for the artDirection meta field which stores
 * attachment IDs in a nested object structure with slots (A1, A2, A3, A4, XL, social).
 *
 * @package PRC\Platform\Art_Direction
 */
class Distributor {
	/**
	 * The art direction slots that may contain attachment IDs.
	 *
	 * @var array
	 */
	private static array $slots = array( 'A1', 'A2', 'A3', 'A4', 'XL', 'social' );

	/**
	 * Construct the Distributor integration class.
	 *
	 * @param mixed $loader The loader instance.
	 */
	public function __construct( $loader = null ) {
		$this->init( $loader );
	}

	/**
	 * Initialize hooks.
	 *
	 * @param mixed $loader The loader instance.
	 */
	public function init( $loader = null ): void {
		if ( null !== $loader ) {
			// Register data handlers on init (after Distributor loads).
			$loader->add_action( 'init', $this, 'register_distributor_data', 20 );
		}
	}

	/**
	 * Check if the Distributor plugin is active.
	 *
	 * @return bool True if Distributor is active.
	 */
	public static function is_distributor_active(): bool {
		return function_exists( 'distributor_register_data' );
	}

	/**
	 * Register custom data handler with Distributor.
	 *
	 * @hook init
	 */
	public function register_distributor_data(): void {
		if ( ! self::is_distributor_active() ) {
			return;
		}

		// Register handler for artDirection meta.
		distributor_register_data(
			'prc_art_direction',
			array(
				'location'           => 'post_meta',
				'attributes'         => array( 'meta_key' => Plugin::$post_meta_key ),
				'pre_distribute_cb'  => array( self::class, 'pre_distribute' ),
				'post_distribute_cb' => array( self::class, 'post_distribute' ),
			)
		);
	}

	/**
	 * Pre-distribute callback for artDirection meta.
	 *
	 * Collects attachment data for each slot's attachment ID using
	 * Distributor's built-in media pre-distribute callback.
	 *
	 * @param mixed $meta_value     The meta value (artDirection object).
	 * @param int   $source_post_id The source post ID.
	 * @return array Extra data for each slot's attachment.
	 */
	public static function pre_distribute( $meta_value, int $source_post_id ): array {
		if ( empty( $meta_value ) || ! is_array( $meta_value ) ) {
			return array();
		}

		$extra_data = array();

		foreach ( self::$slots as $slot ) {
			if ( empty( $meta_value[ $slot ] ) || empty( $meta_value[ $slot ]['id'] ) ) {
				continue;
			}

			$attachment_id = (int) $meta_value[ $slot ]['id'];

			// Use Distributor's built-in media pre-distribute callback.
			if ( function_exists( 'distributor_media_pre_distribute_callback' ) ) {
				$media_data = distributor_media_pre_distribute_callback( $attachment_id, $source_post_id );
			} else {
				// Fallback: collect basic attachment data.
				$media_data = array(
					'source_attachment_id' => $attachment_id,
					'url'                  => wp_get_attachment_url( $attachment_id ),
				);
			}

			if ( ! empty( $media_data ) ) {
				$extra_data[ $slot ] = $media_data;
			}
		}

		return $extra_data;
	}

	/**
	 * Post-distribute callback for artDirection meta.
	 *
	 * Remaps attachment IDs and updates URLs for each slot using
	 * Distributor's built-in media post-distribute callback.
	 *
	 * @param array $extra_data      The extra data from pre-distribute.
	 * @param mixed $original_meta   The original meta value.
	 * @param array $post_data       The post data being distributed.
	 * @param array $connection_data The connection data (unused but required by interface).
	 * @return mixed The updated meta value with remapped IDs and URLs.
	 */
	public static function post_distribute( array $extra_data, $original_meta, array $post_data, array $connection_data = array() ) {
		if ( empty( $original_meta ) || ! is_array( $original_meta ) ) {
			return $original_meta;
		}

		$updated_meta = $original_meta;

		foreach ( self::$slots as $slot ) {
			// Skip if slot doesn't exist or has no ID.
			if ( empty( $original_meta[ $slot ] ) || empty( $original_meta[ $slot ]['id'] ) ) {
				continue;
			}

			$source_id  = (int) $original_meta[ $slot ]['id'];
			$slot_extra = $extra_data[ $slot ] ?? array();

			// Use Distributor's built-in media post-distribute callback.
			if ( ! empty( $slot_extra ) && function_exists( 'distributor_media_post_distribute_callback' ) ) {
				$new_id = distributor_media_post_distribute_callback(
					$slot_extra,
					$source_id,
					$post_data
				);

				if ( $new_id && ! is_wp_error( $new_id ) && is_numeric( $new_id ) ) {
					$new_id = (int) $new_id;

					// Update the slot with the new attachment ID.
					$updated_meta[ $slot ]['id'] = $new_id;

					// Update the URLs to point to the new attachment.
					$new_url = wp_get_attachment_url( $new_id );
					if ( $new_url ) {
						$updated_meta[ $slot ]['rawUrl'] = $new_url;
					}

				// Get the sized URL based on the slot.
				$size      = self::get_image_size_for_slot( $slot );
				$sized_url = wp_get_attachment_image_url( $new_id, $size );
					if ( $sized_url ) {
						$updated_meta[ $slot ]['url'] = $sized_url;
					}

					// Update width and height from the new attachment.
					$image_meta = wp_get_attachment_metadata( $new_id );
					if ( ! empty( $image_meta['width'] ) ) {
						$updated_meta[ $slot ]['width'] = (int) $image_meta['width'];
					}
					if ( ! empty( $image_meta['height'] ) ) {
						$updated_meta[ $slot ]['height'] = (int) $image_meta['height'];
					}
				}
			}
		}

		return $updated_meta;
	}

	/**
	 * Get the appropriate image size for a slot.
	 *
	 * @param string $slot The slot name (A1, A2, etc.).
	 * @return string The WordPress image size to use.
	 */
	private static function get_image_size_for_slot( string $slot ): string {
		// Map slots to appropriate image sizes.
		// These should match the sizes used by the art direction system.
		$size_map = array(
			'A1'     => 'full',
			'A2'     => 'large',
			'A3'     => 'medium_large',
			'A4'     => 'medium',
			'XL'     => 'full',
			'social' => 'large',
		);

		return $size_map[ $slot ] ?? 'full';
	}
}
