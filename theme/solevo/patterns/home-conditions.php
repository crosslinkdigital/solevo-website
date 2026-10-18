<?php
/**
 * Title: Home: conditions we treat
 * Slug: solevo/home-conditions
 * Categories: solevo-home
 * Viewport width: 1400
 */

$conditions = array( 'Neck pain', 'Cervicogenic headaches', 'Shoulder impingement', 'Rotator cuff injuries', 'Frozen shoulder', 'Tennis elbow', 'Thoracic pain', 'Lower back pain', 'Sciatica', 'Hip pain', 'Gluteal tendinopathy', 'ACL injuries', 'Meniscus injuries', 'Patellofemoral pain', 'ITB syndrome', 'Achilles tendinopathy', 'Plantar fasciitis', 'Shin splints', 'Stress fractures', 'Ankle instability', 'Running injuries', 'Gym injuries', 'CrossFit injuries', 'Golf injuries', 'Basketball injuries', 'Workplace &amp; postural pain' );
?>
<!-- wp:group {"tagName":"section","align":"full","backgroundColor":"sand","className":"solevo-section","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull solevo-section has-sand-background-color has-background"><!-- wp:group {"align":"wide","className":"solevo-section-head","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide solevo-section-head"><!-- wp:paragraph {"className":"is-style-eyebrow"} -->
<p class="is-style-eyebrow">Conditions We Treat</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading">Comprehensive care for the whole body</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Select your condition to book an appointment with our team.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide"><!-- wp:list {"className":"is-style-pills solevo-conditions"} -->
<ul class="wp-block-list is-style-pills solevo-conditions"><?php foreach ( $conditions as $c ) : ?><!-- wp:list-item -->
<li><a href="#cliniko"><?php echo $c; // phpcs:ignore ?></a></li>
<!-- /wp:list-item --><?php endforeach; ?></ul>
<!-- /wp:list --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
