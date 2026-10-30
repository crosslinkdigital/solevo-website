<?php
/** /conditions/pregnancy-back-pain (booking: both) */
defined( 'ABSPATH' ) || exit;

return array(
	'eyebrow'    => 'Pregnancy and postnatal',
	'lead'       => 'Back and pelvic pain are common in pregnancy, but they are not something you simply have to put up with. Physiotherapy and pregnancy Pilates can ease pain and help you stay active and comfortable through each trimester.',
	'trust'      => array( 'Private one-on-one appointments', 'No referral required', 'Safe exercise for every trimester' ),
	'what_title' => 'Why does back pain happen in pregnancy?',
	'what'       => array(
		'As your baby grows, your posture changes, your centre of gravity shifts and pregnancy hormones make ligaments more flexible. Together these change how your back and pelvis carry load, which can lead to pain in the lower back, the pelvis or around the pubic bone.',
		'Pain can start at any stage of pregnancy. Pelvic girdle pain (pain at the back of the pelvis or the front at the pubic bone) is especially common and responds well to the right support and exercise.',
	),
	'symptoms'   => array(
		'Aching in the lower back, often worse later in the day',
		'Pain at the back of the pelvis, buttock or over the pubic bone',
		'Pain turning in bed, climbing stairs or getting in and out of the car',
		'Pain standing on one leg, such as when getting dressed',
		'Rib or mid-back pain later in pregnancy',
	),
	'causes'     => array(
		array( 'Changing posture', 'A growing bump changes how your spine and pelvis are loaded.' ),
		array( 'Hormonal changes', 'Hormones that relax ligaments can make the pelvis feel less stable.' ),
		array( 'Changes in strength', 'Stretched abdominal muscles and less activity can leave the back working harder.' ),
		array( 'Daily load', 'Lifting toddlers, long periods sitting or standing, and broken sleep all add up.' ),
	),
	'steps'      => array(
		array( 'Assessment', 'A private appointment to check your back and pelvis, how you move and what makes the pain better or worse.' ),
		array( 'Relief and support', 'Hands-on treatment, advice on sleeping positions, sitting, lifting and getting in and out of bed, and support options where useful.' ),
		array( 'Safe strength', 'Gentle, pregnancy-safe exercise for your hips, trunk and pelvic floor. Many women continue in pregnancy Pilates.' ),
	),
	'services'   => array( 'physio/pregnancy-physiotherapy', 'pilates/pregnancy-pilates', 'pilates/mums-and-bubs' ),
	'flags_title' => 'When to call your maternity team or GP first',
	'flags'      => array(
		'Vaginal bleeding or a leak of fluid',
		'Regular tightenings, cramping or period-like pain',
		'Your baby moving less than usual',
		'Fever, pain or burning when passing urine, or pain on one side of the back (possible kidney infection)',
		'Severe headache, vision changes or sudden swelling of the face, hands or feet',
		'Calf pain or swelling, chest pain or shortness of breath',
	),
	'flags_note' => 'If any of these apply, contact your maternity unit, midwife or GP straight away. In an emergency call 000.',
	'faq'        => array(
		array( 'Is it safe to see a physio while pregnant?', 'Yes. Physiotherapy is safe throughout pregnancy, and treatment and exercise are adjusted for each stage. Let us know how many weeks you are when you book.' ),
		array( 'Do I need clearance from my obstetrician or midwife?', 'Not for a physio appointment. If you have a complicated pregnancy, let your care team know you are seeing us and tell us about any advice you have been given.' ),
		array( 'Will the pain go away after birth?', 'For many women it improves after birth, but not always. A postnatal check helps you return to exercise safely.' ),
		array( 'Can I do Pilates while pregnant?', 'Yes, with the right modifications. Our pregnancy classes are designed by health professionals and adjusted for each trimester.' ),
	),
	'related'    => array( 'conditions/lower-back-pain', 'conditions/bladder-leakage-incontinence' ),
	'todo'       => array( 'Confirm which clinician sees pregnancy patients and add their name to the "Clinically reviewed by" line.' ),
);
