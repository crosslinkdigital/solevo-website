<?php
/**
 * Title: Team
 * Slug: solevo/home-team
 * Categories: solevo-home, solevo
 * Viewport width: 1400
 */

$team = array(
	array(
		'img'   => 'emma-docker',
		'name'  => 'Emma Docker',
		'role'  => 'Bachelor of Sport &amp; Exercise Science | Master of Physiotherapy',
		'bio'   => array(
			'Emma grew up playing basketball and netball and has always lived an active lifestyle. Through this, she developed a passion for treating sports-related injuries and guiding clients through the rehabilitation process in a way that keeps them moving, builds confidence, and supports a safe return to the activities they enjoy.',
			'Emma manages a wide range of musculoskeletal conditions, with particular interest in acute sporting injuries (ankle sprains, muscle strains), overuse injuries, running injuries and post operative rehabilitation.',
			'She uses a combination of hands on treatment, targeted exercise prescription, movement retraining and education to help manage pain and injury. Emma believes in meeting people where they are at, taking a collaborative approach to treatment that is tailored to each individual’s needs and goals.',
			'Emma enjoys working with clients of all ages and fitness levels, particularly active individuals wanting to return to sport, stay active long term, and move with confidence.',
		),
		'tags'  => array( 'Clinical Pilates', 'Dry Needling', 'Sports Physiotherapy', 'Ankle &amp; ACL', 'Shoulder', 'Running Injuries' ),
		'note'  => 'Outside of work, Emma is busy chasing after a toddler. She enjoys good coffee, reading, and fitting in exercise whenever she can.',
	),
	array(
		'img'   => 'rikki-xu',
		'name'  => 'Rikki Xu',
		'role'  => 'Pilates Instructor',
		'bio'   => array(
			'Rikki is a Polestar-trained comprehensive Pilates instructor with a background in yoga. Her teaching style is calm, grounded and focused on building functional strength, mobility and postural alignment.',
			'Through mindful, breath-led movement, Rikki helps clients reconnect with their bodies, improve movement control and build confidence in how they move.',
			'She enjoys guiding clients of all levels through thoughtful, balanced sessions that support strength, stability and overall wellbeing.',
		),
		'tags'  => array(),
		'note'  => 'Outside of Pilates, Rikki has a strong interest in mindfulness and self-awareness practices that support personal growth and balance.',
	),
	array(
		'img'   => 'yasmin-mcfadden',
		'name'  => 'Yasmin McFadden',
		'role'  => 'Yoga Instructor',
		'bio'   => array(
			'Yasmin is a Hatha, Vinyasa and Yin yoga teacher who completed her training in Bali. She is passionate about making yoga accessible to everyone and creating a space where people can slow down, reconnect with themselves and move with intention.',
			'Her classes focus on mindful movement, combining breathwork and somatic elements to help release tension and leave you feeling grounded and nourished.',
		),
		'tags'  => array(),
		'note'  => 'Outside of the studio, Yaz loves spending time at the beach, hiking, writing poetry and searching for the best matcha in town.',
	),
);
?>
<!-- wp:group {"tagName":"section","anchor":"team","align":"full","className":"solevo-section solevo-team-section solevo-wave solevo-wave--linen","layout":{"type":"constrained"}} -->
<section id="team" class="wp-block-group alignfull solevo-section solevo-team-section solevo-wave solevo-wave--linen"><!-- wp:group {"align":"wide","className":"solevo-head","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide solevo-head"><!-- wp:paragraph {"className":"solevo-eyebrow"} -->
<p class="solevo-eyebrow">Our Team</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading">Meet Your <em>Team</em></h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->
<?php foreach ( $team as $m ) : ?>

<!-- wp:columns {"align":"wide","className":"solevo-member"} -->
<div class="wp-block-columns alignwide solevo-member"><!-- wp:column {"width":"356px","className":"solevo-member__photo"} -->
<div class="wp-block-column solevo-member__photo" style="flex-basis:356px"><?php echo solevo_img( $m['img'], 'solevo-framed', 'large' ); // phpcs:ignore ?></div>
<!-- /wp:column -->

<!-- wp:column {"className":"solevo-member__text"} -->
<div class="wp-block-column solevo-member__text"><!-- wp:heading {"level":3,"className":"solevo-member__name"} -->
<h3 class="wp-block-heading solevo-member__name"><?php echo $m['name']; // phpcs:ignore ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"solevo-eyebrow solevo-member__role"} -->
<p class="solevo-eyebrow solevo-member__role"><?php echo $m['role']; // phpcs:ignore ?></p>
<!-- /wp:paragraph --><?php foreach ( $m['bio'] as $para ) : ?>

<!-- wp:paragraph -->
<p><?php echo $para; // phpcs:ignore ?></p>
<!-- /wp:paragraph --><?php endforeach; ?><?php if ( $m['tags'] ) : ?>

<!-- wp:paragraph {"className":"solevo-eyebrow solevo-member__label"} -->
<p class="solevo-eyebrow solevo-member__label">Additional Training</p>
<!-- /wp:paragraph -->

<!-- wp:list {"className":"solevo-boxtags"} -->
<ul class="wp-block-list solevo-boxtags"><?php foreach ( $m['tags'] as $t ) : ?><!-- wp:list-item -->
<li><?php echo $t; // phpcs:ignore ?></li>
<!-- /wp:list-item --><?php endforeach; ?></ul>
<!-- /wp:list --><?php endif; ?>

<!-- wp:paragraph {"className":"solevo-note"} -->
<p class="solevo-note"><?php echo $m['note']; // phpcs:ignore ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --><?php endforeach; ?></section>
<!-- /wp:group -->
