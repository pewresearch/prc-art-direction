# PRC Art Direction

A featured image takeover for PRC Platform. This plugin replaces the default featured image functionality with a system that allows multiple featured images to be set based on template context.

[![Release PRC-Art-Direction](https://github.com/pewresearch/prc-platform/actions/workflows/on-release__release__prc-art-direction.yml/badge.svg)](https://github.com/pewresearch/prc-platform/actions/workflows/on-release__release__prc-art-direction.yml)

---

## Table of Contents
- [Overview](#overview)
- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
- [REST API](#rest-api)
- [Development](#development)
- [Testing](#testing)
- [Changelog](#changelog)
- [License](#license)

---

## Overview

**PRC Art Direction** enables editors to select and assign multiple images to a post, each tailored for a specific layout or context (e.g., A1, A2, A3, A4, XL, Facebook, Twitter). This system provides granular control over how images appear across different templates and social platforms, replacing the single-featured-image paradigm in WordPress.

- **Plugin URI:** https://github.com/pewresearch/prc-art-direction
- **Requires:** WordPress 6.7+, PHP 8.2+
- **Author:** Seth Rubenstein, Pew Research Center
- **License:** GPL-2.0-or-later
- **Requires Plugins:** prc-platform-core

---

## Features

- **Multiple Featured Images:** Assign different images for various contexts (A1, A2, A3, A4, XL, Facebook, Twitter).
- **Block Editor Integration:** Replaces the default "Featured Image" panel with an "Art Direction" panel in the block editor.
- **Inspector Sidebar Panel:** Manage all art direction slots from a dedicated sidebar panel.
- **REST API Support:** Exposes art direction data via the REST API for headless and decoupled frontends.
- **SEO Integration:** Automatically sets OpenGraph and Twitter images for Yoast SEO based on art direction slots.
- **Fallbacks:** If no art direction image is set, falls back to the default featured image.
- **Customizable Post Types:** Enable art direction for custom post types via the `prc_platform__art_direction_enabled_post_types` filter.

---

## Installation

1. **Dependencies:**
   - Ensure the `prc-platform-core` plugin is installed and active.
   - Requires WordPress 6.7+ and PHP 8.2+.

2. **Plugin Setup:**
   - Place this plugin in your `wp-content/plugins` directory (or equivalent mu-plugins location).
   - Activate the plugin via the WordPress admin or with WP-CLI:
     ```sh
     wp plugin activate prc-art-direction
     ```

3. **Local Development (optional):**
   - Use the included `.wp-env.json` for a local environment:
     ```sh
     wp-env start
     ```
   - This will install dependencies and activate the required theme and plugins.

---

## Usage

### In the Block Editor
- Open a post or custom post type with art direction enabled.
- The "Featured Image" panel is replaced by "Art Direction".
- Assign images to each slot (A1, A2, A3, A4, XL, Facebook, Twitter) as needed.
- Use the Inspector Sidebar to manage all slots and review art direction before publishing.
- The A1 image is required; setting it will auto-populate other slots for convenience (can be overridden).
- For A2, A3, and A4 slots, you can toggle a "Border" option for chart art.

### In Templates/Blocks
- Use the provided block `prc-block/core-post-featured-image` to render the appropriate image for the current context.
- Retrieve art direction data in PHP:
  ```php
  use PRC\Platform\Art_Direction;
  $art = Art_Direction\get( $post_id ); // Get all slots
  $a1  = Art_Direction\get( $post_id, 'A1' ); // Get A1 slot only
  ```

---

## REST API

- **REST Field:** Adds `art_direction` to supported post types in the REST API.
- **Custom Endpoint:**
  - `GET /wp-json/prc/v1/art-direction/get/<post_id>`
  - Returns all art direction data for the given post.

#### Example Response
```json
{
  "A1": { "id": 123, "url": "...", "width": 564, "height": 317, ... },
  "A2": { ... },
  "A3": { ... },
  "A4": { ... },
  "XL": { ... },
  "facebook": { ... },
  "twitter": { ... }
}
```

---

## Development

- **Build Assets:**
  ```sh
  npm install
  npm run build
  ```
- **Scripts:**
  - `build`: Build the plugin assets
  - `test`: Run Playwright tests
  - `test:env:start`: Start local wp-env
  - `test:env:stop`: Stop local wp-env
  - `test:env:clean`: Clean and restart wp-env
  - `test:env:destroy`: Destroy the wp-env environment

- **Code Structure:**
  - `includes/` — Core PHP classes and logic
  - `includes/core-post-featured-image/` — Custom block for rendering images
  - `includes/inspector-sidebar-panel/` — Editor UI for managing art direction
  - `tests/` — Playwright and E2E tests

- **Filters & Hooks:**
  - `prc_platform__art_direction_enabled_post_types` — Filter to enable art direction for custom post types
  - `wpseo_opengraph_image` / `wpseo_twitter_image` — Filters for SEO images

---

## Testing

- **E2E Tests:**
  - Run with Playwright:
    ```sh
    npm run test
    ```
  - Tests are located in the `tests/` directory and use `@wordpress/e2e-test-utils-playwright`.

---

## Changelog

See [CHANGELOG.md](CHANGELOG.md) for version history and updates.

---

## License

GPL-2.0-or-later. See [LICENSE](LICENSE) for details.

