<?php
/** /conditions  (index page, General template layout) */
defined( 'ABSPATH' ) || exit;

return array(
	'eyebrow'   => 'Conditions we treat',
	'lead'      => 'Find your condition to see what it is, how our physiotherapists assess and treat it, and the warning signs that mean you should see a GP first.',
	'buttons'   => array( array( 'Book Physio', '#cliniko' ), array( 'Browse conditions', '#all', true ) ),
	'trust'     => array( 'No referral required', 'Brookvale and Terrey Hills' ),
	'sections'  => array(
		solevo_c_condition_list(
			solevo_c_head( 'Browse by area', 'What can we help you with?', 'Scroll to find your condition. Each one has its own page with causes, treatment and when to see a GP.' ),
			array(
				array( 'title' => 'Back and neck', 'items' => array(
					array( 'title' => 'Lower back pain', 'body' => 'Pain, stiffness or tightness between your ribs and pelvis, from everyday aches to persistent pain.', 'path' => 'conditions/lower-back-pain' ),
					array( 'title' => 'Sciatica', 'body' => 'Nerve pain that travels from the lower back into the buttock and leg.', 'path' => 'conditions/sciatica' ),
					array( 'title' => 'Neck pain & headaches', 'body' => 'From everyday stiffness to persistent neck pain. We assess the cause and build a treatment and exercise plan to restore movement.', 'path' => 'conditions/neck-pain-headaches' ),
				) ),
				array( 'title' => 'Sports and running', 'items' => array(
					array( 'title' => 'Sports injury rehab', 'body' => 'Sudden injuries and overuse problems, with a staged return to training and competition.', 'path' => 'conditions/sports-injuries-rehab' ),
					array( 'title' => 'Shin splints', 'body' => 'Pain along the shin that builds with running, and a plan to get you running again.', 'path' => 'conditions/shin-splints' ),
					array( 'title' => 'Foot & ankle', 'body' => 'Ankle and foot pain can affect walking, running, exercise and everyday activities.', 'path' => 'conditions/foot-ankle' ),
					array( 'title' => 'Tendon pain', 'body' => 'Achilles, patellar, gluteal tendons and tennis elbow, managed with targeted strength and loading programs.' ),
				) ),
				array( 'title' => 'Shoulder, hip and knee', 'items' => array(
					array( 'title' => 'Shoulder & arm pain', 'body' => 'Rotator cuff injuries, frozen shoulder and stiffness affecting reaching, lifting, dressing or sleeping.', 'path' => 'conditions/shoulder-arm-pain' ),
					array( 'title' => 'Hip & groin pain', 'body' => 'Joint, muscle and tendon problems affecting walking, stairs and exercise.', 'path' => 'conditions/hip-groin-pain' ),
					array( 'title' => 'Knee pain & injury', 'body' => 'ACL, meniscus and kneecap pain, including rehab before and after surgery.', 'path' => 'conditions/knee-pain' ),
					array( 'title' => 'Rehab after surgery', 'body' => 'Knee and hip replacements, ACL reconstruction and shoulder surgery, following your surgeon\'s protocol.', 'path' => 'physio/pre-and-post-surgery-rehab' ),
				) ),
				array( 'title' => 'Pregnancy', 'items' => array(
					array( 'title' => 'Pregnancy back pain', 'body' => 'Back pain in pregnancy, with hands-on care and safe exercise to keep you active.', 'path' => 'conditions/pregnancy-back-pain' ),
					array( 'title' => 'Pelvic girdle pain', 'body' => 'Pain at the front or back of the pelvis during pregnancy, often felt when walking, on stairs or rolling in bed.', 'path' => 'conditions/pregnancy-back-pain' ),
				) ),
				array( 'title' => 'Seniors and bone health', 'items' => array(
					array( 'title' => 'Balance and falls prevention', 'body' => 'Strength and balance work to feel steadier and more confident, including after a fall.', 'path' => 'conditions/balance-falls-prevention' ),
					array( 'title' => 'Osteoporosis', 'body' => 'Safe strength and weight-bearing exercise selected with your bone health in mind.', 'path' => 'conditions/osteoporosis' ),
					array( 'title' => 'Arthritis and joint pain', 'body' => 'Exercise and hands-on treatment to manage joint pain and keep you moving.', 'path' => 'physio/seniors-physiotherapy' ),
				) ),
			)
		),
		solevo_b_section( solevo_b_p( 'Not listed? We treat most muscle, joint and tendon problems. <a href="#cliniko">Book Physio</a> and we will work it out together.', 'solevo-help__after' ), array( 'class' => 'solevo-c', 'inner_class' => 'solevo-narrow' ) ),
		solevo_c_faq( 'Common questions', array(
			array( 'Do I need a diagnosis before booking?', 'No. Part of your first appointment is working out what is going on. Book Physio and we will assess you.' ),
			array( 'Do I need a referral?', 'No. You only need a referral if you are using Medicare, workers compensation or a CTP claim.' ),
			array( 'When should I see a GP first?', 'Each condition guide lists the warning signs that need a GP or urgent care before physio. In an emergency call 000.' ),
		) ),
		solevo_c_locations( 'Locations', 'Physio in Brookvale and Terrey Hills', 'Choose the clinic that suits you when you book.' ),
	),
);
