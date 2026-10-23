<?php
/**
 * Title: Patient journey
 * Slug: solevo/c-journey
 * Categories: solevo-components
 * Description: Three numbered steps plus a first-appointment facts panel.
 * Viewport width: 1400
 */
echo solevo_c_journey( solevo_c_head( 'What to expect', '[Your journey]', '[Short intro.]' ), array( array( '[Step 1]', '[One sentence.]' ), array( '[Step 2]', '[One sentence.]' ), array( '[Step 3]', '[One sentence.]' ) ), array( array( 'What happens', '[Text]' ), array( 'How long', '[Text]' ), array( 'What to bring', '[Text]' ), array( 'After that', '[Text]' ) ) ); // phpcs:ignore
