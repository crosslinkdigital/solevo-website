<?php
/**
 * Title: Home: technology and assessment
 * Slug: solevo/home-technology
 * Categories: solevo-home, solevo
 * Viewport width: 1400
 */

$items = array( 'Running gait analysis', 'Biomechanical assessment', 'Functional strength testing', 'Return to run testing &amp; programming', 'Movement screening', 'Integrated force plate treadmill analysis', 'Collaborative case conferencing' );
?>
<!-- wp:group {"tagName":"section","align":"full","className":"solevo-section solevo-olive solevo-wave solevo-wave--olive","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull solevo-section solevo-olive solevo-wave solevo-wave--olive"><!-- wp:columns {"align":"wide","className":"solevo-tech__cols"} -->
<div class="wp-block-columns alignwide solevo-tech__cols"><!-- wp:column {"width":"54%"} -->
<div class="wp-block-column" style="flex-basis:54%"><!-- wp:paragraph {"className":"solevo-eyebrow"} -->
<p class="solevo-eyebrow">Technology &amp; Assessment</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"solevo-h2-xl"} -->
<h2 class="wp-block-heading solevo-h2-xl">We assess the entire body, <em>not just the painful area.</em></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"solevo-sub"} -->
<p class="solevo-sub">Utilising advanced tools to ensure precision.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"46%"} -->
<div class="wp-block-column" style="flex-basis:46%"><!-- wp:list {"className":"solevo-dots"} -->
<ul class="wp-block-list solevo-dots"><?php foreach ( $items as $i ) : ?><!-- wp:list-item -->
<li><?php echo $i; // phpcs:ignore ?></li>
<!-- /wp:list-item --><?php endforeach; ?></ul>
<!-- /wp:list --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:group {"align":"wide","className":"solevo-video","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide solevo-video"><?php echo solevo_img( 'running-assessment', 'solevo-wide-photo', 'full' ); // phpcs:ignore ?>

<!-- wp:paragraph {"className":"solevo-video__play"} -->
<p class="solevo-video__play"><a href="#video">Watch how we assess</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
