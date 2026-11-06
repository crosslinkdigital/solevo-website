<?php
/**
 * /physio/adolescent-sports-physiotherapy  (Steph's copy, Areas we treat doc, 4 Nov 2026; reviewed by Emma)
 * A service in the menu (Hayo, 4 Nov), built in the condition layout the copy is written for.
 */
defined( 'ABSPATH' ) || exit;

return array(
	'eyebrow'        => 'Solevo Physio',
	'lead'           => 'Adolescence is a time of rapid growth and physical development, which can place additional demands on muscles, tendons and developing bones. We treat a range of conditions affecting active children and teenagers. Our aim is to manage pain, support healthy development and help young athletes stay active and return to sport safely.',
	'what_title'     => 'Adolescent injuries we treat',
	'what'           => array(
		'During growth spurts, bones can grow faster than surrounding muscles and tendons adapt, sometimes contributing to tightness, pain and increased sensitivity around growth plates. Combined with the demands of training and sport, this can make adolescents more susceptible to certain injuries.',
		'Whether your child is experiencing knee or heel pain during sport, struggling with recurring injuries or recovering from a sporting injury, we tailor treatment and rehabilitation to their stage of development, activity levels and sporting goals.',
	),
	'symptoms_title' => 'Common adolescent injuries',
	'symptoms'       => array(
		'Osgood-Schlatter disease (traction apophysitis of the knee)',
		'Sever\'s disease (traction apophysitis of the heel)',
		'Sinding-Larsen-Johansson syndrome (traction apophysitis of the kneecap)',
		'Hip and pelvic apophysitis',
		'Growth-related heel, knee and hip pain',
		'Muscle strains, including hamstring, calf and groin injuries',
		'Ankle sprains and ligament injuries',
		'Knee ligament and meniscus injuries',
		'Patellofemoral pain (kneecap-related pain)',
		'Bone stress injuries',
	),
	'causes_title'   => 'What contributes to adolescent injuries?',
	'causes'         => array(
		array( 'Growth and development', 'During growth spurts, bones can grow faster than muscles and tendons adapt. This can increase tension around growth plates and attachment sites, contributing to conditions such as Osgood-Schlatter and Sever\'s disease.' ),
		array( 'Changes in training load', 'Sudden increases in training frequency, intensity or sporting commitments can place greater demands on a developing body, particularly when recovery is limited.' ),
		array( 'Strength and muscle flexibility', 'Changes in muscle length, strength and flexibility during growth can affect how the body manages sporting movements and physical demands.' ),
		array( 'Repetitive loading', 'Sports involving repeated running, jumping, kicking and changes of direction can place significant demands on developing bones, joints and tendons.' ),
	),
	'help_title'     => 'How we assess and treat adolescent injuries',
	'steps'          => array(
		array( 'Assessment', 'We discuss your child\'s symptoms, sporting activities, training schedule and goals, then assess their movement, strength and function to understand what may be contributing to their pain.' ),
		array( 'Manage symptoms', 'Treatment focuses on managing pain, modifying activity where needed and maintaining appropriate movement and strength while symptoms settle. We\'ll provide guidance around training adjustments and when it is appropriate to continue or temporarily modify activity.' ),
		array( 'Build strength and return to sport', 'Progressive strengthening, balance and sport-specific exercises help restore function and build tolerance for training and competition. Rehabilitation is tailored to your child\'s development, sporting demands and goals, with a gradual return to sport when appropriate.' ),
	),
	'services'       => array( 'physio/sports-physiotherapy', 'physio' ),
	'flags_title'    => 'When to see a GP or seek urgent care',
	'flags'          => array(
		'Inability to weight-bear or walk following an injury',
		'Significant swelling or an obvious deformity following a fall or sporting injury',
		'Severe or worsening pain, particularly pain that occurs at rest or wakes your child at night',
		'A hot, red or swollen joint accompanied by fever or feeling very unwell',
		'Persistent or worsening bone pain, particularly pain that is becoming more localised or occurs with progressively less activity',
		'Significant pain following an injury with loss of movement or function',
	),
	'flags_note'     => 'Persistent or worsening pain should be medically assessed rather than assumed to be a normal part of growing. Sudden severe pain, suspected fracture or inability to weight-bear following an injury warrants urgent medical assessment.',
	'faq_title'      => 'What to expect from adolescent sports physiotherapy',
	'faq_schema'     => true,
	'faq'            => array(
		array( 'Keep playing?', 'Not every injury requires stopping sport completely. We\'ll help determine which activities can continue, what may need modifying and when a temporary break from certain activities is appropriate.' ),
		array( 'Growth and development?', 'Some conditions, particularly traction apophysitis, are related to growth and may fluctuate during periods of rapid development. We\'ll help manage symptoms while maintaining appropriate strength and activity.' ),
		array( 'Time frame?', 'Some conditions settle over several weeks, while growth-related injuries can require ongoing management as the body develops.' ),
		array( 'At home', 'You\'ll receive practical advice and exercises to help manage symptoms, maintain strength and support recovery between appointments. We\'ll also provide guidance for parents and young athletes around training loads and return to sport.' ),
	),
	'related'        => array( 'conditions/knee-pain', 'conditions/foot-ankle', 'conditions/sports-injuries-rehab' ),
);
