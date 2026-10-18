<?php
/**
 * Title: Home: technology and assessment
 * Slug: solevo/home-technology
 * Categories: solevo-home, solevo
 * Viewport width: 1400
 */

$items = array( 'Running gait analysis', 'Biomechanical assessment', 'Functional strength testing', 'Return to run testing &amp; programming', 'Movement screening', 'Integrated force plate treadmill analysis', 'Collaborative case conferencing' );
?>
<!-- wp:group {"tagName":"section","align":"full","className":"solevo-section","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull solevo-section"><!-- wp:columns {"align":"wide","className":"solevo-split solevo-split--reverse"} -->
<div class="wp-block-columns alignwide solevo-split solevo-split--reverse"><!-- wp:column -->
<div class="wp-block-column"><?php echo solevo_img( 'running-assessment', 'is-style-rounded solevo-tall' ); // phpcs:ignore ?></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"className":"is-style-eyebrow"} -->
<p class="is-style-eyebrow">Technology &amp; Assessment</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading">We assess the entire body, <em>not just the painful area.</em></h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Utilising advanced tools to ensure precision.</p>
<!-- /wp:paragraph -->

<!-- wp:list {"className":"is-style-ticks"} -->
<ul class="wp-block-list is-style-ticks"><?php foreach ( $items as $i ) : ?><!-- wp:list-item -->
<li><?php echo $i; // phpcs:ignore ?></li>
<!-- /wp:list-item --><?php endforeach; ?></ul>
<!-- /wp:list --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
