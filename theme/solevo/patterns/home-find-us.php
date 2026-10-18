<?php
/**
 * Title: Find us (address, hours, map)
 * Slug: solevo/home-find-us
 * Categories: solevo-home, solevo
 * Description: Address, phone and hours pulled from Settings > Solevo, with a lazy-loaded map.
 * Viewport width: 1400
 */
?>
<!-- wp:group {"tagName":"section","align":"full","className":"solevo-section solevo-find","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull solevo-section solevo-find"><!-- wp:columns {"align":"wide","className":"solevo-split"} -->
<div class="wp-block-columns alignwide solevo-split"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"className":"is-style-eyebrow"} -->
<p class="is-style-eyebrow">Find Us</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading">Brookvale Performance Hub</h2>
<!-- /wp:heading -->

<!-- wp:shortcode -->
[solevo_contact show="name,address,phone,email"]
<!-- /wp:shortcode -->

<!-- wp:shortcode -->
[solevo_hours]
<!-- /wp:shortcode -->

<!-- wp:paragraph {"className":"solevo-small"} -->
<p class="solevo-small">Integrated with The Foot Company Podiatry, in the same space.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:shortcode -->
[solevo_map]
<!-- /wp:shortcode --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
