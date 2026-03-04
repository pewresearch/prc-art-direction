/**
 * WordPress Dependencies
 */
import { PanelBody } from '@wordpress/components';

/**
 * Internal Dependencies
 */
import { ProvideArtDirection } from './context';
import ArtDirectionList from './art-direction-list';

export function socialPanelHook(OriginalPanel) {
	return (props) => (
		<>
			<OriginalPanel {...props} />
			<ProvideArtDirection>
				<PanelBody title="Art Direction" initialOpen={false}>
					<ArtDirectionList restrictToSizes={['social']} />
				</PanelBody>
			</ProvideArtDirection>
		</>
	);
}

export default function renderPanelHook(OriginalPanel) {
	return (props) => (
		<>
			<OriginalPanel {...props} />
			<ProvideArtDirection>
				<PanelBody title="Art Direction" initialOpen={false}>
					<ArtDirectionList />
				</PanelBody>
			</ProvideArtDirection>
		</>
	);
}
