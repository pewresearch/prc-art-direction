This file is a merged representation of a subset of the codebase, containing specifically included files, combined into a single document by Repomix.

================================================================
File Summary
================================================================

Purpose:
--------
This file contains a packed representation of the entire repository's contents.
It is designed to be easily consumable by AI systems for analysis, code review,
or other automated processes.

File Format:
------------
The content is organized as follows:
1. This summary section
2. Repository information
3. Directory structure
4. Repository files (if enabled)
4. Multiple file entries, each consisting of:
  a. A separator line (================)
  b. The file path (File: path/to/file)
  c. Another separator line
  d. The full contents of the file
  e. A blank line

Usage Guidelines:
-----------------
- This file should be treated as read-only. Any changes should be made to the
  original repository files, not this packed version.
- When processing this file, use the file path to distinguish
  between different files in the repository.
- Be aware that this file may contain sensitive information. Handle it with
  the same level of security as you would the original repository.

Notes:
------
- Some files may have been excluded based on .gitignore rules and Repomix's configuration
- Binary files are not included in this packed representation. Please refer to the Repository Structure section for a complete list of file paths, including binary files
- Only files matching these patterns are included: plugins/prc-art-direction/.DS_Store, plugins/prc-art-direction/.wp-env.json, plugins/prc-art-direction/README-AI.md, plugins/prc-art-direction/README.md, plugins/prc-art-direction/includes/class-api.php, plugins/prc-art-direction/includes/class-loader.php, plugins/prc-art-direction/includes/class-plugin-activator.php, plugins/prc-art-direction/includes/class-plugin-deactivator.php, plugins/prc-art-direction/includes/class-plugin.php, plugins/prc-art-direction/includes/class-rest-api.php, plugins/prc-art-direction/includes/utils.php, plugins/prc-art-direction/includes/inspector-sidebar-panel/src, plugins/prc-art-direction/includes/inspector-sidebar-panel/webpack.config.js, plugins/prc-art-direction/includes/inspector-sidebar-panel/package.json, plugins/prc-art-direction/includes/inspector-sidebar-panel/class-inspector-sidebar-panel.php, plugins/prc-art-direction/includes/core-post-featured-image/package.json, plugins/prc-art-direction/includes/core-post-featured-image/class-core-post-featured-image.php, plugins/prc-art-direction/includes/core-post-featured-image/src, plugins/prc-art-direction/includes/core-post-featured-image/webpack.config.js, plugins/prc-art-direction/tests, plugins/prc-art-direction/playwright.config.js, plugins/prc-art-direction/package.json, plugins/prc-art-direction/prc-art-direction.php, plugins/prc-art-direction/webpack.config.js
- Files matching patterns in .gitignore are excluded
- Files matching default ignore patterns are excluded
- Files are sorted by Git change count (files with more changes are at the bottom)

Additional Info:
----------------

================================================================
Directory Structure
================================================================
plugins/
  prc-art-direction/
    includes/
      core-post-featured-image/
        src/
          block.json
          editor.scss
          index.js
          README.md
          style.scss
          toolbar.jsx
        class-core-post-featured-image.php
        package.json
        webpack.config.js
      inspector-sidebar-panel/
        src/
          slot/
            index.jsx
            label.jsx
          art-direction-list.jsx
          attachments-panel-hook.js
          context.js
          index.js
          inspector-sidebar.jsx
          pre-publish-panel.jsx
          style.scss
        class-inspector-sidebar-panel.php
        package.json
        webpack.config.js
      class-api.php
      class-loader.php
      class-plugin-activator.php
      class-plugin-deactivator.php
      class-plugin.php
      class-rest-api.php
      utils.php
    tests/
      test-template.spec.ts
    .wp-env.json
    package.json
    playwright.config.js
    prc-art-direction.php
    README-AI.md
    README.md
    webpack.config.js

================================================================
Files
================================================================

================
File: plugins/prc-art-direction/includes/core-post-featured-image/src/block.json
================
{
	"$schema": "https://schemas.wp.org/trunk/block.json",
	"apiVersion": 3,
	"name": "prc-block/core-post-featured-image",
	"version": "0.1.0",
	"title": "Post Feature Image",
	"category": "widgets",
	"textdomain": "core-post-featured-image",
	"editorScript": "file:./index.js",
	"editorStyle": "file:./index.css",
	"style": "file:./style-index.css"
}

================
File: plugins/prc-art-direction/includes/core-post-featured-image/src/editor.scss
================
/*-------------------
     Breakpoints
--------------------*/

$mobileBreakpoint: 320px;
$iPhoneBreakpoint: 390px;
$smallTabletBreakpoint: 666px;
$tabletBreakpoint: 768px;
$computerBreakpoint: 992px;
$largeMonitorBreakpoint: 1200px;
$widescreenMonitorBreakpoint: 1920px;

/* Responsive */
$mediumMobileScreen: $iPhoneBreakpoint;
$largestMobileScreen: ($tabletBreakpoint - 1px);
$largestTabletScreen: ($computerBreakpoint - 1px);
$largestSmallMonitor: ($largeMonitorBreakpoint - 1px);
$largestLargeMonitor: ($widescreenMonitorBreakpoint - 1px);

$A1: 564px;
$A1Small: 345px;
$A1SmallHeight: 194px;
$A1Height: 317px;
$A2: 268px;
$A2Small: $A1Small;
$A2SmallHeight: 194px;
$A2Height: 151px;
$A3: 194px;
$A3Small: 148px;
$A3SmallHeight: 84px;
$A3Height: 110px;
$A4: 268px;
$A4Small: $A1Small;
$A4SmallHeight: 194px;
$A4Height: 151px;
$XL: 720px;
$XLHeight: 405px;
$mobileImageWidth: 690px;

@mixin imageSize($size) {
	// Mobile first

	@if $size == "A1" {
		img {
			max-width: $mobileImageWidth;
			@media only screen and (min-width: $largestMobileScreen) {
				max-width: $A1;
			}
		}
		img {
			@media only screen and (min-width: $largestMobileScreen) {
				height: $A1Height;
			}
		}
	}

	@if $size == "A2" {
		img {
			max-width: $mobileImageWidth;
			@media only screen and (min-width: $largestMobileScreen) {
				max-width: $A2;
			}
		}
		img {
			@media only screen and (min-width: $largestMobileScreen) {
				height: $A2Height;
			}
		}
	}

	@if $size == "A3" {
		img {
			max-width: $A3Small;
			@media only screen and (min-width: $largestMobileScreen) {
				max-width: $A3;
			}
		}
		img {
			@media only screen and (min-width: $largestMobileScreen) {
				height: $A3Height;
			}
		}
	}

	@if $size == "A4" {
		img {
			max-width: $mobileImageWidth;
			@media only screen and (min-width: $largestMobileScreen) {
				max-width: $A4;
			}
		}
		img {
			@media only screen and (min-width: $largestMobileScreen) {
				height: $A4Height;
			}
		}
	}
}

.image {
	grid-area: image;
	img {
		width: 100%;
		height: auto;
	}
	// Chart Art
	&.bordered {
		img {
			border: 1px solid #dadada;
		}
	}

	&.A1 {
		@include imageSize("A1");
	}

	&.A2 {
		@include imageSize("A2");
	}

	&.A3 {
		@include imageSize("A3");
	}

	&.A4 {
		@include imageSize("A4");
	}

	&.XL > img,
	&.XL > source {
		max-width: $XL;
	}
}

================
File: plugins/prc-art-direction/includes/core-post-featured-image/src/index.js
================
/**
 * External Dependencies
 */

import classNames from 'classnames';

/**
 * WordPress Dependencies
 */
import domReady from '@wordpress/dom-ready';
import { addFilter } from '@wordpress/hooks';
import { createHigherOrderComponent } from '@wordpress/compose';

/**
 * Internal Dependencies
 */

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * All files containing `style` keyword are bundled together. The code used
 * gets applied both to the front of your site and to the editor. All other files
 * get applied to the editor only.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './style.scss';
import './editor.scss';
import Toolbar from './toolbar';

const BLOCKNAME = 'core/post-featured-image';
const BLOCKIDENTIFIER = 'prc-block-library/core-post-featured-image';

domReady(() => {
	addFilter(
		'editor.BlockEdit',
		`${BLOCKIDENTIFIER}-wrapper-props`,
		createHigherOrderComponent((BlockEdit) => {
			return (props) => {
				const { name, isSelected, attributes } = props;
				if (BLOCKNAME !== name) {
					return <BlockEdit {...props} />;
				}
				const { imageSize, isChartArt } = attributes;
				const classes = () => {
					return classNames({
						image: true,
						XL: 'XL' === imageSize,
						A1: 'A1' === imageSize,
						A2: 'A2' === imageSize,
						A3: 'A3' === imageSize,
						A4: 'A4' === imageSize,
						bordered: isChartArt,
					});
				};
				console.log('core/post-featured-image', props);
				return (
					<div className={classes()}>
						<BlockEdit {...props} />
						{isSelected && <Toolbar {...props} />}
					</div>
				);
			};
		}, 'withCorePostFeaturedImageWrapperProps'),
		100
	);
});

================
File: plugins/prc-art-direction/includes/core-post-featured-image/src/README.md
================
# Post Content
Contributors:      Pew Research Center
Tags:              block
Tested up to:      6.4
Stable tag:        0.1.0
License:           GPL-2.0-or-later
License URI:       https://www.gnu.org/licenses/gpl-2.0.html



## Description

This is the long description. No limit, and you can use Markdown (as well as in the following sections).

For backwards compatibility, if this section is missing, the full length of the short description will be used, and
Markdown parsed.

## Instructions

This section describes how to use the block.

## Frequently Asked Questions

= A question that someone might have =

An answer to that question.

### What about foo bar?

Answer to foo bar dilemma.

## Screenshots

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif).
2. This is the second screen shot
3. You can store screenshots in a .docs folder in this block directory...

## Changelog

= 0.1.0 =
* Release

## Developer Notes

You may provide arbitrary sections, in the same format as the ones above. This may be of use for extremely complicated
blocks where more information needs to be conveyed that doesn't fit into the categories of "description" or
"installation." Arbitrary sections will be shown below the built-in sections outlined above.

================
File: plugins/prc-art-direction/includes/core-post-featured-image/src/style.scss
================
// just wholesale crib the styles from the story item block
@use "sass:math";

@mixin clearfix() {
	&:after {
		content: "";
		display: table;
		clear: both;
	}
}

/* Colors */
$textColor: var(--wp--preset--color--text-color);
$darkTextColor: rgba(0, 0, 0, 0.85);
$blackLinkColor: var(--wp--preset--color--ui-black);

$A1: 564px;
$A1Small: 345px;
$A1SmallHeight: 194px;
$A1Height: 317px;
$A2: 268px;
$A2Small: $A1Small;
$A2SmallHeight: 194px;
$A2Height: 151px;
$A3: 194px;
$A3Small: 148px;
$A3SmallHeight: 84px;
$A3Height: 110px;
$A4: 268px;
$A4Small: $A1Small;
$A4SmallHeight: 194px;
$A4Height: 151px;
$XL: 720px;
$XLHeight: 405px;

/*-------------------
     Transitions
--------------------*/

$defaultDuration: 0.1s;
$defaultEasing: ease;

/*-------------------
     Breakpoints
--------------------*/

$mobileBreakpoint: 320px;
$iPhoneBreakpoint: 390px;
$smallTabletBreakpoint: 666px;
$tabletBreakpoint: 768px;
$computerBreakpoint: 992px;
$largeMonitorBreakpoint: 1200px;
$widescreenMonitorBreakpoint: 1920px;

/* Responsive */
$mediumMobileScreen: $iPhoneBreakpoint;
$largestMobileScreen: ($tabletBreakpoint - 1px);
$largestTabletScreen: ($computerBreakpoint - 1px);
$largestSmallMonitor: ($largeMonitorBreakpoint - 1px);
$largestLargeMonitor: ($widescreenMonitorBreakpoint - 1px);

$mobileImageWidth: 690px;

$serifFont: var(--wp--preset--font-family--serif);
$sansSerifFont: var(--wp--preset--font-family--sans-serif);
$lineHeight: 1.4285em;

/* Header */
$headerColor: $darkTextColor;
$headerLinkColor: $headerColor;
//
$headerSmallFontSize: 18px;
$headerSmallFontWeight: 400;
$headerSmallLineHeight: 25px;
//
$headerSmallAltFontSize: 18px;
$headerSmallAltFontWeight: bold;
$headerSmallAltLineHeight: 23px;
//
$headerFont: $serifFont;
//
$headerMediumFontSize: 20px;
$headerMediumFontWeight: 700;
$headerMediumLineHeight: 26px;
//
$headerLargeFontSize: 28px;
$headerLargeFontWeight: bold;
$headerLargeLineHeight: 34px;

/* Extras Content */
$extraHorizontalSpacing: 0.5rem;
$extraRowSpacing: 0.5rem;
$extraMargin: 1em 0 0 0;

/* Consecutive Items */
$itemSpacing: 0em 0em 14px 0em;
$relaxedItemSpacing: 0 0 21px 0;
$veryRelaxedItemSpacing: 0 0 28px 0;

/* Divided */
$dividedBorder: 1px solid rgba(34, 36, 38, 0.15);

/* Glow Gradient */
$placeholderLoadingAnimationDuration: 2s;
$placeholderLoadingGradientWidth: 1200px;
$placeholderLoadingGradient: linear-gradient(
	to right,
	rgba(0, 0, 0, 0.08) 0%,
	rgba(0, 0, 0, 0.15) 15%,
	rgba(0, 0, 0, 0.08) 30%
);
$placeholderInvertedLoadingGradient: linear-gradient(
	to right,
	rgba(255, 255, 255, 0.08) 0%,
	rgba(255, 255, 255, 0.14) 15%,
	rgba(255, 255, 255, 0.08) 30%
);

@mixin imageSize($size) {
	// Mobile first
	&:not(.loaded) > picture > img {
		@media only screen and (min-width: $largestMobileScreen) {
			animation: placeholderShimmer $placeholderLoadingAnimationDuration
				linear;
			animation-iteration-count: infinite;
			background-color: white;
			background-image: $placeholderLoadingGradient;
			background-size: $placeholderLoadingGradientWidth 100%;
		}
	}

	@if $size == "A1" {
		img {
			max-width: $mobileImageWidth;
			@media only screen and (min-width: $largestMobileScreen) {
				max-width: $A1;
			}
		}
		img {
			@media only screen and (min-width: $largestMobileScreen) {
				height: $A1Height;
			}
		}
	}

	@if $size == "A2" {
		img {
			max-width: $mobileImageWidth;
			@media only screen and (min-width: $largestMobileScreen) {
				max-width: $A2;
			}
		}
		img {
			@media only screen and (min-width: $largestMobileScreen) {
				height: $A2Height;
			}
		}
	}

	@if $size == "A3" {
		img {
			max-width: $A3Small;
			@media only screen and (min-width: $largestMobileScreen) {
				max-width: $A3;
			}
		}
		img {
			@media only screen and (min-width: $largestMobileScreen) {
				height: $A3Height;
			}
		}
	}

	@if $size == "A4" {
		img {
			max-width: $mobileImageWidth;
			@media only screen and (min-width: $largestMobileScreen) {
				max-width: $A4;
			}
		}
		img {
			@media only screen and (min-width: $largestMobileScreen) {
				height: $A4Height;
			}
		}
	}
}

@keyframes placeholderShimmer {
	0% {
		background-position: -$placeholderLoadingGradientWidth 0;
	}

	100% {
		background-position: $placeholderLoadingGradientWidth 0;
	}
}

/* Image */
.wp-block-post-featured-image {
	.image {
		grid-area: image;
		img {
			width: 100%;
			height: auto;
		}
		// Chart Art
		&.bordered {
			img {
				border: 1px solid #dadada;
			}
		}

		&.A1 {
			@include imageSize("A1");
		}

		&.A2 {
			@include imageSize("A2");
		}

		&.A3 {
			@include imageSize("A3");
		}

		&.A4 {
			@include imageSize("A4");
		}

		&.XL > img,
		&.XL > source {
			max-width: $XL;
		}
	}
}

================
File: plugins/prc-art-direction/includes/core-post-featured-image/src/toolbar.jsx
================
/* eslint-disable max-lines-per-function */

/**
 * WordPress Dependencies
 */
import { __ } from '@wordpress/i18n';
import { BlockControls } from '@wordpress/block-editor';
import { useCallback } from '@wordpress/element';
import {
	ToolbarButton,
	ToolbarDropdownMenu,
	ToolbarGroup,
	Path,
	SVG,
} from '@wordpress/components';

/**
 * Internal Dependencies
 */

function ImageSizeIcon({ selected, currentlyActive = '' }) {
	const iconPaths = {
		A1: 'M12.13,18.09h-3l-.74-2.46H4.49l-.75,2.46H1.27l3.84-12H8.36ZM7.72,13.41,6.44,9.2,5.16,13.41Z M13.31,8.35a7,7,0,0,0,4-2.44h2v10h3.33v2.19H13V15.9h3.63V9a23.54,23.54,0,0,1-3.33,1.78Z',
		A2: 'M12.5,18.09h-3l-.74-2.46H4.86l-.75,2.46H1.64l3.83-12H8.73ZM8.09,13.41,6.81,9.2,5.53,13.41Z M22.16,18.09h-9V15.75l.72-.52,1.46-1a31.07,31.07,0,0,0,3.1-2.6,2.74,2.74,0,0,0,.9-1.87,1.55,1.55,0,0,0-1.66-1.6c-1.19,0-1.86.76-2,2.3l-2.48-.55c.56-2.67,2.11-4,4.66-4a4.37,4.37,0,0,1,3,.91A3.5,3.5,0,0,1,22.2,9.69c0,1.51-.69,2.61-2.52,4a33.64,33.64,0,0,1-3.06,2h5.74Z',
		A3: 'M12.52,18h-3l-.74-2.47H4.89L4.13,18H1.67L5.5,6H8.76ZM8.11,13.32,6.83,9.11,5.56,13.32Z M17.38,10.75a1.87,1.87,0,0,0,1.46-.47,1.36,1.36,0,0,0,.38-.94A1.5,1.5,0,0,0,17.6,7.89c-1,0-1.51.45-1.84,1.53L13.28,9a3.62,3.62,0,0,1,1.1-2,4.58,4.58,0,0,1,3.33-1.24C20.24,5.82,22,7.13,22,9a2.69,2.69,0,0,1-2,2.68,3.09,3.09,0,0,1,1.51.74,2.73,2.73,0,0,1,.9,2.11c0,2.19-1.82,3.61-4.64,3.61A4.67,4.67,0,0,1,14.23,17a3.88,3.88,0,0,1-1.31-2.45l2.55-.36A2,2,0,0,0,17.63,16a1.64,1.64,0,0,0,1.84-1.62,1.55,1.55,0,0,0-.61-1.27,3,3,0,0,0-1.66-.27H16.1V10.75Z',
		A4: 'M12.31,18.09h-3l-.74-2.46H4.67l-.75,2.46H1.45l3.84-12H8.54ZM7.9,13.41,6.62,9.2,5.34,13.41Z M20.86,13.22h1.69v2.1H20.86v2.77H18.05V15.32H12.81v-2.1l4.84-7.31h3.21Zm-2.69,0V9.16c0-.09,0-.28,0-.57l0-.51-3.29,5.14Z',
		XL: 'M9.23,11.58,12.94,18H9.7L7.28,13.65,4.87,18H2.21l3.71-6.38L2.62,6H5.9L7.84,9.65,9.88,6h2.63Z M21.79,15.63V18H14.18V6H17v9.64Z',
	};
	return (
		<SVG
			width={24}
			height={24}
			viewBox="0 0 24 24"
			xmlns="http://www.w3.org/2000/svg"
			isPressed={selected === currentlyActive}
		>
			<Path d={iconPaths[selected]} />
		</SVG>
	);
}

function Toolbar({ attributes, setAttributes, context }) {
	const { imageSize, isChartArt } = attributes;

	const handleImageSizeChange = (newSize) => {
		setAttributes({ imageSize: newSize });
	};

	const MemoizedImageSizeIcon = useCallback(
		() => (
			<ImageSizeIcon selected={imageSize} currentlyActive={imageSize} />
		),
		[imageSize]
	);

	return (
		<BlockControls>
			<ToolbarGroup>
				<ToolbarDropdownMenu
					icon={MemoizedImageSizeIcon}
					label="Select Image Size"
					controls={[
						{
							title: 'A1',
							icon: (
								<ImageSizeIcon
									selected="A1"
									currentlyActive={imageSize}
								/>
							),
							isActive: 'A1' === imageSize,
							onClick: () => handleImageSizeChange('A1'),
						},
						{
							title: 'A2',
							icon: (
								<ImageSizeIcon
									selected="A2"
									currentlyActive={imageSize}
								/>
							),
							isActive: 'A2' === imageSize,
							onClick: () => handleImageSizeChange('A2'),
						},
						{
							title: 'A3',
							icon: (
								<ImageSizeIcon
									selected="A3"
									currentlyActive={imageSize}
								/>
							),
							isActive: 'A3' === imageSize,
							onClick: () => handleImageSizeChange('A3'),
						},
						{
							title: 'A4',
							icon: (
								<ImageSizeIcon
									selected="A4"
									currentlyActive={imageSize}
								/>
							),
							isActive: 'A4' === imageSize,
							onClick: () => handleImageSizeChange('A4'),
						},
						{
							title: 'XL',
							icon: (
								<ImageSizeIcon
									selected="XL"
									currentlyActive={imageSize}
								/>
							),
							isActive: 'XL' === imageSize,
							onClick: () => handleImageSizeChange('XL'),
						},
					]}
				/>
				<ToolbarButton
					icon="chart-pie"
					isPressed={isChartArt}
					label={__('Enable Chart Art')}
					onClick={() => {
						setAttributes({
							isChartArt: !isChartArt,
						});
					}}
				/>
			</ToolbarGroup>
		</BlockControls>
	);
}

export default Toolbar;

================
File: plugins/prc-art-direction/includes/core-post-featured-image/class-core-post-featured-image.php
================
<?php
/**
 * Core Post Featured Image Block
 *
 * @package PRC\Platform\Art_Direction
 */

namespace PRC\Platform\Art_Direction;

use WP_HTML_Tag_Processor;

/**
 * Block Name:        Core Post Feature Image
 * Version:           0.1.0
 * Requires at least: 6.1
 * Requires PHP:      8.1
 * Author:            Pew Research Center
 *
 * @package           prc-block
 */
class Core_Post_Featured_Image {
	/**
	 * Block JSON
	 *
	 * @var array
	 */
	public $block_json;

	/**
	 * Block name
	 *
	 * @var string
	 */
	public $block_name = 'core/post-featured-image';

	/**
	 * Editor script handle
	 *
	 * @var string
	 */
	public $editor_script_handle;

	/**
	 * Style handle
	 *
	 * @var string
	 */
	public $style_handle;

	/**
	 * Editor style handle
	 *
	 * @var string
	 */
	public $editor_style_handle;

	/**
	 * Constructor
	 *
	 * @param mixed $loader Loader.
	 */
	public function __construct( $loader ) {
		$this->init( $loader );
	}

	/**
	 * Initialize the block
	 *
	 * @param mixed $loader Loader.
	 */
	public function init( $loader = null ) {
		if ( null !== $loader ) {
			$loader->add_action( 'init', $this, 'register_assets' );
			$loader->add_action( 'enqueue_block_assets', $this, 'register_style' );
			$loader->add_action( 'enqueue_block_editor_assets', $this, 'register_editor_assets' );
			$loader->add_filter( 'block_type_metadata', $this, 'add_attributes', 100, 1 );
			$loader->add_filter( 'render_block', $this, 'render', 100, 3 );
		}
	}

	/**
	 * Register assets
	 *
	 * @hook init
	 * @return void
	 */
	public function register_assets() {
		$asset_file = include plugin_dir_path( __FILE__ ) . 'build/index.asset.php';

		$script_src       = PRC_ART_DIRECTION_DIR . '/includes/core-post-featured-image/build/index.js';
		$style_src        = PRC_ART_DIRECTION_DIR . '/includes/core-post-featured-image/build/style-index.css';
		$editor_style_src = PRC_ART_DIRECTION_DIR . '/includes/core-post-featured-image/build/index.css';

		$script = wp_register_script(
			'prc-art-direction-core-post-featured-image',
			$script_src,
			$asset_file['dependencies'],
			$asset_file['version'],
			true
		);

		$style = wp_register_style(
			'prc-art-direction-core-post-featured-image',
			$style_src,
			array(),
			$asset_file['version']
		);

		$editor_style = wp_register_style(
			'prc-art-direction-core-post-featured-image__editor',
			$editor_style_src,
			array(),
			$asset_file['version']
		);
	}

