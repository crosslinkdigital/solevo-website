<?php
/**
 * Title: Home: physiotherapy services
 * Slug: solevo/home-services
 * Categories: solevo-home
 * Viewport width: 1400
 */

$services = array(
	array(
		'title' => 'General Physiotherapy',
		'tags'  => array( 'Manual therapy', 'Joint mobilisation', 'Soft tissue therapy', 'Exercise prescription', 'Movement assessments' ),
		'text'  => 'Comprehensive assessment and treatment for neck, shoulder, back, hip, knee, ankle/foot pain, headaches, postural dysfunction and workplace injuries.',
	),
	array(
		'title' => 'Sports Physiotherapy',
		'tags'  => array( 'Return to play programming', 'Marathon &amp; endurance prep', 'Strength &amp; conditioning integration' ),
		'text'  => 'Designed for athletes and active individuals. Managing acute sporting injuries, muscle strains, ligament sprains, tendinopathy and overuse injuries.',
	),
	array(
		'title' => 'Rehabilitation &amp; Strength',
		'tags'  => array( 'Strength', 'Capacity', 'Long term resilience' ),
		'text'  => 'We move beyond passive treatment. Progressive loading programs, gym based rehabilitation, post operative rehab (ACL, shoulder, spinal).',
	),
	array(
		'title' => 'Adjunct Therapies',
		'tags'  => array( 'Dry needling', 'Shockwave therapy', 'Compression recovery therapy', 'Trigger point release' ),
		'text'  => 'Used strategically within a broader rehab plan to accelerate recovery.',
	),
);
?>
<!-- wp:group {"tagName":"section","anchor":"services","align":"full","className":"solevo-section","layout":{"type":"constrained"}} -->
<section id="services" class="wp-block-group alignfull solevo-section"><!-- wp:group {"align":"wide","className":"solevo-section-head","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide solevo-section-head"><!-- wp:paragraph {"className":"is-style-eyebrow"} -->
<p class="is-style-eyebrow">Our Expertise</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading">Physiotherapy services</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","className":"solevo-grid","layout":{"type":"grid","minimumColumnWidth":"17rem"}} -->
<div class="wp-block-group alignwide solevo-grid"><?php foreach ( $services as $s ) : ?><!-- wp:group {"className":"is-style-card","layout":{"type":"default"}} -->
<div class="wp-block-group is-style-card"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php echo $s['title']; // phpcs:ignore ?></h3>
<!-- /wp:heading -->

<!-- wp:list {"className":"is-style-pills"} -->
<ul class="wp-block-list is-style-pills"><?php foreach ( $s['tags'] as $t ) : ?><!-- wp:list-item -->
<li><?php echo $t; // phpcs:ignore ?></li>
<!-- /wp:list-item --><?php endforeach; ?></ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p><?php echo $s['text']; // phpcs:ignore ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"solevo-arrow-link"} -->
<p class="solevo-arrow-link"><a href="#cliniko">Book now →</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --><?php endforeach; ?></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
