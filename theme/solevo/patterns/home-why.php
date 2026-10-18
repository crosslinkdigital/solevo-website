<?php
/**
 * Title: Home: why Solevo
 * Slug: solevo/home-why
 * Categories: solevo-home, solevo
 * Viewport width: 1400
 */

$reasons = array(
	array( '01', 'Whole Body Approach', 'We assess and treat the entire movement system.' ),
	array( '02', 'Strength Led Rehab', 'Exercise based, progressive rehab built for long term resilience.' ),
	array( '03', 'Integrated Care Model', 'Physio + Podiatry + Pilates + Performance all in one space.' ),
	array( '04', 'Northern Beaches Performance Hub', 'Purpose built space in Brookvale designed for movement and recovery.' ),
);
?>
<!-- wp:group {"tagName":"section","align":"full","className":"solevo-section solevo-why-section solevo-wave solevo-wave--after-olive","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull solevo-section solevo-why-section solevo-wave solevo-wave--after-olive"><!-- wp:group {"align":"wide","className":"solevo-head","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide solevo-head"><!-- wp:paragraph {"className":"solevo-eyebrow"} -->
<p class="solevo-eyebrow">The Difference</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading">Why Solevo Physio?</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:columns {"align":"wide","className":"solevo-reasons"} -->
<div class="wp-block-columns alignwide solevo-reasons"><?php foreach ( $reasons as $r ) : ?><!-- wp:column {"className":"solevo-reason"} -->
<div class="wp-block-column solevo-reason"><!-- wp:paragraph {"className":"solevo-num"} -->
<p class="solevo-num"><?php echo $r[0]; // phpcs:ignore ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php echo $r[1]; // phpcs:ignore ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php echo $r[2]; // phpcs:ignore ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --><?php endforeach; ?></div>
<!-- /wp:columns -->

<!-- wp:columns {"align":"wide","className":"solevo-why__photos"} -->
<div class="wp-block-columns alignwide solevo-why__photos"><!-- wp:column -->
<div class="wp-block-column"><?php echo solevo_img( 'why-stretch', 'solevo-photo', 'large' ); // phpcs:ignore ?></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><?php echo solevo_img( 'why-strength', 'solevo-photo', 'large' ); // phpcs:ignore ?></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