	/**
	 * Register editor assets
	 *
	 * @hook enqueue_block_editor_assets
	 * @return void
	 */
	public function register_editor_assets() {
		wp_enqueue_script( 'prc-art-direction-core-post-featured-image' );
		wp_enqueue_style( 'prc-art-direction-core-post-featured-image__editor' );
	}

	/**
	 * Register style
	 *
	 * @hook enqueue_block_assets
	 * @return void
	 */
	public function register_style() {
		wp_enqueue_style( 'prc-art-direction-core-post-featured-image' );
	}

	/**
	 * Register additional attributes for the core-post-featured-image block
	 *
	 * @hook block_type_metadata 100, 1
	 * @param mixed $metadata Metadata.
	 * @return mixed
	 */
	public function add_attributes( $metadata ) {
		if ( $this->block_name !== $metadata['name'] ) {
			return $metadata;
		}

		if ( ! array_key_exists( 'imageSize', $metadata['attributes'] ) ) {
			$metadata['attributes']['imageSize'] = array(
				'type'    => 'string',
				'default' => 'A1',
			);
		}

		if ( ! array_key_exists( 'isChartArt', $metadata['attributes'] ) ) {
			$metadata['attributes']['isChartArt'] = array(
				'type'    => 'boolean',
				'default' => false,
			);
		}

		return $metadata;
	}

	/**
	 * Get the images
	 *
	 * @param int     $image_id The image ID.
	 * @param string  $image_size The image size.
	 * @param boolean $bordered Whether the image is bordered.
	 * @return array
	 */
	private function get_imgs( $image_id, $image_size, $bordered = false ) {
		$caption = get_post_field( 'post_excerpt', $image_id );
		$alt     = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
		$imgs    = array(
			'desktop'  => array(
				'default' => wp_get_attachment_image_src( $image_id, $image_size ),
				'hidpi'   => wp_get_attachment_image_src( $image_id, $image_size . '-HIDPI' ),
			),
			'mobile'   => array(
				'default' => wp_get_attachment_image_src( $image_id, $image_size . '-SMALL' ),
				'hidpi'   => wp_get_attachment_image_src( $image_id, $image_size . '-SMALL-HIDPI' ),
			),
			'bordered' => $bordered,
			'caption'  => $caption,
			'alt'      => $alt,
		);
		return $imgs;
	}

	/**
	 * Render the "core/post-featured-image" block
	 *
	 * @hook render_block
	 * @param string   $block_content Block content.
	 * @param mixed    $block Block.
	 * @param WP_Block $wp_block WP_Block.
	 * @return mixed
	 */
	public function render( $block_content, $block, $wp_block ) {
		if ( $this->block_name !== $block['blockName'] || is_admin() ) {
			return $block_content;
		}

		if ( ! array_key_exists( 'attrs', $block ) ) {
			return $block_content;
		}

		// get img url from $postId at the 'art-direction/get' endpoint
		$post_id   = $wp_block->context['postId'];
		$url       = get_permalink( $post_id );
		$img_size  = array_key_exists( 'imageSize', $block['attrs'] ) ? $block['attrs']['imageSize'] : 'A1';
		$chart_art = array_key_exists( 'isChartArt', $block['attrs'] ) ? $block['attrs']['isChartArt'] : false;
		$api       = new API( $post_id );
		$img_obj   = $api->get( $img_size );
		if ( ! $img_obj ) {
			return $block_content;
		}
		$img_id = array_key_exists( 'id', $img_obj ) ? $img_obj['id'] : null;
		if ( ! $img_id ) {
			return $block_content;
		}

		$image = $this->get_imgs( $img_id, $img_size, $chart_art );

		$sources = array(
			'desktop' => wp_sprintf(
				'<source srcset="%s 1x, %s 2x" media="(min-width: 768px)" width="%s" height="%s">',
				array_key_exists( 0, $image['desktop']['default'] ) ? $image['desktop']['default'][0] : null,
				array_key_exists( 0, $image['desktop']['hidpi'] ) ? $image['desktop']['hidpi'][0] : null,
				array_key_exists( 1, $image['desktop']['default'] ) ? $image['desktop']['default'][1] : null,
				array_key_exists( 2, $image['desktop']['default'] ) ? $image['desktop']['default'][2] : null,
			),
			'mobile'  => wp_sprintf(
				'<source srcset="%s 1x, %s 2x" media="(max-width: 767px)" width="%s" height="%s">',
				array_key_exists( 0, $image['mobile']['default'] ) ? $image['mobile']['default'][0] : null,
				array_key_exists( 0, $image['mobile']['hidpi'] ) ? $image['mobile']['hidpi'][0] : null,
				array_key_exists( 1, $image['mobile']['default'] ) ? $image['mobile']['default'][1] : null,
				array_key_exists( 2, $image['mobile']['default'] ) ? $image['mobile']['default'][2] : null,
			),
		);

		$image_class = \PRC\Platform\Block_Utils\classNames(
			'image',
			'jetpack-lazy-image',
			array(
				$img_size  => $img_size,
				'bordered' => $image['bordered'],
			)
		);

		$block_content = wp_sprintf(
			'<figure class="wp-block-post-featured-image">
				<a href="%1$s" class="%2$s">
					<picture>
						%3$s
						%4$s
						%5$s
					</picture>
				</a>
			</figure>',
			esc_url( $url ),
			esc_attr( $image_class ),
			$sources['desktop'],
			$sources['mobile'],
			wp_sprintf(
				'<img
					srcset="%1$s"
					width="%2$s"
					height="%3$s"
					alt="%4$s"
				>',
				esc_url( $image['desktop']['default'][0] ),
				esc_attr( $image['desktop']['default'][1] ),
				esc_attr( $image['desktop']['default'][2] ),
				esc_attr( $image['alt'] )
			)
		);

		return $block_content;
	}
}

================
File: plugins/prc-art-direction/includes/core-post-featured-image/package.json
================
{
	"name": "@pewresearch/art-direction-core-post-featured-image",
	"version": "1.0.0",
	"author": "PRC",
	"license": "GPL-2.0-or-later",
	"description": "A takeover of the core/post-featured-image block to provide art direction.",
	"scripts": {
		"build": "wp-scripts build src/index.js",
		"start": "wp-scripts start src/index.js"
	},
	"devDependencies": {
		"@wordpress/scripts": "^30.15.0"
	},
	"dependencies": {
		"@wordpress/icons": "^10.22.0"
	}
}

================
File: plugins/prc-art-direction/includes/core-post-featured-image/webpack.config.js
================
const config = require('../../../../webpack.config');

module.exports = config;

================
File: plugins/prc-art-direction/includes/inspector-sidebar-panel/src/slot/index.jsx
================
/* eslint-disable max-lines-per-function */
/**
 * CSS Classes and Styling Forked from Gutenberg featured image component:
 * https://github.com/WordPress/gutenberg/blob/3da717b8d0ac7d7821fc6d0475695ccf3ae2829f/packages/editor/src/components/post-featured-image/index.js
 */

/**
 * External Dependencies
 */
import { MediaImageSlot } from '@prc/components';

/**
 * WordPress Dependencies
 */
import { useMemo } from '@wordpress/element';

/**
 * Internal Dependencies
 */
import { useArtDirection } from '../context';
import Label from './label';

export default function Slot({
	size,
	labels,
	onClick,
	overlayActive,
	enableLabel = true,
}) {
	const { getImageSlot, setImageSlot, capitalize } = useArtDirection();

	const image = useMemo(() => {
		return getImageSlot(size);
	}, [size, getImageSlot]);

	const id = useMemo(() => {
		return image ? image.id : null;
	}, [image]);

	const capitalizeSize = capitalize(size);

	return (
		<div className="prc-platform-art-direction__slot">
			{enableLabel && (
				<Label
					label={labels?.label || `${capitalizeSize}`}
					size={size}
				/>
			)}
			<MediaImageSlot
				{...{
					id,
					size,
					labels: labels || {
						label: `Edit ${capitalizeSize} Image Slot`,
						title: `Select ${capitalizeSize} Image`,
						update: `Update ${capitalizeSize} Image Slot`,
						dropzone: `Drop ${capitalizeSize}`,
					},
					onUpdate: (img) => {
						setImageSlot(img, size);
					},
					onClick,
					overlayActive,
				}}
			/>
		</div>
	);
}

================
File: plugins/prc-art-direction/includes/inspector-sidebar-panel/src/slot/label.jsx
================
/* eslint-disable max-lines-per-function */
/**
 * CSS Classes and Styling Forked from Gutenberg featured image component:
 * https://github.com/WordPress/gutenberg/blob/3da717b8d0ac7d7821fc6d0475695ccf3ae2829f/packages/editor/src/components/post-featured-image/index.js
 */

/**
 * External Dependencies
 */

/**
 * WordPress Dependencies
 */
import { useMemo } from '@wordpress/element';
import {
	Flex,
	FlexBlock,
	FlexItem,
	ToggleControl,
} from '@wordpress/components';

/**
 * Internal Dependencies
 */
import { useArtDirection } from '../context';

export default function Label({ label, size }) {
	const { isImageSlotBordered, toggleImageSlotBordered, capitalize } =
		useArtDirection();
	const isChartArt = isImageSlotBordered(size);
	const labelText = useMemo(() => {
		return label || capitalize(size);
	}, [label, size, capitalize]);
	return (
		<Flex
			style={{
				alignItems: 'center',
				borderTop: '1px solid #eaeaea',
				height: '45px',
			}}
		>
			<FlexBlock>
				<strong>{labelText}</strong>
			</FlexBlock>

			<FlexItem>
				{('A2' === size || 'A3' === size || 'A4' === size) && (
					<ToggleControl
						__nextHasNoMarginBottom
						label="Border"
						onChange={() => toggleImageSlotBordered(size)}
						checked={isChartArt}
					/>
				)}
			</FlexItem>
		</Flex>
	);
}

================
File: plugins/prc-art-direction/includes/inspector-sidebar-panel/src/art-direction-list.jsx
================
/* eslint-disable no-nested-ternary */
/**
 * WordPress Dependencies
 */
import { Fragment } from '@wordpress/element';
import { Flex, FlexBlock, ExternalLink } from '@wordpress/components';

/**
 * Internal Dependencies
 */
import Slot from './slot';
import { useArtDirection } from './context';

export default function ArtDirectionList() {
	const { hasA1Image } = useArtDirection();

	return (
		<div className="prc-platform-art-direction__list">
			<p>
				<ExternalLink href="https://platform.pewresearch.org/wiki/art-direction">
					Art Direction Documentation
				</ExternalLink>
			</p>
			<p
				style={{
					background:
						'var(--wp--custom--color-grey-spectrum-light-one)',
					padding: '0.5em 1em',
					marginLeft: '-1em',
					marginRight: '-1em',
					marginTop: '1em',
					marginBottom: '-1px',
				}}
			>
				<strong>Story Item</strong>
			</p>
			<Slot size="A1" />
			{hasA1Image && (
				<Fragment>
					<Slot size="A2" />
					<Flex>
						<FlexBlock>
							<Slot size="A3" />
						</FlexBlock>
						<FlexBlock>
							<Slot size="A4" />
						</FlexBlock>
					</Flex>
					<p
						style={{
							background:
								'var(--wp--custom--color-grey-spectrum-light-one)',
							padding: '0.5em 1em',
							marginLeft: '-1em',
							marginRight: '-1em',
							marginTop: '1em',
							marginBottom: '-1px',
						}}
					>
						<strong>Social</strong>
					</p>
					<Flex>
						<FlexBlock>
							<Slot size="facebook" />
						</FlexBlock>
						<FlexBlock>
							<Slot size="twitter" />
						</FlexBlock>
					</Flex>
				</Fragment>
			)}
		</div>
	);
}

================
File: plugins/prc-art-direction/includes/inspector-sidebar-panel/src/attachments-panel-hook.js
================
/**
 * WordPress Dependencies
 */
import { Fragment } from '@wordpress/element';
import { PanelBody } from '@wordpress/components';

/**
 * Internal Dependencies
 */
import { ProvideArtDirection } from './context';
import ArtDirectionList from './art-direction-list';

export default function renderAttachmentsPanelHook(AttachmentsPanel) {
	return () => (
		<Fragment>
			<AttachmentsPanel />
			<ProvideArtDirection>
				<PanelBody title="Art Direction" initialOpen={false}>
					<ArtDirectionList />
				</PanelBody>
			</ProvideArtDirection>
		</Fragment>
	);
}

================
File: plugins/prc-art-direction/includes/inspector-sidebar-panel/src/context.js
================
/* eslint-disable max-lines-per-function */
/* eslint-disable max-len */
/**
 * External Dependencies
 */
import { useDebounce } from '@prc/hooks';

/**
 * WordPress Dependencies
 */
import {
	useEffect,
	useState,
	useContext,
	useMemo,
	createContext,
} from '@wordpress/element';
import { useEntityProp, useResourcePermissions } from '@wordpress/core-data';
import { dispatch, useSelect, useDispatch } from '@wordpress/data';

/**
 * Internal Dependencies
 */

const artDirectionContext = createContext();

function shapeImg(img, size) {
	// console.log('prc-platform/art-direction shapeImg::', img);
	if (img.sizes[size]) {
		return {
			id: img.id,
			rawUrl: img.url,
			url: img.sizes[size].url,
			width: img.sizes[size].width,
			height: img.sizes[size].height,
			caption: img.caption,
			chartArt: false,
		};
	}
	// eslint-disable-next-line no-console
	console.error(`No image size found for ${size}`, img);
	return false;
}

/**
 * State logic that sets other state objects.
 * If the state/image being processed is A1 sized it will autopopulate all images.
 * If A2 then A3 and A4 will be acted upon
 * If Facebook then only Twitter will be acted upon
 *
 * @param {WP Media Image Blob} imgData
 * @param {string}              size
 * @return {Object} modified state object
 */
function propagateImageChanges(imgData, size) {
	const updates = {};
	if ('A1' === size) {
		updates.A2 = shapeImg(imgData, 'A2');
		updates.XL = shapeImg(imgData, 'XL');
		updates.facebook = shapeImg(imgData, 'facebook');
		updates.twitter = shapeImg(imgData, 'twitter');
	}
	if ('A1' === size || 'A2' === size) {
		updates.A3 = shapeImg(imgData, 'A3');
		updates.A4 = shapeImg(imgData, 'A4');
	}
	if ('facebook' === size) {
		updates.twitter = shapeImg(imgData, 'twitter');
	}
	updates[size] = shapeImg(imgData, size);
	return updates;
}

function propagateBorderedToggle(updates = {}, size) {
	const value = !updates[size].chartArt;
	if ('A2' === size) {
		updates.A2.chartArt = value;
		updates.A3.chartArt = value;
		updates.A4.chartArt = value;
	} else {
		updates[size].chartArt = value;
	}
	console.log(
		'prc-platform/art-direction propagateBorderedToggle::',
		updates
	);
	return updates;
}

function updateFeatureImage(img = false) {
	if (false !== img) {
		const { editPost } = dispatch('core/editor');
		editPost({ featured_media: img.id });
	}
}

const useArtDirectionContext = () => {
	const { postId, postType, testMeta } = useSelect((select) => {
		return {
			postId: select('core/editor').getCurrentPostId(),
			postType: select('core/editor').getCurrentPostType(),
			testMeta: select('core/editor').getCurrentPostAttribute('meta'),
		};
	}, []);
	const [meta, setMeta] = useEntityProp('postType', postType, 'meta', postId);
	const { canDelete, isResolving } = useResourcePermissions(postType, postId);
	const allowEditing = useMemo(() => {
		console.log('ART CHECK Permissions Check:', isResolving, canDelete);
		if (isResolving) {
			return false;
		}
		return true;
	}, [isResolving, canDelete]);

	const [artDirection, setArtDirection] = useState(meta.artDirection || {});
	const debouncedArtDirection = useDebounce(artDirection, 500);

	/**
	 * Handle saving data back to post.
	 * This approach doesnt support cross collabration as well... but it works for now.
	 */
	useEffect(() => {
		console.log(
			'ART DIRECTION:',
			meta,
			testMeta,
			debouncedArtDirection,
			meta.artDirection,
			artDirection,
			allowEditing
		);
		if (!allowEditing || undefined === meta) {
			console.log(
				"ART DIRECTION UHOH: Can't edit or no meta",
				allowEditing,
				meta
			);
			return;
		}
		// If there is an A1 image, set it as the featured image
		if (debouncedArtDirection.A1 && debouncedArtDirection.A1 !== false) {
			updateFeatureImage(debouncedArtDirection.A1);
			console.log('Featured Image: ', debouncedArtDirection.A1);
		}
		// Check if debouncedArtDirection is different from meta.artDirection, by going through each object and it's properties and making sure they are the same.
		if (
			JSON.stringify(debouncedArtDirection) !==
			JSON.stringify(meta.artDirection)
		) {
			// console.clear();
			console.log(
				'Art Direction Change Detected',
				debouncedArtDirection,
				meta
			);
		} else {
			console.log(
				'No Art Direction Change Detected',
				debouncedArtDirection,
				meta.artDirection
			);
			return;
		}
		console.log('ART DIRECTION UPDATE: ', debouncedArtDirection, meta);
		setMeta({
			...meta,
			artDirection: debouncedArtDirection,
		});
	}, [debouncedArtDirection, allowEditing, meta, setMeta]);

	const setImageSlot = (imgData, size) => {
		const newArtDirection = propagateImageChanges(imgData, size);
		setArtDirection({ ...artDirection, ...newArtDirection });
	};

	const toggleImageSlotBordered = (size) => {
		let newArtDirection = { ...artDirection };
		newArtDirection = propagateBorderedToggle(newArtDirection, size);
		setArtDirection({ ...newArtDirection });
	};

	const isImageSlotBordered = (size) => {
		return artDirection?.[size]?.chartArt;
	};

	const getImageSlot = (size) => {
		return artDirection?.[size];
	};

	const capitalize = (s) => {
		if ('string' !== typeof s) return '';
		return s.charAt(0).toUpperCase() + s.slice(1);
	};

	const hasA1Image = useMemo(() => {
		return !!artDirection.A1;
	}, [artDirection]);

	const allSlotsTheSame = useMemo(() => {
		const keys = Object.keys(debouncedArtDirection);
		const first = debouncedArtDirection[keys[0]];
		console.log('allSlotsTheSame', keys, first);
		for (let i = 1; i < keys.length; i++) {
			console.log(
				'allSlotsTheSame...',
				first,
				debouncedArtDirection[keys[i]]
			);
			let strike = 0;
			if (first.id !== debouncedArtDirection[keys[i]].id) {
				strike += 1;
			}
			if (first.chartArt !== debouncedArtDirection[keys[i]].chartArt) {
				strike += 1;
			}
			if (strike > 0) {
				console.log('allSlotsTheSame...', 'not all the same');
				return false;
			}
		}
		console.log('allSlotsTheSame...', 'all the same');
		return true;
	}, [debouncedArtDirection]);

	return {
		allowEditing,
		postId,
		postType,
		artDirection: debouncedArtDirection,
		hasA1Image,
		setImageSlot,
		getImageSlot,
		isImageSlotBordered,
		toggleImageSlotBordered,
		capitalize,
		allSlotsTheSame,
	};
};

const useArtDirection = () => useContext(artDirectionContext);

function ProvideArtDirection({ children }) {
	const provider = useArtDirectionContext();
	return (
		<artDirectionContext.Provider value={provider}>
			{children}
		</artDirectionContext.Provider>
	);
}

export { ProvideArtDirection, useArtDirection };
export default ProvideArtDirection;

================
File: plugins/prc-art-direction/includes/inspector-sidebar-panel/src/index.js
================
/**
 * WordPress Dependencies
 */
import { addFilter } from '@wordpress/hooks';
import { Fragment } from '@wordpress/element';

/**
 * Internal Dependencies
 */
import './style.scss';
import InspectorSidebar from './inspector-sidebar';
import PrePublishPanel from './pre-publish-panel';
import renderAttachmentsPanelHook from './attachments-panel-hook';

function renderArtDirectionPlugin() {
	return () => (
		<Fragment>
			<InspectorSidebar />
			<PrePublishPanel />
		</Fragment>
	);
}

// Replace the "Featured Image" area with our "Art Direction" panel.
addFilter(
	'editor.PostFeaturedImage',
	'prc-platform/art-direction',
	renderArtDirectionPlugin
);

addFilter(
	'prc-platform.attachments-panel',
	'prc-platform/art-direction',
	renderAttachmentsPanelHook
);

================
File: plugins/prc-art-direction/includes/inspector-sidebar-panel/src/inspector-sidebar.jsx
================
/* eslint-disable max-lines-per-function */
/**
 * External Dependencies
 */
import { InspectorPopoutPanel } from '@prc/components';

/**
 * WordPress Dependencies
 */
import { __ } from '@wordpress/i18n';
import { postFeaturedImage } from '@wordpress/icons';

/**
 * Internal Dependencies
 */
import { ProvideArtDirection, useArtDirection } from './context';
import ArtDirectionList from './art-direction-list';
import Slot from './slot';

function InspectorSidebar() {
	const { hasA1Image, allSlotsTheSame } = useArtDirection();

	return (
		<InspectorPopoutPanel
			title={__('Art Direction')}
			className="prc-platform-art-direction-panel"
			renderToggle={({ isOpen, onToggle }) => (
				<Slot
					{...{
						size: 'A1',
						labels: {
							label: 'Setup Art Direction',
							title: 'Select Art Direction Image',
							update: !allSlotsTheSame
								? 'Update Art Direction (Some Slots Differ)'
								: 'Update Art Direction',
							dropzone: 'Drop A1 Image',
							icon: postFeaturedImage,
						},
						onClick: hasA1Image ? onToggle : undefined, // If the A1 image already exists open the panel, otherwise allow the slot to do it's default action which is to open the media library.
						enableLabel: false,
						overlayActive: isOpen,
					}}
				/>
			)}
		>
			<ArtDirectionList />
		</InspectorPopoutPanel>
	);
}

export default function ProvideInspectorSidebar() {
	return (
		<ProvideArtDirection>
			<InspectorSidebar />
		</ProvideArtDirection>
	);
}

================
File: plugins/prc-art-direction/includes/inspector-sidebar-panel/src/pre-publish-panel.jsx
================
/**
 * WordPress Dependencies
 */
import { PluginPrePublishPanel } from '@wordpress/edit-post';

/**
 * Internal Dependencies
 */
import { ProvideArtDirection } from './context';
import ArtDirectionList from './art-direction-list';

export default function PrePublishPanel() {
	return (
		<PluginPrePublishPanel title="Review Art Direction" initialOpen>
			<ProvideArtDirection>
				<ArtDirectionList />
			</ProvideArtDirection>
		</PluginPrePublishPanel>
	);
}

================
File: plugins/prc-art-direction/includes/inspector-sidebar-panel/src/style.scss
================
.components-button.is-compact.inherit-height {
	height: inherit!important;
}
.components-dropdown.editor-post-url__panel-dropdown {
	.components-button.editor-post-url__panel-toggle.is-compact {
		min-height: max-content !important;
		height: 100%;
	}
}

.prc-platform-art-direction__list {
	min-width: 249px;
	width: 100%;
}

.media-modal:has(.prc-platform-art-direction__modal) {
	z-index: 1999999;
}

================
File: plugins/prc-art-direction/includes/inspector-sidebar-panel/class-inspector-sidebar-panel.php
================
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

================
File: plugins/prc-art-direction/includes/inspector-sidebar-panel/package.json
================
{
	"name": "@pewresearch/art-direction-inspector-sidebar-panel",
	"version": "1.0.0",
	"description": "Art direction for post like objects subsumes featured image",
	"license": "GPL-2.0-or-later",
	"devDependencies": {
		"@wordpress/scripts": "^30.15.0"
	},
	"scripts": {
		"build": "wp-scripts build src/index.js",
		"start": "wp-scripts start src/index.js"
	},
	"dependencies": {
		"@wordpress/icons": "^10.22.0"
	}
}

