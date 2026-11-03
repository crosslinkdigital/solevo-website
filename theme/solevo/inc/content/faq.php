<?php
/** /faq  (General template; central FAQ page, Steph 3 Nov 2026. Each service page keeps its own short FAQ.) */
defined( 'ABSPATH' ) || exit;

$solevo_faq_args = function ( $anchor ) {
	return array( 'anchor' => $anchor, 'eyebrow' => '', 'all_link' => false );
};

return array(
	'eyebrow'   => 'FAQs',
	'lead'      => 'Answers to common questions about physiotherapy, studio classes, funding and booking at Solevo in Brookvale and Terrey Hills.',
	'buttons'   => array( array( 'Book Physio', '#cliniko' ), array( 'Book Studio', '#mindbody', true ) ),
	'locations' => false,
	'jump'      => array( array( 'Physio', '#faq-physio' ), array( 'Funding', '#faq-funding' ), array( 'Studio classes', '#faq-studio' ), array( 'Booking', '#faq-booking' ) ),
	'sections'  => array(
		solevo_c_faq( 'Physiotherapy', array(
			array( 'Do I need a referral?', 'Not for a private appointment. You only need one to claim a Medicare rebate.' ),
			array( 'What happens at my first appointment?', 'A thorough history of your injury, symptoms and goals, movement and strength testing, a diagnosis and treatment.' ),
			array( 'How long are appointments?', 'Your first appointment is 60 minutes at Brookvale and 45 minutes at Terrey Hills. Follow-up appointments are 30 minutes.' ),
			array( 'What should I bring?', 'Clothes you can move in, any scans, reports or surgeon\'s notes, and your health fund card.' ),
			array( 'Do I need to be an athlete to see a sports physio?', 'Not at all. Sports physiotherapy is for anyone whose injury is affecting their ability to exercise, play sport or stay active, from weekend sport and parkrun to competitive athletes.' ),
			array( 'Can I keep training while injured?', 'Often, yes. Your physiotherapist will guide you on how to modify your training while your injury recovers.' ),
		), '', $solevo_faq_args( 'faq-physio' ) ),
		solevo_c_faq( 'Funding and rebates', array(
			array( 'Can I claim through private health insurance?', 'Yes. Physiotherapy is claimable on most extras policies, depending on your cover, and you can claim on the spot with HICAPS.' ),
			array( 'Can I claim a Medicare rebate?', 'Yes, with a valid referral from your GP under a Chronic Condition Management Plan. We process the rebate on the spot. Appointments aren\'t bulk billed, so there is a gap to pay.' ),
			array( 'Do you see WorkCover clients?', 'Yes. We see workers compensation clients at Brookvale and Terrey Hills. Bring your claim number, insurer details and certificate of capacity.' ),
			array( 'Do you see NDIS participants?', 'Yes, if your plan is self-managed or plan-managed. Solevo is not a registered NDIS provider, so we can\'t see NDIA-managed participants.' ),
		), '', $solevo_faq_args( 'faq-funding' ) ),
		solevo_c_faq( 'Studio classes', array(
			array( 'How many people are in a class?', 'Reformer classes are limited to six people. Mat Pilates and yoga classes take up to 14.' ),
			array( 'I\'m injured or in pain. Can I join a class?', 'We recommend booking a physiotherapy assessment before joining a studio class. Clinical Pilates may be the best place to start.' ),
			array( 'How is Clinical Pilates different from a reformer class?', 'Clinical Pilates is a physiotherapist-led program tailored to your injury, condition and goals, starting with a one-to-one assessment. Studio classes focus on overall strength and fitness.' ),
			array( 'What should I bring?', 'Comfortable activewear and a water bottle. Grip socks are recommended for reformer classes.' ),
		), '', $solevo_faq_args( 'faq-studio' ) ),
		solevo_c_faq( 'Booking and locations', array(
			array( 'How do I book?', 'Physiotherapy and Clinical Pilates are booked online through Book Physio. Studio classes are booked through Book Studio.' ),
			array( 'Where are you?', 'Physiotherapy and the studio are in Brookvale. Physiotherapy also runs at Terrey Hills. Addresses and opening hours for both clinics are at the bottom of every page.' ),
			array( 'Is there a gym at both clinics?', 'Our Brookvale clinic has the full rehabilitation gym. Terrey Hills offers physiotherapy and small group classes without the full gym.' ),
		), '', $solevo_faq_args( 'faq-booking' ) ),
	),
	'todo'      => array( 'Check every answer against the FAQs on the service pages after the copy edits, so the wording matches.' ),
);
