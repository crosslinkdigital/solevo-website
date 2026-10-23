<?php
/** /pilates/clinical-pilates  (Studio template reference page; booked through Cliniko) */
defined( 'ABSPATH' ) || exit;

return array(
	'eyebrow'    => 'Solevo Studio · Physio-led',
	'lead'       => 'Clinical Pilates is physio-led exercise on the reformer, tailored to your body, injury or condition. It starts with a one-on-one assessment, then continues one-on-one or in small groups of up to six, bridging the gap between treatment and training.',
	'trust'      => array( 'Run by a physiotherapist', 'One-on-one assessment first', 'Groups of up to 6' ),
	'image'      => 'studio-stretch',
	'what_title' => 'What is Clinical Pilates?',
	'what'       => array(
		'Clinical Pilates uses Pilates equipment, mainly the reformer, to deliver rehab and strength exercise designed by a physiotherapist. Every program is built from an assessment of your body, history and goals, and is progressed as you get stronger.',
		'It is different from a general Studio class. A Studio class is instructor-led and designed for general strength and fitness. Clinical Pilates is designed around an injury, pain or condition, and run by a physiotherapist who knows your history.',
	),
	'who'        => array(
		'Back or neck pain, or a history of disc problems',
		'Rehab after an injury or surgery',
		'Pregnancy and postnatal recovery',
		'Hypermobility, osteoporosis or joint pain',
		'Moving from physio treatment back into regular exercise',
		'Wanting supervised exercise before joining Studio classes',
	),
	'benefits'   => array(
		array( 'Tailored to you', 'Exercises are chosen and adjusted for your injury, condition and goals.' ),
		array( 'Supervised by a physio', 'Technique, load and progressions are checked by someone who understands your body.' ),
		array( 'Strength that lasts', 'Builds trunk, hip and leg strength and control for everyday life and sport.' ),
		array( 'A path into classes', 'When you are ready, move into Studio classes with confidence.' ),
	),
	'formats'    => array(
		array( 'meta' => '60 minutes', 'name' => 'Initial assessment', 'text' => 'A one-on-one session with a physiotherapist to assess your history, posture, movement and strength, and set up your first program on the reformer.', 'best' => 'Everyone starting Clinical Pilates.' ),
		array( 'meta' => '45 minutes', 'name' => 'One-on-one sessions', 'text' => 'Individual sessions focused on your program, ideal early in rehab, after surgery or when you need close supervision.', 'best' => 'Early rehab and complex needs.' ),
		array( 'meta' => 'Up to 6 people', 'name' => 'Clinical reformer small group', 'text' => 'Physio-led small groups where everyone works on their own program, with hands-on guidance from the physiotherapist.', 'best' => 'Ongoing rehab and strength.' ),
	),
	'formats_eyebrow' => 'Session formats',
	'formats_title'   => 'How Clinical Pilates is delivered',
	'steps'      => array(
		array( 'Assessment', 'A 60-minute one-on-one assessment with a physiotherapist and your first program on the reformer.' ),
		array( 'One-on-one or small group', 'Continue with individual sessions or join a small physio-led group, depending on your needs.' ),
		array( 'Progress', 'Your program is reviewed and progressed as you get stronger, with a path into Studio classes if you want it.' ),
	),
	'first'      => array(
		array( 'What to wear', 'Comfortable activewear. Grip socks are recommended on the reformer.' ),
		array( 'Bring', 'Any scans, surgeon\'s notes or advice from your doctor.' ),
		array( 'No experience needed', 'You do not need to have done Pilates before.' ),
		array( 'Booking', 'Clinical Pilates is booked through Cliniko, with your physiotherapist.' ),
	),
	'first_title' => 'Before your first session',
	'pathway'    => true,
	'oversight'  => array(
		'image'   => 'emma-docker',
		'eyebrow' => 'Clinical oversight',
		'name'    => 'Emma Docker',
		'role'    => 'Physiotherapist · Bachelor of Sport &amp; Exercise Science · Master of Physiotherapy',
		'bio'     => 'Clinical Pilates at Solevo is run by a physiotherapist. Emma is Clinical Pilates trained and uses it to bridge hands-on treatment and long-term strength, especially after injury and surgery.',
		'points'  => array( 'AHPRA-registered physiotherapist', 'Clinical Pilates trained' ),
		'link'    => array( 'Meet the team', home_url( '/about' ) ),
	),
	'prices'     => solevo_prices( array( 'clinical' ) ),
	'prices_title' => 'Clinical Pilates prices',
	'prices_intro' => 'Clinical Pilates is a physiotherapy service and may be claimable on private health extras. Your rebate depends on your fund and cover.',
	'health'     => true,
	'faq'        => array(
		array( 'How is Clinical Pilates different from a reformer class?', 'Clinical Pilates is designed and run by a physiotherapist around your injury or condition, starting with an assessment. Reformer classes are instructor-led group classes for general strength and fitness.' ),
		array( 'Do I need to see a physio first?', 'The initial Clinical Pilates assessment is with a physiotherapist, so you can start there. If you are in significant pain, a standard physio appointment may be the best first step.' ),
		array( 'Can I claim it on private health?', 'Clinical Pilates delivered by a physiotherapist may be claimable under your physiotherapy extras. Check with your fund about your cover.' ),
		array( 'I have never done Pilates. Is that OK?', 'Yes. Everything is taught from the start and adjusted to you.' ),
		array( 'How often should I come?', 'Many people come once or twice a week. Your physiotherapist will recommend a plan based on your goals.' ),
	),
	'related'    => array( 'physio', 'conditions/lower-back-pain', 'pilates/private-pilates', 'pilates' ),
	'instagram'  => false,
	'todo'       => array( 'Confirm who runs Clinical Pilates sessions and whether they are claimable on private health (check with Solevo\'s provider number setup).' ),
);