================
File: plugins/prc-art-direction/includes/inspector-sidebar-panel/webpack.config.js
================
const config = require('../../../../webpack.config');

module.exports = config;

================
File: plugins/prc-art-direction/includes/class-api.php
================
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

================
File: plugins/prc-art-direction/includes/class-loader.php
================
<?php
/**
 * Plugin loader.
 *
 * @package    PRC\Platform\Art_Direction
 */

namespace PRC\Platform\Art_Direction;

/**
 * The loader class.
 *
 * @package    PRC\Platform\Art_Direction
 */
class Loader {

	/**
	 * The array of actions registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $actions    The actions registered with WordPress to fire when the plugin loads.
	 */
	protected $actions;

	/**
	 * The array of filters registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $filters    The filters registered with WordPress to fire when the plugin loads.
	 */
	protected $filters;

	/**
	 * Initialize the collections used to maintain the actions and filters.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->actions = array();
		$this->filters = array();
	}

	/**
	 * Add a new action to the collection to be registered with WordPress.
	 *
	 * @since    1.0.0
	 * @param    string $hook             The name of the WordPress action that is being registered.
	 * @param    object $component        A reference to the instance of the object on which the action is defined.
	 * @param    string $callback         The name of the function definition on the $component.
	 * @param    int    $priority         Optional. The priority at which the function should be fired. Default is 10.
	 * @param    int    $accepted_args    Optional. The number of arguments that should be passed to the $callback. Default is 1.
	 */
	public function add_action( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
		$this->actions = $this->add( $this->actions, $hook, $component, $callback, $priority, $accepted_args );
	}

	/**
	 * Add a new filter to the collection to be registered with WordPress.
	 *
	 * @since    1.0.0
	 * @param    string $hook             The name of the WordPress filter that is being registered.
	 * @param    object $component        A reference to the instance of the object on which the filter is defined.
	 * @param    string $callback         The name of the function definition on the $component.
	 * @param    int    $priority         Optional. The priority at which the function should be fired. Default is 10.
	 * @param    int    $accepted_args    Optional. The number of arguments that should be passed to the $callback. Default is 1.
	 */
	public function add_filter( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
		$this->filters = $this->add( $this->filters, $hook, $component, $callback, $priority, $accepted_args );
	}

	/**
	 * A utility function that is used to register the actions and hooks into a single
	 * collection.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @param    array  $hooks            The collection of hooks that is being registered (that is, actions or filters).
	 * @param    string $hook             The name of the WordPress filter that is being registered.
	 * @param    object $component        A reference to the instance of the object on which the filter is defined.
	 * @param    string $callback         The name of the function definition on the $component.
	 * @param    int    $priority         The priority at which the function should be fired.
	 * @param    int    $accepted_args    The number of arguments that should be passed to the $callback.
	 * @return   array                                  The collection of actions and filters registered with WordPress.
	 */
	private function add( $hooks, $hook, $component, $callback, $priority, $accepted_args ) {

		$hooks[] = array(
			'hook'          => $hook,
			'component'     => $component,
			'callback'      => $callback,
			'priority'      => $priority,
			'accepted_args' => $accepted_args,
		);

		return $hooks;
	}

	/**
	 * Register the filters and actions with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {

		foreach ( $this->filters as $hook ) {
			add_filter( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}

		foreach ( $this->actions as $hook ) {
			add_action( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}
	}
}

================
File: plugins/prc-art-direction/includes/class-plugin-activator.php
================
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

================
File: plugins/prc-art-direction/includes/class-plugin-deactivator.php
================
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

================
File: plugins/prc-art-direction/includes/class-plugin.php
================
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
	 * @return    PRC\Platform\XXX\Loader
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

================
File: plugins/prc-art-direction/includes/class-rest-api.php
================
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

================
File: plugins/prc-art-direction/includes/utils.php
================
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

================
File: plugins/prc-art-direction/tests/test-template.spec.ts
================
import { test, expect } from '@wordpress/e2e-test-utils-playwright';

const testTitle = 'Test Post';
const testContent = 'This is a test post.';

test.describe('Create Post', () => {
	test('Ensure post type is properly registered', async ({
		requestUtils,
	}) => {
		const posts = await requestUtils.rest({
			path: '/wp/v2/posts',
			method: 'GET',
		});
		expect(posts).toBeDefined();
	});

	test('Post created', async ({ admin, editor, requestUtils, page }) => {
		// Create a new post.
		await admin.createNewPost({
			title: testTitle,
			content: testContent,
			postType: 'post',
		});
		// Publish the post.
		await editor.publishPost();

		// Get the created homepage via REST API.
		const posts = await requestUtils.rest({
			path: '/wp/v2/posts',
			method: 'GET',
		});
		// Get the first item out of the posts array.
		const post = posts?.[0];
		// Verify the post was created with correct title and content.
		expect(post.title.rendered).toBe(testTitle);
		// Create a screenshot of the post.
		const today = new Date();
		// This gives 'YYYY-MM-DD' format.
		const formattedDate = today.toISOString().split('T')[0];
		await page.screenshot({
			path: `tests/screenshots/post-${formattedDate}.png`,
		});
	});
});

================
File: plugins/prc-art-direction/.wp-env.json
================
{
	"$schema": "https://raw.githubusercontent.com/WordPress/gutenberg/trunk/schemas/json/wp-env.json",
	"core": "WordPress/WordPress",
	"plugins": [
		"../prc-platform-core",
		"../prc-block-library",
		"."
	],
	"themes": [
		"../../themes/prc-design-system"
	],
	"lifecycleScripts": {
		"afterStart": "wp-env run tests-cli wp theme activate prc-design-system"
	},
	"config": {
		"PRC_PLATFORM_TESTING_MODE": true,
		"PRC_PRIMARY_SITE_ID": 1,
		"DEFAULT_TECHNICAL_CONTACT": "srubenstein@pewresearch.org",
		"TAXONOMY_TECHNICAL_CONTACT": "srubenstein@pewresearch.org"
	}
}

================
File: plugins/prc-art-direction/package.json
================
{
    "name": "@pewresearch/prc-art-direction",
    "version": "1.0.0",
    "description": "Provides a module for PRC Platform that allows editors to select multiple images and apply them to the post, then Story Item blocks can use the various images in different layout contexts.",
    "scripts": {
        "build": "wp-scripts build",
        "test": "wp-scripts test-playwright",
        "test:env:start": "wp-env start",
        "test:env:stop": "wp-env stop",
        "test:env:clean": "wp-env clean all && wp-env start",
        "test:env:destroy": "wp-env destroy"
    },
    "devDependencies": {
        "@playwright/test": "^1.51.1",
        "@wordpress/e2e-test-utils-playwright": "^1.22.0",
        "@wordpress/env": "^10.22.0",
        "@wordpress/scripts": "^30.15.0"
    },
    "dependencies": {
        "@wordpress/icons": "^10.22.0"
    }
}

================
File: plugins/prc-art-direction/playwright.config.js
================
import { defineConfig } from '@playwright/test';
import baseConfig from '@wordpress/scripts/config/playwright.config';

const testDir = './tests';

export default defineConfig({
	...baseConfig,
	testDir,
	outputDir: './tests/artifacts',
	use: {
		...baseConfig.use,
		video: 'on',
		trace: 'on',
	},
	reporter: [
		...baseConfig.reporter,
		['html', { outputFolder: './tests/artifacts/reports' }],
	],
});

================
File: plugins/prc-art-direction/prc-art-direction.php
================
<?php
/**
 * PRC Art Direction
 *
 * @package           PRC_Art_Direction
 * @author            Seth Rubenstein
 * @copyright         2024 Pew Research Center
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       PRC Art Direction
 * Plugin URI:        https://github.com/pewresearch/prc-art-direction
 * Description:       A featured image takeover for PRC Platform. This replaces the default featured image functionality with a system that allows multiple featured images to be set based on template context.
 * Version:           1.0.0
 * Requires at least: 6.7
 * Requires PHP:      8.2
 * Author:            Seth Rubenstein
 * Author URI:        https://pewresearch.org
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       prc-art-direction
 * Requires Plugins:  prc-platform-core
 */

namespace PRC\Platform\Art_Direction;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'PRC_ART_DIRECTION_FILE', __FILE__ );
define( 'PRC_ART_DIRECTION_DIR', __DIR__ );
define( 'PRC_ART_DIRECTION_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-activator.php
 */
function activate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-plugin-activator.php';
	Plugin_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-deactivator.php
 */
function deactivate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-plugin-deactivator.php';
	Plugin_Deactivator::deactivate();
}

register_activation_hook( __FILE__, '\PRC\Platform\Art_Direction\activate' );
register_deactivation_hook( __FILE__, '\PRC\Platform\Art_Direction\deactivate' );

/**
 * Helper utilities
 */
require plugin_dir_path( __FILE__ ) . 'includes/utils.php';

