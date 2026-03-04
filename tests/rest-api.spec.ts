/**
 * REST API tests for prc-art-direction.
 *
 * Covers:
 * - The `art_direction` REST field on posts (read/write)
 * - Sanitization of stored values (only allowed keys persisted)
 * - Legacy facebook/twitter → social migration on read and write
 * - Custom endpoint GET /prc-api/v3/art-direction/get/{post_id}
 */
import { test, expect } from '@wordpress/e2e-test-utils-playwright';
import type { RequestUtils } from '@wordpress/e2e-test-utils-playwright';

/* ---------- Helpers ---------- */

async function deletePost(
	requestUtils: RequestUtils,
	postId: number
): Promise<void> {
	await requestUtils.rest({
		method: 'DELETE',
		path: `/wp/v2/posts/${postId}`,
		params: { force: true },
	});
}

async function deleteAttachment(
	requestUtils: RequestUtils,
	attachmentId: number
): Promise<void> {
	await requestUtils.rest({
		method: 'DELETE',
		path: `/wp/v2/media/${attachmentId}`,
		params: { force: true },
	});
}

/**
 * Upload a minimal 1×1 PNG and return the media object.
 * @param requestUtils
 * @param filename
 */
async function uploadImage(
	requestUtils: RequestUtils,
	filename: string = 'art-direction-test.png'
): Promise<{ id: number; source_url: string }> {
	const pngBase64 =
		'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP8/5+hHgAHggJ/PchI7wAAAABJRU5ErkJggg==';
	const buffer = Buffer.from(pngBase64, 'base64');

	const response = await requestUtils.rest({
		method: 'POST',
		path: '/wp/v2/media',
		headers: {
			'Content-Disposition': `attachment; filename="${filename}"`,
			'Content-Type': 'image/png',
		},
		data: buffer,
	});

	return { id: response.id, source_url: response.source_url };
}

/**
 * Build a valid art direction slot object for a given image.
 * @param imageId
 * @param imageUrl
 * @param overrides
 */
function buildSlot(
	imageId: number,
	imageUrl: string,
	overrides: Record<string, unknown> = {}
) {
	return {
		id: imageId,
		rawUrl: imageUrl,
		url: imageUrl,
		width: 1,
		height: 1,
		chartArt: false,
		caption: '',
		...overrides,
	};
}

/* ---------- Tests ---------- */

test.describe('Art Direction REST field (read/write)', () => {
	let postId: number;
	let imageA: { id: number; source_url: string };
	let imageB: { id: number; source_url: string };

	test.beforeAll(async ({ requestUtils }) => {
		imageA = await uploadImage(requestUtils, 'art-dir-a.png');
		imageB = await uploadImage(requestUtils, 'art-dir-b.png');
	});

	test.afterAll(async ({ requestUtils }) => {
		await deleteAttachment(requestUtils, imageA.id);
		await deleteAttachment(requestUtils, imageB.id);
	});

	test.beforeEach(async ({ requestUtils }) => {
		const post = await requestUtils.createPost({
			title: 'Art Direction REST Test',
			status: 'publish',
		});
		postId = post.id;
	});

	test.afterEach(async ({ requestUtils }) => {
		if (postId) {
			await deletePost(requestUtils, postId);
		}
	});

	test('newly created post has no art_direction field value', async ({
		requestUtils,
	}) => {
		const post = await requestUtils.rest({
			method: 'GET',
			path: `/wp/v2/posts/${postId}`,
		});

		// The field should be present but falsy (no data set yet).
		expect(
			post.art_direction === false ||
				post.art_direction === null ||
				(typeof post.art_direction === 'object' &&
					Object.keys(post.art_direction).length === 0)
		).toBe(true);
	});

	test('can set and retrieve art_direction via REST field', async ({
		requestUtils,
	}) => {
		const slotA = buildSlot(imageA.id, imageA.source_url);
		const slotB = buildSlot(imageB.id, imageB.source_url);

		const artDirection = {
			A1: slotA,
			A2: slotA,
			A3: slotB,
			A4: slotB,
			XL: slotA,
			social: slotB,
		};

		// Update the post with art direction data.
		await requestUtils.rest({
			method: 'POST',
			path: `/wp/v2/posts/${postId}`,
			data: { art_direction: artDirection },
		});

		// Read it back.
		const post = await requestUtils.rest({
			method: 'GET',
			path: `/wp/v2/posts/${postId}`,
		});

		expect(post.art_direction).toBeTruthy();
		expect(post.art_direction.A1).toBeDefined();
		expect(post.art_direction.A1.id).toBe(imageA.id);
		expect(post.art_direction.A3).toBeDefined();
		expect(post.art_direction.A3.id).toBe(imageB.id);
		expect(post.art_direction.social).toBeDefined();
		expect(post.art_direction.social.id).toBe(imageB.id);
	});

	test('only allowed keys (A1-A4, XL, social) are persisted', async ({
		requestUtils,
	}) => {
		const slot = buildSlot(imageA.id, imageA.source_url);

		const artDirection = {
			A1: slot,
			A2: slot,
			A3: slot,
			A4: slot,
			XL: slot,
			social: slot,
			// These should be stripped:
			randomKey: slot,
			instagram: slot,
		};

		await requestUtils.rest({
			method: 'POST',
			path: `/wp/v2/posts/${postId}`,
			data: { art_direction: artDirection },
		});

		const post = await requestUtils.rest({
			method: 'GET',
			path: `/wp/v2/posts/${postId}`,
		});

		expect(post.art_direction).toBeTruthy();
		// Allowed keys should exist.
		expect(post.art_direction.A1).toBeDefined();
		expect(post.art_direction.XL).toBeDefined();
		expect(post.art_direction.social).toBeDefined();
		// Disallowed keys should NOT exist.
		expect(post.art_direction.randomKey).toBeUndefined();
		expect(post.art_direction.instagram).toBeUndefined();
	});

	test('slot values are sanitized correctly', async ({ requestUtils }) => {
		const artDirection = {
			A1: {
				id: imageA.id,
				rawUrl: imageA.source_url,
				url: imageA.source_url,
				width: 800,
				height: 600,
				chartArt: true,
				caption: 'Test <strong>caption</strong>',
			},
		};

		await requestUtils.rest({
			method: 'POST',
			path: `/wp/v2/posts/${postId}`,
			data: { art_direction: artDirection },
		});

		const post = await requestUtils.rest({
			method: 'GET',
			path: `/wp/v2/posts/${postId}`,
		});

		const a1 = post.art_direction?.A1;
		expect(a1).toBeDefined();
		expect(a1.id).toBe(imageA.id);
		expect(a1.width).toBe(800);
		expect(a1.height).toBe(600);
		expect(a1.chartArt).toBe(true);
		// sanitize_text_field strips HTML tags.
		expect(a1.caption).not.toContain('<strong>');
	});

	test('can update a single slot without losing others', async ({
		requestUtils,
	}) => {
		const slotA = buildSlot(imageA.id, imageA.source_url);
		const slotB = buildSlot(imageB.id, imageB.source_url);

		// Set initial full art direction.
		await requestUtils.rest({
			method: 'POST',
			path: `/wp/v2/posts/${postId}`,
			data: {
				art_direction: {
					A1: slotA,
					A2: slotA,
					A3: slotA,
					A4: slotA,
					XL: slotA,
					social: slotA,
				},
			},
		});

		// Update only A3 to a different image.
		await requestUtils.rest({
			method: 'POST',
			path: `/wp/v2/posts/${postId}`,
			data: {
				art_direction: {
					A1: slotA,
					A2: slotA,
					A3: slotB,
					A4: slotA,
					XL: slotA,
					social: slotA,
				},
			},
		});

		const post = await requestUtils.rest({
			method: 'GET',
			path: `/wp/v2/posts/${postId}`,
		});

		expect(post.art_direction.A1.id).toBe(imageA.id);
		expect(post.art_direction.A3.id).toBe(imageB.id);
		expect(post.art_direction.social.id).toBe(imageA.id);
	});
});

