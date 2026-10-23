<?php
/** /physio/postnatal-physiotherapy */
defined( 'ABSPATH' ) || exit;

return array(
	'eyebrow'   => 'Solevo Physio · Women\'s health',
	'lead'      => 'A postnatal check and a clear, safe plan back to exercise. We assess your tummy muscles and pelvic floor, treat back and pelvic pain, and help you return to the activities you enjoy.',
	'trust'     => array( 'Private one-on-one appointments', 'No GP referral needed', 'Vaginal or caesarean birth' ),
	'who_title' => 'Recovery after birth, at your pace',
	'who'       => array(
		'Whether you had a vaginal birth or a caesarean, your body has been through a lot. A postnatal physio check looks at your abdominal muscles, pelvic floor, back and posture, and gives you a plan that fits life with a new baby.',
		'It is never too late. We see women a few weeks after birth and women whose babies are now at school.',
	),
	'who_list'  => array(
		'You want to return to running, the gym or Pilates safely',
		'You have a gap in your tummy muscles (abdominal separation)',
		'You leak when you cough, sneeze, laugh or exercise',
		'You have back, pelvic, wrist or neck pain from feeding and carrying',
		'You had a caesarean or a difficult birth',
	),
	'help'      => array(
		array( 'icon' => 'womens', 'title' => 'Pelvic floor', 'hint' => 'Leakage, heaviness, recovery', 'body' => 'A pelvic floor assessment and a program to rebuild strength and coordination.', 'links' => array( solevo_c_link( 'physio/pelvic-floor-physiotherapy' ), solevo_c_link( 'conditions/bladder-leakage-incontinence' ) ) ),
		array( 'icon' => 'strength', 'title' => 'Abdominal separation', 'hint' => 'Tummy gap, core strength', 'body' => 'We measure the gap and build a progressive program for your abdominal muscles.' ),
		array( 'icon' => 'back', 'title' => 'Back and body pain', 'hint' => 'Back, pelvis, neck, wrists', 'body' => 'Pain from feeding, lifting and carrying, eased with treatment and practical changes.' ),
		array( 'icon' => 'sport', 'title' => 'Return to exercise', 'hint' => 'Running, gym, Pilates', 'body' => 'A staged plan back to exercise, with Postnatal Pilates and Mums and Bubs as options.', 'links' => array( solevo_c_link( 'pilates/postnatal-pilates' ), solevo_c_link( 'pilates/mums-and-bubs' ) ) ),
	),
	'steps'     => array(
		array( 'Postnatal check', 'A private assessment of your abdominal muscles, pelvic floor, back and posture. Any internal examination is optional.' ),
		array( 'Treatment and rebuilding', 'Hands-on care where needed and a pelvic floor and core program you can fit around your baby.' ),
		array( 'Back to activity', 'A clear plan back to running, lifting or classes, progressed as you get stronger.' ),
	),
	'first'     => array(
		array( 'When', 'Many women come from around six weeks after birth, once cleared by their GP or obstetrician. You can come at any time after that.' ),
		array( 'How long', 'Your first appointment is longer than a follow-up. You will see the exact length when you book.' ),
		array( 'Your baby', 'Let us know when you book if you would like to bring your baby.' ),
		array( 'After that', 'A home program and, if you like, a path into Postnatal Pilates or Mums and Bubs.' ),
	),
	'faq'       => array(
		array( 'How soon after birth can I come?', 'Many women come from around six weeks after birth, after their GP or obstetrician check. If you have pain or concerns earlier, get in touch.' ),
		array( 'Can I bring my baby?', 'Let us know when you book and we will plan your appointment around it.' ),
		array( 'Is an internal examination required?', 'No. It is optional and only done with your consent. We can assess and treat in other ways.' ),
		array( 'I had my baby years ago. Is it too late?', 'Not at all. Postnatal physio helps at any stage after birth.' ),
	),
	'related'   => array( 'physio/pelvic-floor-physiotherapy', 'pilates/postnatal-pilates', 'pilates/mums-and-bubs', 'conditions/bladder-leakage-incontinence' ),
	'todo'      => array( 'Confirm: which clinician provides postnatal checks, whether babies can come to appointments, and whether internal examinations are offered.' ),
);
