<?php
/** /pilates  (Studio hub: reformer, mat, yoga) */
defined( 'ABSPATH' ) || exit;

return array(
	'eyebrow'    => 'Solevo Studio · Brookvale',
	'lead'       => 'Boutique reformer Pilates, mat Pilates and yoga in Brookvale. Classes are designed with physiotherapists and capped at six reformers, so every session is properly coached.',
	'trust'      => array( 'Max 6 reformers per class', 'All classes 45 minutes', 'Designed with physiotherapists' ),
	'image'      => 'yoga-stretch',
	'what_eyebrow' => 'Solevo Studio',
	'what_title' => 'Small classes, intelligent programming',
	'what'       => array(
		'Solevo Studio blends clinical precision with intentional movement. Our classes are designed in collaboration with physiotherapists, so they build strength, mobility and control safely, whether you are new to Pilates or have practised for years.',
		'With a maximum of six people on the reformers and 14 on the mat, your instructor can watch your technique and adjust exercises for you.',
	),
	'who_title'  => 'Classes for',
	'who'        => array(
		'Building strength, posture and core control',
		'Staying fit alongside running, sport or the gym',
		'Pregnancy and postnatal strength',
		'Mobility, flexibility and stress relief',
		'Keeping strong after finishing physio rehab',
	),
	'formats'    => array(
		array( 'meta' => 'Reformer · 6 places', 'name' => 'Reformer Athletica', 'tag' => 'Sweat. Stabilise. Perform.', 'text' => 'A dynamic reformer class for active people: unilateral strength, core control and athletic conditioning with precision.', 'best' => 'Active bodies wanting a performance edge.' ),
		array( 'meta' => 'Reformer · 6 places', 'name' => 'Reformer Strength / Align', 'tag' => 'Build strength the smart way.', 'text' => 'Progressive resistance and slower, tempo-based work to build deep stability, joint control and posture.', 'best' => 'Strength with a focus on form.' ),
		array( 'meta' => 'Reformer · 6 places', 'name' => 'Reformer Pre and Post Natal', 'tag' => 'Strong through every stage.', 'text' => 'Supportive reformer work for pregnancy and postpartum, with modifications for every trimester and recovery phase.', 'best' => 'All stages of pregnancy, and after postnatal clearance.' ),
		array( 'meta' => 'Mat · 14 places', 'name' => 'Mat Pilates Strength', 'tag' => 'Simple. Strong. Effective.', 'text' => 'Bodyweight and small equipment to build deep core, hip and shoulder strength with a focus on technique and breath.', 'best' => 'Building resilient, balanced strength.' ),
		array( 'meta' => 'Mat · 14 places', 'name' => 'Mat Pilates Sculpt', 'tag' => 'Lengthen. Sculpt. Sweat.', 'text' => 'A faster mat session with flowing sequences and endurance sets that lift your heart rate while keeping control.', 'best' => 'Strength with a metabolic edge.' ),
		array( 'meta' => 'Yoga · 14 places', 'name' => 'Yoga Vinyasa', 'tag' => 'Move with intention.', 'text' => 'Fluid, breath-led movement that builds mobility, strength and balance.', 'best' => 'All levels, with options provided.' ),
		array( 'meta' => 'Yoga · 14 places', 'name' => 'Yoga Restore and Release', 'tag' => 'Reset your system.', 'text' => 'Slow, grounding and recovery-focused, with longer holds, deep stretches and guided breathwork.', 'best' => 'Recovery, flexibility and stress relief.' ),
	),
	'formats_eyebrow' => 'Classes',
	'formats_title'   => 'Reformer, mat and yoga classes',
	'formats_intro'   => 'All classes run for 45 minutes at our Brookvale studio.',
	'pathway'    => true,
	'prices'     => solevo_prices( array( 'reformer', 'mat', 'private' ) ),
	'prices_title' => 'Class prices',
	'prices_intro' => 'Casual classes and class packs. Clinical Pilates is priced separately as a physiotherapy service.',
	'faq'        => array(
		array( 'I am new to Pilates. Which class should I start with?', 'Reformer Strength / Align or Mat Pilates Strength are good places to start. If you have an injury or pain, start with Clinical Pilates or a physio appointment.' ),
		array( 'How many people are in a class?', 'Reformer classes are capped at six people and mat and yoga classes at 14.' ),
		array( 'What should I bring?', 'Comfortable activewear and a water bottle. Grip socks are recommended for reformer classes.' ),
		array( 'Can I do classes while pregnant?', 'Yes. Our Pre and Post Natal classes are designed by health professionals with modifications for every stage.' ),
		array( 'How do I book?', 'Studio classes are booked through Mindbody. Physio and Clinical Pilates are booked separately through Cliniko.' ),
	),
	'related'    => array( 'pilates/clinical-pilates', 'pilates/mat-pilates', 'pilates/private-pilates', 'pilates/mums-and-bubs', 'pilates/seniors', 'pilates/pregnancy-pilates', 'pilates/postnatal-pilates', 'pilates/over-50s-fitness' ),
	'related_title' => 'All Studio classes and programs',
	'instagram'  => true,
	'todo'       => array( 'Confirm class pack expiry terms and add them under pricing if Solevo wants them shown.' ),
);
