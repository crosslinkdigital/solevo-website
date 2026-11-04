<?php
/** /physio/ndis  (Steph's copy, Osteoporosis / NDIS / Active Seniors doc, 4 Nov 2026; reviewed by Emma) */
defined( 'ABSPATH' ) || exit;

return array(
	'eyebrow'        => 'NDIS physiotherapy',
	'lead'           => 'We provide physiotherapy for NDIS participants, helping improve strength, mobility, balance and physical function to support greater independence and participation in everyday activities.',
	'image'          => 'studio-stretch',
	'trust'          => array( 'Self-managed and plan-managed NDIS', 'Brookvale and Terrey Hills', 'One-on-one appointments' ),
	'who_eyebrow'    => 'Who it is for',
	'who_title'      => 'Physiotherapy built around your goals',
	'who'            => array(
		'Whether you\'re looking to improve your mobility, manage an ongoing condition, build strength or maintain your independence, we tailor physiotherapy to your individual needs, abilities and goals.',
		'We welcome self-managed and plan-managed NDIS participants at our Brookvale and Terrey Hills clinics.',
	),
	'who_list_title' => 'This may suit you if',
	'who_list'       => array(
		'You\'re an NDIS participant with self-managed or plan-managed funding',
		'You want to improve your strength, mobility or balance',
		'You need support managing a physical condition or injury',
		'You want to maintain your independence and everyday function',
		'You have specific physical goals you\'d like to work towards',
	),
	'help_intro'     => 'Tap a topic to see how physiotherapy may help.',
	'help'           => array(
		array( 'icon' => 'knee', 'title' => 'Mobility and movement', 'body' => 'Improving walking, movement and physical ability for everyday activities.' ),
		array( 'icon' => 'strength', 'title' => 'Strength and conditioning', 'body' => 'Building strength, endurance and physical capacity to support daily activities and independence.' ),
		array( 'icon' => 'sport', 'title' => 'Balance and falls prevention', 'body' => 'Improving balance, coordination and confidence with movement to help reduce falls risk.', 'links' => array( solevo_c_link( 'conditions/balance-falls-prevention' ) ) ),
		array( 'icon' => 'back', 'title' => 'Pain and injury management', 'body' => 'Managing musculoskeletal pain, injuries and physical limitations that affect everyday function.' ),
		array( 'icon' => 'tendon', 'title' => 'Long-term conditions', 'body' => 'Supporting people living with ongoing physical conditions to maintain or improve strength, mobility and function.' ),
	),
	'journey_title'  => 'What will physiotherapy look like?',
	'steps'          => array(
		array( 'Assessment and goal setting', 'We discuss your medical history, current abilities, daily activities and NDIS goals, followed by an assessment of your movement, strength, balance and physical function.' ),
		array( 'Treatment and rehabilitation', 'Hands-on treatment where appropriate, combined with an individualised exercise and rehabilitation program to improve movement, manage symptoms and build physical capacity.' ),
		array( 'Progress and ongoing support', 'Your rehabilitation is adjusted as you progress, with exercises and practical strategies to help you work towards your goals and maintain improvements between appointments.' ),
	),
	'first'          => array(
		array( 'What happens', 'We\'ll discuss your medical history, current needs, everyday activities and goals, followed by an assessment of your movement, strength, balance and physical function.' ),
		array( 'How long', 'Your first appointment is 60 minutes at Brookvale and 45 minutes at Terrey Hills. Follow-up appointments are 30 minutes.' ),
		array( 'What to bring', 'Your NDIS plan or relevant plan details, information about your goals and funding arrangements, a list of medications and any relevant medical reports or imaging results.' ),
	),
	'why_title'      => 'Physiotherapy focused on your goals and independence',
	'why'            => array(
		array( 'Individualised treatment', 'Physiotherapy tailored to your abilities, support needs and individual goals.' ),
		array( 'Strength and functional rehabilitation', 'Build strength, balance and physical capacity to support everyday activities and greater independence. Our Brookvale clinic has a dedicated rehabilitation space with strength training equipment.' ),
		array( 'Working towards your goals', 'We monitor your progress and adjust your rehabilitation to support your goals and changing needs. Where appropriate, we can communicate with your support coordinator, plan manager, treating doctor and other members of your support team.' ),
	),
	// Steph's optional block, included (Hayo, 4 Nov).
	'before_faq'     => solevo_c_text( '', 'NDIS funding and eligibility', array(
		'We accept self-managed and plan-managed NDIS participants only. We cannot provide NDIS-funded services to NDIA-managed participants.',
		'Physiotherapy funding must be available within your NDIS plan and relevant to your individual goals and support needs. Plan-managed participants can arrange payment through their plan manager, while self-managed participants can pay for appointments and claim reimbursement through the NDIS.',
	), array( 'anchor' => 'funding', 'bg' => 'surface' ) ),
	'faq_title'      => 'NDIS physiotherapy FAQs',
	'faq'            => array(),
	'related'        => array( 'physio/seniors-physiotherapy', 'pilates/clinical-pilates', 'physio' ),
);
