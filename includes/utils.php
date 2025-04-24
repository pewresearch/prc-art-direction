<?php
/**
 * Utils
 *
 * @package PRC\Platform\Art_Direction
 */

namespace PRC\Platform\Art_Direction;

/**
 * Get the art direction
 *
 * @param int    $post_id The post ID.
 * @param string $size The size.
 * @return array
 */
function get( $post_id, $size = 'all' ) {
	$api = new API( $post_id );
	return $api->get( $size );
}
