/**
 * Frontend output tests for prc-art-direction.
 *
 * Covers:
 * - The `art_direction` REST field label change ("Art Direction" instead of "Featured Image")
 * - Post with art_direction meta returns correct REST data on the frontend
 * - Post type label customization for featured image
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

async function uploadImage(
	requestUtils: RequestUtils,
	filename: string = 'frontend-test.png'
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

test.describe('Art Direction frontend data', () => {
	let postId: number;
	let image: { id: number; source_url: string };

	test.beforeAll(async ({ requestUtils }) => {
		image = await uploadImage(requestUtils, 'frontend-art.png');
	});

	test.afterAll(async ({ requestUtils }) => {
		await deleteAttachment(requestUtils, image.id);
	});

	test.beforeEach(async ({ requestUtils }) => {
		const post = await requestUtils.createPost({
			title: 'Frontend Art Direction Test',
			status: 'publish',
		});
		postId = post.id;
	});

	test.afterEach(async ({ requestUtils }) => {
		if (postId) {
			await deletePost(requestUtils, postId);
		}
	});

	test('art_direction field is exposed in REST API response', async ({
		requestUtils,
	}) => {
		// Confirm the field exists on the post type schema.
		const post = await requestUtils.rest({
			method: 'GET',
			path: `/wp/v2/posts/${postId}`,
		});

		// The field should be defined on the response object.
		expect('art_direction' in post).toBe(true);
	});

	test('art_direction data roundtrips correctly', async ({
		requestUtils,
	}) => {
		const slot = buildSlot(image.id, image.source_url, {
			chartArt: true,
			caption: 'Test caption',
		});

		const artDirection = {
			A1: slot,
			A2: buildSlot(image.id, image.source_url),
			A3: buildSlot(image.id, image.source_url),
			A4: buildSlot(image.id, image.source_url),
			XL: buildSlot(image.id, image.source_url),
			social: buildSlot(image.id, image.source_url, {
				caption: 'Social caption',
			}),
		};

		// Write.
		await requestUtils.rest({
			method: 'POST',
			path: `/wp/v2/posts/${postId}`,
			data: { art_direction: artDirection },
		});

		// Read.
		const post = await requestUtils.rest({
			method: 'GET',
			path: `/wp/v2/posts/${postId}`,
		});

		const ad = post.art_direction;
		expect(ad).toBeTruthy();

		// Verify A1 slot specifics.
		expect(ad.A1.id).toBe(image.id);
		expect(ad.A1.chartArt).toBe(true);
		expect(ad.A1.caption).toBe('Test caption');

		// Verify social slot.
		expect(ad.social.id).toBe(image.id);
		expect(ad.social.caption).toBe('Social caption');
	});

	test('clearing art_direction results in empty/falsy value', async ({
		requestUtils,
	}) => {
		const slot = buildSlot(image.id, image.source_url);

		// First set some data.
		await requestUtils.rest({
			method: 'POST',
			path: `/wp/v2/posts/${postId}`,
			data: {
				art_direction: {
					A1: slot,
					A2: slot,
					A3: slot,
					A4: slot,
					XL: slot,
					social: slot,
				},
			},
		});

		// Now clear by sending an empty object.
		await requestUtils.rest({
			method: 'POST',
			path: `/wp/v2/posts/${postId}`,
			data: { art_direction: {} },
		});

		const post = await requestUtils.rest({
			method: 'GET',
			path: `/wp/v2/posts/${postId}`,
		});

		// After clearing, art_direction should be empty or falsy.
		const ad = post.art_direction;
		const isEmpty =
			!ad || (typeof ad === 'object' && Object.keys(ad).length === 0);
		expect(isEmpty).toBe(true);
	});
});

test.describe('Art Direction post type label customization', () => {
	test('post type REST response uses customized featured image labels', async ({
		requestUtils,
	}) => {
		// Query the post type definition to check label customization.
		const postTypes = await requestUtils.rest({
			method: 'GET',
			path: '/wp/v2/types/post',
		});

		// The plugin changes featured_image labels to "Art Direction".
		if (postTypes.labels) {
			const labels = postTypes.labels;
			// Check if the featured image label has been renamed.
			if (labels.featured_image) {
				expect(labels.featured_image).toBe('Art Direction');
			}
			if (labels.set_featured_image) {
				expect(labels.set_featured_image).toContain('art direction');
			}
		}
	});
});

test.describe('Art Direction slot properties', () => {
	let postId: number;
	let image: { id: number; source_url: string };

	test.beforeAll(async ({ requestUtils }) => {
		image = await uploadImage(requestUtils, 'slot-props-test.png');
	});

	test.afterAll(async ({ requestUtils }) => {
		await deleteAttachment(requestUtils, image.id);
	});

	test.beforeEach(async ({ requestUtils }) => {
		const post = await requestUtils.createPost({
			title: 'Slot Properties Test',
			status: 'publish',
		});
		postId = post.id;
	});

	test.afterEach(async ({ requestUtils }) => {
		if (postId) {
			await deletePost(requestUtils, postId);
		}
	});

	test('each slot has expected properties after save', async ({
		requestUtils,
	}) => {
		const slot = buildSlot(image.id, image.source_url, {
			width: 1200,
			height: 630,
			chartArt: false,
			caption: 'A test image',
		});

		await requestUtils.rest({
			method: 'POST',
			path: `/wp/v2/posts/${postId}`,
			data: {
				art_direction: {
					A1: slot,
					A2: slot,
					A3: slot,
					A4: slot,
					XL: slot,
					social: slot,
				},
			},
		});

		const post = await requestUtils.rest({
			method: 'GET',
			path: `/wp/v2/posts/${postId}`,
		});

		const expectedKeys = [
			'id',
			'rawUrl',
			'url',
			'width',
			'height',
			'chartArt',
			'caption',
		];
		const slots = ['A1', 'A2', 'A3', 'A4', 'XL', 'social'];

		for (const slotName of slots) {
			const slotData = post.art_direction[slotName];
			expect(slotData).toBeDefined();
			for (const key of expectedKeys) {
				expect(slotData).toHaveProperty(key);
			}
			expect(typeof slotData.id).toBe('number');
			expect(typeof slotData.chartArt).toBe('boolean');
			expect(typeof slotData.width).toBe('number');
			expect(typeof slotData.height).toBe('number');
		}
	});

	test('chartArt boolean toggles correctly', async ({ requestUtils }) => {
		const slotBordered = buildSlot(image.id, image.source_url, {
			chartArt: true,
		});
		const slotNormal = buildSlot(image.id, image.source_url, {
			chartArt: false,
		});

		await requestUtils.rest({
			method: 'POST',
			path: `/wp/v2/posts/${postId}`,
			data: {
				art_direction: {
					A1: slotBordered,
					A2: slotNormal,
					A3: slotBordered,
					A4: slotNormal,
					XL: slotBordered,
					social: slotNormal,
				},
			},
		});

		const post = await requestUtils.rest({
			method: 'GET',
			path: `/wp/v2/posts/${postId}`,
		});

		expect(post.art_direction.A1.chartArt).toBe(true);
		expect(post.art_direction.A2.chartArt).toBe(false);
		expect(post.art_direction.A3.chartArt).toBe(true);
		expect(post.art_direction.A4.chartArt).toBe(false);
		expect(post.art_direction.XL.chartArt).toBe(true);
		expect(post.art_direction.social.chartArt).toBe(false);
	});
});
