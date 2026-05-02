<?php
/**
 * Art-Direction Image Sizes
 *
 * Registers the image sizes that back the art-direction contexts (A1/A2/A3/A4
 * + variants, XL/XL-HIDPI, social) defined in {@see Plugin::$field_schema}.
 *
 * Each registered size is also surfaced in the media library "size" dropdown
 * via `image_size_names_choose`, composing with the design system theme's
 * general sizes.
 *
 * @package PRC\Platform\Art_Direction
 */

declare(strict_types=1);

namespace PRC\Platform\Art_Direction;

/**
 * Media_Sizes class.
 *
 * @package PRC\Platform\Art_Direction
 */
class Media_Sizes {
	/**
	 * The art-direction image sizes.
	 *
	 * @var array<string, array{width:int, height:int|null, crop:bool, label:string}>
	 */
	private array $media_sizes = array();

	/**
	 * Construct the Media_Sizes class.
	 *
	 * @param mixed $loader The loader instance.
	 */
	public function __construct( $loader = null ) {
		$this->media_sizes = array(
			'A1'               => array( 'width' => 564,  'height' => 317,  'crop' => true,  'label' => 'A1' ),
			'A1-HIDPI'         => array( 'width' => 1128, 'height' => 634,  'crop' => true,  'label' => 'A1-HIDPI' ),
			'A1-SMALL'         => array( 'width' => 690,  'height' => 388,  'crop' => true,  'label' => 'A1-SMALL' ),
			'A1-SMALL-HIDPI'   => array( 'width' => 1380, 'height' => 776,  'crop' => true,  'label' => 'A1-SMALL-HIDPI' ),
			'A2'               => array( 'width' => 268,  'height' => 151,  'crop' => true,  'label' => 'A2' ),
			'A2-HIDPI'         => array( 'width' => 536,  'height' => 302,  'crop' => true,  'label' => 'A2-HIDPI' ),
			'A2-SMALL'         => array( 'width' => 690,  'height' => 388,  'crop' => true,  'label' => 'A2-SMALL' ),
			'A2-SMALL-HIDPI'   => array( 'width' => 1380, 'height' => 776,  'crop' => true,  'label' => 'A2-SMALL-HIDPI' ),
			'A3'               => array( 'width' => 194,  'height' => 110,  'crop' => true,  'label' => 'A3' ),
			'A3-HIDPI'         => array( 'width' => 388,  'height' => 220,  'crop' => true,  'label' => 'A3-HIDPI' ),
			'A3-SMALL'         => array( 'width' => 148,  'height' => 84,   'crop' => true,  'label' => 'A3-SMALL' ),
			'A3-SMALL-HIDPI'   => array( 'width' => 296,  'height' => 168,  'crop' => true,  'label' => 'A3-SMALL-HIDPI' ),
			'A4'               => array( 'width' => 268,  'height' => 151,  'crop' => true,  'label' => 'A4' ),
			'A4-HIDPI'         => array( 'width' => 536,  'height' => 302,  'crop' => true,  'label' => 'A4-HIDPI' ),
			'A4-SMALL'         => array( 'width' => 690,  'height' => 388,  'crop' => true,  'label' => 'A4-SMALL' ),
			'A4-SMALL-SHIDPI'  => array( 'width' => 1380, 'height' => 776,  'crop' => true,  'label' => 'A4-SMALL-SHIDPI' ),
			'XL'               => array( 'width' => 720,  'height' => 405,  'crop' => true,  'label' => 'XL' ),
			'XL-HIDPI'         => array( 'width' => 1440, 'height' => 810,  'crop' => true,  'label' => 'XL-HIDPI' ),
			'social'           => array( 'width' => 1200, 'height' => 628,  'crop' => true,  'label' => 'Social' ),
		);

		$this->init( $loader );
	}

	/**
	 * Register hooks with the loader.
	 *
	 * @param mixed $loader The loader instance.
	 * @return void
	 */
	private function init( $loader = null ): void {
		if ( null === $loader ) {
			return;
		}
		$loader->add_action( 'init', $this, 'register_image_sizes' );
		$loader->add_filter( 'image_size_names_choose', $this, 'filter_image_sizes_dropdown' );
	}

	/**
	 * Register the art-direction image sizes.
	 *
	 * @hook init
	 */
	public function register_image_sizes(): void {
		if ( empty( $this->media_sizes ) ) {
			return;
		}

		foreach ( $this->media_sizes as $name => $size ) {
			add_image_size( $name, $size['width'], $size['height'], $size['crop'] );
		}
	}

	/**
	 * Add the art-direction sizes to the media library size dropdown.
	 *
	 * @hook image_size_names_choose
	 *
	 * @param array<string,string> $sizes Existing size => label map.
	 * @return array<string,string>
	 */
	public function filter_image_sizes_dropdown( $sizes ) {
		foreach ( $this->media_sizes as $name => $size ) {
			$sizes[ $name ] = $size['label'];
		}
		return $sizes;
	}
}