/**
 * The core plugin class that is used to define the hooks that initialize the various components.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-plugin.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_prc_art_direction() {
	$plugin = new Plugin();
	$plugin->run();
}
run_prc_art_direction();

================
File: plugins/prc-art-direction/README-AI.md
================
This file is a merged representation of a subset of the codebase, containing specifically included files, combined into a single document by Repomix.

================================================================
File Summary
================================================================

Purpose:
--------
This file contains a packed representation of the entire repository's contents.
It is designed to be easily consumable by AI systems for analysis, code review,
or other automated processes.

File Format:
------------
The content is organized as follows:
1. This summary section
2. Repository information
3. Directory structure
4. Repository files (if enabled)
4. Multiple file entries, each consisting of:
  a. A separator line (================)
  b. The file path (File: path/to/file)
  c. Another separator line
  d. The full contents of the file
  e. A blank line

Usage Guidelines:
-----------------
- This file should be treated as read-only. Any changes should be made to the
  original repository files, not this packed version.
- When processing this file, use the file path to distinguish
  between different files in the repository.
- Be aware that this file may contain sensitive information. Handle it with
  the same level of security as you would the original repository.

Notes:
------
- Some files may have been excluded based on .gitignore rules and Repomix's configuration
- Binary files are not included in this packed representation. Please refer to the Repository Structure section for a complete list of file paths, including binary files
- Only files matching these patterns are included: plugins/prc-art-direction
- Files matching patterns in .gitignore are excluded
- Files matching default ignore patterns are excluded
- Files are sorted by Git change count (files with more changes are at the bottom)

Additional Info:
----------------

================================================================
Directory Structure
================================================================
plugins/
  prc-art-direction/
    includes/
      core-post-featured-image/
        build/
          block.json
          index-rtl.css
          index.asset.php
          index.css
          index.js
          index.js.map
          style-index-rtl.css
          style-index.css
        src/
          block.json
          editor.scss
          index.js
          README.md
          style.scss
          toolbar.jsx
        class-core-post-featured-image.php
        package.json
        webpack.config.js
      inspector-sidebar-panel/
        build/
          index.asset.php
          index.js
          index.js.map
          style-index-rtl.css
          style-index.css
        src/
          slot/
            index.jsx
            label.jsx
          art-direction-list.jsx
          attachments-panel-hook.js
          context.js
          index.js
          inspector-sidebar.jsx
          pre-publish-panel.jsx
          style.scss
        class-inspector-sidebar-panel.php
        package.json
        webpack.config.js
      class-api.php
      class-loader.php
      class-plugin-activator.php
      class-plugin-deactivator.php
      class-plugin.php
      class-rest-api.php
      utils.php
    tests/
      test-template.spec.ts
    .wp-env.json
    package.json
    playwright.config.js
    prc-art-direction.php
    README.md
    webpack.config.js

================================================================
Files
================================================================

================
File: plugins/prc-art-direction/includes/core-post-featured-image/build/block.json
================
{
  "$schema": "https://schemas.wp.org/trunk/block.json",
  "apiVersion": 3,
  "name": "prc-block/core-post-featured-image",
  "version": "0.1.0",
  "title": "Post Feature Image",
  "category": "widgets",
  "textdomain": "core-post-featured-image",
  "editorScript": "file:./index.js",
  "editorStyle": "file:./index.css",
  "style": "file:./style-index.css"
}

================
File: plugins/prc-art-direction/includes/core-post-featured-image/build/index-rtl.css
================
.image{grid-area:image}.image img{height:auto;width:100%}.image.bordered img{border:1px solid #dadada}.image.A1 img{max-width:690px}@media only screen and (min-width:767px){.image.A1 img{height:317px;max-width:564px}}.image.A2 img{max-width:690px}@media only screen and (min-width:767px){.image.A2 img{height:151px;max-width:268px}}.image.A3 img{max-width:148px}@media only screen and (min-width:767px){.image.A3 img{height:110px;max-width:194px}}.image.A4 img{max-width:690px}@media only screen and (min-width:767px){.image.A4 img{height:151px;max-width:268px}}.image.XL>img,.image.XL>source{max-width:720px}

================
File: plugins/prc-art-direction/includes/core-post-featured-image/build/index.asset.php
================
<?php return array('dependencies' => array('classnames', 'react-jsx-runtime', 'wp-block-editor', 'wp-components', 'wp-compose', 'wp-dom-ready', 'wp-element', 'wp-hooks', 'wp-i18n', 'wp-polyfill'), 'version' => '174172b4e3b587bd8c98');

================
File: plugins/prc-art-direction/includes/core-post-featured-image/build/index.css
================
.image{grid-area:image}.image img{height:auto;width:100%}.image.bordered img{border:1px solid #dadada}.image.A1 img{max-width:690px}@media only screen and (min-width:767px){.image.A1 img{height:317px;max-width:564px}}.image.A2 img{max-width:690px}@media only screen and (min-width:767px){.image.A2 img{height:151px;max-width:268px}}.image.A3 img{max-width:148px}@media only screen and (min-width:767px){.image.A3 img{height:110px;max-width:194px}}.image.A4 img{max-width:690px}@media only screen and (min-width:767px){.image.A4 img{height:151px;max-width:268px}}.image.XL>img,.image.XL>source{max-width:720px}

================
File: plugins/prc-art-direction/includes/core-post-featured-image/build/index.js
================
(()=>{"use strict";var e,t={967:(e,t,r)=>{const i=window.classnames;var o=r.n(i);const c=window.wp.domReady;var n=r.n(c);const s=window.wp.hooks,l=window.wp.compose,a=window.wp.i18n,d=window.wp.blockEditor,A=window.wp.element,h=window.wp.components,p=window.ReactJSXRuntime;function u({selected:e,currentlyActive:t=""}){return(0,p.jsx)(h.SVG,{width:24,height:24,viewBox:"0 0 24 24",xmlns:"http://www.w3.org/2000/svg",isPressed:e===t,children:(0,p.jsx)(h.Path,{d:{A1:"M12.13,18.09h-3l-.74-2.46H4.49l-.75,2.46H1.27l3.84-12H8.36ZM7.72,13.41,6.44,9.2,5.16,13.41Z M13.31,8.35a7,7,0,0,0,4-2.44h2v10h3.33v2.19H13V15.9h3.63V9a23.54,23.54,0,0,1-3.33,1.78Z",A2:"M12.5,18.09h-3l-.74-2.46H4.86l-.75,2.46H1.64l3.83-12H8.73ZM8.09,13.41,6.81,9.2,5.53,13.41Z M22.16,18.09h-9V15.75l.72-.52,1.46-1a31.07,31.07,0,0,0,3.1-2.6,2.74,2.74,0,0,0,.9-1.87,1.55,1.55,0,0,0-1.66-1.6c-1.19,0-1.86.76-2,2.3l-2.48-.55c.56-2.67,2.11-4,4.66-4a4.37,4.37,0,0,1,3,.91A3.5,3.5,0,0,1,22.2,9.69c0,1.51-.69,2.61-2.52,4a33.64,33.64,0,0,1-3.06,2h5.74Z",A3:"M12.52,18h-3l-.74-2.47H4.89L4.13,18H1.67L5.5,6H8.76ZM8.11,13.32,6.83,9.11,5.56,13.32Z M17.38,10.75a1.87,1.87,0,0,0,1.46-.47,1.36,1.36,0,0,0,.38-.94A1.5,1.5,0,0,0,17.6,7.89c-1,0-1.51.45-1.84,1.53L13.28,9a3.62,3.62,0,0,1,1.1-2,4.58,4.58,0,0,1,3.33-1.24C20.24,5.82,22,7.13,22,9a2.69,2.69,0,0,1-2,2.68,3.09,3.09,0,0,1,1.51.74,2.73,2.73,0,0,1,.9,2.11c0,2.19-1.82,3.61-4.64,3.61A4.67,4.67,0,0,1,14.23,17a3.88,3.88,0,0,1-1.31-2.45l2.55-.36A2,2,0,0,0,17.63,16a1.64,1.64,0,0,0,1.84-1.62,1.55,1.55,0,0,0-.61-1.27,3,3,0,0,0-1.66-.27H16.1V10.75Z",A4:"M12.31,18.09h-3l-.74-2.46H4.67l-.75,2.46H1.45l3.84-12H8.54ZM7.9,13.41,6.62,9.2,5.34,13.41Z M20.86,13.22h1.69v2.1H20.86v2.77H18.05V15.32H12.81v-2.1l4.84-7.31h3.21Zm-2.69,0V9.16c0-.09,0-.28,0-.57l0-.51-3.29,5.14Z",XL:"M9.23,11.58,12.94,18H9.7L7.28,13.65,4.87,18H2.21l3.71-6.38L2.62,6H5.9L7.84,9.65,9.88,6h2.63Z M21.79,15.63V18H14.18V6H17v9.64Z"}[e]})})}const v=function({attributes:e,setAttributes:t,context:r}){const{imageSize:i,isChartArt:o}=e,c=e=>{t({imageSize:e})},n=(0,A.useCallback)((()=>(0,p.jsx)(u,{selected:i,currentlyActive:i})),[i]);return(0,p.jsx)(d.BlockControls,{children:(0,p.jsxs)(h.ToolbarGroup,{children:[(0,p.jsx)(h.ToolbarDropdownMenu,{icon:n,label:"Select Image Size",controls:[{title:"A1",icon:(0,p.jsx)(u,{selected:"A1",currentlyActive:i}),isActive:"A1"===i,onClick:()=>c("A1")},{title:"A2",icon:(0,p.jsx)(u,{selected:"A2",currentlyActive:i}),isActive:"A2"===i,onClick:()=>c("A2")},{title:"A3",icon:(0,p.jsx)(u,{selected:"A3",currentlyActive:i}),isActive:"A3"===i,onClick:()=>c("A3")},{title:"A4",icon:(0,p.jsx)(u,{selected:"A4",currentlyActive:i}),isActive:"A4"===i,onClick:()=>c("A4")},{title:"XL",icon:(0,p.jsx)(u,{selected:"XL",currentlyActive:i}),isActive:"XL"===i,onClick:()=>c("XL")}]}),(0,p.jsx)(h.ToolbarButton,{icon:"chart-pie",isPressed:o,label:(0,a.__)("Enable Chart Art"),onClick:()=>{t({isChartArt:!o})}})]})})};n()((()=>{(0,s.addFilter)("editor.BlockEdit","prc-block-library/core-post-featured-image-wrapper-props",(0,l.createHigherOrderComponent)((e=>t=>{const{name:r,isSelected:i,attributes:c}=t;if("core/post-featured-image"!==r)return(0,p.jsx)(e,{...t});const{imageSize:n,isChartArt:s}=c;return console.log("core/post-featured-image",t),(0,p.jsxs)("div",{className:o()({image:!0,XL:"XL"===n,A1:"A1"===n,A2:"A2"===n,A3:"A3"===n,A4:"A4"===n,bordered:s}),children:[(0,p.jsx)(e,{...t}),i&&(0,p.jsx)(v,{...t})]})}),"withCorePostFeaturedImageWrapperProps"),100)}))}},r={};function i(e){var o=r[e];if(void 0!==o)return o.exports;var c=r[e]={exports:{}};return t[e](c,c.exports,i),c.exports}i.m=t,e=[],i.O=(t,r,o,c)=>{if(!r){var n=1/0;for(d=0;d<e.length;d++){for(var[r,o,c]=e[d],s=!0,l=0;l<r.length;l++)(!1&c||n>=c)&&Object.keys(i.O).every((e=>i.O[e](r[l])))?r.splice(l--,1):(s=!1,c<n&&(n=c));if(s){e.splice(d--,1);var a=o();void 0!==a&&(t=a)}}return t}c=c||0;for(var d=e.length;d>0&&e[d-1][2]>c;d--)e[d]=e[d-1];e[d]=[r,o,c]},i.n=e=>{var t=e&&e.__esModule?()=>e.default:()=>e;return i.d(t,{a:t}),t},i.d=(e,t)=>{for(var r in t)i.o(t,r)&&!i.o(e,r)&&Object.defineProperty(e,r,{enumerable:!0,get:t[r]})},i.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t),(()=>{var e={57:0,350:0};i.O.j=t=>0===e[t];var t=(t,r)=>{var o,c,[n,s,l]=r,a=0;if(n.some((t=>0!==e[t]))){for(o in s)i.o(s,o)&&(i.m[o]=s[o]);if(l)var d=l(i)}for(t&&t(r);a<n.length;a++)c=n[a],i.o(e,c)&&e[c]&&e[c][0](),e[c]=0;return i.O(d)},r=globalThis.webpackChunk_pewresearch_art_direction_core_post_featured_image=globalThis.webpackChunk_pewresearch_art_direction_core_post_featured_image||[];r.forEach(t.bind(null,0)),r.push=t.bind(null,r.push.bind(r))})();var o=i.O(void 0,[350],(()=>i(967)));o=i.O(o)})();
//# sourceMappingURL=index.js.map

================
File: plugins/prc-art-direction/includes/core-post-featured-image/build/index.js.map
================
{"version":3,"file":"index.js","mappings":"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","sources":["webpack://@pewresearch/art-direction-core-post-featured-image/webpack/runtime/chunk loaded","webpack://@pewresearch/art-direction-core-post-featured-image/external window \"classnames\"","webpack://@pewresearch/art-direction-core-post-featured-image/external window [\"wp\",\"domReady\"]","webpack://@pewresearch/art-direction-core-post-featured-image/external window [\"wp\",\"hooks\"]","webpack://@pewresearch/art-direction-core-post-featured-image/external window [\"wp\",\"compose\"]","webpack://@pewresearch/art-direction-core-post-featured-image/external window [\"wp\",\"i18n\"]","webpack://@pewresearch/art-direction-core-post-featured-image/external window [\"wp\",\"blockEditor\"]","webpack://@pewresearch/art-direction-core-post-featured-image/external window [\"wp\",\"element\"]","webpack://@pewresearch/art-direction-core-post-featured-image/external window [\"wp\",\"components\"]","webpack://@pewresearch/art-direction-core-post-featured-image/external window \"ReactJSXRuntime\"","webpack://@pewresearch/art-direction-core-post-featured-image/./src/toolbar.jsx","webpack://@pewresearch/art-direction-core-post-featured-image/./src/index.js","webpack://@pewresearch/art-direction-core-post-featured-image/webpack/bootstrap","webpack://@pewresearch/art-direction-core-post-featured-image/webpack/runtime/compat get default export","webpack://@pewresearch/art-direction-core-post-featured-image/webpack/runtime/define property getters","webpack://@pewresearch/art-direction-core-post-featured-image/webpack/runtime/hasOwnProperty shorthand","webpack://@pewresearch/art-direction-core-post-featured-image/webpack/runtime/jsonp chunk loading","webpack://@pewresearch/art-direction-core-post-featured-image/webpack/startup"],"sourcesContent":["var deferred = [];\n__webpack_require__.O = (result, chunkIds, fn, priority) => {\n\tif(chunkIds) {\n\t\tpriority = priority || 0;\n\t\tfor(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];\n\t\tdeferred[i] = [chunkIds, fn, priority];\n\t\treturn;\n\t}\n\tvar notFulfilled = Infinity;\n\tfor (var i = 0; i < deferred.length; i++) {\n\t\tvar [chunkIds, fn, priority] = deferred[i];\n\t\tvar fulfilled = true;\n\t\tfor (var j = 0; j < chunkIds.length; j++) {\n\t\t\tif ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {\n\t\t\t\tchunkIds.splice(j--, 1);\n\t\t\t} else {\n\t\t\t\tfulfilled = false;\n\t\t\t\tif(priority < notFulfilled) notFulfilled = priority;\n\t\t\t}\n\t\t}\n\t\tif(fulfilled) {\n\t\t\tdeferred.splice(i--, 1)\n\t\t\tvar r = fn();\n\t\t\tif (r !== undefined) result = r;\n\t\t}\n\t}\n\treturn result;\n};","const __WEBPACK_NAMESPACE_OBJECT__ = window[\"classnames\"];","const __WEBPACK_NAMESPACE_OBJECT__ = window[\"wp\"][\"domReady\"];","const __WEBPACK_NAMESPACE_OBJECT__ = window[\"wp\"][\"hooks\"];","const __WEBPACK_NAMESPACE_OBJECT__ = window[\"wp\"][\"compose\"];","const __WEBPACK_NAMESPACE_OBJECT__ = window[\"wp\"][\"i18n\"];","const __WEBPACK_NAMESPACE_OBJECT__ = window[\"wp\"][\"blockEditor\"];","const __WEBPACK_NAMESPACE_OBJECT__ = window[\"wp\"][\"element\"];","const __WEBPACK_NAMESPACE_OBJECT__ = window[\"wp\"][\"components\"];","const __WEBPACK_NAMESPACE_OBJECT__ = window[\"ReactJSXRuntime\"];","/* eslint-disable max-lines-per-function */\n\n/**\n * WordPress Dependencies\n */\nimport { __ } from '@wordpress/i18n';\nimport { BlockControls } from '@wordpress/block-editor';\nimport { useCallback } from '@wordpress/element';\nimport {\n\tToolbarButton,\n\tToolbarDropdownMenu,\n\tToolbarGroup,\n\tPath,\n\tSVG,\n} from '@wordpress/components';\n\n/**\n * Internal Dependencies\n */\n\nfunction ImageSizeIcon({ selected, currentlyActive = '' }) {\n\tconst iconPaths = {\n\t\tA1: 'M12.13,18.09h-3l-.74-2.46H4.49l-.75,2.46H1.27l3.84-12H8.36ZM7.72,13.41,6.44,9.2,5.16,13.41Z M13.31,8.35a7,7,0,0,0,4-2.44h2v10h3.33v2.19H13V15.9h3.63V9a23.54,23.54,0,0,1-3.33,1.78Z',\n\t\tA2: 'M12.5,18.09h-3l-.74-2.46H4.86l-.75,2.46H1.64l3.83-12H8.73ZM8.09,13.41,6.81,9.2,5.53,13.41Z M22.16,18.09h-9V15.75l.72-.52,1.46-1a31.07,31.07,0,0,0,3.1-2.6,2.74,2.74,0,0,0,.9-1.87,1.55,1.55,0,0,0-1.66-1.6c-1.19,0-1.86.76-2,2.3l-2.48-.55c.56-2.67,2.11-4,4.66-4a4.37,4.37,0,0,1,3,.91A3.5,3.5,0,0,1,22.2,9.69c0,1.51-.69,2.61-2.52,4a33.64,33.64,0,0,1-3.06,2h5.74Z',\n\t\tA3: 'M12.52,18h-3l-.74-2.47H4.89L4.13,18H1.67L5.5,6H8.76ZM8.11,13.32,6.83,9.11,5.56,13.32Z M17.38,10.75a1.87,1.87,0,0,0,1.46-.47,1.36,1.36,0,0,0,.38-.94A1.5,1.5,0,0,0,17.6,7.89c-1,0-1.51.45-1.84,1.53L13.28,9a3.62,3.62,0,0,1,1.1-2,4.58,4.58,0,0,1,3.33-1.24C20.24,5.82,22,7.13,22,9a2.69,2.69,0,0,1-2,2.68,3.09,3.09,0,0,1,1.51.74,2.73,2.73,0,0,1,.9,2.11c0,2.19-1.82,3.61-4.64,3.61A4.67,4.67,0,0,1,14.23,17a3.88,3.88,0,0,1-1.31-2.45l2.55-.36A2,2,0,0,0,17.63,16a1.64,1.64,0,0,0,1.84-1.62,1.55,1.55,0,0,0-.61-1.27,3,3,0,0,0-1.66-.27H16.1V10.75Z',\n\t\tA4: 'M12.31,18.09h-3l-.74-2.46H4.67l-.75,2.46H1.45l3.84-12H8.54ZM7.9,13.41,6.62,9.2,5.34,13.41Z M20.86,13.22h1.69v2.1H20.86v2.77H18.05V15.32H12.81v-2.1l4.84-7.31h3.21Zm-2.69,0V9.16c0-.09,0-.28,0-.57l0-.51-3.29,5.14Z',\n\t\tXL: 'M9.23,11.58,12.94,18H9.7L7.28,13.65,4.87,18H2.21l3.71-6.38L2.62,6H5.9L7.84,9.65,9.88,6h2.63Z M21.79,15.63V18H14.18V6H17v9.64Z',\n\t};\n\treturn (\n\t\t<SVG\n\t\t\twidth={24}\n\t\t\theight={24}\n\t\t\tviewBox=\"0 0 24 24\"\n\t\t\txmlns=\"http://www.w3.org/2000/svg\"\n\t\t\tisPressed={selected === currentlyActive}\n\t\t>\n\t\t\t<Path d={iconPaths[selected]} />\n\t\t</SVG>\n\t);\n}\n\nfunction Toolbar({ attributes, setAttributes, context }) {\n\tconst { imageSize, isChartArt } = attributes;\n\n\tconst handleImageSizeChange = (newSize) => {\n\t\tsetAttributes({ imageSize: newSize });\n\t};\n\n\tconst MemoizedImageSizeIcon = useCallback(\n\t\t() => (\n\t\t\t<ImageSizeIcon selected={imageSize} currentlyActive={imageSize} />\n\t\t),\n\t\t[imageSize]\n\t);\n\n\treturn (\n\t\t<BlockControls>\n\t\t\t<ToolbarGroup>\n\t\t\t\t<ToolbarDropdownMenu\n\t\t\t\t\ticon={MemoizedImageSizeIcon}\n\t\t\t\t\tlabel=\"Select Image Size\"\n\t\t\t\t\tcontrols={[\n\t\t\t\t\t\t{\n\t\t\t\t\t\t\ttitle: 'A1',\n\t\t\t\t\t\t\ticon: (\n\t\t\t\t\t\t\t\t<ImageSizeIcon\n\t\t\t\t\t\t\t\t\tselected=\"A1\"\n\t\t\t\t\t\t\t\t\tcurrentlyActive={imageSize}\n\t\t\t\t\t\t\t\t/>\n\t\t\t\t\t\t\t),\n\t\t\t\t\t\t\tisActive: 'A1' === imageSize,\n\t\t\t\t\t\t\tonClick: () => handleImageSizeChange('A1'),\n\t\t\t\t\t\t},\n\t\t\t\t\t\t{\n\t\t\t\t\t\t\ttitle: 'A2',\n\t\t\t\t\t\t\ticon: (\n\t\t\t\t\t\t\t\t<ImageSizeIcon\n\t\t\t\t\t\t\t\t\tselected=\"A2\"\n\t\t\t\t\t\t\t\t\tcurrentlyActive={imageSize}\n\t\t\t\t\t\t\t\t/>\n\t\t\t\t\t\t\t),\n\t\t\t\t\t\t\tisActive: 'A2' === imageSize,\n\t\t\t\t\t\t\tonClick: () => handleImageSizeChange('A2'),\n\t\t\t\t\t\t},\n\t\t\t\t\t\t{\n\t\t\t\t\t\t\ttitle: 'A3',\n\t\t\t\t\t\t\ticon: (\n\t\t\t\t\t\t\t\t<ImageSizeIcon\n\t\t\t\t\t\t\t\t\tselected=\"A3\"\n\t\t\t\t\t\t\t\t\tcurrentlyActive={imageSize}\n\t\t\t\t\t\t\t\t/>\n\t\t\t\t\t\t\t),\n\t\t\t\t\t\t\tisActive: 'A3' === imageSize,\n\t\t\t\t\t\t\tonClick: () => handleImageSizeChange('A3'),\n\t\t\t\t\t\t},\n\t\t\t\t\t\t{\n\t\t\t\t\t\t\ttitle: 'A4',\n\t\t\t\t\t\t\ticon: (\n\t\t\t\t\t\t\t\t<ImageSizeIcon\n\t\t\t\t\t\t\t\t\tselected=\"A4\"\n\t\t\t\t\t\t\t\t\tcurrentlyActive={imageSize}\n\t\t\t\t\t\t\t\t/>\n\t\t\t\t\t\t\t),\n\t\t\t\t\t\t\tisActive: 'A4' === imageSize,\n\t\t\t\t\t\t\tonClick: () => handleImageSizeChange('A4'),\n\t\t\t\t\t\t},\n\t\t\t\t\t\t{\n\t\t\t\t\t\t\ttitle: 'XL',\n\t\t\t\t\t\t\ticon: (\n\t\t\t\t\t\t\t\t<ImageSizeIcon\n\t\t\t\t\t\t\t\t\tselected=\"XL\"\n\t\t\t\t\t\t\t\t\tcurrentlyActive={imageSize}\n\t\t\t\t\t\t\t\t/>\n\t\t\t\t\t\t\t),\n\t\t\t\t\t\t\tisActive: 'XL' === imageSize,\n\t\t\t\t\t\t\tonClick: () => handleImageSizeChange('XL'),\n\t\t\t\t\t\t},\n\t\t\t\t\t]}\n\t\t\t\t/>\n\t\t\t\t<ToolbarButton\n\t\t\t\t\ticon=\"chart-pie\"\n\t\t\t\t\tisPressed={isChartArt}\n\t\t\t\t\tlabel={__('Enable Chart Art')}\n\t\t\t\t\tonClick={() => {\n\t\t\t\t\t\tsetAttributes({\n\t\t\t\t\t\t\tisChartArt: !isChartArt,\n\t\t\t\t\t\t});\n\t\t\t\t\t}}\n\t\t\t\t/>\n\t\t\t</ToolbarGroup>\n\t\t</BlockControls>\n\t);\n}\n\nexport default Toolbar;\n","/**\n * External Dependencies\n */\n\nimport classNames from 'classnames';\n\n/**\n * WordPress Dependencies\n */\nimport domReady from '@wordpress/dom-ready';\nimport { addFilter } from '@wordpress/hooks';\nimport { createHigherOrderComponent } from '@wordpress/compose';\n\n/**\n * Internal Dependencies\n */\n\n/**\n * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.\n * All files containing `style` keyword are bundled together. The code used\n * gets applied both to the front of your site and to the editor. All other files\n * get applied to the editor only.\n *\n * @see https://www.npmjs.com/package/@wordpress/scripts#using-css\n */\nimport './style.scss';\nimport './editor.scss';\nimport Toolbar from './toolbar';\n\nconst BLOCKNAME = 'core/post-featured-image';\nconst BLOCKIDENTIFIER = 'prc-block-library/core-post-featured-image';\n\ndomReady(() => {\n\taddFilter(\n\t\t'editor.BlockEdit',\n\t\t`${BLOCKIDENTIFIER}-wrapper-props`,\n\t\tcreateHigherOrderComponent((BlockEdit) => {\n\t\t\treturn (props) => {\n\t\t\t\tconst { name, isSelected, attributes } = props;\n\t\t\t\tif (BLOCKNAME !== name) {\n\t\t\t\t\treturn <BlockEdit {...props} />;\n\t\t\t\t}\n\t\t\t\tconst { imageSize, isChartArt } = attributes;\n\t\t\t\tconst classes = () => {\n\t\t\t\t\treturn classNames({\n\t\t\t\t\t\timage: true,\n\t\t\t\t\t\tXL: 'XL' === imageSize,\n\t\t\t\t\t\tA1: 'A1' === imageSize,\n\t\t\t\t\t\tA2: 'A2' === imageSize,\n\t\t\t\t\t\tA3: 'A3' === imageSize,\n\t\t\t\t\t\tA4: 'A4' === imageSize,\n\t\t\t\t\t\tbordered: isChartArt,\n\t\t\t\t\t});\n\t\t\t\t};\n\t\t\t\tconsole.log('core/post-featured-image', props);\n\t\t\t\treturn (\n\t\t\t\t\t<div className={classes()}>\n\t\t\t\t\t\t<BlockEdit {...props} />\n\t\t\t\t\t\t{isSelected && <Toolbar {...props} />}\n\t\t\t\t\t</div>\n\t\t\t\t);\n\t\t\t};\n\t\t}, 'withCorePostFeaturedImageWrapperProps'),\n\t\t100\n\t);\n});\n","// The module cache\nvar __webpack_module_cache__ = {};\n\n// The require function\nfunction __webpack_require__(moduleId) {\n\t// Check if module is in cache\n\tvar cachedModule = __webpack_module_cache__[moduleId];\n\tif (cachedModule !== undefined) {\n\t\treturn cachedModule.exports;\n\t}\n\t// Create a new module (and put it into the cache)\n\tvar module = __webpack_module_cache__[moduleId] = {\n\t\t// no module.id needed\n\t\t// no module.loaded needed\n\t\texports: {}\n\t};\n\n\t// Execute the module function\n\t__webpack_modules__[moduleId](module, module.exports, __webpack_require__);\n\n\t// Return the exports of the module\n\treturn module.exports;\n}\n\n// expose the modules object (__webpack_modules__)\n__webpack_require__.m = __webpack_modules__;\n\n","// getDefaultExport function for compatibility with non-harmony modules\n__webpack_require__.n = (module) => {\n\tvar getter = module && module.__esModule ?\n\t\t() => (module['default']) :\n\t\t() => (module);\n\t__webpack_require__.d(getter, { a: getter });\n\treturn getter;\n};","// define getter functions for harmony exports\n__webpack_require__.d = (exports, definition) => {\n\tfor(var key in definition) {\n\t\tif(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {\n\t\t\tObject.defineProperty(exports, key, { enumerable: true, get: definition[key] });\n\t\t}\n\t}\n};","__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))","// no baseURI\n\n// object to store loaded and loading chunks\n// undefined = chunk not loaded, null = chunk preloaded/prefetched\n// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded\nvar installedChunks = {\n\t57: 0,\n\t350: 0\n};\n\n// no chunk on demand loading\n\n// no prefetching\n\n// no preloaded\n\n// no HMR\n\n// no HMR manifest\n\n__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);\n\n// install a JSONP callback for chunk loading\nvar webpackJsonpCallback = (parentChunkLoadingFunction, data) => {\n\tvar [chunkIds, moreModules, runtime] = data;\n\t// add \"moreModules\" to the modules object,\n\t// then flag all \"chunkIds\" as loaded and fire callback\n\tvar moduleId, chunkId, i = 0;\n\tif(chunkIds.some((id) => (installedChunks[id] !== 0))) {\n\t\tfor(moduleId in moreModules) {\n\t\t\tif(__webpack_require__.o(moreModules, moduleId)) {\n\t\t\t\t__webpack_require__.m[moduleId] = moreModules[moduleId];\n\t\t\t}\n\t\t}\n\t\tif(runtime) var result = runtime(__webpack_require__);\n\t}\n\tif(parentChunkLoadingFunction) parentChunkLoadingFunction(data);\n\tfor(;i < chunkIds.length; i++) {\n\t\tchunkId = chunkIds[i];\n\t\tif(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {\n\t\t\tinstalledChunks[chunkId][0]();\n\t\t}\n\t\tinstalledChunks[chunkId] = 0;\n\t}\n\treturn __webpack_require__.O(result);\n}\n\nvar chunkLoadingGlobal = globalThis[\"webpackChunk_pewresearch_art_direction_core_post_featured_image\"] = globalThis[\"webpackChunk_pewresearch_art_direction_core_post_featured_image\"] || [];\nchunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));\nchunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));","// startup\n// Load entry module and return exports\n// This entry module depends on other loaded chunks and execution need to be delayed\nvar __webpack_exports__ = __webpack_require__.O(undefined, [350], () => (__webpack_require__(967)))\n__webpack_exports__ = __webpack_require__.O(__webpack_exports__);\n"],"names":["deferred","window","ImageSizeIcon","selected","currentlyActive","_jsx","SVG","width","height","viewBox","xmlns","isPressed","children","Path","d","A1","A2","A3","A4","XL","attributes","setAttributes","context","imageSize","isChartArt","handleImageSizeChange","newSize","MemoizedImageSizeIcon","useCallback","BlockControls","_jsxs","ToolbarGroup","ToolbarDropdownMenu","icon","label","controls","title","isActive","onClick","ToolbarButton","__","domReady","addFilter","createHigherOrderComponent","BlockEdit","props","name","isSelected","console","log","className","classNames","image","bordered","Toolbar","__webpack_module_cache__","__webpack_require__","moduleId","cachedModule","undefined","exports","module","__webpack_modules__","m","O","result","chunkIds","fn","priority","notFulfilled","Infinity","i","length","fulfilled","j","Object","keys","every","key","splice","r","n","getter","__esModule","a","definition","o","defineProperty","enumerable","get","obj","prop","prototype","hasOwnProperty","call","installedChunks","chunkId","webpackJsonpCallback","parentChunkLoadingFunction","data","moreModules","runtime","some","id","chunkLoadingGlobal","globalThis","forEach","bind","push","__webpack_exports__"],"sourceRoot":""}

