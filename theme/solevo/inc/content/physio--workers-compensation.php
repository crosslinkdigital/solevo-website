<?php
/** /physio/workers-compensation  (Steph's WorkCover copy, 3 Nov 2026) */
defined( 'ABSPATH' ) || exit;

return array(
	'eyebrow'   => 'Physiotherapy for work injuries',
	'lead'      => 'Injured at work? We provide assessment, treatment and progressive rehabilitation for workplace injuries, helping you recover strength, restore movement and return to work safely.',
	'image'     => 'clinic-reformer-room',
	'trust'     => array( 'Workers compensation clients', 'Brookvale and Terrey Hills', 'One-on-one appointments' ),
	'who_title' => 'Rehab built around your job',
	'who'       => array(
		'Whether you\'ve sustained a sudden injury or developed pain over time, we tailor your rehabilitation to your injury, job demands and recovery goals.',
		'We see workers compensation clients at our Brookvale and Terrey Hills clinics.',
	),
	'who_list'  => array(
		'You\'ve been injured at work and have a workers compensation claim',
		'Your injury happened suddenly, or pain has built up over time',
		'You need rehab matched to the physical demands of your job',
		'You want a clear, safe plan back to work',
	),
	'help_title' => 'What work injuries do we treat?',
	'help_intro' => 'Tap a topic to see what we commonly treat.',
	'help'      => array(
		array( 'icon' => 'back', 'title' => 'Back and neck injuries', 'hint' => 'Lifting injuries, disc problems, sciatica, neck pain', 'body' => 'Assessment and rehabilitation for back and neck injuries affecting lifting, bending, sitting and everyday work activities. We focus on restoring movement, strength and tolerance for your work duties.', 'links' => array( solevo_c_link( 'conditions/lower-back-pain' ), solevo_c_link( 'conditions/sciatica' ) ) ),
		array( 'icon' => 'shoulder', 'title' => 'Shoulder and arm injuries', 'hint' => 'Rotator cuff injuries, shoulder strains, elbow and wrist pain', 'body' => 'Treatment and progressive strengthening for injuries affecting reaching, lifting, carrying and repetitive upper-limb tasks.' ),
		array( 'icon' => 'knee', 'title' => 'Muscle and joint injuries', 'hint' => 'Sprains, strains, ligament and joint injuries', 'body' => 'Rehabilitation for workplace injuries involving muscles, joints and ligaments, helping restore strength, mobility and physical capacity.' ),
		array( 'icon' => 'tendon', 'title' => 'Repetitive strain and overuse injuries', 'hint' => 'Tendon pain, repetitive lifting, repetitive movements', 'body' => 'Assessment and rehabilitation for pain that develops through repeated movements or sustained work demands, with targeted exercise and strategies to manage your workload.' ),
		array( 'icon' => 'sport', 'title' => 'Lower limb injuries', 'hint' => 'Knee, ankle, hip and foot injuries', 'body' => 'Treatment and rehabilitation for injuries affecting standing, walking, climbing stairs and other physically demanding work activities.' ),
	),
	'journey_title' => 'How your rehabilitation works',
	'steps'     => array(
		array( 'Assessment and diagnosis', 'We discuss your injury, symptoms, work duties and recovery goals, followed by a thorough assessment of your movement, strength and physical function.' ),
		array( 'Treatment and early rehabilitation', 'Hands-on treatment where appropriate, combined with a tailored rehabilitation plan to manage pain, restore movement and help you maintain as much activity as possible during recovery.' ),
		array( 'Strengthening and return to work', 'Progressive strength and functional rehabilitation tailored to your job demands, helping rebuild your physical capacity and prepare you for a safe return to work.' ),
	),
	'first'     => array(
		array( 'What happens', 'We\'ll discuss your injury, medical history, work duties and recovery goals, followed by a thorough assessment of your movement, strength and physical function.' ),
		array( 'How long', 'Your first appointment is 60 minutes at Brookvale and 45 minutes at Terrey Hills. Follow-up appointments are 30 minutes.' ),
		array( 'What to bring', 'Your workers compensation claim details, claim number, insurer information, certificate of capacity, relevant medical reports and any imaging results.' ),
	),
	'why_title' => 'Individualised rehabilitation, focused on getting you back to work',
	'why'       => array(
		array( 'Individualised treatment', 'Rehabilitation tailored to your injury, work duties and recovery goals.' ),
		array( 'Progressive strengthening', 'Build the strength and physical capacity needed for your everyday work tasks. Our Brookvale clinic has a dedicated rehabilitation space with strength training equipment.' ),
		array( 'Communication and coordination', 'Where appropriate we communicate with your treating doctor, insurer and other members of your rehabilitation team.' ),
	),
	'faq_title' => 'WorkCover physio FAQs',
	'faq'       => array(
		array( 'What do I need to bring to my first appointment?', 'Your claim number, insurer details, certificate of capacity, and any relevant medical reports or imaging.' ),
		array( 'Do you talk to my doctor and insurer?', 'Where appropriate, yes. We communicate with your treating doctor, insurer and other members of your rehabilitation team.' ),
	),
	'related'   => array( 'physio', 'conditions/lower-back-pain', 'physio/pre-and-post-surgery-rehab' ),
);
