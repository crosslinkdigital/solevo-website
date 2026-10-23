<?php
/** /book  (General template) */
defined( 'ABSPATH' ) || exit;

return array(
	'eyebrow'   => 'Book',
	'lead'      => 'Two ways to book. Physiotherapy and Clinical Pilates are booked through Cliniko. Reformer, mat, pregnancy and postnatal classes and yoga are booked through Mindbody.',
	'buttons'   => array( array( 'Book Physio', '#cliniko' ), array( 'Book Studio', '#mindbody' ) ),
	'trust'     => array( 'Book online any time', 'No GP referral needed for physio' ),
	'jump'      => array( array( 'Timetable', '#timetable' ), array( 'Prices', '#pricing' ), array( 'Locations', '#locations' ) ),
	'sections'  => array(
		solevo_c_booking_paths( solevo_c_head( 'Choose your booking', 'Physio or Studio?', 'In pain or injured? Start with physio. Looking for a class? Book Studio.' ) ),
		solevo_c_timetable( 'Studio timetable', 'Live class times for reformer, mat and yoga. Book your spot online.' ),
		solevo_c_prices(
			solevo_c_head( 'Prices', 'Prices', 'Physiotherapy may be claimable on private health extras. Your rebate depends on your fund and cover.' ),
			array_merge(
				array( array( 'title' => 'Physiotherapy', 'meta' => 'Brookvale and Terrey Hills · booked through Cliniko', 'rows' => array(
					array( 'Initial appointment', 'Assessment and treatment', '$160' ),
					array( 'Follow-up appointment', '', '$110' ),
				) ) ),
				solevo_prices( array( 'clinical', 'reformer', 'mat', 'private', 'mums' ) )
			),
			solevo_c_todo( 'Confirm physio prices ($160 initial, $110 follow-up), cancellation policy and class pack expiry terms.' )
		),
		solevo_c_faq( 'Booking questions', array(
			array( 'Which booking system do I use?', 'Physiotherapy and Clinical Pilates: Cliniko (Book Physio). Group classes, private Pilates and yoga: Mindbody (Book Studio).' ),
			array( 'Do I need a referral for physio?', 'No. You only need a referral if you are using Medicare, workers compensation or a CTP claim. Please call before booking in those cases.' ),
			array( 'Can I book physio at Terrey Hills?', 'Yes, physiotherapy runs at Terrey Hills Medical Centre on Wednesdays, 8:00am to 3:30pm. Choose Terrey Hills when you book.' ),
			array( 'I am not sure what to book.', 'If you have pain, an injury or a health condition, book a physio appointment. If you want to exercise and feel well, choose a Studio class.' ),
		) ),
		solevo_c_locations( 'Locations', 'Where to find us', 'Physio in Brookvale and Terrey Hills. Studio classes in Brookvale.' ),
	),
);
