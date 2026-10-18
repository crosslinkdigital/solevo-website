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
<!-- wp:group {"tagName":"section","align":"full","backgroundColor":"surface","className":"solevo-section","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull solevo-section has-surface-background-color has-background"><!-- wp:columns {"align":"wide","className":"solevo-split"} -->
<div class="wp-block-columns alignwide solevo-split"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"className":"is-style-eyebrow"} -->
<p class="is-style-eyebrow">The Difference</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading">Why Solevo Physio?</h2>
<!-- /wp:heading -->

<!-- wp:group {"className":"solevo-reasons","layout":{"type":"grid","minimumColumnWidth":"14rem"}} -->
<div class="wp-block-group solevo-reasons"><?php foreach ( $reasons as $r ) : ?><!-- wp:group {"className":"solevo-reason","layout":{"type":"default"}} -->
<div class="wp-block-group solevo-reason"><!-- wp:paragraph {"className":"solevo-num"} -->
<p class="solevo-num"><?php echo $r[0]; // phpcs:ignore ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php echo $r[1]; // phpcs:ignore ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php echo $r[2]; // phpcs:ignore ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --><?php endforeach; ?></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"className":"solevo-duo"} -->
<div class="wp-block-column solevo-duo"><?php echo solevo_img( 'why-stretch', 'is-style-rounded' ); // phpcs:ignore ?>

<?php echo solevo_img( 'why-strength', 'is-style-rounded' ); // phpcs:ignore ?></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
