<?php
/**
 * Title: Home: physiotherapy services
 * Slug: solevo/home-services
 * Categories: solevo-home
 * Viewport width: 1400
 */

$services = array(
	array( 'General Physiotherapy', array( 'Manual therapy', 'Joint mobilisation', 'Soft tissue therapy', 'Exercise prescription', 'Movement assessments' ), 'Comprehensive assessment and treatment for neck, shoulder, back, hip, knee, ankle/foot pain, headaches, postural dysfunction and workplace injuries.' ),
	array( 'Sports Physiotherapy', array( 'Return to play programming', 'Marathon &amp; endurance prep', 'Strength &amp; conditioning integration' ), 'Designed for athletes and active individuals. Managing acute sporting injuries, muscle strains, ligament sprains, tendinopathy and overuse injuries.' ),
	array( 'Rehabilitation &amp; Strength', array( 'Strength', 'Capacity', 'Long term resilience' ), 'We move beyond passive treatment. Progressive loading programs, gym based rehabilitation, post operative rehab (ACL, shoulder, spinal).' ),
	array( 'Adjunct Therapies', array( 'Dry needling', 'Shockwave therapy', 'Compression recovery therapy', 'Trigger point release' ), 'Used strategically within a broader rehab plan to accelerate recovery.' ),
);
?>
<!-- wp:group {"tagName":"section","anchor":"services","align":"full","className":"solevo-section solevo-services-section","layout":{"type":"constrained"}} -->
<section id="services" class="wp-block-group alignfull solevo-section solevo-services-section"><!-- wp:group {"align":"wide","className":"solevo-head","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide solevo-head"><!-- wp:paragraph {"className":"solevo-eyebrow"} -->
<p class="solevo-eyebrow">Our Expertise</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading">Physiotherapy Services</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","className":"solevo-service-list","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide solevo-service-list"><?php foreach ( $services as $s ) : ?><!-- wp:columns {"className":"solevo-service"} -->
<div class="wp-block-columns solevo-service"><!-- wp:column {"width":"43%"} -->
<div class="wp-block-column" style="flex-basis:43%"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php echo $s[0]; // phpcs:ignore ?></h3>
<!-- /wp:heading -->

<!-- wp:list {"className":"solevo-plaintags"} -->
<ul class="wp-block-list solevo-plaintags"><?php foreach ( $s[1] as $t ) : ?><!-- wp:list-item -->
<li><?php echo $t; // phpcs:ignore ?></li>
<!-- /wp:list-item --><?php endforeach; ?></ul>
<!-- /wp:list --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"57%"} -->
<div class="wp-block-column" style="flex-basis:57%"><!-- wp:paragraph {"className":"solevo-service__desc"} -->
<p class="solevo-service__desc"><?php echo $s[2]; // phpcs:ignore ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"solevo-textlink"} -->
<p class="solevo-textlink"><a href="#cliniko">Book now →</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --><?php endforeach; ?></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
