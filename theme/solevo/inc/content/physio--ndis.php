<?php
/** /physio/ndis  (draft by CrossLink, 3 Nov 2026; Emma reviews the clinical content before it goes live) */
defined( 'ABSPATH' ) || exit;

return array(
	'eyebrow'   => 'NDIS physiotherapy',
	'lead'      => 'Physiotherapy for NDIS participants in Brookvale and Terrey Hills, with strength, mobility and balance programs built around the goals in your plan.',
	'image'     => 'studio-stretch',
	'trust'     => array( 'Self-managed and plan-managed NDIS', 'Brookvale and Terrey Hills', 'One-on-one appointments' ),
	'who_eyebrow' => 'NDIS funding',
	'who_title' => 'Who we can see under the NDIS',
	'who'       => array(
		'Solevo is not a registered NDIS provider. We can see NDIS participants whose plans are self-managed or plan-managed. We can\'t see participants whose plans are NDIA-managed (agency-managed).',
		'Not sure how your plan is managed? It\'s shown in your NDIS plan and in the my NDIS portal, or your support coordinator can tell you.',
	),
	'who_list_title' => 'We can see you if your NDIS plan is',
	'who_list'  => array(
		'Self-managed: you pay us and claim the cost back from the NDIS',
		'Plan-managed: we invoice your plan manager',
		'Not NDIA-managed: agency-managed plans need a registered provider',
	),
	'help_title' => 'How NDIS physiotherapy can help',
	'help_intro' => 'Physiotherapy funded under Capacity Building supports, focused on the goals in your plan.',
	'help'      => array(
		array( 'icon' => 'strength', 'title' => 'Strength and mobility', 'hint' => 'Everyday tasks, getting around', 'body' => 'Exercise programs to build the strength and mobility you need for daily life, from getting up from a chair to climbing stairs.' ),
		array( 'icon' => 'sport', 'title' => 'Balance and falls prevention', 'hint' => 'Steadiness, confidence, falls risk', 'body' => 'Balance assessment and targeted exercise to improve stability and confidence, at home and out in the community.', 'links' => array( solevo_c_link( 'conditions/balance-falls-prevention' ) ) ),
		array( 'icon' => 'back', 'title' => 'Pain and joint conditions', 'hint' => 'Back pain, arthritis, joint pain', 'body' => 'Hands-on treatment where it helps, and exercise to manage pain and keep you moving.' ),
		array( 'icon' => 'knee', 'title' => 'Independence and participation', 'hint' => 'Work, study, community, sport', 'body' => 'Rehabilitation linked to the goals in your plan, such as returning to work, joining community activities or getting back into sport.' ),
	),
	'journey_title' => 'How NDIS physiotherapy works',
	'steps'     => array(
		array( 'Assessment and goals', 'We discuss your health, your NDIS goals and what you want to be able to do, then assess your strength, movement and balance.' ),
		array( 'Your program', 'Hands-on treatment where appropriate and an exercise program in the clinic and at home, tailored to your goals and ability.' ),
		array( 'Progress and review', 'We measure your progress over time and adjust your program as you improve.' ),
	),
	'first'     => array(
		array( 'What happens', 'A discussion of your health, your NDIS goals and current challenges, followed by an assessment of your strength, movement and balance.' ),
		array( 'How long', 'Your first appointment is 60 minutes at Brookvale and 45 minutes at Terrey Hills. Follow-up appointments are 30 minutes.' ),
		array( 'What to bring', 'Your NDIS number, how your plan is managed, your plan manager\'s details if you have one, any relevant reports, and a list of your medications.' ),
	),
	'why'       => array(
		array( 'One-on-one with a physiotherapist', 'Every appointment is with a physiotherapist from start to finish.' ),
		array( 'Rehab space in Brookvale', 'Our Brookvale clinic has a dedicated rehabilitation space with strength training equipment.' ),
		array( 'Exercise that continues', 'Keep building strength and control in Clinical Pilates or small group classes.' ),
	),
	'faq_title' => 'NDIS physiotherapy FAQs',
	'faq'       => array(
		array( 'Are you a registered NDIS provider?', 'No. Solevo is not a registered NDIS provider, so we can only see participants whose plans are self-managed or plan-managed.' ),
		array( 'Can I use NDIA-managed (agency-managed) funding?', 'No. NDIA-managed participants need a registered NDIS provider.' ),
		array( 'How does payment work?', 'If your plan is self-managed, you pay at your appointment and claim the cost back from the NDIS. If your plan is plan-managed, we invoice your plan manager.' ),
		array( 'Do I need a referral?', 'No. You can book directly. Bring your NDIS plan details to your first appointment.' ),
	),
	'related'   => array( 'physio/seniors-physiotherapy', 'pilates/clinical-pilates', 'physio' ),
	'todo'      => array(
		'Emma to review all clinical content on this page before it goes live (Steph, 3 Nov).',
		'Confirm with Steph: how plan-managed invoicing and self-managed payment work at Solevo, and whether NDIS appointments run at both clinics.',
		'Confirm whether Solevo provides progress reports for NDIS plan reviews before mentioning it on the page.',
	),
);
