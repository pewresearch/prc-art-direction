<?php
/**
 * CLI Commands for Art Direction
 *
 * @package PRC\Platform\Art_Direction
 */

namespace PRC\Platform\Art_Direction;

use WPCOM_VIP_CLI_Command;
use WP_CLI;
use WP_CLI\Utils;

// If WPCOM_VIP_CLI_Command does not exist exit early.
if ( ! class_exists( 'WPCOM_VIP_CLI_Command' ) ) {
	return;
}

if ( defined( 'WP_CLI' ) && WP_CLI ) {
	/**
	 * Manage Art Direction data migrations.
	 */
	class CLI extends WPCOM_VIP_CLI_Command {

		/**
		 * Constructor.
		 */
		public function __construct() {
		}

		/**
		 * Migrate legacy facebook/twitter art direction keys to unified social key.
		 *
		 * This command finds all posts with artDirection meta that have 'facebook' or 'twitter'
		 * keys and migrates them to the new 'social' key structure.
		 *
		 * ## OPTIONS
		 *
		 * [--dry-run]
		 * : Run the migration without making any changes.
		 *
		 * [--post-type=<post-type>]
		 * : Limit migration to a specific post type. Default: all enabled post types.
		 *
		 * [--format=<format>]
		 * : Output format. Accepts: table, csv, json, yaml. Default: table.
		 *
		 * ## EXAMPLES
		 *
		 *     # Preview what would be migrated
		 *     wp prc art-direction migrate-social --dry-run
		 *
		 *     # Run the migration
		 *     wp prc art-direction migrate-social --dry-run=false
		 *
		 *     # Migrate only posts
		 *     wp prc art-direction migrate-social --post-type=post --dry-run=false
		 *
		 * @param array $args       Positional arguments.
		 * @param array $assoc_args Associative arguments.
		 * @subcommand migrate-social
		 */
		public function migrate_social( $args, $assoc_args ) {
			// Disable term counting, Elasticsearch indexing, and PushPress.
			$this->start_bulk_operation();

			// Handle dry-run flag.
			if ( isset( $assoc_args['dry-run'] ) ) {
				if ( 'false' === $assoc_args['dry-run'] ) {
					$dry_run = false;
				} else {
					$dry_run = (bool) $assoc_args['dry-run'];
				}
			} else {
				$dry_run = true;
			}

			$format    = Utils\get_flag_value( $assoc_args, 'format', 'table' );
			$post_type = Utils\get_flag_value( $assoc_args, 'post-type', null );

			// Determine which post types to process.
			$post_types = null !== $post_type
				? array( $post_type )
				: Plugin::get_enabled_post_types();

			if ( $dry_run ) {
				WP_CLI::line( '🛟  Running in dry-run mode, no changes will be made.' );
			} else {
				WP_CLI::line( '🔴  Migration armed and ready - changes will be saved.' );
			}

			WP_CLI::line( sprintf( 'Processing post types: %s', implode( ', ', $post_types ) ) );
			WP_CLI::line( '' );

			$posts_per_page   = 100;
			$paged            = 1;
			$migrated_count   = 0;
			$skipped_count    = 0;
			$already_migrated = 0;
			$results          = array();

			do {
				$query_args = array(
					'post_type'        => $post_types,
					'posts_per_page'   => $posts_per_page,
					'paged'            => $paged,
					'post_status'      => 'any',
					'suppress_filters' => false,
					'meta_query'       => array(
						array(
							'key'     => Plugin::$post_meta_key,
							'compare' => 'EXISTS',
						),
					),
				);

				$posts = get_posts( $query_args );

				foreach ( $posts as $post ) {
					$art_direction = get_post_meta( $post->ID, Plugin::$post_meta_key, true );

					if ( ! is_array( $art_direction ) ) {
						++$skipped_count;
						continue;
					}

					$has_facebook = isset( $art_direction['facebook'] );
					$has_twitter  = isset( $art_direction['twitter'] );
					$has_social   = isset( $art_direction['social'] );

					// Skip if already has social and no legacy keys.
					if ( $has_social && ! $has_facebook && ! $has_twitter ) {
						++$already_migrated;
						continue;
					}

					// Skip if no legacy keys to migrate.
					if ( ! $has_facebook && ! $has_twitter ) {
						++$skipped_count;
						continue;
					}

					// Perform migration.
					$new_art_direction = $art_direction;

					// If 'social' doesn't exist but 'facebook' does, migrate it.
					if ( ! $has_social && $has_facebook && is_array( $art_direction['facebook'] ) ) {
						$new_art_direction['social'] = $art_direction['facebook'];
					}

					// Remove legacy keys.
					unset( $new_art_direction['facebook'], $new_art_direction['twitter'] );

					$results[] = array(
						'post_id'    => $post->ID,
						'post_title' => mb_substr( $post->post_title, 0, 40 ) . ( mb_strlen( $post->post_title ) > 40 ? '...' : '' ),
						'post_type'  => $post->post_type,
						'had_fb'     => $has_facebook ? 'Yes' : 'No',
						'had_tw'     => $has_twitter ? 'Yes' : 'No',
						'status'     => $dry_run ? 'Would migrate' : 'Migrated',
					);

					if ( ! $dry_run ) {
						update_post_meta( $post->ID, Plugin::$post_meta_key, $new_art_direction );
					}

					++$migrated_count;
				}

				++$paged;

				// Pause for a breath every batch.
				if ( count( $posts ) === $posts_per_page ) {
					WP_CLI::line( sprintf( 'Processed %d posts so far...', ( $paged - 1 ) * $posts_per_page ) );
					sleep( 1 );
				}

				// Free up memory.
				$this->vip_inmemory_cleanup();

			} while ( count( $posts ) === $posts_per_page );

			// Output results.
			if ( ! empty( $results ) ) {
				WP_CLI::line( '' );
				$formatted = Utils\format_items( $format, $results, array( 'post_id', 'post_title', 'post_type', 'had_fb', 'had_tw', 'status' ) );
				WP_CLI::line( $formatted );
			}

			WP_CLI::line( '' );
			WP_CLI::line( '--- Summary ---' );
			WP_CLI::line( sprintf( 'Posts with legacy keys to migrate: %d', $migrated_count ) );
			WP_CLI::line( sprintf( 'Posts already migrated (has social, no legacy): %d', $already_migrated ) );
			WP_CLI::line( sprintf( 'Posts skipped (no art direction data): %d', $skipped_count ) );

			if ( $dry_run ) {
				WP_CLI::success( sprintf( '%d posts would be migrated. Run with --dry-run=false to apply changes.', $migrated_count ) );
			} else {
				WP_CLI::success( sprintf( '%d posts have been migrated to the new social key structure.', $migrated_count ) );
			}

			// Trigger a term count as well as trigger bulk indexing of Elasticsearch site.
			$this->end_bulk_operation();
		}
	}

	WP_CLI::add_command( 'prc art-direction', '\PRC\Platform\Art_Direction\CLI' );
}
