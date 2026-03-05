# PRC Art Direction

A multi-slot featured image system for the PRC Platform that replaces WordPress's default featured image with context-aware art direction.

## Overview

This plugin replaces the standard WordPress featured image with a structured system that lets editors assign distinct images to named slots (A1, A2, A3, A4, XL, social). Downstream blocks and themes read the appropriate slot for each layout context rather than stretching one image into every use case.

It sits between the block editor and the media library on the way in, and between the `API` class and blocks/themes on the way out. When no art direction data exists for a post, the system falls back transparently to the WordPress featured image, cropped into the standard slot sizes.

### Dependencies

- **Upstream**: `prc-platform-core` (required), `prc-block-utils` (for class name helpers), Yoast SEO (optional — social image filters activate only when present), 10up Distributor (optional — ID remapping activates only when present)
- **Downstream**: Any block or theme that reads `art_direction` from the REST API or calls `\PRC\Platform\Art_Direction\get()`; the `core/post-featured-image` block renderer is modified directly by this plugin

## Local Development Setup

### Prerequisites

- Node.js 22+, npm 10.9+
- WordPress Playground (`npm run playground:start` from repo root)

### Running Locally

```bash
# Build both JS bundles from repo root
npm run build -w @prc/art-direction

# Or build each target independently
npm run build:inspector-panel -w @prc/art-direction
npm run build:core-featured-image -w @prc/art-direction
```

### Running Tests

The test suite uses Playwright and `@wordpress/e2e-test-utils-playwright`. Tests require a running WordPress environment.

```bash
# Start the test environment (wp-env, local to this plugin)
npm run test:env:start -w @prc/art-direction

# Run Playwright tests
npm run test -w @prc/art-direction

# Tear down
npm run test:env:stop -w @prc/art-direction
```

## Architecture

The plugin is organized around a PHP `API` class that reads the `artDirection` post meta and returns per-slot image data, with REST, CLI, and editor integrations layered on top.

**Image slots** are fixed and named: `A1`, `A2`, `A3`, `A4`, `XL`, `social`. Each slot stores the same schema:

```
{ id, rawUrl, url, width, height, chartArt, caption }
```

`chartArt` is a boolean flag that signals the image has a white/light background (typically a chart) and should receive a border treatment in templates.

**Post type support** is opt-in. The `post` type is enabled by default. Other types opt in via `add_post_type_support( $type, 'prc-art-direction' )` or the `prc_platform__art_direction_enabled_post_types` filter.

**Post meta key**: `artDirection` (camelCase, stored as a serialized object).

**Fallback behavior**: If a post has no `artDirection` meta but has a WordPress featured image, the `API` class constructs slot data from that image using the corresponding registered image sizes (`A1`, `A1-HIDPI`, `A1-SMALL`, etc.).

**Legacy migration**: An older version of the schema stored separate `facebook` and `twitter` keys instead of a unified `social` key. The REST API migrates these on read and write. A WP-CLI command handles bulk migration of stored data.

### Key Files

| Path | Purpose |
|------|---------|
| `prc-art-direction.php` | Plugin entry point; defines constants, wires activation hooks, boots `Plugin` |
| `includes/class-plugin.php` | Core class; registers post meta, post type support, Yoast SEO image filters, and instantiates all subsystems |
| `includes/class-api.php` | Primary PHP API; instantiate with a post ID and call `->get($slot)` to retrieve art direction data for a given slot or all slots |
| `includes/utils.php` | Global helper `\PRC\Platform\Art_Direction\get( $post_id, $size )` — thin wrapper around `API` |
| `includes/class-rest-api.php` | Registers the `art_direction` REST field on all enabled post types; handles sanitization and legacy key migration on read/write |
| `includes/class-distributor.php` | 10up Distributor integration; remaps attachment IDs and URLs for each slot when content is pushed to another site |
| `includes/class-cli.php` | WP-CLI command for bulk-migrating legacy `facebook`/`twitter` keys to the unified `social` key |
| `includes/inspector-sidebar-panel/src/index.jsx` | Editor entry point; replaces `editor.PostFeaturedImage` with the Art Direction panel; hooks into `prc-platform.attachments-panel` and `prc-platform.seo.ui.social` |
| `includes/inspector-sidebar-panel/src/inspector-sidebar.jsx` | The sidebar panel component rendering all image slots |
| `includes/inspector-sidebar-panel/src/pre-publish-panel.jsx` | Pre-publish checklist panel for reviewing art direction before publish |
| `includes/core-post-featured-image/class-core-post-featured-image.php` | Modifies `core/post-featured-image` block at render time; adds `imageSize` and `isChartArt` attributes; outputs a responsive `<picture>` element using HIDPI and mobile variants |
| `tests/editor-panel.spec.ts` | Playwright tests for editor panel rendering and asset enqueueing |
| `tests/rest-api.spec.ts` | Playwright tests for REST field read/write, sanitization, legacy migration, and featured image fallback |
| `tests/frontend-output.spec.ts` | Playwright tests for frontend block rendering |

