<?php
/** /physio/pelvic-floor-physiotherapy */
defined( 'ABSPATH' ) || exit;

return array(
	'eyebrow'   => 'Solevo Physio · Women\'s health',
	'lead'      => 'Private, one-on-one pelvic floor physiotherapy for leakage, heaviness, pregnancy and postnatal recovery. A calm, confidential space to talk about symptoms many women live with for years.',
	'trust'     => array( 'Private one-on-one appointments', 'No GP referral needed', 'Internal assessment always optional' ),
	'who_title' => 'What pelvic floor physiotherapy is',
	'who'       => array(
		'Your pelvic floor is a group of muscles that supports your bladder, bowel and uterus and helps control leakage. Pregnancy, birth, menopause, heavy lifting and high-impact sport can all affect how well it works.',
		'Pelvic floor physiotherapy assesses these muscles and builds a program to strengthen, relax or coordinate them, depending on what you need. Pelvic floor training is recommended as a first treatment for stress urinary incontinence.',
	),
	'who_list'  => array(
		'You leak with coughing, sneezing, running or lifting',
		'You get sudden urges or need the toilet often',
		'You feel heaviness or a bulge in the vagina',
		'You are pregnant or have had a baby',
		'You are going through menopause and noticing changes',
	),
	'help'      => array(
		array( 'icon' => 'womens', 'title' => 'Bladder leakage', 'hint' => 'Stress and urge incontinence', 'body' => 'Leakage with effort or urgency, treated with pelvic floor training and bladder habits.', 'links' => array( solevo_c_link( 'conditions/bladder-leakage-incontinence' ) ) ),
		array( 'icon' => 'surgery', 'title' => 'Prolapse symptoms', 'hint' => 'Heaviness, dragging, bulge', 'body' => 'Pelvic floor training and advice on lifting and exercise to help manage prolapse symptoms.' ),
		array( 'icon' => 'strength', 'title' => 'Pregnancy and postnatal', 'hint' => 'Prepare and recover', 'body' => 'Preparing the pelvic floor before birth and rebuilding it after.', 'links' => array( solevo_c_link( 'physio/pregnancy-physiotherapy' ), solevo_c_link( 'physio/postnatal-physiotherapy' ) ) ),
		array( 'icon' => 'sport', 'title' => 'Exercise and sport', 'hint' => 'Running, lifting, CrossFit', 'body' => 'Leakage during sport is common and treatable. We help you keep training with confidence.' ),
	),
	'steps'     => array(
		array( 'Private conversation', 'We talk through your symptoms, bladder and bowel habits and goals. There is no rush and nothing is embarrassing to us.' ),
		array( 'Assessment', 'An assessment of your pelvic floor muscles. An internal examination gives the most accurate picture, but it is always your choice.' ),
		array( 'Your program', 'A pelvic floor program, bladder advice and a plan back to the activities you want to do, reviewed as you progress.' ),
	),
	'first'     => array(
		array( 'Privacy', 'Appointments are one-on-one in a private room.' ),
		array( 'How long', 'Your first appointment is longer than a follow-up. You will see the exact length when you book.' ),
		array( 'What to bring', 'A list of any medications and, if you like, a few days of bladder diary notes.' ),
		array( 'Your choice', 'You decide what assessment you are comfortable with. You can stop or change your mind at any time.' ),
	),
	'faq'       => array(
		array( 'Do I need an internal examination?', 'No. It is optional and only done with your consent. We can assess and treat in other ways.' ),
		array( 'Will Kegels fix it?', 'Pelvic floor exercises work best when they are taught and checked, because many people do them incorrectly. Some people need to learn to relax the pelvic floor rather than strengthen it.' ),
		array( 'Can I come during my period?', 'Yes. Let us know and we can adjust the assessment if needed.' ),
		array( 'Do I need a referral?', 'No. You can book a private appointment directly.' ),
		array( 'Can I claim on private health insurance?', 'Physiotherapy is covered by most private health extras policies. Your rebate depends on your fund and cover.' ),
	),
	'related'   => array( 'conditions/bladder-leakage-incontinence', 'physio/postnatal-physiotherapy', 'physio/pregnancy-physiotherapy', 'pilates/postnatal-pilates' ),
	'todo'      => array( 'Confirm which clinician provides pelvic floor physiotherapy and whether internal examinations are offered. Do not publish until confirmed.' ),
);
