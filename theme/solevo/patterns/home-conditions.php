<?php
/**
 * Title: Home: conditions we treat
 * Slug: solevo/home-conditions
 * Categories: solevo-home
 * Viewport width: 1400
 */

$conditions = array( 'Neck pain', 'Cervicogenic headaches', 'Shoulder impingement', 'Rotator cuff injuries', 'Frozen shoulder', 'Tennis elbow', 'Thoracic pain', 'Lower back pain', 'Sciatica', 'Hip pain', 'Gluteal tendinopathy', 'ACL injuries', 'Meniscus injuries', 'Patellofemoral pain', 'ITB syndrome', 'Achilles tendinopathy', 'Plantar fasciitis', 'Shin splints', 'Stress fractures', 'Ankle instability', 'Running injuries', 'Gym injuries', 'CrossFit injuries', 'Golf injuries', 'Basketball injuries', 'Workplace &amp; postural pain' );
?>
<!-- wp:group {"tagName":"section","align":"full","className":"solevo-section solevo-conditions-section solevo-wave solevo-wave--paper","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull solevo-section solevo-conditions-section solevo-wave solevo-wave--paper"><!-- wp:group {"align":"wide","className":"solevo-head","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide solevo-head"><!-- wp:paragraph {"className":"solevo-eyebrow"} -->
<p class="solevo-eyebrow">Conditions We Treat</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"solevo-h2-sm"} -->
<h2 class="wp-block-heading solevo-h2-sm">Comprehensive care for the whole body</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"solevo-sub"} -->
<p class="solevo-sub">Select your condition to book an appointment with our team.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide"><!-- wp:list {"className":"solevo-condtags"} -->
<ul class="wp-block-list solevo-condtags"><?php foreach ( $conditions as $c ) : ?><!-- wp:list-item -->
<li><a href="#cliniko"><?php echo $c; // phpcs:ignore ?></a></li>
<!-- /wp:list-item --><?php endforeach; ?></ul>
<!-- /wp:list --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
