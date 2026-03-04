/**
 * WordPress Dependencies
 */
import { addFilter } from '@wordpress/hooks';
import domReady from '@wordpress/dom-ready';

/**
 * Internal Dependencies
 */
import './style.scss';
import InspectorSidebar from './inspector-sidebar';
import PrePublishPanel from './pre-publish-panel';
import renderPanelHook, {socialPanelHook} from './genera-panel-hook';

function renderArtDirectionPlugin() {
	return () => (
		<>
			<InspectorSidebar />
			<PrePublishPanel />
		</>
	);
}

domReady(() => {
	console.log('@prc/art-direction init');
	// Replace the "Featured Image" area with our "Art Direction" panel.
	addFilter(
		'editor.PostFeaturedImage',
		'prc-platform/art-direction',
		renderArtDirectionPlugin
	);
	// Add Art Direction options to our attachments panel plugin.
	addFilter(
		'prc-platform.attachments-panel',
		'prc-platform/art-direction',
		renderPanelHook
	);
	// Add Art Direction options to our seo panel plugin.
	addFilter(
		'prc-platform.seo.ui.social',
		'prc-platform/art-direction',
		socialPanelHook,
	);
});


