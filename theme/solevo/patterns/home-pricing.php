<?php
/**
 * Title: Studio pricing
 * Slug: solevo/home-pricing
 * Categories: solevo-home, solevo
 * Viewport width: 1400
 */

$tables = array(
	array( 'Reformer Pilates Classes', '45 min', array(
		array( 'Casual / Drop-in', '$49' ),
		array( '5 Class Pack <span>($45 per class)</span>', '$225' ),
		array( '10 Class Pack <span>($42 per class)</span>', '$420' ),
		array( '20 Class Pack <span>($39 per class)</span>', '$780' ),
		array( '50 Class Pack <span>($37 per class)</span>', '$1,850' ),
	) ),
	array( 'Mat Pilates &amp; Yoga Classes', '45 min', array(
		array( 'Casual / Drop-in', '$30' ),
		array( '5 Class Pack <span>($28 per class)</span>', '$140' ),
		array( '10 Class Pack <span>($26 per class)</span>', '$260' ),
		array( '20 Class Pack <span>($24 per class)</span>', '$480' ),
	) ),
	array( 'Private &amp; Duo Sessions', '', array(
		array( 'Private Session', '$140' ),
		array( 'Private 5 Pack', '$650' ),
		array( 'Private 10 Pack', '$1,200' ),
		array( 'Duo Session 2:1', '$180' ),
		array( 'Duo 5 Pack', '$850' ),
		array( 'Duo 10 Pack', '$1,600' ),
	) ),
	array( 'Clinical Pilates', '', array(
		array( 'Initial Clinical Pilates Assessment <span>(1:1, 60 min)</span>', '$180' ),
		array( 'Subsequent Clinical Pilates Session <span>(1:1, 45 min)</span>', '$150' ),
		array( 'Clinical Reformer Pilates, Small Group <span>(max 6, per person)</span>', '$80' ),
	) ),
);
?>
<!-- wp:group {"tagName":"section","anchor":"pricing","align":"full","className":"solevo-section","layout":{"type":"constrained"}} -->
<section id="pricing" class="wp-block-group alignfull solevo-section"><!-- wp:group {"align":"wide","className":"solevo-section-head","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide solevo-section-head"><!-- wp:paragraph {"className":"is-style-eyebrow"} -->
<p class="is-style-eyebrow">Studio Pricing</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading">Pricing</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","className":"solevo-grid solevo-prices","layout":{"type":"grid","minimumColumnWidth":"17rem"}} -->
<div class="wp-block-group alignwide solevo-grid solevo-prices"><?php foreach ( $tables as $t ) : ?><!-- wp:group {"className":"is-style-card solevo-price-card","layout":{"type":"default"}} -->
<div class="wp-block-group is-style-card solevo-price-card"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php echo $t[0]; // phpcs:ignore ?></h3>
<!-- /wp:heading --><?php if ( $t[1] ) : ?>

<!-- wp:paragraph {"className":"solevo-badge"} -->
<p class="solevo-badge"><?php echo $t[1]; // phpcs:ignore ?></p>
<!-- /wp:paragraph --><?php endif; ?><?php foreach ( $t[2] as $row ) : ?>

<!-- wp:group {"className":"solevo-price-row","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between","verticalAlignment":"top"}} -->
<div class="wp-block-group solevo-price-row"><!-- wp:paragraph -->
<p><?php echo $row[0]; // phpcs:ignore ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"solevo-price"} -->
<p class="solevo-price"><?php echo $row[1]; // phpcs:ignore ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --><?php endforeach; ?></div>
<!-- /wp:group --><?php endforeach; ?>

<!-- wp:group {"backgroundColor":"ink","textColor":"base","className":"is-style-card solevo-price-card solevo-offer","layout":{"type":"default"}} -->
<div class="wp-block-group is-style-card solevo-price-card solevo-offer has-base-color has-ink-background-color has-text-color has-background"><!-- wp:paragraph {"className":"is-style-eyebrow"} -->
<p class="is-style-eyebrow">Limited Offer</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Solevo Founders Pack</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>10 Reformer Classes</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"solevo-offer__price"} -->
<p class="solevo-offer__price">$360 <span>($36 per class)</span></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"solevo-small"} -->
<p class="solevo-small">Limited to first 100 clients only</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#mindbody">Claim the Founders Pack</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"className":"solevo-small solevo-center"} -->
<p class="solevo-small solevo-center"><strong>Pack expiry:</strong> 5 pack, 1 month · 10 pack, 3 months · 20 pack, 6 months · 50 pack, 12 months</p>
<!-- /wp:paragraph --></section>
<!-- /wp:group -->
