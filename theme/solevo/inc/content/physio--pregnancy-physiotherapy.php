<?php
/** /physio/pregnancy-physiotherapy */
defined( 'ABSPATH' ) || exit;

return array(
	'eyebrow'   => 'Solevo Physio · Women\'s health',
	'lead'      => 'Private, one-on-one physiotherapy for back, pelvic and rib pain in pregnancy, plus safe exercise so you can stay active and comfortable through every trimester.',
	'trust'     => array( 'Private one-on-one appointments', 'No referral required', 'Safe for every trimester' ),
	'who_title' => 'Physio through your pregnancy',
	'who'       => array(
		'Your body changes quickly in pregnancy. Posture shifts, ligaments soften and the load on your back and pelvis increases. Pain is common, but it is not something you have to simply put up with.',
		'We help you understand what is going on, ease pain with hands-on care and practical advice, and keep you moving with exercise that is safe for your stage of pregnancy.',
	),
	'who_list'  => array(
		'Lower back or pelvic pain, including pain at the pubic bone',
		'Rib, mid-back or neck pain later in pregnancy',
		'Pain turning in bed, on stairs or getting dressed',
		'Wanting to keep exercising safely while pregnant',
		'Wanting to prepare your pelvic floor for birth and recovery',
	),
	'help'      => array(
		array( 'icon' => 'back', 'title' => 'Back pain', 'hint' => 'Lower back, mid-back, ribs', 'body' => 'Pain that builds through the day or with standing and lifting, eased with treatment, positions and exercise.', 'links' => array( solevo_c_link( 'conditions/pregnancy-back-pain' ) ), 'cta' => array( 'Book Physio', '#cliniko' ) ),
		array( 'icon' => 'womens', 'title' => 'Pelvic girdle pain', 'hint' => 'Back of pelvis, pubic bone', 'body' => 'Pain at the back or front of the pelvis, with advice on movement, support and sleep.' ),
		array( 'icon' => 'strength', 'title' => 'Exercise in pregnancy', 'hint' => 'Safe strength and Pilates', 'body' => 'A plan for exercise that suits your stage, fitness and goals, including pregnancy Pilates.', 'links' => array( solevo_c_link( 'pilates/pregnancy-pilates' ), solevo_c_link( 'pilates/mums-and-bubs' ) ) ),
	),
	'steps'     => array(
		array( 'Private assessment', 'We talk through your pregnancy, symptoms and activity, then assess your back, pelvis and how you move.' ),
		array( 'Treatment and advice', 'Hands-on treatment, positions for sleeping and sitting, and support options such as belts where useful.' ),
		array( 'Stay strong', 'Safe exercise for your hips, trunk and pelvic floor, progressed as your pregnancy changes.' ),
	),
	'first'     => array(
		array( 'What happens', 'A private conversation about your pregnancy and symptoms, then a gentle assessment and treatment.' ),
		array( 'How long', 'Your first appointment is longer than a follow-up. You will see the exact length when you book.' ),
		array( 'What to bring', 'Comfortable clothes and any notes from your obstetrician or midwife.' ),
		array( 'After that', 'A plan for treatment and exercise through the rest of your pregnancy and after birth.' ),
	),
	'faq'       => array(
		array( 'Is physio safe in pregnancy?', 'Yes. Treatment and exercise are adjusted for your stage of pregnancy. Tell us how many weeks you are when you book.' ),
		array( 'When should I come in?', 'Any time pain starts, or whenever you would like advice about exercise. Earlier is often easier.' ),
		array( 'Do I need my obstetrician\'s permission?', 'Not for physio. If your pregnancy is complicated, let your care team know and share any advice with us.' ),
	),
	'related'   => array( 'conditions/pregnancy-back-pain', 'pilates/pregnancy-pilates', 'physio/postnatal-physiotherapy', 'physio/pelvic-floor-physiotherapy' ),
	'todo'      => array( 'Confirm which clinician sees pregnancy patients. Add a practitioner section and the reviewed-by line once confirmed.' ),
);