================
File: plugins/prc-art-direction/includes/core-post-featured-image/build/style-index-rtl.css
================
@keyframes placeholderShimmer{0%{background-position:right -1200px top 0}to{background-position:right 1200px top 0}}.wp-block-post-featured-image .image{grid-area:image}.wp-block-post-featured-image .image img{height:auto;width:100%}.wp-block-post-featured-image .image.bordered img{border:1px solid #dadada}@media only screen and (min-width:767px){.wp-block-post-featured-image .image.A1:not(.loaded)>picture>img{animation:placeholderShimmer 2s linear;animation-iteration-count:infinite;background-color:#fff;background-image:linear-gradient(-90deg,#00000014 0,#00000026 15%,#00000014 30%);background-size:1200px 100%}}.wp-block-post-featured-image .image.A1 img{max-width:690px}@media only screen and (min-width:767px){.wp-block-post-featured-image .image.A1 img{height:317px;max-width:564px}.wp-block-post-featured-image .image.A2:not(.loaded)>picture>img{animation:placeholderShimmer 2s linear;animation-iteration-count:infinite;background-color:#fff;background-image:linear-gradient(-90deg,#00000014 0,#00000026 15%,#00000014 30%);background-size:1200px 100%}}.wp-block-post-featured-image .image.A2 img{max-width:690px}@media only screen and (min-width:767px){.wp-block-post-featured-image .image.A2 img{height:151px;max-width:268px}.wp-block-post-featured-image .image.A3:not(.loaded)>picture>img{animation:placeholderShimmer 2s linear;animation-iteration-count:infinite;background-color:#fff;background-image:linear-gradient(-90deg,#00000014 0,#00000026 15%,#00000014 30%);background-size:1200px 100%}}.wp-block-post-featured-image .image.A3 img{max-width:148px}@media only screen and (min-width:767px){.wp-block-post-featured-image .image.A3 img{height:110px;max-width:194px}.wp-block-post-featured-image .image.A4:not(.loaded)>picture>img{animation:placeholderShimmer 2s linear;animation-iteration-count:infinite;background-color:#fff;background-image:linear-gradient(-90deg,#00000014 0,#00000026 15%,#00000014 30%);background-size:1200px 100%}}.wp-block-post-featured-image .image.A4 img{max-width:690px}@media only screen and (min-width:767px){.wp-block-post-featured-image .image.A4 img{height:151px;max-width:268px}}.wp-block-post-featured-image .image.XL>img,.wp-block-post-featured-image .image.XL>source{max-width:720px}

================
File: plugins/prc-art-direction/includes/core-post-featured-image/build/style-index.css
================
@keyframes placeholderShimmer{0%{background-position:-1200px 0}to{background-position:1200px 0}}.wp-block-post-featured-image .image{grid-area:image}.wp-block-post-featured-image .image img{height:auto;width:100%}.wp-block-post-featured-image .image.bordered img{border:1px solid #dadada}@media only screen and (min-width:767px){.wp-block-post-featured-image .image.A1:not(.loaded)>picture>img{animation:placeholderShimmer 2s linear;animation-iteration-count:infinite;background-color:#fff;background-image:linear-gradient(90deg,#00000014 0,#00000026 15%,#00000014 30%);background-size:1200px 100%}}.wp-block-post-featured-image .image.A1 img{max-width:690px}@media only screen and (min-width:767px){.wp-block-post-featured-image .image.A1 img{height:317px;max-width:564px}.wp-block-post-featured-image .image.A2:not(.loaded)>picture>img{animation:placeholderShimmer 2s linear;animation-iteration-count:infinite;background-color:#fff;background-image:linear-gradient(90deg,#00000014 0,#00000026 15%,#00000014 30%);background-size:1200px 100%}}.wp-block-post-featured-image .image.A2 img{max-width:690px}@media only screen and (min-width:767px){.wp-block-post-featured-image .image.A2 img{height:151px;max-width:268px}.wp-block-post-featured-image .image.A3:not(.loaded)>picture>img{animation:placeholderShimmer 2s linear;animation-iteration-count:infinite;background-color:#fff;background-image:linear-gradient(90deg,#00000014 0,#00000026 15%,#00000014 30%);background-size:1200px 100%}}.wp-block-post-featured-image .image.A3 img{max-width:148px}@media only screen and (min-width:767px){.wp-block-post-featured-image .image.A3 img{height:110px;max-width:194px}.wp-block-post-featured-image .image.A4:not(.loaded)>picture>img{animation:placeholderShimmer 2s linear;animation-iteration-count:infinite;background-color:#fff;background-image:linear-gradient(90deg,#00000014 0,#00000026 15%,#00000014 30%);background-size:1200px 100%}}.wp-block-post-featured-image .image.A4 img{max-width:690px}@media only screen and (min-width:767px){.wp-block-post-featured-image .image.A4 img{height:151px;max-width:268px}}.wp-block-post-featured-image .image.XL>img,.wp-block-post-featured-image .image.XL>source{max-width:720px}

================
File: plugins/prc-art-direction/includes/core-post-featured-image/src/block.json
================
{
	"$schema": "https://schemas.wp.org/trunk/block.json",
	"apiVersion": 3,
	"name": "prc-block/core-post-featured-image",
	"version": "0.1.0",
	"title": "Post Feature Image",
	"category": "widgets",
	"textdomain": "core-post-featured-image",
	"editorScript": "file:./index.js",
	"editorStyle": "file:./index.css",
	"style": "file:./style-index.css"
}

================
File: plugins/prc-art-direction/includes/core-post-featured-image/src/editor.scss
================
/*-------------------
     Breakpoints
--------------------*/

$mobileBreakpoint: 320px;
$iPhoneBreakpoint: 390px;
$smallTabletBreakpoint: 666px;
$tabletBreakpoint: 768px;
$computerBreakpoint: 992px;
$largeMonitorBreakpoint: 1200px;
$widescreenMonitorBreakpoint: 1920px;

/* Responsive */
$mediumMobileScreen: $iPhoneBreakpoint;
$largestMobileScreen: ($tabletBreakpoint - 1px);
$largestTabletScreen: ($computerBreakpoint - 1px);
$largestSmallMonitor: ($largeMonitorBreakpoint - 1px);
$largestLargeMonitor: ($widescreenMonitorBreakpoint - 1px);

$A1: 564px;
$A1Small: 345px;
$A1SmallHeight: 194px;
$A1Height: 317px;
$A2: 268px;
$A2Small: $A1Small;
$A2SmallHeight: 194px;
$A2Height: 151px;
$A3: 194px;
$A3Small: 148px;
$A3SmallHeight: 84px;
$A3Height: 110px;
$A4: 268px;
$A4Small: $A1Small;
$A4SmallHeight: 194px;
$A4Height: 151px;
$XL: 720px;
$XLHeight: 405px;
$mobileImageWidth: 690px;

@mixin imageSize($size) {
	// Mobile first

	@if $size == "A1" {
		img {
			max-width: $mobileImageWidth;
			@media only screen and (min-width: $largestMobileScreen) {
				max-width: $A1;
			}
		}
		img {
			@media only screen and (min-width: $largestMobileScreen) {
				height: $A1Height;
			}
		}
	}

	@if $size == "A2" {
		img {
			max-width: $mobileImageWidth;
			@media only screen and (min-width: $largestMobileScreen) {
				max-width: $A2;
			}
		}
		img {
			@media only screen and (min-width: $largestMobileScreen) {
				height: $A2Height;
			}
		}
	}

	@if $size == "A3" {
		img {
			max-width: $A3Small;
			@media only screen and (min-width: $largestMobileScreen) {
				max-width: $A3;
			}
		}
		img {
			@media only screen and (min-width: $largestMobileScreen) {
				height: $A3Height;
			}
		}
	}

	@if $size == "A4" {
		img {
			max-width: $mobileImageWidth;
			@media only screen and (min-width: $largestMobileScreen) {
				max-width: $A4;
			}
		}
		img {
			@media only screen and (min-width: $largestMobileScreen) {
				height: $A4Height;
			}
		}
	}
}

.image {
	grid-area: image;
	img {
		width: 100%;
		height: auto;
	}
	// Chart Art
	&.bordered {
		img {
			border: 1px solid #dadada;
		}
	}

	&.A1 {
		@include imageSize("A1");
	}

	&.A2 {
		@include imageSize("A2");
	}

	&.A3 {
		@include imageSize("A3");
	}

	&.A4 {
		@include imageSize("A4");
	}

	&.XL > img,
	&.XL > source {
		max-width: $XL;
	}
}

================
File: plugins/prc-art-direction/includes/core-post-featured-image/src/index.js
================
/**
 * External Dependencies
 */

import classNames from 'classnames';

/**
 * WordPress Dependencies
 */
import domReady from '@wordpress/dom-ready';
import { addFilter } from '@wordpress/hooks';
import { createHigherOrderComponent } from '@wordpress/compose';

/**
 * Internal Dependencies
 */

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * All files containing `style` keyword are bundled together. The code used
 * gets applied both to the front of your site and to the editor. All other files
 * get applied to the editor only.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './style.scss';
import './editor.scss';
import Toolbar from './toolbar';

const BLOCKNAME = 'core/post-featured-image';
const BLOCKIDENTIFIER = 'prc-block-library/core-post-featured-image';

domReady(() => {
	addFilter(
		'editor.BlockEdit',
		`${BLOCKIDENTIFIER}-wrapper-props`,
		createHigherOrderComponent((BlockEdit) => {
			return (props) => {
				const { name, isSelected, attributes } = props;
				if (BLOCKNAME !== name) {
					return <BlockEdit {...props} />;
				}
				const { imageSize, isChartArt } = attributes;
				const classes = () => {
					return classNames({
						image: true,
						XL: 'XL' === imageSize,
						A1: 'A1' === imageSize,
						A2: 'A2' === imageSize,
						A3: 'A3' === imageSize,
						A4: 'A4' === imageSize,
						bordered: isChartArt,
					});
				};
				console.log('core/post-featured-image', props);
				return (
					<div className={classes()}>
						<BlockEdit {...props} />
						{isSelected && <Toolbar {...props} />}
					</div>
				);
			};
		}, 'withCorePostFeaturedImageWrapperProps'),
		100
	);
});

================
File: plugins/prc-art-direction/includes/core-post-featured-image/src/README.md
================
# Post Content
Contributors:      Pew Research Center
Tags:              block
Tested up to:      6.4
Stable tag:        0.1.0
License:           GPL-2.0-or-later
License URI:       https://www.gnu.org/licenses/gpl-2.0.html



## Description

This is the long description. No limit, and you can use Markdown (as well as in the following sections).

For backwards compatibility, if this section is missing, the full length of the short description will be used, and
Markdown parsed.

## Instructions

This section describes how to use the block.

## Frequently Asked Questions

= A question that someone might have =

An answer to that question.

### What about foo bar?

Answer to foo bar dilemma.

## Screenshots

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif).
2. This is the second screen shot
3. You can store screenshots in a .docs folder in this block directory...

## Changelog

= 0.1.0 =
* Release

## Developer Notes

You may provide arbitrary sections, in the same format as the ones above. This may be of use for extremely complicated
blocks where more information needs to be conveyed that doesn't fit into the categories of "description" or
"installation." Arbitrary sections will be shown below the built-in sections outlined above.

================
File: plugins/prc-art-direction/includes/core-post-featured-image/src/style.scss
================
// just wholesale crib the styles from the story item block
@use "sass:math";

@mixin clearfix() {
	&:after {
		content: "";
		display: table;
		clear: both;
	}
}

/* Colors */
$textColor: var(--wp--preset--color--text-color);
$darkTextColor: rgba(0, 0, 0, 0.85);
$blackLinkColor: var(--wp--preset--color--ui-black);

$A1: 564px;
$A1Small: 345px;
$A1SmallHeight: 194px;
$A1Height: 317px;
$A2: 268px;
$A2Small: $A1Small;
$A2SmallHeight: 194px;
$A2Height: 151px;
$A3: 194px;
$A3Small: 148px;
$A3SmallHeight: 84px;
$A3Height: 110px;
$A4: 268px;
$A4Small: $A1Small;
$A4SmallHeight: 194px;
$A4Height: 151px;
$XL: 720px;
$XLHeight: 405px;

/*-------------------
     Transitions
--------------------*/

$defaultDuration: 0.1s;
$defaultEasing: ease;

/*-------------------
     Breakpoints
--------------------*/

$mobileBreakpoint: 320px;
$iPhoneBreakpoint: 390px;
$smallTabletBreakpoint: 666px;
$tabletBreakpoint: 768px;
$computerBreakpoint: 992px;
$largeMonitorBreakpoint: 1200px;
$widescreenMonitorBreakpoint: 1920px;

/* Responsive */
$mediumMobileScreen: $iPhoneBreakpoint;
$largestMobileScreen: ($tabletBreakpoint - 1px);
$largestTabletScreen: ($computerBreakpoint - 1px);
$largestSmallMonitor: ($largeMonitorBreakpoint - 1px);
$largestLargeMonitor: ($widescreenMonitorBreakpoint - 1px);

$mobileImageWidth: 690px;

$serifFont: var(--wp--preset--font-family--serif);
$sansSerifFont: var(--wp--preset--font-family--sans-serif);
$lineHeight: 1.4285em;

/* Header */
$headerColor: $darkTextColor;
$headerLinkColor: $headerColor;
//
$headerSmallFontSize: 18px;
$headerSmallFontWeight: 400;
$headerSmallLineHeight: 25px;
//
$headerSmallAltFontSize: 18px;
$headerSmallAltFontWeight: bold;
$headerSmallAltLineHeight: 23px;
//
$headerFont: $serifFont;
//
$headerMediumFontSize: 20px;
$headerMediumFontWeight: 700;
$headerMediumLineHeight: 26px;
//
$headerLargeFontSize: 28px;
$headerLargeFontWeight: bold;
$headerLargeLineHeight: 34px;

/* Extras Content */
$extraHorizontalSpacing: 0.5rem;
$extraRowSpacing: 0.5rem;
$extraMargin: 1em 0 0 0;

/* Consecutive Items */
$itemSpacing: 0em 0em 14px 0em;
$relaxedItemSpacing: 0 0 21px 0;
$veryRelaxedItemSpacing: 0 0 28px 0;

/* Divided */
$dividedBorder: 1px solid rgba(34, 36, 38, 0.15);

/* Glow Gradient */
$placeholderLoadingAnimationDuration: 2s;
$placeholderLoadingGradientWidth: 1200px;
$placeholderLoadingGradient: linear-gradient(
	to right,
	rgba(0, 0, 0, 0.08) 0%,
	rgba(0, 0, 0, 0.15) 15%,
	rgba(0, 0, 0, 0.08) 30%
);
$placeholderInvertedLoadingGradient: linear-gradient(
	to right,
	rgba(255, 255, 255, 0.08) 0%,
	rgba(255, 255, 255, 0.14) 15%,
	rgba(255, 255, 255, 0.08) 30%
);

@mixin imageSize($size) {
	// Mobile first
	&:not(.loaded) > picture > img {
		@media only screen and (min-width: $largestMobileScreen) {
			animation: placeholderShimmer $placeholderLoadingAnimationDuration
				linear;
			animation-iteration-count: infinite;
			background-color: white;
			background-image: $placeholderLoadingGradient;
			background-size: $placeholderLoadingGradientWidth 100%;
		}
	}

	@if $size == "A1" {
		img {
			max-width: $mobileImageWidth;
			@media only screen and (min-width: $largestMobileScreen) {
				max-width: $A1;
			}
		}
		img {
			@media only screen and (min-width: $largestMobileScreen) {
				height: $A1Height;
			}
		}
	}

	@if $size == "A2" {
		img {
			max-width: $mobileImageWidth;
			@media only screen and (min-width: $largestMobileScreen) {
				max-width: $A2;
			}
		}
		img {
			@media only screen and (min-width: $largestMobileScreen) {
				height: $A2Height;
			}
		}
	}

	@if $size == "A3" {
		img {
			max-width: $A3Small;
			@media only screen and (min-width: $largestMobileScreen) {
				max-width: $A3;
			}
		}
		img {
			@media only screen and (min-width: $largestMobileScreen) {
				height: $A3Height;
			}
		}
	}

	@if $size == "A4" {
		img {
			max-width: $mobileImageWidth;
			@media only screen and (min-width: $largestMobileScreen) {
				max-width: $A4;
			}
		}
		img {
			@media only screen and (min-width: $largestMobileScreen) {
				height: $A4Height;
			}
		}
	}
}

@keyframes placeholderShimmer {
	0% {
		background-position: -$placeholderLoadingGradientWidth 0;
	}

	100% {
		background-position: $placeholderLoadingGradientWidth 0;
	}
}

/* Image */
.wp-block-post-featured-image {
	.image {
		grid-area: image;
		img {
			width: 100%;
			height: auto;
		}
		// Chart Art
		&.bordered {
			img {
				border: 1px solid #dadada;
			}
		}

		&.A1 {
			@include imageSize("A1");
		}

		&.A2 {
			@include imageSize("A2");
		}

		&.A3 {
			@include imageSize("A3");
		}

		&.A4 {
			@include imageSize("A4");
		}

		&.XL > img,
		&.XL > source {
			max-width: $XL;
		}
	}
}

================
File: plugins/prc-art-direction/includes/core-post-featured-image/src/toolbar.jsx
================
/* eslint-disable max-lines-per-function */

/**
 * WordPress Dependencies
 */
import { __ } from '@wordpress/i18n';
import { BlockControls } from '@wordpress/block-editor';
import { useCallback } from '@wordpress/element';
import {
	ToolbarButton,
	ToolbarDropdownMenu,
	ToolbarGroup,
	Path,
	SVG,
} from '@wordpress/components';

/**
 * Internal Dependencies
 */

function ImageSizeIcon({ selected, currentlyActive = '' }) {
	const iconPaths = {
		A1: 'M12.13,18.09h-3l-.74-2.46H4.49l-.75,2.46H1.27l3.84-12H8.36ZM7.72,13.41,6.44,9.2,5.16,13.41Z M13.31,8.35a7,7,0,0,0,4-2.44h2v10h3.33v2.19H13V15.9h3.63V9a23.54,23.54,0,0,1-3.33,1.78Z',
		A2: 'M12.5,18.09h-3l-.74-2.46H4.86l-.75,2.46H1.64l3.83-12H8.73ZM8.09,13.41,6.81,9.2,5.53,13.41Z M22.16,18.09h-9V15.75l.72-.52,1.46-1a31.07,31.07,0,0,0,3.1-2.6,2.74,2.74,0,0,0,.9-1.87,1.55,1.55,0,0,0-1.66-1.6c-1.19,0-1.86.76-2,2.3l-2.48-.55c.56-2.67,2.11-4,4.66-4a4.37,4.37,0,0,1,3,.91A3.5,3.5,0,0,1,22.2,9.69c0,1.51-.69,2.61-2.52,4a33.64,33.64,0,0,1-3.06,2h5.74Z',
		A3: 'M12.52,18h-3l-.74-2.47H4.89L4.13,18H1.67L5.5,6H8.76ZM8.11,13.32,6.83,9.11,5.56,13.32Z M17.38,10.75a1.87,1.87,0,0,0,1.46-.47,1.36,1.36,0,0,0,.38-.94A1.5,1.5,0,0,0,17.6,7.89c-1,0-1.51.45-1.84,1.53L13.28,9a3.62,3.62,0,0,1,1.1-2,4.58,4.58,0,0,1,3.33-1.24C20.24,5.82,22,7.13,22,9a2.69,2.69,0,0,1-2,2.68,3.09,3.09,0,0,1,1.51.74,2.73,2.73,0,0,1,.9,2.11c0,2.19-1.82,3.61-4.64,3.61A4.67,4.67,0,0,1,14.23,17a3.88,3.88,0,0,1-1.31-2.45l2.55-.36A2,2,0,0,0,17.63,16a1.64,1.64,0,0,0,1.84-1.62,1.55,1.55,0,0,0-.61-1.27,3,3,0,0,0-1.66-.27H16.1V10.75Z',
		A4: 'M12.31,18.09h-3l-.74-2.46H4.67l-.75,2.46H1.45l3.84-12H8.54ZM7.9,13.41,6.62,9.2,5.34,13.41Z M20.86,13.22h1.69v2.1H20.86v2.77H18.05V15.32H12.81v-2.1l4.84-7.31h3.21Zm-2.69,0V9.16c0-.09,0-.28,0-.57l0-.51-3.29,5.14Z',
		XL: 'M9.23,11.58,12.94,18H9.7L7.28,13.65,4.87,18H2.21l3.71-6.38L2.62,6H5.9L7.84,9.65,9.88,6h2.63Z M21.79,15.63V18H14.18V6H17v9.64Z',
	};
	return (
		<SVG
			width={24}
			height={24}
			viewBox="0 0 24 24"
			xmlns="http://www.w3.org/2000/svg"
			isPressed={selected === currentlyActive}
		>
			<Path d={iconPaths[selected]} />
		</SVG>
	);
}

function Toolbar({ attributes, setAttributes, context }) {
	const { imageSize, isChartArt } = attributes;

	const handleImageSizeChange = (newSize) => {
		setAttributes({ imageSize: newSize });
	};

	const MemoizedImageSizeIcon = useCallback(
		() => (
			<ImageSizeIcon selected={imageSize} currentlyActive={imageSize} />
		),
		[imageSize]
	);

	return (
		<BlockControls>
			<ToolbarGroup>
				<ToolbarDropdownMenu
					icon={MemoizedImageSizeIcon}
					label="Select Image Size"
					controls={[
						{
							title: 'A1',
							icon: (
								<ImageSizeIcon
									selected="A1"
									currentlyActive={imageSize}
								/>
							),
							isActive: 'A1' === imageSize,
							onClick: () => handleImageSizeChange('A1'),
						},
						{
							title: 'A2',
							icon: (
								<ImageSizeIcon
									selected="A2"
									currentlyActive={imageSize}
								/>
							),
							isActive: 'A2' === imageSize,
							onClick: () => handleImageSizeChange('A2'),
						},
						{
							title: 'A3',
							icon: (
								<ImageSizeIcon
									selected="A3"
									currentlyActive={imageSize}
								/>
							),
							isActive: 'A3' === imageSize,
							onClick: () => handleImageSizeChange('A3'),
						},
						{
							title: 'A4',
							icon: (
								<ImageSizeIcon
									selected="A4"
									currentlyActive={imageSize}
								/>
							),
							isActive: 'A4' === imageSize,
							onClick: () => handleImageSizeChange('A4'),
						},
						{
							title: 'XL',
							icon: (
								<ImageSizeIcon
									selected="XL"
									currentlyActive={imageSize}
								/>
							),
							isActive: 'XL' === imageSize,
							onClick: () => handleImageSizeChange('XL'),
						},
					]}
				/>
				<ToolbarButton
					icon="chart-pie"
					isPressed={isChartArt}
					label={__('Enable Chart Art')}
					onClick={() => {
						setAttributes({
							isChartArt: !isChartArt,
						});
					}}
				/>
			</ToolbarGroup>
		</BlockControls>
	);
}

export default Toolbar;

================
File: plugins/prc-art-direction/includes/core-post-featured-image/class-core-post-featured-image.php
================
<?php
/**
 * Core Post Featured Image Block
 *
 * @package PRC\Platform\Art_Direction
 */

namespace PRC\Platform\Art_Direction;

use WP_HTML_Tag_Processor;

/**
 * Block Name:        Core Post Feature Image
 * Version:           0.1.0
 * Requires at least: 6.1
 * Requires PHP:      8.1
 * Author:            Pew Research Center
 *
 * @package           prc-block
 */
class Core_Post_Featured_Image {
	/**
	 * Block JSON
	 *
	 * @var array
	 */
	public $block_json;

	/**
	 * Block name
	 *
	 * @var string
	 */
	public $block_name = 'core/post-featured-image';

	/**
	 * Editor script handle
	 *
	 * @var string
	 */
	public $editor_script_handle;

	/**
	 * Style handle
	 *
	 * @var string
	 */
	public $style_handle;

	/**
	 * Editor style handle
	 *
	 * @var string
	 */
	public $editor_style_handle;

	/**
	 * Constructor
	 *
	 * @param mixed $loader Loader.
	 */
	public function __construct( $loader ) {
		$this->init( $loader );
	}

	/**
	 * Initialize the block
	 *
	 * @param mixed $loader Loader.
	 */
	public function init( $loader = null ) {
		if ( null !== $loader ) {
			$loader->add_action( 'init', $this, 'register_assets' );
			$loader->add_action( 'enqueue_block_assets', $this, 'register_style' );
			$loader->add_action( 'enqueue_block_editor_assets', $this, 'register_editor_assets' );
			$loader->add_filter( 'block_type_metadata', $this, 'add_attributes', 100, 1 );
			$loader->add_filter( 'render_block', $this, 'render', 100, 3 );
		}
	}

	/**
	 * Register assets
	 *
	 * @hook init
	 * @return void
	 */
	public function register_assets() {
		$asset_file = include plugin_dir_path( __FILE__ ) . 'build/index.asset.php';

		$script_src       = PRC_ART_DIRECTION_DIR . '/includes/core-post-featured-image/build/index.js';
		$style_src        = PRC_ART_DIRECTION_DIR . '/includes/core-post-featured-image/build/style-index.css';
		$editor_style_src = PRC_ART_DIRECTION_DIR . '/includes/core-post-featured-image/build/index.css';

		$script = wp_register_script(
			'prc-art-direction-core-post-featured-image',
			$script_src,
			$asset_file['dependencies'],
			$asset_file['version'],
			true
		);

		$style = wp_register_style(
			'prc-art-direction-core-post-featured-image',
			$style_src,
			array(),
			$asset_file['version']
		);

		$editor_style = wp_register_style(
			'prc-art-direction-core-post-featured-image__editor',
			$editor_style_src,
			array(),
			$asset_file['version']
		);
	}

	/**
	 * Register editor assets
	 *
	 * @hook enqueue_block_editor_assets
	 * @return void
	 */
	public function register_editor_assets() {
		wp_enqueue_script( 'prc-art-direction-core-post-featured-image' );
		wp_enqueue_style( 'prc-art-direction-core-post-featured-image__editor' );
	}

	/**
	 * Register style
	 *
	 * @hook enqueue_block_assets
	 * @return void
	 */
	public function register_style() {
		wp_enqueue_style( 'prc-art-direction-core-post-featured-image' );
	}

	/**
	 * Register additional attributes for the core-post-featured-image block
	 *
	 * @hook block_type_metadata 100, 1
	 * @param mixed $metadata Metadata.
	 * @return mixed
	 */
	public function add_attributes( $metadata ) {
		if ( $this->block_name !== $metadata['name'] ) {
			return $metadata;
		}

		if ( ! array_key_exists( 'imageSize', $metadata['attributes'] ) ) {
			$metadata['attributes']['imageSize'] = array(
				'type'    => 'string',
				'default' => 'A1',
			);
		}

		if ( ! array_key_exists( 'isChartArt', $metadata['attributes'] ) ) {
			$metadata['attributes']['isChartArt'] = array(
				'type'    => 'boolean',
				'default' => false,
			);
		}

		return $metadata;
	}

	/**
	 * Get the images
	 *
	 * @param int     $image_id The image ID.
	 * @param string  $image_size The image size.
	 * @param boolean $bordered Whether the image is bordered.
	 * @return array
	 */
	private function get_imgs( $image_id, $image_size, $bordered = false ) {
		$caption = get_post_field( 'post_excerpt', $image_id );
		$alt     = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
		$imgs    = array(
			'desktop'  => array(
				'default' => wp_get_attachment_image_src( $image_id, $image_size ),
				'hidpi'   => wp_get_attachment_image_src( $image_id, $image_size . '-HIDPI' ),
			),
			'mobile'   => array(
				'default' => wp_get_attachment_image_src( $image_id, $image_size . '-SMALL' ),
				'hidpi'   => wp_get_attachment_image_src( $image_id, $image_size . '-SMALL-HIDPI' ),
			),
			'bordered' => $bordered,
			'caption'  => $caption,
			'alt'      => $alt,
		);
		return $imgs;
	}

	/**
	 * Render the "core/post-featured-image" block
	 *
	 * @hook render_block
	 * @param string   $block_content Block content.
	 * @param mixed    $block Block.
	 * @param WP_Block $wp_block WP_Block.
	 * @return mixed
	 */
	public function render( $block_content, $block, $wp_block ) {
		if ( $this->block_name !== $block['blockName'] || is_admin() ) {
			return $block_content;
		}

		if ( ! array_key_exists( 'attrs', $block ) ) {
			return $block_content;
		}

		// get img url from $postId at the 'art-direction/get' endpoint
		$post_id   = $wp_block->context['postId'];
		$url       = get_permalink( $post_id );
		$img_size  = array_key_exists( 'imageSize', $block['attrs'] ) ? $block['attrs']['imageSize'] : 'A1';
		$chart_art = array_key_exists( 'isChartArt', $block['attrs'] ) ? $block['attrs']['isChartArt'] : false;
		$api       = new API( $post_id );
		$img_obj   = $api->get( $img_size );
		if ( ! $img_obj ) {
			return $block_content;
		}
		$img_id = array_key_exists( 'id', $img_obj ) ? $img_obj['id'] : null;
		if ( ! $img_id ) {
			return $block_content;
		}

		$image = $this->get_imgs( $img_id, $img_size, $chart_art );

		$sources = array(
			'desktop' => wp_sprintf(
				'<source srcset="%s 1x, %s 2x" media="(min-width: 768px)" width="%s" height="%s">',
				array_key_exists( 0, $image['desktop']['default'] ) ? $image['desktop']['default'][0] : null,
				array_key_exists( 0, $image['desktop']['hidpi'] ) ? $image['desktop']['hidpi'][0] : null,
				array_key_exists( 1, $image['desktop']['default'] ) ? $image['desktop']['default'][1] : null,
				array_key_exists( 2, $image['desktop']['default'] ) ? $image['desktop']['default'][2] : null,
			),
			'mobile'  => wp_sprintf(
				'<source srcset="%s 1x, %s 2x" media="(max-width: 767px)" width="%s" height="%s">',
				array_key_exists( 0, $image['mobile']['default'] ) ? $image['mobile']['default'][0] : null,
				array_key_exists( 0, $image['mobile']['hidpi'] ) ? $image['mobile']['hidpi'][0] : null,
				array_key_exists( 1, $image['mobile']['default'] ) ? $image['mobile']['default'][1] : null,
				array_key_exists( 2, $image['mobile']['default'] ) ? $image['mobile']['default'][2] : null,
			),
		);

		$image_class = \PRC\Platform\Block_Utils\classNames(
			'image',
			'jetpack-lazy-image',
			array(
				$img_size  => $img_size,
				'bordered' => $image['bordered'],
			)
		);

		$block_content = wp_sprintf(
			'<figure class="wp-block-post-featured-image">
				<a href="%1$s" class="%2$s">
					<picture>
						%3$s
						%4$s
						%5$s
					</picture>
				</a>
			</figure>',
			esc_url( $url ),
			esc_attr( $image_class ),
			$sources['desktop'],
			$sources['mobile'],
			wp_sprintf(
				'<img
					srcset="%1$s"
					width="%2$s"
					height="%3$s"
					alt="%4$s"
				>',
				esc_url( $image['desktop']['default'][0] ),
				esc_attr( $image['desktop']['default'][1] ),
				esc_attr( $image['desktop']['default'][2] ),
				esc_attr( $image['alt'] )
			)
		);

		return $block_content;
	}
}

================
File: plugins/prc-art-direction/includes/core-post-featured-image/package.json
================
{
	"name": "@pewresearch/art-direction-core-post-featured-image",
	"version": "1.0.0",
	"author": "PRC",
	"license": "GPL-2.0-or-later",
	"description": "A takeover of the core/post-featured-image block to provide art direction.",
	"scripts": {
		"build": "wp-scripts build src/index.js",
		"start": "wp-scripts start src/index.js"
	},
	"devDependencies": {
		"@wordpress/scripts": "^30.15.0"
	},
	"dependencies": {
		"@wordpress/icons": "^10.22.0"
	}
}

================
File: plugins/prc-art-direction/includes/core-post-featured-image/webpack.config.js
================
const config = require('../../../../webpack.config');

module.exports = config;

================
File: plugins/prc-art-direction/includes/inspector-sidebar-panel/build/index.asset.php
================
<?php return array('dependencies' => array('prc-components', 'prc-hooks', 'react-jsx-runtime', 'wp-components', 'wp-core-data', 'wp-data', 'wp-edit-post', 'wp-element', 'wp-hooks', 'wp-i18n', 'wp-polyfill', 'wp-primitives'), 'version' => '59343a3c2bc1e1bc8f48');

================
File: plugins/prc-art-direction/includes/inspector-sidebar-panel/build/index.js
================
(()=>{"use strict";var e,t={494:()=>{const e=window.wp.hooks,t=window.wp.element,o=window.prcComponents,r=window.wp.i18n,i=window.wp.primitives,n=window.ReactJSXRuntime,l=(0,n.jsx)(i.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24",children:(0,n.jsx)(i.Path,{d:"M19 3H5c-.6 0-1 .4-1 1v7c0 .5.4 1 1 1h14c.5 0 1-.4 1-1V4c0-.6-.4-1-1-1zM5.5 10.5v-.4l1.8-1.3 1.3.8c.3.2.7.2.9-.1L11 8.1l2.4 2.4H5.5zm13 0h-2.9l-4-4c-.3-.3-.8-.3-1.1 0L8.9 8l-1.2-.8c-.3-.2-.6-.2-.9 0l-1.3 1V4.5h13v6zM4 20h9v-1.5H4V20zm0-4h16v-1.5H4V16z"})}),s=window.prcHooks,a=window.wp.coreData,c=window.wp.data,d=(0,t.createContext)();function p(e,t){return e.sizes[t]?{id:e.id,rawUrl:e.url,url:e.sizes[t].url,width:e.sizes[t].width,height:e.sizes[t].height,caption:e.caption,chartArt:!1}:(console.error(`No image size found for ${t}`,e),!1)}const g=()=>(0,t.useContext)(d);function h({children:e}){const o=(()=>{const{postId:e,postType:o,testMeta:r}=(0,c.useSelect)((e=>({postId:e("core/editor").getCurrentPostId(),postType:e("core/editor").getCurrentPostType(),testMeta:e("core/editor").getCurrentPostAttribute("meta")})),[]),[i,n]=(0,a.useEntityProp)("postType",o,"meta",e),{canDelete:l,isResolving:d}=(0,a.useResourcePermissions)(o,e),g=(0,t.useMemo)((()=>(console.log("ART CHECK Permissions Check:",d,l),!d)),[d,l]),[h,m]=(0,t.useState)(i.artDirection||{}),u=(0,s.useDebounce)(h,500);(0,t.useEffect)((()=>{console.log("ART DIRECTION:",i,r,u,i.artDirection,h,g),g&&void 0!==i?(u.A1&&!1!==u.A1&&(function(e=!1){if(!1!==e){const{editPost:t}=(0,c.dispatch)("core/editor");t({featured_media:e.id})}}(u.A1),console.log("Featured Image: ",u.A1)),JSON.stringify(u)!==JSON.stringify(i.artDirection)?(console.log("Art Direction Change Detected",u,i),console.log("ART DIRECTION UPDATE: ",u,i),n({...i,artDirection:u})):console.log("No Art Direction Change Detected",u,i.artDirection)):console.log("ART DIRECTION UHOH: Can't edit or no meta",g,i)}),[u,g,i,n]);const x=(0,t.useMemo)((()=>!!h.A1),[h]),A=(0,t.useMemo)((()=>{const e=Object.keys(u),t=u[e[0]];console.log("allSlotsTheSame",e,t);for(let o=1;o<e.length;o++){console.log("allSlotsTheSame...",t,u[e[o]]);let r=0;if(t.id!==u[e[o]].id&&(r+=1),t.chartArt!==u[e[o]].chartArt&&(r+=1),r>0)return console.log("allSlotsTheSame...","not all the same"),!1}return console.log("allSlotsTheSame...","all the same"),!0}),[u]);return{allowEditing:g,postId:e,postType:o,artDirection:u,hasA1Image:x,setImageSlot:(e,t)=>{const o=function(e,t){const o={};return"A1"===t&&(o.A2=p(e,"A2"),o.XL=p(e,"XL"),o.facebook=p(e,"facebook"),o.twitter=p(e,"twitter")),"A1"!==t&&"A2"!==t||(o.A3=p(e,"A3"),o.A4=p(e,"A4")),"facebook"===t&&(o.twitter=p(e,"twitter")),o[t]=p(e,t),o}(e,t);m({...h,...o})},getImageSlot:e=>h?.[e],isImageSlotBordered:e=>h?.[e]?.chartArt,toggleImageSlotBordered:e=>{let t={...h};t=function(e={},t){const o=!e[t].chartArt;return"A2"===t?(e.A2.chartArt=o,e.A3.chartArt=o,e.A4.chartArt=o):e[t].chartArt=o,console.log("prc-platform/art-direction propagateBorderedToggle::",e),e}(t,e),m({...t})},capitalize:e=>"string"!=typeof e?"":e.charAt(0).toUpperCase()+e.slice(1),allSlotsTheSame:A}})();return(0,n.jsx)(d.Provider,{value:o,children:e})}const m=window.wp.components;function u({label:e,size:o}){const{isImageSlotBordered:r,toggleImageSlotBordered:i,capitalize:l}=g(),s=r(o),a=(0,t.useMemo)((()=>e||l(o)),[e,o,l]);return(0,n.jsxs)(m.Flex,{style:{alignItems:"center",borderTop:"1px solid #eaeaea",height:"45px"},children:[(0,n.jsx)(m.FlexBlock,{children:(0,n.jsx)("strong",{children:a})}),(0,n.jsx)(m.FlexItem,{children:("A2"===o||"A3"===o||"A4"===o)&&(0,n.jsx)(m.ToggleControl,{__nextHasNoMarginBottom:!0,label:"Border",onChange:()=>i(o),checked:s})})]})}function x({size:e,labels:r,onClick:i,overlayActive:l,enableLabel:s=!0}){const{getImageSlot:a,setImageSlot:c,capitalize:d}=g(),p=(0,t.useMemo)((()=>a(e)),[e,a]),h=(0,t.useMemo)((()=>p?p.id:null),[p]),m=d(e);return(0,n.jsxs)("div",{className:"prc-platform-art-direction__slot",children:[s&&(0,n.jsx)(u,{label:r?.label||`${m}`,size:e}),(0,n.jsx)(o.MediaImageSlot,{id:h,size:e,labels:r||{label:`Edit ${m} Image Slot`,title:`Select ${m} Image`,update:`Update ${m} Image Slot`,dropzone:`Drop ${m}`},onUpdate:t=>{c(t,e)},onClick:i,overlayActive:l})]})}function A(){const{hasA1Image:e}=g();return(0,n.jsxs)("div",{className:"prc-platform-art-direction__list",children:[(0,n.jsx)("p",{children:(0,n.jsx)(m.ExternalLink,{href:"https://platform.pewresearch.org/wiki/art-direction",children:"Art Direction Documentation"})}),(0,n.jsx)("p",{style:{background:"var(--wp--custom--color-grey-spectrum-light-one)",padding:"0.5em 1em",marginLeft:"-1em",marginRight:"-1em",marginTop:"1em",marginBottom:"-1px"},children:(0,n.jsx)("strong",{children:"Story Item"})}),(0,n.jsx)(x,{size:"A1"}),e&&(0,n.jsxs)(t.Fragment,{children:[(0,n.jsx)(x,{size:"A2"}),(0,n.jsxs)(m.Flex,{children:[(0,n.jsx)(m.FlexBlock,{children:(0,n.jsx)(x,{size:"A3"})}),(0,n.jsx)(m.FlexBlock,{children:(0,n.jsx)(x,{size:"A4"})})]}),(0,n.jsx)("p",{style:{background:"var(--wp--custom--color-grey-spectrum-light-one)",padding:"0.5em 1em",marginLeft:"-1em",marginRight:"-1em",marginTop:"1em",marginBottom:"-1px"},children:(0,n.jsx)("strong",{children:"Social"})}),(0,n.jsxs)(m.Flex,{children:[(0,n.jsx)(m.FlexBlock,{children:(0,n.jsx)(x,{size:"facebook"})}),(0,n.jsx)(m.FlexBlock,{children:(0,n.jsx)(x,{size:"twitter"})})]})]})]})}function w(){const{hasA1Image:e,allSlotsTheSame:t}=g();return(0,n.jsx)(o.InspectorPopoutPanel,{title:(0,r.__)("Art Direction"),className:"prc-platform-art-direction-panel",renderToggle:({isOpen:o,onToggle:r})=>(0,n.jsx)(x,{size:"A1",labels:{label:"Setup Art Direction",title:"Select Art Direction Image",update:t?"Update Art Direction":"Update Art Direction (Some Slots Differ)",dropzone:"Drop A1 Image",icon:l},onClick:e?r:void 0,enableLabel:!1,overlayActive:o}),children:(0,n.jsx)(A,{})})}function f(){return(0,n.jsx)(h,{children:(0,n.jsx)(w,{})})}const j=window.wp.editPost;function v(){return(0,n.jsx)(j.PluginPrePublishPanel,{title:"Review Art Direction",initialOpen:!0,children:(0,n.jsx)(h,{children:(0,n.jsx)(A,{})})})}(0,e.addFilter)("editor.PostFeaturedImage","prc-platform/art-direction",(function(){return()=>(0,n.jsxs)(t.Fragment,{children:[(0,n.jsx)(f,{}),(0,n.jsx)(v,{})]})})),(0,e.addFilter)("prc-platform.attachments-panel","prc-platform/art-direction",(function(e){return()=>(0,n.jsxs)(t.Fragment,{children:[(0,n.jsx)(e,{}),(0,n.jsx)(h,{children:(0,n.jsx)(m.PanelBody,{title:"Art Direction",initialOpen:!1,children:(0,n.jsx)(A,{})})})]})}))}},o={};function r(e){var i=o[e];if(void 0!==i)return i.exports;var n=o[e]={exports:{}};return t[e](n,n.exports,r),n.exports}r.m=t,e=[],r.O=(t,o,i,n)=>{if(!o){var l=1/0;for(d=0;d<e.length;d++){for(var[o,i,n]=e[d],s=!0,a=0;a<o.length;a++)(!1&n||l>=n)&&Object.keys(r.O).every((e=>r.O[e](o[a])))?o.splice(a--,1):(s=!1,n<l&&(l=n));if(s){e.splice(d--,1);var c=i();void 0!==c&&(t=c)}}return t}n=n||0;for(var d=e.length;d>0&&e[d-1][2]>n;d--)e[d]=e[d-1];e[d]=[o,i,n]},r.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t),(()=>{var e={57:0,350:0};r.O.j=t=>0===e[t];var t=(t,o)=>{var i,n,[l,s,a]=o,c=0;if(l.some((t=>0!==e[t]))){for(i in s)r.o(s,i)&&(r.m[i]=s[i]);if(a)var d=a(r)}for(t&&t(o);c<l.length;c++)n=l[c],r.o(e,n)&&e[n]&&e[n][0](),e[n]=0;return r.O(d)},o=globalThis.webpackChunk_pewresearch_art_direction=globalThis.webpackChunk_pewresearch_art_direction||[];o.forEach(t.bind(null,0)),o.push=t.bind(null,o.push.bind(o))})();var i=r.O(void 0,[350],(()=>r(494)));i=r.O(i)})();
//# sourceMappingURL=index.js.map

================
File: plugins/prc-art-direction/includes/inspector-sidebar-panel/build/index.js.map
================
{"version":3,"file":"index.js","mappings":"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","sources":["webpack://@pewresearch/art-direction/webpack/runtime/chunk loaded","webpack://@pewresearch/art-direction/external window [\"wp\",\"hooks\"]","webpack://@pewresearch/art-direction/external window [\"wp\",\"element\"]","webpack://@pewresearch/art-direction/external window \"prcComponents\"","webpack://@pewresearch/art-direction/external window [\"wp\",\"i18n\"]","webpack://@pewresearch/art-direction/external window [\"wp\",\"primitives\"]","webpack://@pewresearch/art-direction/external window \"ReactJSXRuntime\"","webpack://@pewresearch/art-direction/./node_modules/@wordpress/icons/build-module/library/post-featured-image.js","webpack://@pewresearch/art-direction/external window \"prcHooks\"","webpack://@pewresearch/art-direction/external window [\"wp\",\"coreData\"]","webpack://@pewresearch/art-direction/external window [\"wp\",\"data\"]","webpack://@pewresearch/art-direction/./src/context.js","webpack://@pewresearch/art-direction/external window [\"wp\",\"components\"]","webpack://@pewresearch/art-direction/./src/slot/label.jsx","webpack://@pewresearch/art-direction/./src/slot/index.jsx","webpack://@pewresearch/art-direction/./src/art-direction-list.jsx","webpack://@pewresearch/art-direction/./src/inspector-sidebar.jsx","webpack://@pewresearch/art-direction/external window [\"wp\",\"editPost\"]","webpack://@pewresearch/art-direction/./src/pre-publish-panel.jsx","webpack://@pewresearch/art-direction/./src/index.js","webpack://@pewresearch/art-direction/./src/attachments-panel-hook.js","webpack://@pewresearch/art-direction/webpack/bootstrap","webpack://@pewresearch/art-direction/webpack/runtime/hasOwnProperty shorthand","webpack://@pewresearch/art-direction/webpack/runtime/jsonp chunk loading","webpack://@pewresearch/art-direction/webpack/startup"],"sourcesContent":["var deferred = [];\n__webpack_require__.O = (result, chunkIds, fn, priority) => {\n\tif(chunkIds) {\n\t\tpriority = priority || 0;\n\t\tfor(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];\n\t\tdeferred[i] = [chunkIds, fn, priority];\n\t\treturn;\n\t}\n\tvar notFulfilled = Infinity;\n\tfor (var i = 0; i < deferred.length; i++) {\n\t\tvar [chunkIds, fn, priority] = deferred[i];\n\t\tvar fulfilled = true;\n\t\tfor (var j = 0; j < chunkIds.length; j++) {\n\t\t\tif ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {\n\t\t\t\tchunkIds.splice(j--, 1);\n\t\t\t} else {\n\t\t\t\tfulfilled = false;\n\t\t\t\tif(priority < notFulfilled) notFulfilled = priority;\n\t\t\t}\n\t\t}\n\t\tif(fulfilled) {\n\t\t\tdeferred.splice(i--, 1)\n\t\t\tvar r = fn();\n\t\t\tif (r !== undefined) result = r;\n\t\t}\n\t}\n\treturn result;\n};","const __WEBPACK_NAMESPACE_OBJECT__ = window[\"wp\"][\"hooks\"];","const __WEBPACK_NAMESPACE_OBJECT__ = window[\"wp\"][\"element\"];","const __WEBPACK_NAMESPACE_OBJECT__ = window[\"prcComponents\"];","const __WEBPACK_NAMESPACE_OBJECT__ = window[\"wp\"][\"i18n\"];","const __WEBPACK_NAMESPACE_OBJECT__ = window[\"wp\"][\"primitives\"];","const __WEBPACK_NAMESPACE_OBJECT__ = window[\"ReactJSXRuntime\"];","/**\n * WordPress dependencies\n */\nimport { Path, SVG } from '@wordpress/primitives';\nimport { jsx as _jsx } from \"react/jsx-runtime\";\nconst postFeaturedImage = /*#__PURE__*/_jsx(SVG, {\n  xmlns: \"http://www.w3.org/2000/svg\",\n  viewBox: \"0 0 24 24\",\n  children: /*#__PURE__*/_jsx(Path, {\n    d: \"M19 3H5c-.6 0-1 .4-1 1v7c0 .5.4 1 1 1h14c.5 0 1-.4 1-1V4c0-.6-.4-1-1-1zM5.5 10.5v-.4l1.8-1.3 1.3.8c.3.2.7.2.9-.1L11 8.1l2.4 2.4H5.5zm13 0h-2.9l-4-4c-.3-.3-.8-.3-1.1 0L8.9 8l-1.2-.8c-.3-.2-.6-.2-.9 0l-1.3 1V4.5h13v6zM4 20h9v-1.5H4V20zm0-4h16v-1.5H4V16z\"\n  })\n});\nexport default postFeaturedImage;\n//# sourceMappingURL=post-featured-image.js.map","const __WEBPACK_NAMESPACE_OBJECT__ = window[\"prcHooks\"];","const __WEBPACK_NAMESPACE_OBJECT__ = window[\"wp\"][\"coreData\"];","const __WEBPACK_NAMESPACE_OBJECT__ = window[\"wp\"][\"data\"];","/* eslint-disable max-lines-per-function */\n/* eslint-disable max-len */\n/**\n * External Dependencies\n */\nimport { useDebounce } from '@prc/hooks';\n\n/**\n * WordPress Dependencies\n */\nimport {\n\tuseEffect,\n\tuseState,\n\tuseContext,\n\tuseMemo,\n\tcreateContext,\n} from '@wordpress/element';\nimport { useEntityProp, useResourcePermissions } from '@wordpress/core-data';\nimport { dispatch, useSelect, useDispatch } from '@wordpress/data';\n\n/**\n * Internal Dependencies\n */\n\nconst artDirectionContext = createContext();\n\nfunction shapeImg(img, size) {\n\t// console.log('prc-platform/art-direction shapeImg::', img);\n\tif (img.sizes[size]) {\n\t\treturn {\n\t\t\tid: img.id,\n\t\t\trawUrl: img.url,\n\t\t\turl: img.sizes[size].url,\n\t\t\twidth: img.sizes[size].width,\n\t\t\theight: img.sizes[size].height,\n\t\t\tcaption: img.caption,\n\t\t\tchartArt: false,\n\t\t};\n\t}\n\t// eslint-disable-next-line no-console\n\tconsole.error(`No image size found for ${size}`, img);\n\treturn false;\n}\n\n/**\n * State logic that sets other state objects.\n * If the state/image being processed is A1 sized it will autopopulate all images.\n * If A2 then A3 and A4 will be acted upon\n * If Facebook then only Twitter will be acted upon\n *\n * @param {WP Media Image Blob} imgData\n * @param {string}              size\n * @return {Object} modified state object\n */\nfunction propagateImageChanges(imgData, size) {\n\tconst updates = {};\n\tif ('A1' === size) {\n\t\tupdates.A2 = shapeImg(imgData, 'A2');\n\t\tupdates.XL = shapeImg(imgData, 'XL');\n\t\tupdates.facebook = shapeImg(imgData, 'facebook');\n\t\tupdates.twitter = shapeImg(imgData, 'twitter');\n\t}\n\tif ('A1' === size || 'A2' === size) {\n\t\tupdates.A3 = shapeImg(imgData, 'A3');\n\t\tupdates.A4 = shapeImg(imgData, 'A4');\n\t}\n\tif ('facebook' === size) {\n\t\tupdates.twitter = shapeImg(imgData, 'twitter');\n\t}\n\tupdates[size] = shapeImg(imgData, size);\n\treturn updates;\n}\n\nfunction propagateBorderedToggle(updates = {}, size) {\n\tconst value = !updates[size].chartArt;\n\tif ('A2' === size) {\n\t\tupdates.A2.chartArt = value;\n\t\tupdates.A3.chartArt = value;\n\t\tupdates.A4.chartArt = value;\n\t} else {\n\t\tupdates[size].chartArt = value;\n\t}\n\tconsole.log(\n\t\t'prc-platform/art-direction propagateBorderedToggle::',\n\t\tupdates\n\t);\n\treturn updates;\n}\n\nfunction updateFeatureImage(img = false) {\n\tif (false !== img) {\n\t\tconst { editPost } = dispatch('core/editor');\n\t\teditPost({ featured_media: img.id });\n\t}\n}\n\nconst useArtDirectionContext = () => {\n\tconst { postId, postType, testMeta } = useSelect((select) => {\n\t\treturn {\n\t\t\tpostId: select('core/editor').getCurrentPostId(),\n\t\t\tpostType: select('core/editor').getCurrentPostType(),\n\t\t\ttestMeta: select('core/editor').getCurrentPostAttribute('meta'),\n\t\t};\n\t}, []);\n\tconst [meta, setMeta] = useEntityProp('postType', postType, 'meta', postId);\n\tconst { canDelete, isResolving } = useResourcePermissions(postType, postId);\n\tconst allowEditing = useMemo(() => {\n\t\tconsole.log('ART CHECK Permissions Check:', isResolving, canDelete);\n\t\tif (isResolving) {\n\t\t\treturn false;\n\t\t}\n\t\treturn true;\n\t}, [isResolving, canDelete]);\n\n\tconst [artDirection, setArtDirection] = useState(meta.artDirection || {});\n\tconst debouncedArtDirection = useDebounce(artDirection, 500);\n\n\t/**\n\t * Handle saving data back to post.\n\t * This approach doesnt support cross collabration as well... but it works for now.\n\t */\n\tuseEffect(() => {\n\t\tconsole.log(\n\t\t\t'ART DIRECTION:',\n\t\t\tmeta,\n\t\t\ttestMeta,\n\t\t\tdebouncedArtDirection,\n\t\t\tmeta.artDirection,\n\t\t\tartDirection,\n\t\t\tallowEditing\n\t\t);\n\t\tif (!allowEditing || undefined === meta) {\n\t\t\tconsole.log(\n\t\t\t\t\"ART DIRECTION UHOH: Can't edit or no meta\",\n\t\t\t\tallowEditing,\n\t\t\t\tmeta\n\t\t\t);\n\t\t\treturn;\n\t\t}\n\t\t// If there is an A1 image, set it as the featured image\n\t\tif (debouncedArtDirection.A1 && debouncedArtDirection.A1 !== false) {\n\t\t\tupdateFeatureImage(debouncedArtDirection.A1);\n\t\t\tconsole.log('Featured Image: ', debouncedArtDirection.A1);\n\t\t}\n\t\t// Check if debouncedArtDirection is different from meta.artDirection, by going through each object and it's properties and making sure they are the same.\n\t\tif (\n\t\t\tJSON.stringify(debouncedArtDirection) !==\n\t\t\tJSON.stringify(meta.artDirection)\n\t\t) {\n\t\t\t// console.clear();\n\t\t\tconsole.log(\n\t\t\t\t'Art Direction Change Detected',\n\t\t\t\tdebouncedArtDirection,\n\t\t\t\tmeta\n\t\t\t);\n\t\t} else {\n\t\t\tconsole.log(\n\t\t\t\t'No Art Direction Change Detected',\n\t\t\t\tdebouncedArtDirection,\n\t\t\t\tmeta.artDirection\n\t\t\t);\n\t\t\treturn;\n\t\t}\n\t\tconsole.log('ART DIRECTION UPDATE: ', debouncedArtDirection, meta);\n\t\tsetMeta({\n\t\t\t...meta,\n\t\t\tartDirection: debouncedArtDirection,\n\t\t});\n\t}, [debouncedArtDirection, allowEditing, meta, setMeta]);\n\n\tconst setImageSlot = (imgData, size) => {\n\t\tconst newArtDirection = propagateImageChanges(imgData, size);\n\t\tsetArtDirection({ ...artDirection, ...newArtDirection });\n\t};\n\n\tconst toggleImageSlotBordered = (size) => {\n\t\tlet newArtDirection = { ...artDirection };\n\t\tnewArtDirection = propagateBorderedToggle(newArtDirection, size);\n\t\tsetArtDirection({ ...newArtDirection });\n\t};\n\n\tconst isImageSlotBordered = (size) => {\n\t\treturn artDirection?.[size]?.chartArt;\n\t};\n\n\tconst getImageSlot = (size) => {\n\t\treturn artDirection?.[size];\n\t};\n\n\tconst capitalize = (s) => {\n\t\tif ('string' !== typeof s) return '';\n\t\treturn s.charAt(0).toUpperCase() + s.slice(1);\n\t};\n\n\tconst hasA1Image = useMemo(() => {\n\t\treturn !!artDirection.A1;\n\t}, [artDirection]);\n\n\tconst allSlotsTheSame = useMemo(() => {\n\t\tconst keys = Object.keys(debouncedArtDirection);\n\t\tconst first = debouncedArtDirection[keys[0]];\n\t\tconsole.log('allSlotsTheSame', keys, first);\n\t\tfor (let i = 1; i < keys.length; i++) {\n\t\t\tconsole.log(\n\t\t\t\t'allSlotsTheSame...',\n\t\t\t\tfirst,\n\t\t\t\tdebouncedArtDirection[keys[i]]\n\t\t\t);\n\t\t\tlet strike = 0;\n\t\t\tif (first.id !== debouncedArtDirection[keys[i]].id) {\n\t\t\t\tstrike += 1;\n\t\t\t}\n\t\t\tif (first.chartArt !== debouncedArtDirection[keys[i]].chartArt) {\n\t\t\t\tstrike += 1;\n\t\t\t}\n\t\t\tif (strike > 0) {\n\t\t\t\tconsole.log('allSlotsTheSame...', 'not all the same');\n\t\t\t\treturn false;\n\t\t\t}\n\t\t}\n\t\tconsole.log('allSlotsTheSame...', 'all the same');\n\t\treturn true;\n\t}, [debouncedArtDirection]);\n\n\treturn {\n\t\tallowEditing,\n\t\tpostId,\n\t\tpostType,\n\t\tartDirection: debouncedArtDirection,\n\t\thasA1Image,\n\t\tsetImageSlot,\n\t\tgetImageSlot,\n\t\tisImageSlotBordered,\n\t\ttoggleImageSlotBordered,\n\t\tcapitalize,\n\t\tallSlotsTheSame,\n\t};\n};\n\nconst useArtDirection = () => useContext(artDirectionContext);\n\nfunction ProvideArtDirection({ children }) {\n\tconst provider = useArtDirectionContext();\n\treturn (\n\t\t<artDirectionContext.Provider value={provider}>\n\t\t\t{children}\n\t\t</artDirectionContext.Provider>\n\t);\n}\n\nexport { ProvideArtDirection, useArtDirection };\nexport default ProvideArtDirection;\n","const __WEBPACK_NAMESPACE_OBJECT__ = window[\"wp\"][\"components\"];","/* eslint-disable max-lines-per-function */\n/**\n * CSS Classes and Styling Forked from Gutenberg featured image component:\n * https://github.com/WordPress/gutenberg/blob/3da717b8d0ac7d7821fc6d0475695ccf3ae2829f/packages/editor/src/components/post-featured-image/index.js\n */\n\n/**\n * External Dependencies\n */\n\n/**\n * WordPress Dependencies\n */\nimport { useMemo } from '@wordpress/element';\nimport {\n\tFlex,\n\tFlexBlock,\n\tFlexItem,\n\tToggleControl,\n} from '@wordpress/components';\n\n/**\n * Internal Dependencies\n */\nimport { useArtDirection } from '../context';\n\nexport default function Label({ label, size }) {\n\tconst { isImageSlotBordered, toggleImageSlotBordered, capitalize } =\n\t\tuseArtDirection();\n\tconst isChartArt = isImageSlotBordered(size);\n\tconst labelText = useMemo(() => {\n\t\treturn label || capitalize(size);\n\t}, [label, size, capitalize]);\n\treturn (\n\t\t<Flex\n\t\t\tstyle={{\n\t\t\t\talignItems: 'center',\n\t\t\t\tborderTop: '1px solid #eaeaea',\n\t\t\t\theight: '45px',\n\t\t\t}}\n\t\t>\n\t\t\t<FlexBlock>\n\t\t\t\t<strong>{labelText}</strong>\n\t\t\t</FlexBlock>\n\n\t\t\t<FlexItem>\n\t\t\t\t{('A2' === size || 'A3' === size || 'A4' === size) && (\n\t\t\t\t\t<ToggleControl\n\t\t\t\t\t\t__nextHasNoMarginBottom\n\t\t\t\t\t\tlabel=\"Border\"\n\t\t\t\t\t\tonChange={() => toggleImageSlotBordered(size)}\n\t\t\t\t\t\tchecked={isChartArt}\n\t\t\t\t\t/>\n\t\t\t\t)}\n\t\t\t</FlexItem>\n\t\t</Flex>\n\t);\n}\n","/* eslint-disable max-lines-per-function */\n/**\n * CSS Classes and Styling Forked from Gutenberg featured image component:\n * https://github.com/WordPress/gutenberg/blob/3da717b8d0ac7d7821fc6d0475695ccf3ae2829f/packages/editor/src/components/post-featured-image/index.js\n */\n\n/**\n * External Dependencies\n */\nimport { MediaImageSlot } from '@prc/components';\n\n/**\n * WordPress Dependencies\n */\nimport { useMemo } from '@wordpress/element';\n\n/**\n * Internal Dependencies\n */\nimport { useArtDirection } from '../context';\nimport Label from './label';\n\nexport default function Slot({\n\tsize,\n\tlabels,\n\tonClick,\n\toverlayActive,\n\tenableLabel = true,\n}) {\n\tconst { getImageSlot, setImageSlot, capitalize } = useArtDirection();\n\n\tconst image = useMemo(() => {\n\t\treturn getImageSlot(size);\n\t}, [size, getImageSlot]);\n\n\tconst id = useMemo(() => {\n\t\treturn image ? image.id : null;\n\t}, [image]);\n\n\tconst capitalizeSize = capitalize(size);\n\n\treturn (\n\t\t<div className=\"prc-platform-art-direction__slot\">\n\t\t\t{enableLabel && (\n\t\t\t\t<Label\n\t\t\t\t\tlabel={labels?.label || `${capitalizeSize}`}\n\t\t\t\t\tsize={size}\n\t\t\t\t/>\n\t\t\t)}\n\t\t\t<MediaImageSlot\n\t\t\t\t{...{\n\t\t\t\t\tid,\n\t\t\t\t\tsize,\n\t\t\t\t\tlabels: labels || {\n\t\t\t\t\t\tlabel: `Edit ${capitalizeSize} Image Slot`,\n\t\t\t\t\t\ttitle: `Select ${capitalizeSize} Image`,\n\t\t\t\t\t\tupdate: `Update ${capitalizeSize} Image Slot`,\n\t\t\t\t\t\tdropzone: `Drop ${capitalizeSize}`,\n\t\t\t\t\t},\n\t\t\t\t\tonUpdate: (img) => {\n\t\t\t\t\t\tsetImageSlot(img, size);\n\t\t\t\t\t},\n\t\t\t\t\tonClick,\n\t\t\t\t\toverlayActive,\n\t\t\t\t}}\n\t\t\t/>\n\t\t</div>\n\t);\n}\n","/* eslint-disable no-nested-ternary */\n/**\n * WordPress Dependencies\n */\nimport { Fragment } from '@wordpress/element';\nimport { Flex, FlexBlock, ExternalLink } from '@wordpress/components';\n\n/**\n * Internal Dependencies\n */\nimport Slot from './slot';\nimport { useArtDirection } from './context';\n\nexport default function ArtDirectionList() {\n\tconst { hasA1Image } = useArtDirection();\n\n\treturn (\n\t\t<div className=\"prc-platform-art-direction__list\">\n\t\t\t<p>\n\t\t\t\t<ExternalLink href=\"https://platform.pewresearch.org/wiki/art-direction\">\n\t\t\t\t\tArt Direction Documentation\n\t\t\t\t</ExternalLink>\n\t\t\t</p>\n\t\t\t<p\n\t\t\t\tstyle={{\n\t\t\t\t\tbackground:\n\t\t\t\t\t\t'var(--wp--custom--color-grey-spectrum-light-one)',\n\t\t\t\t\tpadding: '0.5em 1em',\n\t\t\t\t\tmarginLeft: '-1em',\n\t\t\t\t\tmarginRight: '-1em',\n\t\t\t\t\tmarginTop: '1em',\n\t\t\t\t\tmarginBottom: '-1px',\n\t\t\t\t}}\n\t\t\t>\n\t\t\t\t<strong>Story Item</strong>\n\t\t\t</p>\n\t\t\t<Slot size=\"A1\" />\n\t\t\t{hasA1Image && (\n\t\t\t\t<Fragment>\n\t\t\t\t\t<Slot size=\"A2\" />\n\t\t\t\t\t<Flex>\n\t\t\t\t\t\t<FlexBlock>\n\t\t\t\t\t\t\t<Slot size=\"A3\" />\n\t\t\t\t\t\t</FlexBlock>\n\t\t\t\t\t\t<FlexBlock>\n\t\t\t\t\t\t\t<Slot size=\"A4\" />\n\t\t\t\t\t\t</FlexBlock>\n\t\t\t\t\t</Flex>\n\t\t\t\t\t<p\n\t\t\t\t\t\tstyle={{\n\t\t\t\t\t\t\tbackground:\n\t\t\t\t\t\t\t\t'var(--wp--custom--color-grey-spectrum-light-one)',\n\t\t\t\t\t\t\tpadding: '0.5em 1em',\n\t\t\t\t\t\t\tmarginLeft: '-1em',\n\t\t\t\t\t\t\tmarginRight: '-1em',\n\t\t\t\t\t\t\tmarginTop: '1em',\n\t\t\t\t\t\t\tmarginBottom: '-1px',\n\t\t\t\t\t\t}}\n\t\t\t\t\t>\n\t\t\t\t\t\t<strong>Social</strong>\n\t\t\t\t\t</p>\n\t\t\t\t\t<Flex>\n\t\t\t\t\t\t<FlexBlock>\n\t\t\t\t\t\t\t<Slot size=\"facebook\" />\n\t\t\t\t\t\t</FlexBlock>\n\t\t\t\t\t\t<FlexBlock>\n\t\t\t\t\t\t\t<Slot size=\"twitter\" />\n\t\t\t\t\t\t</FlexBlock>\n\t\t\t\t\t</Flex>\n\t\t\t\t</Fragment>\n\t\t\t)}\n\t\t</div>\n\t);\n}\n","/* eslint-disable max-lines-per-function */\n/**\n * External Dependencies\n */\nimport { InspectorPopoutPanel } from '@prc/components';\n\n/**\n * WordPress Dependencies\n */\nimport { __ } from '@wordpress/i18n';\nimport { postFeaturedImage } from '@wordpress/icons';\n\n/**\n * Internal Dependencies\n */\nimport { ProvideArtDirection, useArtDirection } from './context';\nimport ArtDirectionList from './art-direction-list';\nimport Slot from './slot';\n\nfunction InspectorSidebar() {\n\tconst { hasA1Image, allSlotsTheSame } = useArtDirection();\n\n\treturn (\n\t\t<InspectorPopoutPanel\n\t\t\ttitle={__('Art Direction')}\n\t\t\tclassName=\"prc-platform-art-direction-panel\"\n\t\t\trenderToggle={({ isOpen, onToggle }) => (\n\t\t\t\t<Slot\n\t\t\t\t\t{...{\n\t\t\t\t\t\tsize: 'A1',\n\t\t\t\t\t\tlabels: {\n\t\t\t\t\t\t\tlabel: 'Setup Art Direction',\n\t\t\t\t\t\t\ttitle: 'Select Art Direction Image',\n\t\t\t\t\t\t\tupdate: !allSlotsTheSame\n\t\t\t\t\t\t\t\t? 'Update Art Direction (Some Slots Differ)'\n\t\t\t\t\t\t\t\t: 'Update Art Direction',\n\t\t\t\t\t\t\tdropzone: 'Drop A1 Image',\n\t\t\t\t\t\t\ticon: postFeaturedImage,\n\t\t\t\t\t\t},\n\t\t\t\t\t\tonClick: hasA1Image ? onToggle : undefined, // If the A1 image already exists open the panel, otherwise allow the slot to do it's default action which is to open the media library.\n\t\t\t\t\t\tenableLabel: false,\n\t\t\t\t\t\toverlayActive: isOpen,\n\t\t\t\t\t}}\n\t\t\t\t/>\n\t\t\t)}\n\t\t>\n\t\t\t<ArtDirectionList />\n\t\t</InspectorPopoutPanel>\n\t);\n}\n\nexport default function ProvideInspectorSidebar() {\n\treturn (\n\t\t<ProvideArtDirection>\n\t\t\t<InspectorSidebar />\n\t\t</ProvideArtDirection>\n\t);\n}\n","const __WEBPACK_NAMESPACE_OBJECT__ = window[\"wp\"][\"editPost\"];","/**\n * WordPress Dependencies\n */\nimport { PluginPrePublishPanel } from '@wordpress/edit-post';\n\n/**\n * Internal Dependencies\n */\nimport { ProvideArtDirection } from './context';\nimport ArtDirectionList from './art-direction-list';\n\nexport default function PrePublishPanel() {\n\treturn (\n\t\t<PluginPrePublishPanel title=\"Review Art Direction\" initialOpen>\n\t\t\t<ProvideArtDirection>\n\t\t\t\t<ArtDirectionList />\n\t\t\t</ProvideArtDirection>\n\t\t</PluginPrePublishPanel>\n\t);\n}\n","/**\n * WordPress Dependencies\n */\nimport { addFilter } from '@wordpress/hooks';\nimport { Fragment } from '@wordpress/element';\n\n/**\n * Internal Dependencies\n */\nimport './style.scss';\nimport InspectorSidebar from './inspector-sidebar';\nimport PrePublishPanel from './pre-publish-panel';\nimport renderAttachmentsPanelHook from './attachments-panel-hook';\n\nfunction renderArtDirectionPlugin() {\n\treturn () => (\n\t\t<Fragment>\n\t\t\t<InspectorSidebar />\n\t\t\t<PrePublishPanel />\n\t\t</Fragment>\n\t);\n}\n\n// Replace the \"Featured Image\" area with our \"Art Direction\" panel.\naddFilter(\n\t'editor.PostFeaturedImage',\n\t'prc-platform/art-direction',\n\trenderArtDirectionPlugin\n);\n\naddFilter(\n\t'prc-platform.attachments-panel',\n\t'prc-platform/art-direction',\n\trenderAttachmentsPanelHook\n);\n","/**\n * WordPress Dependencies\n */\nimport { Fragment } from '@wordpress/element';\nimport { PanelBody } from '@wordpress/components';\n\n/**\n * Internal Dependencies\n */\nimport { ProvideArtDirection } from './context';\nimport ArtDirectionList from './art-direction-list';\n\nexport default function renderAttachmentsPanelHook(AttachmentsPanel) {\n\treturn () => (\n\t\t<Fragment>\n\t\t\t<AttachmentsPanel />\n\t\t\t<ProvideArtDirection>\n\t\t\t\t<PanelBody title=\"Art Direction\" initialOpen={false}>\n\t\t\t\t\t<ArtDirectionList />\n\t\t\t\t</PanelBody>\n\t\t\t</ProvideArtDirection>\n\t\t</Fragment>\n\t);\n}\n","// The module cache\nvar __webpack_module_cache__ = {};\n\n// The require function\nfunction __webpack_require__(moduleId) {\n\t// Check if module is in cache\n\tvar cachedModule = __webpack_module_cache__[moduleId];\n\tif (cachedModule !== undefined) {\n\t\treturn cachedModule.exports;\n\t}\n\t// Create a new module (and put it into the cache)\n\tvar module = __webpack_module_cache__[moduleId] = {\n\t\t// no module.id needed\n\t\t// no module.loaded needed\n\t\texports: {}\n\t};\n\n\t// Execute the module function\n\t__webpack_modules__[moduleId](module, module.exports, __webpack_require__);\n\n\t// Return the exports of the module\n\treturn module.exports;\n}\n\n// expose the modules object (__webpack_modules__)\n__webpack_require__.m = __webpack_modules__;\n\n","__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))","// no baseURI\n\n// object to store loaded and loading chunks\n// undefined = chunk not loaded, null = chunk preloaded/prefetched\n// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded\nvar installedChunks = {\n\t57: 0,\n\t350: 0\n};\n\n// no chunk on demand loading\n\n// no prefetching\n\n// no preloaded\n\n// no HMR\n\n// no HMR manifest\n\n__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);\n\n// install a JSONP callback for chunk loading\nvar webpackJsonpCallback = (parentChunkLoadingFunction, data) => {\n\tvar [chunkIds, moreModules, runtime] = data;\n\t// add \"moreModules\" to the modules object,\n\t// then flag all \"chunkIds\" as loaded and fire callback\n\tvar moduleId, chunkId, i = 0;\n\tif(chunkIds.some((id) => (installedChunks[id] !== 0))) {\n\t\tfor(moduleId in moreModules) {\n\t\t\tif(__webpack_require__.o(moreModules, moduleId)) {\n\t\t\t\t__webpack_require__.m[moduleId] = moreModules[moduleId];\n\t\t\t}\n\t\t}\n\t\tif(runtime) var result = runtime(__webpack_require__);\n\t}\n\tif(parentChunkLoadingFunction) parentChunkLoadingFunction(data);\n\tfor(;i < chunkIds.length; i++) {\n\t\tchunkId = chunkIds[i];\n\t\tif(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {\n\t\t\tinstalledChunks[chunkId][0]();\n\t\t}\n\t\tinstalledChunks[chunkId] = 0;\n\t}\n\treturn __webpack_require__.O(result);\n}\n\nvar chunkLoadingGlobal = globalThis[\"webpackChunk_pewresearch_art_direction\"] = globalThis[\"webpackChunk_pewresearch_art_direction\"] || [];\nchunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));\nchunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));","// startup\n// Load entry module and return exports\n// This entry module depends on other loaded chunks and execution need to be delayed\nvar __webpack_exports__ = __webpack_require__.O(undefined, [350], () => (__webpack_require__(494)))\n__webpack_exports__ = __webpack_require__.O(__webpack_exports__);\n"],"names":["deferred","window","SVG","xmlns","viewBox","children","Path","d","artDirectionContext","createContext","shapeImg","img","size","sizes","id","rawUrl","url","width","height","caption","chartArt","console","error","useArtDirection","useContext","ProvideArtDirection","provider","useArtDirectionContext","postId","postType","testMeta","useSelect","select","getCurrentPostId","getCurrentPostType","getCurrentPostAttribute","meta","setMeta","useEntityProp","canDelete","isResolving","useResourcePermissions","allowEditing","useMemo","log","artDirection","setArtDirection","useState","debouncedArtDirection","useDebounce","useEffect","undefined","A1","editPost","dispatch","featured_media","updateFeatureImage","JSON","stringify","hasA1Image","allSlotsTheSame","keys","Object","first","i","length","strike","setImageSlot","imgData","newArtDirection","updates","A2","XL","facebook","twitter","A3","A4","propagateImageChanges","getImageSlot","isImageSlotBordered","toggleImageSlotBordered","value","propagateBorderedToggle","capitalize","s","charAt","toUpperCase","slice","_jsx","Provider","Label","label","isChartArt","labelText","_jsxs","Flex","style","alignItems","borderTop","FlexBlock","FlexItem","ToggleControl","__nextHasNoMarginBottom","onChange","checked","Slot","labels","onClick","overlayActive","enableLabel","image","capitalizeSize","className","MediaImageSlot","title","update","dropzone","onUpdate","ArtDirectionList","ExternalLink","href","background","padding","marginLeft","marginRight","marginTop","marginBottom","Fragment","InspectorSidebar","InspectorPopoutPanel","__","renderToggle","isOpen","onToggle","icon","postFeaturedImage","ProvideInspectorSidebar","PrePublishPanel","PluginPrePublishPanel","initialOpen","addFilter","AttachmentsPanel","PanelBody","__webpack_module_cache__","__webpack_require__","moduleId","cachedModule","exports","module","__webpack_modules__","m","O","result","chunkIds","fn","priority","notFulfilled","Infinity","fulfilled","j","every","key","splice","r","o","obj","prop","prototype","hasOwnProperty","call","installedChunks","chunkId","webpackJsonpCallback","parentChunkLoadingFunction","data","moreModules","runtime","some","chunkLoadingGlobal","globalThis","forEach","bind","push","__webpack_exports__"],"sourceRoot":""}

================
File: plugins/prc-art-direction/includes/inspector-sidebar-panel/build/style-index-rtl.css
================
.components-button.is-compact.inherit-height{height:inherit!important}.components-dropdown.editor-post-url__panel-dropdown .components-button.editor-post-url__panel-toggle.is-compact{height:100%;min-height:max-content!important}.prc-platform-art-direction__list{min-width:249px;width:100%}.media-modal:has(.prc-platform-art-direction__modal){z-index:1999999}

================
File: plugins/prc-art-direction/includes/inspector-sidebar-panel/build/style-index.css
================
.components-button.is-compact.inherit-height{height:inherit!important}.components-dropdown.editor-post-url__panel-dropdown .components-button.editor-post-url__panel-toggle.is-compact{height:100%;min-height:max-content!important}.prc-platform-art-direction__list{min-width:249px;width:100%}.media-modal:has(.prc-platform-art-direction__modal){z-index:1999999}

================
File: plugins/prc-art-direction/includes/inspector-sidebar-panel/src/slot/index.jsx
================
/* eslint-disable max-lines-per-function */
/**
 * CSS Classes and Styling Forked from Gutenberg featured image component:
 * https://github.com/WordPress/gutenberg/blob/3da717b8d0ac7d7821fc6d0475695ccf3ae2829f/packages/editor/src/components/post-featured-image/index.js
 */

/**
 * External Dependencies
 */
import { MediaImageSlot } from '@prc/components';

/**
 * WordPress Dependencies
 */
import { useMemo } from '@wordpress/element';

/**
 * Internal Dependencies
 */
import { useArtDirection } from '../context';
import Label from './label';

export default function Slot({
	size,
	labels,
	onClick,
	overlayActive,
	enableLabel = true,
}) {
	const { getImageSlot, setImageSlot, capitalize } = useArtDirection();

	const image = useMemo(() => {
		return getImageSlot(size);
	}, [size, getImageSlot]);

	const id = useMemo(() => {
		return image ? image.id : null;
	}, [image]);

	const capitalizeSize = capitalize(size);

	return (
		<div className="prc-platform-art-direction__slot">
			{enableLabel && (
				<Label
					label={labels?.label || `${capitalizeSize}`}
					size={size}
				/>
			)}
			<MediaImageSlot
				{...{
					id,
					size,
					labels: labels || {
						label: `Edit ${capitalizeSize} Image Slot`,
						title: `Select ${capitalizeSize} Image`,
						update: `Update ${capitalizeSize} Image Slot`,
						dropzone: `Drop ${capitalizeSize}`,
					},
					onUpdate: (img) => {
						setImageSlot(img, size);
					},
					onClick,
					overlayActive,
				}}
			/>
		</div>
	);
}

================
File: plugins/prc-art-direction/includes/inspector-sidebar-panel/src/slot/label.jsx
================
/* eslint-disable max-lines-per-function */
/**
 * CSS Classes and Styling Forked from Gutenberg featured image component:
 * https://github.com/WordPress/gutenberg/blob/3da717b8d0ac7d7821fc6d0475695ccf3ae2829f/packages/editor/src/components/post-featured-image/index.js
 */

/**
 * External Dependencies
 */

/**
 * WordPress Dependencies
 */
import { useMemo } from '@wordpress/element';
import {
	Flex,
	FlexBlock,
	FlexItem,
	ToggleControl,
} from '@wordpress/components';

/**
 * Internal Dependencies
 */
import { useArtDirection } from '../context';

export default function Label({ label, size }) {
	const { isImageSlotBordered, toggleImageSlotBordered, capitalize } =
		useArtDirection();
	const isChartArt = isImageSlotBordered(size);
	const labelText = useMemo(() => {
		return label || capitalize(size);
	}, [label, size, capitalize]);
	return (
		<Flex
			style={{
				alignItems: 'center',
				borderTop: '1px solid #eaeaea',
				height: '45px',
			}}
		>
			<FlexBlock>
				<strong>{labelText}</strong>
			</FlexBlock>

			<FlexItem>
				{('A2' === size || 'A3' === size || 'A4' === size) && (
					<ToggleControl
						__nextHasNoMarginBottom
						label="Border"
						onChange={() => toggleImageSlotBordered(size)}
						checked={isChartArt}
					/>
				)}
			</FlexItem>
		</Flex>
	);
}

================
File: plugins/prc-art-direction/includes/inspector-sidebar-panel/src/art-direction-list.jsx
================
/* eslint-disable no-nested-ternary */
/**
 * WordPress Dependencies
 */
import { Fragment } from '@wordpress/element';
import { Flex, FlexBlock, ExternalLink } from '@wordpress/components';

/**
 * Internal Dependencies
 */
import Slot from './slot';
import { useArtDirection } from './context';

export default function ArtDirectionList() {
	const { hasA1Image } = useArtDirection();

	return (
		<div className="prc-platform-art-direction__list">
			<p>
				<ExternalLink href="https://platform.pewresearch.org/wiki/art-direction">
					Art Direction Documentation
				</ExternalLink>
			</p>
			<p
				style={{
					background:
						'var(--wp--custom--color-grey-spectrum-light-one)',
					padding: '0.5em 1em',
					marginLeft: '-1em',
					marginRight: '-1em',
					marginTop: '1em',
					marginBottom: '-1px',
				}}
			>
				<strong>Story Item</strong>
			</p>
			<Slot size="A1" />
			{hasA1Image && (
				<Fragment>
					<Slot size="A2" />
					<Flex>
						<FlexBlock>
							<Slot size="A3" />
						</FlexBlock>
						<FlexBlock>
							<Slot size="A4" />
						</FlexBlock>
					</Flex>
					<p
						style={{
							background:
								'var(--wp--custom--color-grey-spectrum-light-one)',
							padding: '0.5em 1em',
							marginLeft: '-1em',
							marginRight: '-1em',
							marginTop: '1em',
							marginBottom: '-1px',
						}}
					>
						<strong>Social</strong>
					</p>
					<Flex>
						<FlexBlock>
							<Slot size="facebook" />
						</FlexBlock>
						<FlexBlock>
							<Slot size="twitter" />
						</FlexBlock>
					</Flex>
				</Fragment>
			)}
		</div>
	);
}

================
File: plugins/prc-art-direction/includes/inspector-sidebar-panel/src/attachments-panel-hook.js
================
/**
 * WordPress Dependencies
 */
import { Fragment } from '@wordpress/element';
import { PanelBody } from '@wordpress/components';

/**
 * Internal Dependencies
 */
import { ProvideArtDirection } from './context';
import ArtDirectionList from './art-direction-list';

export default function renderAttachmentsPanelHook(AttachmentsPanel) {
	return () => (
		<Fragment>
			<AttachmentsPanel />
			<ProvideArtDirection>
				<PanelBody title="Art Direction" initialOpen={false}>
					<ArtDirectionList />
				</PanelBody>
			</ProvideArtDirection>
		</Fragment>
	);
}

================
File: plugins/prc-art-direction/includes/inspector-sidebar-panel/src/context.js
================
/* eslint-disable max-lines-per-function */
/* eslint-disable max-len */
/**
 * External Dependencies
 */
import { useDebounce } from '@prc/hooks';

/**
 * WordPress Dependencies
 */
import {
	useEffect,
	useState,
	useContext,
	useMemo,
	createContext,
} from '@wordpress/element';
import { useEntityProp, useResourcePermissions } from '@wordpress/core-data';
import { dispatch, useSelect, useDispatch } from '@wordpress/data';

/**
 * Internal Dependencies
 */

const artDirectionContext = createContext();

function shapeImg(img, size) {
	// console.log('prc-platform/art-direction shapeImg::', img);
	if (img.sizes[size]) {
		return {
			id: img.id,
			rawUrl: img.url,
			url: img.sizes[size].url,
			width: img.sizes[size].width,
			height: img.sizes[size].height,
			caption: img.caption,
			chartArt: false,
		};
	}
	// eslint-disable-next-line no-console
	console.error(`No image size found for ${size}`, img);
	return false;
}

/**
 * State logic that sets other state objects.
 * If the state/image being processed is A1 sized it will autopopulate all images.
 * If A2 then A3 and A4 will be acted upon
 * If Facebook then only Twitter will be acted upon
 *
 * @param {WP Media Image Blob} imgData
 * @param {string}              size
 * @return {Object} modified state object
 */
function propagateImageChanges(imgData, size) {
	const updates = {};
	if ('A1' === size) {
		updates.A2 = shapeImg(imgData, 'A2');
		updates.XL = shapeImg(imgData, 'XL');
		updates.facebook = shapeImg(imgData, 'facebook');
		updates.twitter = shapeImg(imgData, 'twitter');
	}
	if ('A1' === size || 'A2' === size) {
		updates.A3 = shapeImg(imgData, 'A3');
		updates.A4 = shapeImg(imgData, 'A4');
	}
	if ('facebook' === size) {
		updates.twitter = shapeImg(imgData, 'twitter');
	}
	updates[size] = shapeImg(imgData, size);
	return updates;
}

function propagateBorderedToggle(updates = {}, size) {
	const value = !updates[size].chartArt;
	if ('A2' === size) {
		updates.A2.chartArt = value;
		updates.A3.chartArt = value;
		updates.A4.chartArt = value;
	} else {
		updates[size].chartArt = value;
	}
	console.log(
		'prc-platform/art-direction propagateBorderedToggle::',
		updates
	);
	return updates;
}

function updateFeatureImage(img = false) {
	if (false !== img) {
		const { editPost } = dispatch('core/editor');
		editPost({ featured_media: img.id });
	}
}

const useArtDirectionContext = () => {
	const { postId, postType, testMeta } = useSelect((select) => {
		return {
			postId: select('core/editor').getCurrentPostId(),
			postType: select('core/editor').getCurrentPostType(),
			testMeta: select('core/editor').getCurrentPostAttribute('meta'),
		};
	}, []);
	const [meta, setMeta] = useEntityProp('postType', postType, 'meta', postId);
	const { canDelete, isResolving } = useResourcePermissions(postType, postId);
	const allowEditing = useMemo(() => {
		console.log('ART CHECK Permissions Check:', isResolving, canDelete);
		if (isResolving) {
			return false;
		}
		return true;
	}, [isResolving, canDelete]);

	const [artDirection, setArtDirection] = useState(meta.artDirection || {});
	const debouncedArtDirection = useDebounce(artDirection, 500);

	/**
	 * Handle saving data back to post.
	 * This approach doesnt support cross collabration as well... but it works for now.
	 */
	useEffect(() => {
		console.log(
			'ART DIRECTION:',
			meta,
			testMeta,
			debouncedArtDirection,
			meta.artDirection,
			artDirection,
			allowEditing
		);
		if (!allowEditing || undefined === meta) {
			console.log(
				"ART DIRECTION UHOH: Can't edit or no meta",
				allowEditing,
				meta
			);
			return;
		}
		// If there is an A1 image, set it as the featured image
		if (debouncedArtDirection.A1 && debouncedArtDirection.A1 !== false) {
			updateFeatureImage(debouncedArtDirection.A1);
			console.log('Featured Image: ', debouncedArtDirection.A1);
		}
		// Check if debouncedArtDirection is different from meta.artDirection, by going through each object and it's properties and making sure they are the same.
		if (
			JSON.stringify(debouncedArtDirection) !==
			JSON.stringify(meta.artDirection)
		) {
			// console.clear();
			console.log(
				'Art Direction Change Detected',
				debouncedArtDirection,
				meta
			);
		} else {
			console.log(
				'No Art Direction Change Detected',
				debouncedArtDirection,
				meta.artDirection
			);
			return;
		}
		console.log('ART DIRECTION UPDATE: ', debouncedArtDirection, meta);
		setMeta({
			...meta,
			artDirection: debouncedArtDirection,
		});
	}, [debouncedArtDirection, allowEditing, meta, setMeta]);

	const setImageSlot = (imgData, size) => {
		const newArtDirection = propagateImageChanges(imgData, size);
		setArtDirection({ ...artDirection, ...newArtDirection });
	};

	const toggleImageSlotBordered = (size) => {
		let newArtDirection = { ...artDirection };
		newArtDirection = propagateBorderedToggle(newArtDirection, size);
		setArtDirection({ ...newArtDirection });
	};

	const isImageSlotBordered = (size) => {
		return artDirection?.[size]?.chartArt;
	};

	const getImageSlot = (size) => {
		return artDirection?.[size];
	};

	const capitalize = (s) => {
		if ('string' !== typeof s) return '';
		return s.charAt(0).toUpperCase() + s.slice(1);
	};

	const hasA1Image = useMemo(() => {
		return !!artDirection.A1;
	}, [artDirection]);

	const allSlotsTheSame = useMemo(() => {
		const keys = Object.keys(debouncedArtDirection);
		const first = debouncedArtDirection[keys[0]];
		console.log('allSlotsTheSame', keys, first);
		for (let i = 1; i < keys.length; i++) {
			console.log(
				'allSlotsTheSame...',
				first,
				debouncedArtDirection[keys[i]]
			);
			let strike = 0;
			if (first.id !== debouncedArtDirection[keys[i]].id) {
				strike += 1;
			}
			if (first.chartArt !== debouncedArtDirection[keys[i]].chartArt) {
				strike += 1;
			}
			if (strike > 0) {
				console.log('allSlotsTheSame...', 'not all the same');
				return false;
			}
		}
		console.log('allSlotsTheSame...', 'all the same');
		return true;
	}, [debouncedArtDirection]);

	return {
		allowEditing,
		postId,
		postType,
		artDirection: debouncedArtDirection,
		hasA1Image,
		setImageSlot,
		getImageSlot,
		isImageSlotBordered,
		toggleImageSlotBordered,
		capitalize,
		allSlotsTheSame,
	};
};

const useArtDirection = () => useContext(artDirectionContext);

function ProvideArtDirection({ children }) {
	const provider = useArtDirectionContext();
	return (
		<artDirectionContext.Provider value={provider}>
			{children}
		</artDirectionContext.Provider>
	);
}

export { ProvideArtDirection, useArtDirection };
export default ProvideArtDirection;

================
File: plugins/prc-art-direction/includes/inspector-sidebar-panel/src/index.js
================
/**
 * WordPress Dependencies
 */
import { addFilter } from '@wordpress/hooks';
import { Fragment } from '@wordpress/element';

/**
 * Internal Dependencies
 */
import './style.scss';
import InspectorSidebar from './inspector-sidebar';
import PrePublishPanel from './pre-publish-panel';
import renderAttachmentsPanelHook from './attachments-panel-hook';

function renderArtDirectionPlugin() {
	return () => (
		<Fragment>
			<InspectorSidebar />
			<PrePublishPanel />
		</Fragment>
	);
}

// Replace the "Featured Image" area with our "Art Direction" panel.
addFilter(
	'editor.PostFeaturedImage',
	'prc-platform/art-direction',
	renderArtDirectionPlugin
);

addFilter(
	'prc-platform.attachments-panel',
	'prc-platform/art-direction',
	renderAttachmentsPanelHook
);

================
File: plugins/prc-art-direction/includes/inspector-sidebar-panel/src/inspector-sidebar.jsx
================
/* eslint-disable max-lines-per-function */
/**
 * External Dependencies
 */
import { InspectorPopoutPanel } from '@prc/components';

/**
 * WordPress Dependencies
 */
import { __ } from '@wordpress/i18n';
import { postFeaturedImage } from '@wordpress/icons';

/**
 * Internal Dependencies
 */
import { ProvideArtDirection, useArtDirection } from './context';
import ArtDirectionList from './art-direction-list';
import Slot from './slot';

function InspectorSidebar() {
	const { hasA1Image, allSlotsTheSame } = useArtDirection();

	return (
		<InspectorPopoutPanel
			title={__('Art Direction')}
			className="prc-platform-art-direction-panel"
			renderToggle={({ isOpen, onToggle }) => (
				<Slot
					{...{
						size: 'A1',
						labels: {
							label: 'Setup Art Direction',
							title: 'Select Art Direction Image',
							update: !allSlotsTheSame
								? 'Update Art Direction (Some Slots Differ)'
								: 'Update Art Direction',
							dropzone: 'Drop A1 Image',
							icon: postFeaturedImage,
						},
						onClick: hasA1Image ? onToggle : undefined, // If the A1 image already exists open the panel, otherwise allow the slot to do it's default action which is to open the media library.
						enableLabel: false,
						overlayActive: isOpen,
					}}
				/>
			)}
		>
			<ArtDirectionList />
		</InspectorPopoutPanel>
	);
}

export default function ProvideInspectorSidebar() {
	return (
		<ProvideArtDirection>
			<InspectorSidebar />
		</ProvideArtDirection>
	);
}

================
File: plugins/prc-art-direction/includes/inspector-sidebar-panel/src/pre-publish-panel.jsx
================
/**
 * WordPress Dependencies
 */
import { PluginPrePublishPanel } from '@wordpress/edit-post';

/**
 * Internal Dependencies
 */
import { ProvideArtDirection } from './context';
import ArtDirectionList from './art-direction-list';

export default function PrePublishPanel() {
	return (
		<PluginPrePublishPanel title="Review Art Direction" initialOpen>
			<ProvideArtDirection>
				<ArtDirectionList />
			</ProvideArtDirection>
		</PluginPrePublishPanel>
	);
}

================
File: plugins/prc-art-direction/includes/inspector-sidebar-panel/src/style.scss
================
.components-button.is-compact.inherit-height {
	height: inherit!important;
}
.components-dropdown.editor-post-url__panel-dropdown {
	.components-button.editor-post-url__panel-toggle.is-compact {
		min-height: max-content !important;
		height: 100%;
	}
}

.prc-platform-art-direction__list {
	min-width: 249px;
	width: 100%;
}

.media-modal:has(.prc-platform-art-direction__modal) {
	z-index: 1999999;
}

================
File: plugins/prc-art-direction/includes/inspector-sidebar-panel/class-inspector-sidebar-panel.php
================
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

================
File: plugins/prc-art-direction/includes/inspector-sidebar-panel/package.json
================
{
	"name": "@pewresearch/art-direction-inspector-sidebar-panel",
	"version": "1.0.0",
	"description": "Art direction for post like objects subsumes featured image",
	"license": "GPL-2.0-or-later",
	"devDependencies": {
		"@wordpress/scripts": "^30.15.0"
	},
	"scripts": {
		"build": "wp-scripts build src/index.js",
		"start": "wp-scripts start src/index.js"
	},
	"dependencies": {
		"@wordpress/icons": "^10.22.0"
	}
}

================
File: plugins/prc-art-direction/includes/inspector-sidebar-panel/webpack.config.js
================
const config = require('../../../../webpack.config');

module.exports = config;

================
File: plugins/prc-art-direction/includes/class-api.php
================
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

================
File: plugins/prc-art-direction/includes/class-loader.php
================
<?php
/**
 * Plugin loader.
 *
 * @package    PRC\Platform\Art_Direction
 */

namespace PRC\Platform\Art_Direction;

/**
 * The loader class.
 *
 * @package    PRC\Platform\Art_Direction
 */
class Loader {

	/**
	 * The array of actions registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $actions    The actions registered with WordPress to fire when the plugin loads.
	 */
	protected $actions;

	/**
	 * The array of filters registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $filters    The filters registered with WordPress to fire when the plugin loads.
	 */
	protected $filters;

	/**
	 * Initialize the collections used to maintain the actions and filters.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->actions = array();
		$this->filters = array();
	}

	/**
	 * Add a new action to the collection to be registered with WordPress.
	 *
	 * @since    1.0.0
	 * @param    string $hook             The name of the WordPress action that is being registered.
	 * @param    object $component        A reference to the instance of the object on which the action is defined.
	 * @param    string $callback         The name of the function definition on the $component.
	 * @param    int    $priority         Optional. The priority at which the function should be fired. Default is 10.
	 * @param    int    $accepted_args    Optional. The number of arguments that should be passed to the $callback. Default is 1.
	 */
	public function add_action( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
		$this->actions = $this->add( $this->actions, $hook, $component, $callback, $priority, $accepted_args );
	}

	/**
	 * Add a new filter to the collection to be registered with WordPress.
	 *
	 * @since    1.0.0
	 * @param    string $hook             The name of the WordPress filter that is being registered.
	 * @param    object $component        A reference to the instance of the object on which the filter is defined.
	 * @param    string $callback         The name of the function definition on the $component.
	 * @param    int    $priority         Optional. The priority at which the function should be fired. Default is 10.
	 * @param    int    $accepted_args    Optional. The number of arguments that should be passed to the $callback. Default is 1.
	 */
	public function add_filter( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
		$this->filters = $this->add( $this->filters, $hook, $component, $callback, $priority, $accepted_args );
	}

	/**
	 * A utility function that is used to register the actions and hooks into a single
	 * collection.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @param    array  $hooks            The collection of hooks that is being registered (that is, actions or filters).
	 * @param    string $hook             The name of the WordPress filter that is being registered.
	 * @param    object $component        A reference to the instance of the object on which the filter is defined.
	 * @param    string $callback         The name of the function definition on the $component.
	 * @param    int    $priority         The priority at which the function should be fired.
	 * @param    int    $accepted_args    The number of arguments that should be passed to the $callback.
	 * @return   array                                  The collection of actions and filters registered with WordPress.
	 */
	private function add( $hooks, $hook, $component, $callback, $priority, $accepted_args ) {

		$hooks[] = array(
			'hook'          => $hook,
			'component'     => $component,
			'callback'      => $callback,
			'priority'      => $priority,
			'accepted_args' => $accepted_args,
		);

		return $hooks;
	}

	/**
	 * Register the filters and actions with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {

		foreach ( $this->filters as $hook ) {
			add_filter( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}

		foreach ( $this->actions as $hook ) {
			add_action( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}
	}
}

================
File: plugins/prc-art-direction/includes/class-plugin-activator.php
================
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

================
File: plugins/prc-art-direction/includes/class-plugin-deactivator.php
================
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

================
File: plugins/prc-art-direction/includes/class-plugin.php
================
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
	 * @return    PRC\Platform\XXX\Loader
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

================
File: plugins/prc-art-direction/includes/class-rest-api.php
================
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

================
File: plugins/prc-art-direction/includes/utils.php
================
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

================
File: plugins/prc-art-direction/tests/test-template.spec.ts
================
import { test, expect } from '@wordpress/e2e-test-utils-playwright';

const testTitle = 'Test Post';
const testContent = 'This is a test post.';

test.describe('Create Post', () => {
	test('Ensure post type is properly registered', async ({
		requestUtils,
	}) => {
		const posts = await requestUtils.rest({
			path: '/wp/v2/posts',
			method: 'GET',
		});
		expect(posts).toBeDefined();
	});

	test('Post created', async ({ admin, editor, requestUtils, page }) => {
		// Create a new post.
		await admin.createNewPost({
			title: testTitle,
			content: testContent,
			postType: 'post',
		});
		// Publish the post.
		await editor.publishPost();

		// Get the created homepage via REST API.
		const posts = await requestUtils.rest({
			path: '/wp/v2/posts',
			method: 'GET',
		});
		// Get the first item out of the posts array.
		const post = posts?.[0];
		// Verify the post was created with correct title and content.
		expect(post.title.rendered).toBe(testTitle);
		// Create a screenshot of the post.
		const today = new Date();
		// This gives 'YYYY-MM-DD' format.
		const formattedDate = today.toISOString().split('T')[0];
		await page.screenshot({
			path: `tests/screenshots/post-${formattedDate}.png`,
		});
	});
});

================
File: plugins/prc-art-direction/.wp-env.json
================
{
	"$schema": "https://raw.githubusercontent.com/WordPress/gutenberg/trunk/schemas/json/wp-env.json",
	"core": "WordPress/WordPress",
	"plugins": [
		"../prc-platform-core",
		"../prc-block-library",
		"."
	],
	"themes": [
		"../../themes/prc-design-system"
	],
	"lifecycleScripts": {
		"afterStart": "wp-env run tests-cli wp theme activate prc-design-system"
	},
	"config": {
		"PRC_PLATFORM_TESTING_MODE": true,
		"PRC_PRIMARY_SITE_ID": 1,
		"DEFAULT_TECHNICAL_CONTACT": "srubenstein@pewresearch.org",
		"TAXONOMY_TECHNICAL_CONTACT": "srubenstein@pewresearch.org"
	}
}

================
File: plugins/prc-art-direction/package.json
================
{
    "name": "@pewresearch/prc-art-direction",
    "version": "1.0.0",
    "description": "Provides a module for PRC Platform that allows editors to select multiple images and apply them to the post, then Story Item blocks can use the various images in different layout contexts.",
    "scripts": {
        "build": "wp-scripts build",
        "test": "wp-scripts test-playwright",
        "test:env:start": "wp-env start",
        "test:env:stop": "wp-env stop",
        "test:env:clean": "wp-env clean all && wp-env start",
        "test:env:destroy": "wp-env destroy"
    },
    "devDependencies": {
        "@playwright/test": "^1.51.1",
        "@wordpress/e2e-test-utils-playwright": "^1.22.0",
        "@wordpress/env": "^10.22.0",
        "@wordpress/scripts": "^30.15.0"
    },
    "dependencies": {
        "@wordpress/icons": "^10.22.0"
    }
}

================
File: plugins/prc-art-direction/playwright.config.js
================
import { defineConfig } from '@playwright/test';
import baseConfig from '@wordpress/scripts/config/playwright.config';

const testDir = './tests';

export default defineConfig({
	...baseConfig,
	testDir,
	outputDir: './tests/artifacts',
	use: {
		...baseConfig.use,
		video: 'on',
		trace: 'on',
	},
	reporter: [
		...baseConfig.reporter,
		['html', { outputFolder: './tests/artifacts/reports' }],
	],
});

================
File: plugins/prc-art-direction/prc-art-direction.php
================
<?php
/**
 * PRC Art Direction
 *
 * @package           PRC_Art_Direction
 * @author            Seth Rubenstein
 * @copyright         2024 Pew Research Center
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       PRC Art Direction
 * Plugin URI:        https://github.com/pewresearch/prc-art-direction
 * Description:       A featured image takeover for PRC Platform. This replaces the default featured image functionality with a system that allows multiple featured images to be set based on template context.
 * Version:           1.0.0
 * Requires at least: 6.7
 * Requires PHP:      8.2
 * Author:            Seth Rubenstein
 * Author URI:        https://pewresearch.org
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       prc-art-direction
 * Requires Plugins:  prc-platform-core
 */

namespace PRC\Platform\Art_Direction;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'PRC_ART_DIRECTION_FILE', __FILE__ );
define( 'PRC_ART_DIRECTION_DIR', __DIR__ );
define( 'PRC_ART_DIRECTION_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-activator.php
 */
function activate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-plugin-activator.php';
	Plugin_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-deactivator.php
 */
function deactivate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-plugin-deactivator.php';
	Plugin_Deactivator::deactivate();
}

register_activation_hook( __FILE__, '\PRC\Platform\Art_Direction\activate' );
register_deactivation_hook( __FILE__, '\PRC\Platform\Art_Direction\deactivate' );

/**
 * Helper utilities
 */
require plugin_dir_path( __FILE__ ) . 'includes/utils.php';

/**
 * The core plugin class that is used to define the hooks that initialize the various components.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-plugin.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_prc_art_direction() {
	$plugin = new Plugin();
	$plugin->run();
}
run_prc_art_direction();

================
File: plugins/prc-art-direction/README.md
================
# PRC Art Direction

A featured image takeover for PRC Platform. This replaces the default featured image functionality with a system that allows multiple featured images to be set based on template context.

================
File: plugins/prc-art-direction/webpack.config.js
================
const config = require('../../webpack.config');

module.exports = config;



================================================================
End of Codebase
================================================================

================
File: plugins/prc-art-direction/README.md
================
# PRC Art Direction

A featured image takeover for PRC Platform. This replaces the default featured image functionality with a system that allows multiple featured images to be set based on template context.

================
File: plugins/prc-art-direction/webpack.config.js
================
const config = require('../../webpack.config');

module.exports = config;



================================================================
End of Codebase
================================================================
