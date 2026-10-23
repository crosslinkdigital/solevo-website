<?php
/** /pilates/mums-and-bubs  (campaign page, Google Ads target) */
defined( 'ABSPATH' ) || exit;

return array(
	'eyebrow'    => 'Solevo Studio · Six-week program',
	'lead'       => 'A six-week Pilates program for mums in Brookvale. Start with a one-on-one assessment, then train in a small group of six, three classes a week, with mums at the same stage as you. A$79 per week.',
	'trust'      => array( 'One-on-one assessment first', 'Groups of six', 'Three classes a week' ),
	'image'      => 'studio-stretch',
	'what_eyebrow' => 'The program',
	'what_title' => 'Rebuild strength with support',
	'what'       => array(
		'Mums and Bubs is a structured six-week block, not a drop-in class. You start with a one-on-one assessment of your core, pelvic floor and goals, so your program suits your body and stage of recovery.',
		'You then train in a small group of six, three times a week, coached by our team. A clear block with a set start and finish makes it easier to commit, and you can feel your progress week to week.',
	),
	'who_title'  => 'Who it is for',
	'who'        => array(
		'Mums wanting to rebuild core and pelvic floor strength',
		'Returning to exercise after birth, once cleared',
		'Mums who want structure and accountability',
		'Anyone wanting to train with others at a similar stage',
	),
	'benefits'   => array(
		array( 'Core and pelvic floor', 'Rebuild deep core and pelvic floor strength safely.' ),
		array( 'Posture and back', 'Strengthen for feeding, lifting and carrying.' ),
		array( 'Small group support', 'Train with five other mums at a similar stage.' ),
		array( 'Clear progress', 'A six-week block with a start and finish.' ),
	),
	'steps'      => array(
		array( 'One-on-one assessment', 'We check your core, pelvic floor and goals before you join a group.' ),
		array( 'Your group of six', 'Train with mums at a similar stage, coached by our team.' ),
		array( 'Six weeks, three classes a week', 'A structured block with progress you can feel. Then continue in Postnatal Pilates or Studio classes.' ),
	),
	'steps_title' => 'How the program works',
	'prices'     => solevo_prices( array( 'mums' ) ),
	'prices_title' => 'Program price',
	'faq'        => array(
		array( 'How soon after birth can I start?', 'Most mums start after their six-week postnatal check, once cleared by their GP or obstetrician. If you had a caesarean or complications, check with your doctor first.' ),
		array( 'Do I need a physio check first?', 'The program starts with a one-on-one assessment. If you have leakage, heaviness, pain or abdominal separation, a postnatal physio appointment is a good first step.' ),
		array( 'What does the A$79 per week include?', 'Three classes a week for six weeks and a one-on-one assessment to start.' ),
		array( 'What if I miss a class?', 'Please contact us and we will help where we can.' ),
		array( 'How do I book?', 'Book through Mindbody, or contact us if you have questions first.' ),
	),
	'related'    => array( 'pilates/postnatal-pilates', 'physio/postnatal-physiotherapy', 'physio/pelvic-floor-physiotherapy', 'pilates/pregnancy-pilates' ),
	'related_title' => 'Postnatal care at Solevo',
	'instagram'  => true,
	'todo'       => array( 'Confirm with Steph: can babies attend classes, who runs the program, what happens with a missed class, and whether pregnant women can join. Update the FAQ before ads go to this page.' ),
);