## Hooks & Filters

### PHP Actions & Filters

| Hook | Type | Description |
|------|------|-------------|
| `prc_platform__art_direction_enabled_post_types` | Filter | Append post type slugs to the list of types that support art direction. Prefer `add_post_type_support( $type, 'prc-art-direction' )` for new code. |
| `wpseo_opengraph_image` | Filter (consumed) | Replaced with the `social` slot URL when one is set |
| `wpseo_twitter_image` | Filter (consumed) | Replaced with the `social` slot URL when one is set |
| `block_type_metadata` | Filter (consumed) | Adds `imageSize` (default `A1`) and `isChartArt` (default `false`) attributes to `core/post-featured-image` |
| `render_block` | Filter (consumed) | Intercepts `core/post-featured-image` rendering and replaces output with a responsive `<picture>` element built from art direction data |
| `prc_api_endpoints` | Filter (consumed) | Registers the custom `GET /prc-api/v3/art-direction/get/{post_id}` endpoint |

### JavaScript Filters (`@wordpress/hooks`)

| Filter | Description |
|--------|-------------|
| `editor.PostFeaturedImage` | Replaces the default Featured Image panel in the block editor with the Art Direction multi-slot panel |
| `prc-platform.attachments-panel` | Injects Art Direction options into the platform Attachments sidebar panel |
| `prc-platform.seo.ui.social` | Injects the `social` slot picker into the platform SEO panel's social section |

## REST API

**Field on post endpoints** — available on all enabled post types:

```
GET  /wp/v2/posts/{id}          → response.art_direction
POST /wp/v2/posts/{id}          body: { art_direction: { A1: {...}, social: {...} } }
```

**Dedicated endpoint** (public, no auth required):

```
GET /prc-api/v3/art-direction/get/{post_id}
```

Returns the full art direction object for the post, or the featured image fallback if no art direction data is stored.

## WP-CLI

```bash
# Preview posts that would be migrated (facebook/twitter → social)
wp prc art-direction migrate-social --dry-run

# Run migration on all enabled post types
wp prc art-direction migrate-social --dry-run=false

# Migrate only a specific post type
wp prc art-direction migrate-social --post-type=post --dry-run=false
```

## Troubleshooting

### Art Direction panel not appearing in editor

**Symptom**: The sidebar shows the default "Featured image" panel instead of the Art Direction panel.  
**Cause**: The `inspector-sidebar-panel` JS bundle is not built or not enqueued. The panel only enqueues on post types that have `prc-art-direction` support.  
**Fix**: Run `npm run build -w @prc/art-direction` and confirm the post type is registered with `add_post_type_support( $type, 'prc-art-direction' )`.

### Frontend images not rendering from art direction data

**Symptom**: The `core/post-featured-image` block renders the default WordPress featured image instead of the art direction slot.  
**Cause**: `artDirection` post meta is empty and no fallback featured image is set, or the `core-post-featured-image` JS/PHP hasn't been built.  
**Fix**: Confirm art direction data is saved for the post via the editor panel, then check the REST response at `/prc-api/v3/art-direction/get/{post_id}`.

### Social OG image not updating after saving art direction

**Symptom**: Yoast SEO still serves the old image in Open Graph / Twitter card meta tags.  
**Cause**: The Yoast SEO page cache or edge cache may be serving a stale version.  
**Fix**: Purge the Yoast SEO cache for the post and purge any edge/CDN cache layer. Verify the `social` slot is set in the editor and present in the REST response.

### Distributor push loses art direction images

**Symptom**: After pushing a post to another site, art direction images are missing or broken on the destination.  
**Cause**: Distributor is not active on one or both sites, or a version mismatch means `distributor_register_data` is unavailable.  
**Fix**: Confirm Distributor is active and up-to-date on both source and destination sites. The `Distributor` class only registers its handler when `distributor_register_data()` exists.

## Related Docs

- [DEVELOPMENT_GUIDELINES.md](../../docs/DEVELOPMENT_GUIDELINES.md)
- [prc-platform-core](../prc-platform-core/README.md)
