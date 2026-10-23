<?php
/** /physio/seniors-physiotherapy */
defined( 'ABSPATH' ) || exit;

return array(
	'lead'      => 'Physiotherapy for seniors in Brookvale and Terrey Hills: balance and falls prevention, arthritis, joint replacement rehab and strength, so you can stay active and independent.',
	'trust'     => array( 'One-on-one appointments', 'No GP referral needed', 'Family welcome to attend' ),
	'who_title' => 'Stay strong, steady and independent',
	'who'       => array(
		'Getting older does not have to mean giving up the things you enjoy. Strength, balance and joint health can all improve with the right exercise at any age.',
		'We take time to understand your health, goals and daily life, then build a practical program that keeps you moving, whether that is walking with friends, gardening, travelling or playing with grandchildren.',
	),
	'who_list'  => array(
		'You feel less steady, or have had a fall',
		'Arthritis is making walking or stairs harder',
		'You are recovering from a hip or knee replacement',
		'You have osteoporosis and want to exercise safely',
		'You want to stay strong and keep doing what you enjoy',
	),
	'help'      => array(
		array( 'icon' => 'strength', 'title' => 'Balance and falls', 'hint' => 'Testing and training', 'body' => 'Balance testing and exercise that reduces the risk of falls.', 'links' => array( solevo_c_link( 'conditions/balance-falls-prevention' ) ) ),
		array( 'icon' => 'knee', 'title' => 'Arthritis and joint pain', 'hint' => 'Knees, hips, hands, back', 'body' => 'Exercise and strength work is the first-line treatment for knee and hip osteoarthritis.' ),
		array( 'icon' => 'surgery', 'title' => 'Joint replacement rehab', 'hint' => 'Hip and knee', 'body' => 'Rehab before and after hip and knee replacement, following your surgeon\'s protocol.' ),
		array( 'icon' => 'back', 'title' => 'Back pain and stenosis', 'hint' => 'Walking further, standing longer', 'body' => 'Help with back and leg pain that limits walking.', 'links' => array( solevo_c_link( 'conditions/spinal-stenosis' ) ) ),
		array( 'icon' => 'tendon', 'title' => 'Bone health', 'hint' => 'Osteoporosis and osteopenia', 'body' => 'Safe, progressive strength exercise for bone health.', 'links' => array( solevo_c_link( 'conditions/osteoporosis-pilates' ) ) ),
	),
	'steps'     => array(
		array( 'Thorough assessment', 'We review your health and medications, then test strength, balance, walking and the movements you find hard.' ),
		array( 'Treatment and exercise', 'Hands-on treatment where it helps and an exercise program matched to your goals and energy.' ),
		array( 'Keep progressing', 'Continue one-on-one, at home or in small physio-designed Seniors Pilates classes.' ),
	),
	'first'     => array(
		array( 'What happens', 'A relaxed conversation about your health and goals, then strength, balance and movement tests.' ),
		array( 'How long', 'Your first appointment is longer than a follow-up. You will see the exact length when you book.' ),
		array( 'What to bring', 'A list of your medications, any scans or letters, and comfortable shoes.' ),
		array( 'Bring someone', 'Family members and carers are welcome to come with you.' ),
	),
	'practitioner' => array(
		'image'   => 'emma-docker',
		'eyebrow' => 'Your physiotherapist',
		'name'    => 'Emma Docker',
		'role'    => 'Physiotherapist · Bachelor of Sport &amp; Exercise Science · Master of Physiotherapy',
		'bio'     => 'Emma works with people of all ages and fitness levels, combining hands-on treatment, targeted exercise and clear education, and believes in meeting people where they are.',
		'points'  => array( 'AHPRA-registered physiotherapist', 'Clinical Pilates trained' ),
		'link'    => array( 'Meet the team', home_url( '/about' ) ),
	),
	'faq'       => array(
		array( 'Am I too old to start exercising?', 'No. Strength and balance improve with exercise at any age. Programs start where you are.' ),
		array( 'Can physio help my arthritis?', 'Yes. Exercise and strength work are recommended first treatments for knee and hip osteoarthritis and can ease pain and improve function.' ),
		array( 'Can I use Medicare?', 'If your GP has given you a Chronic Disease Management plan, please call before booking so we can check the paperwork and gap.' ),
		array( 'Is there parking?', 'Please see the Contact page for parking and access details.' ),
	),
	'related'   => array( 'conditions/balance-falls-prevention', 'pilates/seniors', 'conditions/osteoporosis-pilates', 'conditions/spinal-stenosis' ),
	'todo'      => array( 'Confirm whether Solevo accepts Medicare Chronic Disease Management referrals, and add parking and access details to Contact.' ),
);
