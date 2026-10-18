<?php
/**
 * Title: Studio classes
 * Slug: solevo/home-studio
 * Categories: solevo-home, solevo
 * Viewport width: 1400
 */

$categories = array(
	array(
		'name'    => 'Reformer Pilates',
		'places'  => '6 places',
		'classes' => array(
			array( 'Reformer Athletica', 'Sweat. Stabilise. Perform.', 'A performance based reformer class built for the active individual. Expect dynamic sequencing, unilateral strength, core control and athletic conditioning layered with precision. This class challenges stability, coordination and endurance while protecting joints and improving movement efficiency.', 'Active bodies wanting a performance edge.' ),
			array( 'Reformer Strength / Align', 'Build strength the smart way.', 'Controlled strength meets intelligent alignment. This session blends progressive resistance with slower, tempo based work to build deep stability, joint control and balanced muscle development. You’ll refine posture, improve movement mechanics and leave feeling strong and centred.', 'Those wanting strength with precision and form focus.' ),
			array( 'Reformer Pre &amp; Post Natal', 'Strong through every stage.', 'Supportive, safe and empowering movement for pregnancy and postpartum. Designed by health professionals, this class focuses on pelvic floor connection, core support, postural strength and whole body stability. Modifications are provided for every trimester and recovery phase.', 'All stages of pregnancy and postnatal clearance.' ),
		),
	),
	array(
		'name'    => 'Mat Pilates',
		'places'  => '14 places',
		'classes' => array(
			array( 'Mat Pilates Strength', 'Simple. Strong. Effective.', 'Foundational strength using bodyweight and small equipment. This class builds deep core stability, hip strength and shoulder control through controlled, progressive sequences. Expect intelligent programming with a strong focus on technique and breath.', 'Building resilient, balanced strength.' ),
			array( 'Mat Pilates Sculpt', 'Lengthen. Sculpt. Sweat.', 'A faster paced mat session designed to elevate heart rate while maintaining control. Expect flowing sequences, endurance sets and core centric burn that leaves you energised and toned.', 'Those wanting strength with a metabolic edge.' ),
			array( 'Mat Pilates Pre &amp; Post Natal', 'Restore with confidence.', 'Gentle yet strengthening mat based support for mums to be and new mums. Focused on breath, pelvic floor integration and gradual core rebuilding, this class restores strength safely while improving posture and reducing tension.', '' ),
		),
	),
	array(
		'name'    => 'Yoga',
		'places'  => '14 places',
		'classes' => array(
			array( 'Yoga Vinyasa', 'Move with intention.', 'Fluid movement connected to breath. This energising flow builds mobility, strength and balance through creative sequencing. Expect smooth transitions, mindful breathwork and space to challenge yourself or slow down as needed.', 'All levels (options provided).' ),
			array( 'Yoga Restore &amp; Release', 'Reset your system.', 'Slow, grounding and recovery focused. This class blends longer holds, deep stretches and guided breathwork to release tension and calm the nervous system. Ideal for recovery days or high stress weeks.', 'Recovery, flexibility and stress reduction.' ),
		),
	),
);
?>
<!-- wp:group {"tagName":"section","anchor":"studio","align":"full","backgroundColor":"eucalypt","textColor":"base","className":"solevo-section solevo-dark","layout":{"type":"constrained"}} -->
<section id="studio" class="wp-block-group alignfull solevo-section solevo-dark has-base-color has-eucalypt-background-color has-text-color has-background"><!-- wp:columns {"align":"wide","className":"solevo-split"} -->
<div class="wp-block-columns alignwide solevo-split"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"className":"is-style-eyebrow"} -->
<p class="is-style-eyebrow">Solevo Studio</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading">Reform. Strengthen. <em>Evolve.</em></h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>A boutique reformer pilates, mat pilates and yoga studio in Brookvale designed to build strength, mobility and control in an elevated, small group setting.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Solevo Studio blends clinical precision with intentional movement. Our classes are designed in collaboration with physiotherapists and sports scientists, delivering intelligent programming that strengthens, restores and challenges the whole body.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"solevo-badge"} -->
<p class="solevo-badge">All classes 45 minutes</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><?php echo solevo_img( 'studio-stretch', 'is-style-rounded solevo-tall' ); // phpcs:ignore ?></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->
<?php foreach ( $categories as $cat ) : ?>
<!-- wp:group {"align":"wide","className":"solevo-class-group","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide solevo-class-group"><!-- wp:group {"className":"solevo-class-group__head","layout":{"type":"flex","flexWrap":"wrap","verticalAlignment":"bottom"}} -->
<div class="wp-block-group solevo-class-group__head"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php echo $cat['name']; // phpcs:ignore ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"solevo-badge"} -->
<p class="solevo-badge"><?php echo $cat['places']; // phpcs:ignore ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"solevo-grid","layout":{"type":"grid","minimumColumnWidth":"17rem"}} -->
<div class="wp-block-group solevo-grid"><?php foreach ( $cat['classes'] as $c ) : ?><!-- wp:group {"className":"is-style-card solevo-class","layout":{"type":"default"}} -->
<div class="wp-block-group is-style-card solevo-class"><!-- wp:heading {"level":4} -->
<h4 class="wp-block-heading"><?php echo $c[0]; // phpcs:ignore ?></h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"solevo-class__tag"} -->
<p class="solevo-class__tag"><?php echo $c[1]; // phpcs:ignore ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php echo $c[2]; // phpcs:ignore ?></p>
<!-- /wp:paragraph --><?php if ( $c[3] ) : ?>

<!-- wp:paragraph {"className":"solevo-class__best"} -->
<p class="solevo-class__best"><strong>Best for:</strong> <?php echo $c[3]; // phpcs:ignore ?></p>
<!-- /wp:paragraph --><?php endif; ?></div>
<!-- /wp:group --><?php endforeach; ?></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<?php endforeach; ?>
<!-- wp:group {"align":"wide","className":"is-style-card solevo-events","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide is-style-card solevo-events"><!-- wp:paragraph {"className":"is-style-eyebrow"} -->
<p class="is-style-eyebrow">Events &amp; Wellness Workshops</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Solevo Wellness Series: Learn. Move. Evolve.</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Monthly workshops and specialty events designed to elevate performance and wellbeing. From injury prevention and running mechanics to breathwork, women’s health and strength education, these sessions combine expert insight with practical, hands on learning.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>If you're a practitioner or facilitator interested in hosting a workshop or wellness event at Solevo, we'd love to hear from you. Please reach out via <a href="mailto:hello@solevo.com.au">hello@solevo.com.au</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
