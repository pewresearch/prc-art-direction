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
import renderAttachmentsPanelHook from './attachments-panel-hook';

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
		renderAttachmentsPanelHook
	);
});


