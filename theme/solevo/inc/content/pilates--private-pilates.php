<?php
/** /pilates/private-pilates */
defined( 'ABSPATH' ) || exit;

return array(
	'eyebrow'    => 'Solevo Studio · Private',
	'lead'       => 'Private and duo reformer Pilates sessions in Brookvale, built around your body and goals. Single sessions or 5 and 10 packs.',
	'trust'      => array( 'One-on-one or duo', 'Packs available', 'Built around your goals' ),
	'image'      => 'studio-stretch',
	'what_title' => 'Pilates, entirely around you',
	'what'       => array(
		'A private session gives you an instructor\'s full attention: exercises chosen for your body, technique refined in detail and progressions at your pace.',
		'Duo sessions are a great way to train with a partner, friend or family member while still getting a tailored session.',
	),
	'who'        => array(
		'New to Pilates and wanting a confident start',
		'Specific goals such as posture, strength or mobility',
		'Preferring a private setting to a group',
		'Training with a partner or friend',
	),
	'formats'    => array(
		array( 'meta' => 'One-on-one', 'name' => 'Private session', 'text' => 'A session built entirely around you with one instructor.', 'best' => 'Personalised progress and technique.' ),
		array( 'meta' => 'Two people', 'name' => 'Duo session', 'text' => 'Train with a partner or friend, with one instructor guiding you both.', 'best' => 'Training together.' ),
	),
	'prices'     => solevo_prices( array( 'private' ) ),
	'prices_title' => 'Private and duo prices',
	'prices_intro' => 'If you have an injury or condition, Clinical Pilates with a physiotherapist may suit you better.',
	'faq'        => array(
		array( 'Private Pilates or Clinical Pilates?', 'Private Pilates is with an instructor and suits general strength and technique goals. Clinical Pilates is with a physiotherapist and designed around an injury or condition.' ),
		array( 'Do private sessions use the reformer?', 'Sessions are mainly on the reformer, with other equipment as needed.' ),
		array( 'Can I move into group classes later?', 'Yes. Many people start privately, then join Studio classes.' ),
		array( 'How do I book a duo session?', 'Book through Mindbody, or contact us to arrange a time for you both.' ),
	),
	'related'    => array( 'pilates/clinical-pilates', 'pilates', 'pilates/mat-pilates' ),
	'related_title' => 'More from Solevo Studio',
);
