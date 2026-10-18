<?php
/**
 * Title: Find us (address, hours, map)
 * Slug: solevo/home-find-us
 * Categories: solevo
 * Description: Address, phone and hours pulled from Settings > Solevo, with a lazy-loaded map. For inner pages (the homepage map lives in the footer).
 * Viewport width: 1400
 */
?>
<!-- wp:group {"tagName":"section","align":"full","className":"solevo-section solevo-find","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull solevo-section solevo-find"><!-- wp:columns {"align":"wide","verticalAlignment":"center"} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"40%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:40%"><!-- wp:paragraph {"className":"solevo-eyebrow solevo-left"} -->
<p class="solevo-eyebrow solevo-left">Find Us</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"solevo-left"} -->
<h2 class="wp-block-heading solevo-left">Brookvale Performance Hub</h2>
<!-- /wp:heading -->

<!-- wp:shortcode -->
[solevo_contact show="name,address,phone,email"]
<!-- /wp:shortcode -->

<!-- wp:shortcode -->
[solevo_hours]
<!-- /wp:shortcode --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"60%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:60%"><!-- wp:shortcode -->
[solevo_map]
<!-- /wp:shortcode --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
