/* eslint-disable max-lines-per-function */
/* eslint-disable max-len */
/**
 * WordPress Dependencies
 */
import {
	useEffect,
	useContext,
	useMemo,
	useCallback,
	createContext,
} from '@wordpress/element';
import { useEntityProp, useResourcePermissions } from '@wordpress/core-data';
import { dispatch, useSelect } from '@wordpress/data';

const artDirectionContext = createContext();

function shapeImg(img, size) {
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
 * If A2 then A3 and A4 will be acted upon.
 *
 * @param {Object} currentArtDirection The current art direction state.
 * @param {Object} imgData             WordPress Media Object containing id, url, sizes, and caption.
 * @param {string} size                The image size slot.
 * @return {Object} modified state object
 */
function propagateImageChanges(currentArtDirection, imgData, size) {
	const updates = { ...currentArtDirection };
	if ('A1' === size) {
		updates.A2 = shapeImg(imgData, 'A2');
		updates.XL = shapeImg(imgData, 'XL');
		updates.social = shapeImg(imgData, 'social');
	}
	if ('A1' === size || 'A2' === size) {
		updates.A3 = shapeImg(imgData, 'A3');
		updates.A4 = shapeImg(imgData, 'A4');
	}
	updates[size] = shapeImg(imgData, size);
	return updates;
}

function propagateBorderedToggle(artDirection, size) {
	const updates = { ...artDirection };
	const value = !updates[size].chartArt;
	if ('A2' === size) {
		updates.A2 = { ...updates.A2, chartArt: value };
		updates.A3 = { ...updates.A3, chartArt: value };
		updates.A4 = { ...updates.A4, chartArt: value };
	} else {
		updates[size] = { ...updates[size], chartArt: value };
	}
	return updates;
}

function updateFeatureImage(img = false) {
	if (false !== img) {
		const { editPost } = dispatch('core/editor');
		editPost({ featured_media: img.id });
	}
}

const useArtDirectionContext = () => {
	const { postId, postType } = useSelect((select) => {
		return {
			postId: select('core/editor').getCurrentPostId(),
			postType: select('core/editor').getCurrentPostType(),
		};
	}, []);

	// Use the REST field 'art_direction' directly via useEntityProp
	const [artDirection, setArtDirection] = useEntityProp(
		'postType',
		postType,
		'art_direction',
		postId
	);

	const { isResolving } = useResourcePermissions(postType, postId);
	const allowEditing = useMemo(() => {
		if (isResolving) {
			return false;
		}
		return true;
	}, [isResolving]);

	// Sync featured image when A1 changes
	useEffect(() => {
		if (artDirection?.A1?.id) {
			updateFeatureImage(artDirection.A1);
		}
	}, [artDirection?.A1?.id]);

	const setImageSlot = (imgData, size) => {
		const currentArtDirection = artDirection || {};
		const newArtDirection = propagateImageChanges(
			currentArtDirection,
			imgData,
			size
		);
		setArtDirection(newArtDirection);
	};

	const toggleImageSlotBordered = (size) => {
		const currentArtDirection = artDirection || {};
		const newArtDirection = propagateBorderedToggle(
			currentArtDirection,
			size
		);
		setArtDirection(newArtDirection);
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
		return !!artDirection?.A1;
	}, [artDirection]);

	const allSlotsTheSame = useMemo(() => {
		if (!artDirection) return true;
		const keys = Object.keys(artDirection);
		if (keys.length === 0) return true;
		const first = artDirection[keys[0]];
		if (!first) return true;
		for (let i = 1; i < keys.length; i++) {
			const current = artDirection[keys[i]];
			if (!current) continue;
			if (first.id !== current.id) {
				return false;
			}
			if (first.chartArt !== current.chartArt) {
				return false;
			}
		}
		return true;
	}, [artDirection]);

	return {
		allowEditing,
		postId,
		postType,
		artDirection: artDirection || {},
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