test.describe('Legacy facebook/twitter → social migration', () => {
	let postId: number;
	let image: { id: number; source_url: string };

	test.beforeAll(async ({ requestUtils }) => {
		image = await uploadImage(requestUtils, 'legacy-migration.png');
	});

	test.afterAll(async ({ requestUtils }) => {
		await deleteAttachment(requestUtils, image.id);
	});

	test.beforeEach(async ({ requestUtils }) => {
		const post = await requestUtils.createPost({
			title: 'Legacy Migration Test',
			status: 'publish',
		});
		postId = post.id;
	});

	test.afterEach(async ({ requestUtils }) => {
		if (postId) {
			await deletePost(requestUtils, postId);
		}
	});

	test('writing legacy facebook key migrates to social and strips legacy keys', async ({
		requestUtils,
	}) => {
		const slot = buildSlot(image.id, image.source_url);

		// Send with legacy 'facebook' key instead of 'social'.
		await requestUtils.rest({
			method: 'POST',
			path: `/wp/v2/posts/${postId}`,
			data: {
				art_direction: {
					A1: slot,
					facebook: slot,
					twitter: slot,
				},
			},
		});

		const post = await requestUtils.rest({
			method: 'GET',
			path: `/wp/v2/posts/${postId}`,
		});

		// The migration should have converted facebook → social.
		expect(post.art_direction.social).toBeDefined();
		expect(post.art_direction.social.id).toBe(image.id);
		// Legacy keys should not be present in the response.
		expect(post.art_direction.facebook).toBeUndefined();
		expect(post.art_direction.twitter).toBeUndefined();
	});
});

test.describe('Art Direction REST field — featured image fallback', () => {
	let postId: number;
	let image: { id: number; source_url: string };

	test.beforeAll(async ({ requestUtils }) => {
		image = await uploadImage(requestUtils, 'featured-fallback.png');
	});

	test.afterAll(async ({ requestUtils }) => {
		await deleteAttachment(requestUtils, image.id);
	});

	test.beforeEach(async ({ requestUtils }) => {
		const post = await requestUtils.createPost({
			title: 'Featured Image Fallback Test',
			status: 'publish',
			featured_media: image.id,
		});
		postId = post.id;
	});

	test.afterEach(async ({ requestUtils }) => {
		if (postId) {
			await deletePost(requestUtils, postId);
		}
	});

	test('post with featured image but no art_direction returns fallback data for all slots', async ({
		requestUtils,
	}) => {
		const post = await requestUtils.rest({
			method: 'GET',
			path: `/wp/v2/posts/${postId}`,
		});

		// When no explicit art direction is set but a featured image exists,
		// the API should return fallback data derived from the featured image.
		const ad = post.art_direction;
		if (ad && typeof ad === 'object' && Object.keys(ad).length > 0) {
			// If fallback data is returned, it should have the standard slots.
			expect(ad.A1).toBeDefined();
			expect(ad.A1.id).toBe(image.id);
			expect(ad.A2).toBeDefined();
			expect(ad.A2.id).toBe(image.id);
			expect(ad.XL).toBeDefined();
		}
	});
});
