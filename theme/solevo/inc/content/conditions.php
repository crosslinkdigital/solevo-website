<?php
/** /conditions  (index page, General template layout) */
defined( 'ABSPATH' ) || exit;

return array(
	'eyebrow'   => 'Conditions we treat',
	'lead'      => 'Find your condition to see what it is, how our physiotherapists assess and treat it, and the warning signs that mean you should see a GP first.',
	'buttons'   => array( array( 'Book Physio', '#cliniko' ), array( 'Browse conditions', '#help', true ) ),
	'trust'     => array( 'No GP referral needed', 'Brookvale and Terrey Hills' ),
	'sections'  => array(
		solevo_c_help_grid(
			solevo_c_head( 'Browse by area', 'What can we help you with?', 'Tap an area to see the conditions we commonly treat.' ),
			array(
				array( 'icon' => 'back', 'title' => 'Back and spine', 'hint' => 'Back pain, sciatica, disc, stenosis', 'body' => 'Low back pain, nerve pain down the leg, disc injuries and spinal stenosis.', 'links' => array( solevo_c_link( 'conditions/lower-back-pain' ), solevo_c_link( 'conditions/sciatica' ), solevo_c_link( 'conditions/herniated-disc' ), solevo_c_link( 'conditions/spinal-stenosis' ) ) ),
				array( 'icon' => 'sport', 'title' => 'Sports and running', 'hint' => 'Sprains, strains, ACL, tendons', 'body' => 'Sudden and overuse sports injuries, and a staged return to sport.', 'links' => array( solevo_c_link( 'conditions/sports-injuries-rehab' ), solevo_c_link( 'physio/sports-physiotherapy' ) ) ),
				array( 'icon' => 'womens', 'title' => 'Pregnancy and pelvic health', 'hint' => 'Pregnancy pain, leakage', 'body' => 'Back and pelvic pain in pregnancy, and bladder leakage at any stage of life.', 'links' => array( solevo_c_link( 'conditions/pregnancy-back-pain' ), solevo_c_link( 'conditions/bladder-leakage-incontinence' ), solevo_c_link( 'physio/pelvic-floor-physiotherapy' ) ) ),
				array( 'icon' => 'strength', 'title' => 'Seniors and bone health', 'hint' => 'Balance, falls, osteoporosis', 'body' => 'Staying steady, strong and independent, with safe exercise for bone health.', 'links' => array( solevo_c_link( 'conditions/balance-falls-prevention' ), solevo_c_link( 'conditions/osteoporosis-pilates' ), solevo_c_link( 'physio/seniors-physiotherapy' ) ) ),
			),
			solevo_b_p( 'Not listed? We treat most muscle, joint and tendon problems. <a href="#cliniko">Book Physio</a> and we will work it out together.', 'solevo-help__after' )
		),
		solevo_b_section( solevo_c_head( 'All conditions', 'Condition guides' ) . solevo_b_shortcode( '[solevo_child_pages]' ), array( 'class' => 'solevo-c solevo-children2', 'bg' => 'surface', 'anchor' => 'all' ) ),
		solevo_c_faq( 'Common questions', array(
			array( 'Do I need a diagnosis before booking?', 'No. Part of your first appointment is working out what is going on. Book Physio and we will assess you.' ),
			array( 'Do I need a GP referral?', 'No. You only need a referral if you are using Medicare, workers compensation or a CTP claim.' ),
			array( 'When should I see a GP first?', 'Each condition guide lists the warning signs that need a GP or urgent care before physio. In an emergency call 000.' ),
		) ),
		solevo_c_locations( 'Locations', 'Physio in Brookvale and Terrey Hills', 'Choose the clinic that suits you when you book.' ),
	),
);
