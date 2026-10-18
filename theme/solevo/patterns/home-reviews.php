<?php
/**
 * Title: Google reviews
 * Slug: solevo/home-reviews
 * Categories: solevo-home, solevo
 * Description: Shows real Google reviews once the Trustindex plugin is connected. Hidden from visitors until then.
 * Viewport width: 1400
 */
?>
<!-- wp:group {"tagName":"section","align":"full","backgroundColor":"surface","className":"solevo-section solevo-reviews","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull solevo-section solevo-reviews has-surface-background-color has-background"><!-- wp:group {"align":"wide","className":"solevo-section-head","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide solevo-section-head"><!-- wp:paragraph {"className":"is-style-eyebrow"} -->
<p class="is-style-eyebrow">Reviews</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading">What our clients say</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide"><!-- wp:shortcode -->
[solevo_reviews]
<!-- /wp:shortcode --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
