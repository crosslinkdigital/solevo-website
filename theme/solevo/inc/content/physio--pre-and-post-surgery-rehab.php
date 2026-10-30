<?php
/** /physio/pre-and-post-surgery-rehab (new 26 Oct 2026, in the old pelvic floor slot). Draft until Hayo approves. */
defined( 'ABSPATH' ) || exit;

return array(
	'lead'      => 'Physiotherapy before and after surgery, with Emma in Brookvale and Terrey Hills. Building strength before an operation helps your recovery start well. Afterwards, we follow your surgeon\'s plan from the first steps back to full strength.',
	'trust'     => array( 'One-on-one appointments', 'No referral required', 'Follows your surgeon\'s protocol' ),
	'who_title' => 'Rehab that starts before your operation',
	'who'       => array(
		'Many people only see a physio after surgery. Starting beforehand means you go into your operation stronger, you know your first exercises already, and the early weeks feel less daunting.',
		'After surgery, rehab is built in clear stages. Your physio works to your surgeon\'s protocol, checks your progress at each step and moves you on when you are ready, not on a fixed timetable.',
	),
	'who_list'  => array(
		'You have surgery booked and want to prepare',
		'You have had surgery and are ready to start rehab',
		'Your surgeon has given you a rehab protocol to follow',
		'Your recovery has stalled and you want a clear plan',
		'You want to return to sport, work or the things you enjoy',
	),
	'help_title' => 'Surgery we commonly see',
	'help_intro' => 'Tap a topic to see how rehab works before and after.',
	'help'      => array(
		array( 'icon' => 'knee', 'title' => 'ACL reconstruction', 'hint' => 'Knee ligament surgery', 'body' => 'Strength and range of motion before surgery, then a staged plan after it, from walking well to running, jumping and returning to sport.' ),
		array( 'icon' => 'surgery', 'title' => 'Knee and hip replacement', 'hint' => 'Joint replacement', 'body' => 'Getting stronger and moving well before your operation, then building walking, stairs and everyday strength afterwards.' ),
		array( 'icon' => 'shoulder', 'title' => 'Shoulder surgery', 'hint' => 'Rotator cuff and stabilisation', 'body' => 'Careful early movement within your surgeon\'s limits, then rebuilding range and strength for reaching, lifting and sport.' ),
		array( 'icon' => 'tendon', 'title' => 'Ankle and foot surgery', 'hint' => 'Fractures, tendons and ligaments', 'body' => 'Restoring movement, balance and strength after ankle or foot surgery, with input from The Foot Company podiatry where it helps.' ),
		array( 'icon' => 'back', 'title' => 'Spinal surgery', 'hint' => 'Once your surgeon clears you', 'body' => 'A gradual return to movement and strength after spinal surgery, once your surgeon has cleared you to start rehab.' ),
	),
	'journey_title' => 'Your surgery rehab journey',
	'steps'     => array(
		array( 'Before surgery', 'An assessment, then strength and movement work so you go into your operation as strong as possible and know your first exercises.' ),
		array( 'Early recovery', 'Settling pain and swelling, getting moving safely and protecting the repair, following your surgeon\'s protocol.' ),
		array( 'Back to full strength', 'Progressive strength work in our rehab gym, with clear checkpoints before you return to sport, work or running.' ),
	),
	'first'     => array(
		array( 'What happens', 'We talk through your surgery, your goals and any protocol from your surgeon, then assess how you are moving.' ),
		array( 'How long', 'Your first appointment is longer than a follow-up. You will see the exact length when you book.' ),
		array( 'What to bring', 'Your surgeon\'s rehab protocol or discharge letter, any scan reports, and comfortable clothes.' ),
		array( 'When to book', 'Before surgery, a few weeks ahead if you can. After surgery, as soon as your surgeon says rehab can start.' ),
	),
	'practitioner' => array(
		'image'   => 'emma-docker',
		'eyebrow' => 'Your physiotherapist',
		'name'    => 'Emma Docker',
		'role'    => 'Physiotherapist · Bachelor of Sport &amp; Exercise Science · Master of Physiotherapy',
		'bio'     => 'Emma has a particular interest in rehab after surgery, as well as sports and running injuries. She combines hands-on treatment, targeted exercise and clear education, and works with people of all ages and fitness levels.',
		'points'  => array( 'AHPRA-registered physiotherapist', 'Works alongside The Foot Company podiatry' ),
		'link'    => array( 'Meet the team', home_url( '/about' ) ),
	),
	'fees'      => array(),
	'faq'       => array(
		array( 'When should I start before surgery?', 'A few weeks before your operation is ideal, but even one or two appointments help you prepare.' ),
		array( 'When can I start after surgery?', 'When your surgeon says rehab can begin. This is often within the first week or two, but it depends on your operation.' ),
		array( 'Will you follow my surgeon\'s protocol?', 'Yes. Your rehab follows your surgeon\'s protocol, and we can keep your surgeon updated on your progress if you would like.' ),
		array( 'How long does rehab take?', 'It depends on the surgery and your goals. Some people need a few weeks, others several months, for example after an ACL reconstruction. Your physio will give you a clear idea at your first appointment.' ),
	),
	'related'   => array( 'physio/sports-physiotherapy', 'conditions/sports-injuries-rehab', 'physio/seniors-physiotherapy' ),
);
