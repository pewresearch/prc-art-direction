/* eslint-disable no-nested-ternary */
/**
 * WordPress Dependencies
 */
import { Flex, FlexBlock } from '@wordpress/components';

/**
 * Internal Dependencies
 */
import Slot from './slot';
import { useArtDirection } from './context';

export default function ArtDirectionList({restrictToSizes = ['A1', 'A2', 'A3', 'A4', 'social']}) {
	const { hasA1Image } = useArtDirection();
	return (
		<div className="prc-platform-art-direction__list">
			{restrictToSizes.includes('A1') && (
				<>
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
				</>
			)}
			{hasA1Image && (
				<>
					{restrictToSizes.includes('A2') && <Slot size="A2" />}
					{restrictToSizes.includes('A3') && restrictToSizes.includes('A4') && (
						<Flex>
							<FlexBlock>
								{restrictToSizes.includes('A3') && <Slot size="A3" />}
							</FlexBlock>
							<FlexBlock>
								{restrictToSizes.includes('A4') && <Slot size="A4" />}
							</FlexBlock>
						</Flex>
					)}
					{restrictToSizes.includes('social') && (
						<>
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
							<Slot size="social" />
						</>
					)}
				</>
			)}
			{!hasA1Image && (
				<p style={{ marginTop: '1em' }}>
					<em>
						Please upload an A1 image to enable additional art
						direction options.
					</em>
				</p>
			)}
		</div>
	);
}
