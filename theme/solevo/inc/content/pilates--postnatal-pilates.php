<?php
/** /pilates/postnatal-pilates */
defined( 'ABSPATH' ) || exit;

return array(
	'eyebrow'    => 'Solevo Studio · Postnatal',
	'lead'       => 'Postnatal Pilates in Brookvale to rebuild core and pelvic floor strength safely after birth. Small reformer and mat classes, designed by health professionals.',
	'trust'      => array( 'After postnatal clearance', 'Small classes', 'Designed by health professionals' ),
	'image'      => 'studio-stretch',
	'what_title' => 'Rebuild your strength after birth',
	'what'       => array(
		'Postnatal Pilates helps you rebuild gradually: breath, pelvic floor and deep core first, then posture and whole-body strength for feeding, lifting and carrying.',
		'Classes are designed by health professionals and adjusted for your stage of recovery, whether you had a vaginal birth or a caesarean.',
	),
	'who'        => array(
		'Mums who have had their postnatal clearance',
		'Rebuilding core and pelvic floor strength',
		'Easing back, neck and shoulder tension from feeding and carrying',
		'A gentle return before running or the gym',
	),
	'benefits'   => array(
		array( 'Pelvic floor recovery', 'Reconnect and strengthen the pelvic floor.' ),
		array( 'Core rebuilding', 'Gradual work for abdominal muscles after birth.' ),
		array( 'Posture and tension', 'Strength and mobility for feeding and carrying.' ),
		array( 'A step back to exercise', 'A safe bridge to running, the gym or Studio classes.' ),
	),
	'formats'    => array(
		array( 'meta' => 'Reformer · up to 6', 'name' => 'Reformer Pre and Post Natal', 'tag' => 'Strong through every stage.', 'text' => 'Supportive reformer work for postnatal recovery, with modifications for each stage.', 'best' => 'After postnatal clearance.' ),
		array( 'meta' => 'Mat · up to 14', 'name' => 'Mat Pre and Post Natal', 'tag' => 'Restore with confidence.', 'text' => 'Gentle mat work focused on breath, pelvic floor integration and gradual core rebuilding.', 'best' => 'A gentle start.' ),
		array( 'meta' => 'Six weeks', 'name' => 'Mums and Bubs program', 'tag' => 'Structure and support.', 'text' => 'A six-week block with a one-on-one assessment and three small-group classes a week.', 'best' => 'Mums wanting a structured program.' ),
	),
	'prices'     => solevo_prices( array( 'reformer', 'mat', 'mums' ) ),
	'prices_title' => 'Prices',
	'faq'        => array(
		array( 'How soon after birth can I start?', 'Most mums start after their six-week postnatal check, once cleared by their GP or obstetrician. After a caesarean or complications, check with your doctor first.' ),
		array( 'Should I see a physio first?', 'If you have leakage, heaviness, pain or abdominal separation, a postnatal physio check first helps tailor your classes.' ),
		array( 'Is this the same as Mums and Bubs?', 'Postnatal classes are casual or class-pack classes. Mums and Bubs is a structured six-week program with an assessment to start.' ),
		array( 'Can I bring my baby?', 'Please contact us to check before your first class.' ),
	),
	'related'    => array( 'pilates/mums-and-bubs', 'physio/postnatal-physiotherapy', 'physio/pelvic-floor-physiotherapy', 'conditions/bladder-leakage-incontinence' ),
	'related_title' => 'Postnatal care at Solevo',
	'todo'       => array( 'Confirm whether babies can attend postnatal classes and update the FAQ.' ),
);
