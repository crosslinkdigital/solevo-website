<?php
/** /physio/sports-physiotherapy */
defined( 'ABSPATH' ) || exit;

return array(
	'lead'      => 'Sports physiotherapy for active people at every level, from weekend sport and parkrun to competition. Hands-on treatment, strength testing and a clear plan back to the sport you love, in Brookvale and Terrey Hills.',
	'image'     => 'emma-docker',
	'who_title' => 'Sports physio for every level',
	'who'       => array(
		'You do not need to be an elite athlete to benefit from sports physiotherapy. If an injury is stopping you running, training, playing or simply staying active, we treat it with the same structured approach used in high-level sport.',
		'Rehab is planned around your sport, your season and your goals, and progress is measured so you know exactly when you are ready for the next step.',
	),
	'who_list'  => array(
		'You have a new sprain, strain or ligament injury',
		'Pain is building as you increase training',
		'You are recovering from surgery such as an ACL reconstruction',
		'You keep re-injuring the same area',
		'You want a plan for a race, season or event',
	),
	'help'      => array(
		array( 'icon' => 'sport', 'title' => 'Sprains and strains', 'hint' => 'Ankle, hamstring, calf, groin', 'body' => 'Rolled ankles and muscle strains, with early care to protect the injury and a staged return to running and sport.', 'links' => array( solevo_c_link( 'conditions/sports-injuries-rehab' ) ) ),
		array( 'icon' => 'knee', 'title' => 'Knee injuries', 'hint' => 'ACL, meniscus, kneecap pain', 'body' => 'Ligament and meniscus injuries, kneecap pain and rehab before and after knee surgery.' ),
		array( 'icon' => 'tendon', 'title' => 'Tendon pain', 'hint' => 'Achilles, patellar, hip tendons', 'body' => 'Tendons respond to the right load. We build a measured strength program that lets you keep training where possible.', 'links' => array( '<a href="#tfc">Heel and foot pain: The Foot Company podiatry</a>' ) ),
		array( 'icon' => 'shoulder', 'title' => 'Shoulder injuries', 'hint' => 'Throwing, swimming, gym', 'body' => 'Rotator cuff and shoulder instability problems in overhead and gym athletes.' ),
		array( 'icon' => 'back', 'title' => 'Back pain in sport', 'hint' => 'Lifting, rowing, golf, running', 'body' => 'Back pain that limits training, with strength and technique work to get you lifting and running again.', 'links' => array( solevo_c_link( 'conditions/lower-back-pain' ) ) ),
		array( 'icon' => 'strength', 'title' => 'Return to sport', 'hint' => 'Testing and staged progressions', 'body' => 'Strength, hop and running tests guide each stage so return to sport is based on clear targets.' ),
	),
	'steps'     => array(
		array( 'Assessment and diagnosis', 'We work out what is injured, measure strength and movement against your other side and look at the demands of your sport.' ),
		array( 'Treatment and early rehab', 'Hands-on treatment where it helps, protecting healing tissue and keeping you as fit as possible while it recovers.' ),
		array( 'Strength and return to sport', 'Progressive strength, running and sport-specific drills, tested at each stage, through to full training and competition.' ),
	),
	'first'     => array(
		array( 'What happens', 'History, assessment of the injury, strength and movement testing, a diagnosis and usually treatment in the same session.' ),
		array( 'How long', 'Your first appointment is longer than a follow-up. You will see the exact length when you book.' ),
		array( 'What to bring', 'Training gear, running shoes if relevant, and any scans or surgeon\'s notes.' ),
		array( 'After that', 'A rehab plan with clear milestones and a timeline for your sport or event.' ),
	),
	'why'       => array(
		array( 'Measured progress', 'Strength and function testing so decisions are based on numbers, not guesswork.' ),
		array( 'Rehab gym on site', 'Strength equipment in Brookvale, so rehab is supervised and progressed with your physio.' ),
		array( 'Physio and podiatry together', 'Foot, ankle and running concerns can be managed with <a href="#tfc">The Foot Company podiatry</a> next door.' ),
		array( 'Pilates for the long term', 'Continue building strength and control in Clinical Pilates or Studio classes.' ),
	),
	'practitioner' => array(
		'image'   => 'emma-docker',
		'eyebrow' => 'Your physiotherapist',
		'name'    => 'Emma Docker',
		'role'    => 'Physiotherapist · Bachelor of Sport &amp; Exercise Science · Master of Physiotherapy',
		'bio'     => 'Emma grew up playing basketball and netball and has a particular interest in acute sporting injuries, such as ankle sprains and muscle strains, overuse and running injuries, and rehab after surgery including ACL reconstruction.',
		'points'  => array( 'AHPRA-registered physiotherapist', 'Clinical Pilates trained' ),
		'link'    => array( 'Meet the team', home_url( '/about' ) ),
	),
	'faq'       => array(
		array( 'Do I need to be an athlete?', 'No. Sports physiotherapy suits anyone who is active, from walkers and weekend sport to competitive athletes.' ),
		array( 'Can I keep training while injured?', 'Often yes, with changes. We help you stay as active as possible while the injury recovers.' ),
		array( 'Do you do ACL rehab?', 'Yes, from the early weeks after surgery through to return to sport, following your surgeon\'s protocol.' ),
		array( 'Do I need a referral?', 'No. You can book a private physio appointment directly.' ),
		array( 'Can I claim on private health insurance?', 'Physiotherapy is covered by most private health extras policies. Your rebate depends on your fund and cover.' ),
	),
	'related'   => array( 'conditions/sports-injuries-rehab', 'pilates/clinical-pilates', 'physio' ),
);
