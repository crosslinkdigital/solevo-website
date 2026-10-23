<?php
/**
 * Gold-standard page: /physio (Service template).
 * Section order follows the rebuild brief, section 13. Every section is a component from
 * components.php, so the other service, condition and studio pages reuse the same parts.
 *
 * Facts not yet confirmed by Solevo are marked with [solevo_todo] notes, which only
 * logged-in editors can see. Nothing unconfirmed is shown to visitors as fact.
 *
 * @package Solevo
 */

defined( 'ABSPATH' ) || exit;

function solevo_scaffold_physio( $page ) {
	$c = '';

	/* 1. Hero ------------------------------------------------------------ */
	$c .= solevo_c_hero( array(
		'eyebrow'   => 'Solevo Physio',
		'h1'        => esc_html( $page['h1'] ),
		'lead'      => 'One-on-one physiotherapy for pain, injury and getting back to the things you enjoy. Hands-on treatment and progressive rehab for everyday people: desk workers, parents, weekend runners and athletes alike.',
		'buttons'   => array( array( 'Book Physio', '#cliniko' ), array( 'What we treat', '#help', true ) ),
		'locations' => true,
		'trust'     => array( 'No GP referral needed', 'One-on-one appointments', 'Book online any time' ),
		'image'     => 'emma-docker',
	) );

	/* 2. What can we help you with? ------------------------------------- */
	$c .= solevo_c_help_grid(
		solevo_c_head( 'Where it hurts', 'What can we help you with?', 'Choose the area that is bothering you to see what we commonly treat and where to go next.' ),
		array(
			array(
				'icon'  => 'back',
				'title' => 'Back and neck pain',
				'hint'  => 'Stiffness, disc pain, sciatica',
				'body'  => 'Low back and neck pain, stiffness from desk work, disc injuries and nerve pain down the leg. We look at how your spine, hips and daily load fit together, not just the sore spot.',
				'links' => array( solevo_c_link( 'conditions/lower-back-pain' ), solevo_c_link( 'conditions/sciatica' ), solevo_c_link( 'conditions/herniated-disc' ) ),
			),
			array(
				'icon'  => 'shoulder',
				'title' => 'Shoulder injuries',
				'hint'  => 'Rotator cuff, impingement, frozen shoulder',
				'body'  => 'Pain lifting your arm, reaching overhead or lying on your side. Rotator cuff and tendon problems, impingement, frozen shoulder and rehab after a dislocation.',
			),
			array(
				'icon'  => 'knee',
				'title' => 'Hip and knee pain',
				'hint'  => 'Runner\'s knee, ACL, meniscus, hip tendons',
				'body'  => 'Knee pain on stairs or when running, ACL and meniscus injuries, hip and buttock pain, and stiff, painful joints from arthritis.',
				'links' => array( solevo_c_link( 'conditions/sports-injuries-rehab' ), solevo_c_link( 'physio/seniors-physiotherapy' ) ),
			),
			array(
				'icon'  => 'sport',
				'title' => 'Sports and running injuries',
				'hint'  => 'Sprains, strains, return to sport',
				'body'  => 'Ankle sprains, muscle strains and running injuries, with a staged plan back to training and competition at whatever level you play.',
				'links' => array( solevo_c_link( 'physio/sports-physiotherapy' ), solevo_c_link( 'conditions/sports-injuries-rehab' ) ),
			),
			array(
				'icon'  => 'tendon',
				'title' => 'Tendon and overuse injuries',
				'hint'  => 'Achilles, tennis elbow, gluteal tendons',
				'body'  => 'Pain that builds with use: Achilles, patellar and gluteal tendons, and tennis elbow. Tendons respond to the right amount of load, so rehab is gradual and measured.',
				'links' => array( solevo_c_link( 'physio/sports-physiotherapy' ), '<a href="#tfc">Heel and foot pain: The Foot Company podiatry</a>' ),
			),
			array(
				'icon'  => 'surgery',
				'title' => 'Post-surgical rehabilitation',
				'hint'  => 'ACL, shoulder, spinal, joint surgery',
				'body'  => 'Rehab after surgery such as an ACL reconstruction, shoulder repair, spinal surgery or a joint replacement. We follow your surgeon\'s protocol, from the first movements back to full strength.',
			),
			array(
				'icon'  => 'womens',
				'title' => 'Women\'s health',
				'hint'  => 'Pregnancy, postnatal, pelvic floor',
				'body'  => 'Back and pelvic pain in pregnancy, recovery after birth and pelvic floor concerns such as leakage, in private one-on-one appointments.',
				'links' => array( solevo_c_link( 'physio/pregnancy-physiotherapy' ), solevo_c_link( 'physio/postnatal-physiotherapy' ), solevo_c_link( 'physio/pelvic-floor-physiotherapy' ) ),
			),
			array(
				'icon'  => 'strength',
				'title' => 'Strength and mobility',
				'hint'  => 'Stiff, unsteady or deconditioned',
				'body'  => 'Not injured, but not moving the way you want to? We build strength, balance and mobility, then you can keep progressing in Clinical Pilates.',
				'links' => array( solevo_c_link( 'pilates/clinical-pilates' ), solevo_c_link( 'conditions/balance-falls-prevention' ) ),
			),
		),
		solevo_b_p( 'Not sure what it is? That is what the first appointment is for. <a href="#cliniko">Book Physio</a> or <a href="' . esc_url( home_url( '/conditions' ) ) . '">browse all conditions</a>.', 'solevo-help__after' )
	);

	/* 3. Physiotherapy services (links down to every child page) -------- */
	$pathway = solevo_c_pathway(
		'Physio, Clinical Pilates or Studio classes?',
		'Three ways to work with us. If you are in pain or injured, start with physio.',
		array(
			array(
				'label'  => 'Start here',
				'title'  => 'Physiotherapy',
				'text'   => 'One-on-one with a physiotherapist. Assessment, diagnosis, hands-on treatment and a rehab plan.',
				'booked' => 'Booked online through Cliniko',
				'button' => array( 'Book Physio', '#cliniko', true ),
			),
			array(
				'label'  => 'Then',
				'title'  => 'Clinical Pilates',
				'text'   => 'Physio-led exercise on the reformer, one-on-one or in small groups, after an initial assessment. Rehab that keeps building strength.',
				'booked' => 'Booked with your physio through Cliniko',
				'button' => array( 'About Clinical Pilates', home_url( '/pilates/clinical-pilates' ), true ),
			),
			array(
				'label'  => 'Ongoing',
				'title'  => 'Studio classes',
				'text'   => 'Reformer, mat Pilates and yoga classes run by our instructors, for general strength and fitness once you are moving well.',
				'booked' => 'Booked through Mindbody',
				'button' => array( 'Book Studio', '#mindbody', true ),
			),
		)
	);
	$c .= solevo_c_service_cards(
		solevo_c_head( 'Our physiotherapy', 'Physiotherapy services', 'Care for everyday aches and pains through to sports injuries and surgery, explained in plain language.' ),
		array(
			array( 'title' => 'General physiotherapy', 'text' => 'Assessment and treatment for aches, pains and injuries anywhere in the body, at any age and fitness level.', 'more' => array( 'Book Physio', '#cliniko' ) ),
			array( 'title' => 'Sports physiotherapy', 'text' => 'Injury care and return-to-sport plans for active people at every level, from weekend sport to competition.', 'more' => array( 'Sports physio', home_url( '/physio/sports-physiotherapy' ) ) ),
			array( 'title' => 'Rehabilitation', 'text' => 'A structured plan after injury, built in clear stages so you always know what comes next and why.', 'more' => array( 'Book Physio', '#cliniko' ) ),
			array( 'title' => 'Strength and exercise rehab', 'text' => 'Supervised strength work in our rehab gym, progressed as you get stronger so you can do more with confidence.', 'more' => array( 'Book Physio', '#cliniko' ) ),
			array( 'title' => 'Everyday joint and muscle pain', 'text' => 'Back, neck, shoulder, hip and knee pain that gets in the way of work, sleep, exercise or looking after family.', 'more' => array( 'Book Physio', '#cliniko' ) ),
			array( 'title' => 'Post-operative rehab', 'text' => 'From early movement after surgery back to full strength, following your surgeon\'s protocol at each stage.', 'more' => array( 'Book Physio', '#cliniko' ) ),
			array( 'title' => 'Workplace injuries', 'text' => 'Neck and back pain from desk work, lifting strains and injuries from physical jobs, with a plan to keep you working.', 'more' => array( 'Book Physio', '#cliniko' ) ),
			array( 'title' => 'Women\'s health physiotherapy', 'text' => 'Private, one-on-one care in pregnancy, after birth and for pelvic floor concerns.', 'links' => array( solevo_c_link( 'physio/pregnancy-physiotherapy', 'Pregnancy' ), solevo_c_link( 'physio/postnatal-physiotherapy', 'Postnatal' ), solevo_c_link( 'physio/pelvic-floor-physiotherapy', 'Pelvic floor' ) ) ),
			array( 'title' => 'Physio for seniors', 'text' => 'Balance, strength and joint care to help you stay steady, active and independent.', 'more' => array( 'Seniors physio', home_url( '/physio/seniors-physiotherapy' ) ) ),
		),
		$pathway . solevo_c_todo( 'Workplace injuries: does Solevo accept workers compensation (icare) and CTP claims? If yes, say so on this card and in the funding list.' )
	);

	/* 4. Your physiotherapy journey -------------------------------------- */
	$c .= solevo_c_journey(
		solevo_c_head( 'What to expect', 'Your physiotherapy journey', 'Three stages, adjusted to you. Some people need a few sessions, others a longer rehab block. Your physio explains the likely plan at your first visit.' ),
		array(
			array( 'Detailed assessment', 'We talk through your symptoms, history and goals, then look at how you move, test strength and check the areas that may be contributing.' ),
			array( 'Personalised treatment and rehab', 'Hands-on treatment where it helps, plus targeted exercises you understand and can do at home or in our rehab gym.' ),
			array( 'Progressive strengthening and return to activity', 'We build capacity step by step so you can get back to everyday life, exercise or sport with confidence.' ),
		),
		array(
			array( 'What happens', 'History, movement and strength assessment, a clear explanation of what is going on, and usually treatment in the same session.' ),
			array( 'How long', 'Your first appointment is longer than a follow-up so there is time for a proper assessment. You will see the exact length when you book.' ),
			array( 'What to bring', 'Clothes you can move in, any scans, reports or surgeon\'s notes, and your health fund card.' ),
			array( 'After that', 'You agree a plan with your physio: how often to come in, what to do at home and how progress is measured. The plan is reviewed as you improve.' ),
		),
		solevo_c_todo( 'Confirm appointment lengths (initial and follow-up, in minutes) so they can be stated in "How long" and the FAQ.' )
	);

	/* 5. Why choose Solevo ----------------------------------------------- */
	$c .= solevo_c_why(
		solevo_c_head( 'Why Solevo', 'Why choose Solevo Physio?' ),
		array(
			array( 'Individualised one-on-one care', 'Every appointment is one-on-one with a physiotherapist, with a plan built around your body, work and goals.' ),
			array( 'Hands-on treatment and progressive rehab', 'Manual therapy to settle pain, then exercise that progresses with you, so you build capacity rather than chase short-term relief.' ),
			array( 'Fully equipped rehabilitation gym', 'Strength equipment and reformers on site in Brookvale, so rehab happens with your physio, not on a handout.' ),
			array( 'Physiotherapy and podiatry together', 'We share our Brookvale space with <a href="#tfc">The Foot Company podiatry</a>, so foot, heel and gait concerns can be managed in one joined-up plan.' ),
		),
		array( 'Book online any time', 'Two locations: Brookvale and Terrey Hills', 'Physio, Clinical Pilates and Studio classes in one place' )
	);

	/* 6. Facilities, assessment and imagery ------------------------------ */
	$c .= solevo_c_facilities(
		'Assessment and facilities',
		'We assess the whole body, <em>not just the painful area</em>',
		'Pain in one place is often driven by how another area moves or copes with load. A whole-body assessment means treatment targets the cause, and progress can be measured.',
		array(
			array( 'Movement assessment.', 'We watch how you walk, squat, bend or run to see what is overloading the sore area.' ),
			array( 'Strength testing.', 'We measure strength and compare sides, so progress is tracked in numbers rather than guesswork.' ),
			array( 'Functional testing.', 'Balance, hop and sport-specific tests show when you are ready for the next step, like returning to running.' ),
			array( 'Gym-based rehabilitation.', 'Your exercises are taught, checked and progressed on real equipment, with your physio beside you.' ),
			array( 'Fully equipped facilities.', 'Treatment space, a strength area and a reformer studio in our Brookvale clinic.' ),
		),
		array( 'running-assessment' )
	);

	/* 7. Trust signals (compliant: no clinical testimonials) ------------- */
	$c .= solevo_c_practitioner( array(
		'image'   => 'emma-docker',
		'eyebrow' => 'Your physiotherapist',
		'name'    => 'Emma Docker',
		'role'    => 'Physiotherapist · Bachelor of Sport &amp; Exercise Science · Master of Physiotherapy',
		'bio'     => 'Emma treats a wide range of muscle, joint and tendon problems, with a particular interest in sports injuries, overuse and running injuries, and rehab after surgery. She combines hands-on treatment, targeted exercise, movement retraining and clear education, and works with people of all ages and fitness levels.',
		'points'  => array( 'AHPRA-registered physiotherapist', 'Clinical Pilates trained', 'Works alongside The Foot Company podiatry' ),
		'link'    => array( 'Meet the team', home_url( '/about' ) ),
	) );

	/* 8. Fees, funding and FAQs ------------------------------------------ */
	$c .= solevo_c_fees_faq(
		solevo_c_head( 'Fees and FAQs', 'Fees, funding and common questions' ),
		array(
			array( 'Initial physiotherapy appointment', 'Assessment and treatment', '$160' ),
			array( 'Follow-up appointment', 'Treatment and rehab progression', '$110' ),
			array( 'Initial Clinical Pilates assessment', 'One-on-one, 60 minutes', '$180' ),
		),
		array(
			'<strong>No referral needed.</strong> Book a private physio appointment directly.',
			'<strong>Private health insurance.</strong> Physiotherapy is claimable on most extras policies. Your rebate depends on your fund and cover.',
			'<strong>Medicare, DVA, workers compensation or CTP?</strong> Please call or email before booking so we can check the paperwork you need.',
		),
		array(
			array( 'Do I need a referral from my GP?', 'No. You can book a private physiotherapy appointment without a referral. If you want to use a Medicare Chronic Disease Management plan, workers compensation or a CTP claim, you will need paperwork from your GP or insurer, so get in touch before booking.' ),
			array( 'How long is the first appointment?', 'Your first appointment is longer than a follow-up, because it includes a full assessment as well as treatment. The exact length is shown when you book online.' ),
			array( 'What should I wear and bring?', 'Wear comfortable clothes you can move in, such as shorts and a T-shirt or activewear. Bring any scans, reports or surgeon\'s notes and your health fund card.' ),
			array( 'Can I claim on private health insurance?', 'Physiotherapy is covered by most private health extras policies. How much you get back depends on your fund and level of cover, so check with your fund if you are unsure.' ),
			array( 'Which location should I book?', 'Brookvale is our main clinic, with the rehab gym and Pilates studio on site. Physio also runs at Terrey Hills Medical Centre on Wednesdays, 8:00am to 3:30pm. Choose your location when you book.' ),
			array( 'How many sessions will I need?', 'It depends on what is going on and what you want to get back to. After your assessment your physio will explain the likely plan, and it is reviewed as you progress.' ),
			array( 'Physio, Clinical Pilates or a Studio class?', 'If you are in pain or injured, start with a physio appointment. Clinical Pilates is physio-led rehab exercise. Studio classes are for general strength and fitness once you are moving well.' ),
		),
		solevo_c_todo( 'Confirm physio prices ($160 initial, $110 follow-up) and whether claims are processed on the spot (HICAPS).' ),
		solevo_c_reviewed()
	);

	/* 9. Locations -------------------------------------------------------- */
	$c .= solevo_c_locations( 'Locations', 'Physio in Brookvale and Terrey Hills', 'Choose the clinic that suits you when you book.', 'physio',
		solevo_c_todo( 'Confirm the Terrey Hills Medical Centre street address and add it in Settings > Solevo (Location 2: address). Add Cliniko deep links per location if you want each button to open the right clinic.' ) );

	/* 10. Final Book Physio CTA comes from the template's booking band (context-aware). */
	return $c;
}
