<?php
/**
 * Title: Studio pricing
 * Slug: solevo/home-pricing
 * Categories: solevo-home, solevo
 * Viewport width: 1400
 */

$tables = array(
	array( 'Reformer Pilates Classes', '45 min', array(
		array( 'Casual / Drop-in', '', '$49' ),
		array( '5 Class Pack', '($45 per class)', '$225' ),
		array( '10 Class Pack', '($42 per class)', '$420' ),
		array( '20 Class Pack', '($39 per class)', '$780' ),
		array( '50 Class Pack', '($37 per class)', '$1,850' ),
	) ),
	array( 'Mat Pilates &amp; Yoga Classes', '', array(
		array( 'Casual / Drop-in', '', '$30' ),
		array( '5 Class Pack', '($28 per class)', '$140' ),
		array( '10 Class Pack', '($26 per class)', '$260' ),
		array( '20 Class Pack', '($24 per class)', '$480' ),
	) ),
	array( 'Private &amp; Duo Sessions', '', array(
		array( 'Private Session', '', '$140' ),
		array( 'Private 5 Pack', '', '$650' ),
		array( 'Private 10 Pack', '', '$1,200' ),
		array( 'Duo Session 2:1', '', '$180' ),
		array( 'Duo 5 Pack', '', '$850' ),
		array( 'Duo 10 Pack', '', '$1,600' ),
	) ),
	array( 'Clinical Pilates', '', array(
		array( 'Initial Clinical Pilates Assessment (1:1 — 60 min)', '', '$180' ),
		array( 'Subsequent Clinical Pilates Session (1:1 — 45 min)', '', '$150' ),
		array( 'Clinical Reformer Pilates — Small Group (Max 6)', '(per person)', '$80' ),
	) ),
);
?>
<!-- wp:group {"tagName":"section","anchor":"pricing","align":"full","className":"solevo-section solevo-pricing-section","layout":{"type":"constrained"}} -->
<section id="pricing" class="wp-block-group alignfull solevo-section solevo-pricing-section"><!-- wp:group {"align":"wide","className":"solevo-head","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide solevo-head"><!-- wp:paragraph {"className":"solevo-eyebrow"} -->
<p class="solevo-eyebrow">Studio Pricing</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading">Pricing</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","className":"solevo-prices","layout":{"type":"grid","columnCount":2}} -->
<div class="wp-block-group alignwide solevo-prices"><?php foreach ( $tables as $t ) : ?><!-- wp:group {"className":"solevo-price-card","layout":{"type":"default"}} -->
<div class="wp-block-group solevo-price-card"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php echo $t[0]; // phpcs:ignore ?></h3>
<!-- /wp:heading --><?php if ( $t[1] ) : ?>

<!-- wp:paragraph {"className":"solevo-eyebrow solevo-price-card__meta"} -->
<p class="solevo-eyebrow solevo-price-card__meta"><?php echo $t[1]; // phpcs:ignore ?></p>
<!-- /wp:paragraph --><?php endif; ?>

<!-- wp:group {"className":"solevo-price-rows","layout":{"type":"default"}} -->
<div class="wp-block-group solevo-price-rows"><?php foreach ( $t[2] as $row ) : ?><!-- wp:group {"className":"solevo-price-row","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between","verticalAlignment":"top"}} -->
<div class="wp-block-group solevo-price-row"><!-- wp:paragraph -->
<p><?php echo $row[0]; // phpcs:ignore ?><?php echo $row[1] ? '<br><span>' . $row[1] . '</span>' : ''; // phpcs:ignore ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"solevo-price"} -->
<p class="solevo-price"><?php echo $row[2]; // phpcs:ignore ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --><?php endforeach; ?></div>
<!-- /wp:group --></div>
<!-- /wp:group --><?php endforeach; ?></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","className":"solevo-expiry","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center"}} -->
<div class="wp-block-group alignwide solevo-expiry"><!-- wp:paragraph {"className":"solevo-expiry__label"} -->
<p class="solevo-expiry__label">Pack Expiry:</p>
<!-- /wp:paragraph -->

<!-- wp:list {"className":"solevo-expiry__list"} -->
<ul class="wp-block-list solevo-expiry__list"><!-- wp:list-item -->
<li>5 pack — 1 month expiry</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>10 pack — 3 months</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>20 pack — 6 months</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>50 pack — 12 months</li>
<!-- /wp:list-item --></ul>
<!-- /wp:list --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","className":"solevo-founders","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide solevo-founders"><!-- wp:paragraph {"className":"solevo-eyebrow"} -->
<p class="solevo-eyebrow">Limited Offer</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Solevo Founders Pack</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"solevo-founders__what"} -->
<p class="solevo-founders__what">10 Reformer Classes</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"solevo-founders__price"} -->
<p class="solevo-founders__price">$360</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"solevo-founders__per"} -->
<p class="solevo-founders__per">($36 per class)</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"solevo-eyebrow"} -->
<p class="solevo-eyebrow">Limited to first 100 clients only</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
