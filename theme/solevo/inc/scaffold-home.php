<?php
/**
 * Homepage (phase 5): physio-first, on the design system.
 *
 * Order follows Steph's homepage list (20 Oct 2026): physio hero with Book Physio and Call,
 * Emma straight under the hero, Google reviews near the top, Why Solevo, physio services,
 * conditions, assessment, locations, a small Studio band, then the booking band from the
 * front-page template. No studio pricing, timetable, class packs or instructor bios.
 *
 * Built only when "Reset the homepage" is ticked in Appearance > Solevo setup.
 *
 * @package Solevo
 */

defined( 'ABSPATH' ) || exit;

function solevo_scaffold_home( $page ) {
	$c     = '';
	$phone = solevo_opt( 'phone' );

	/* 1. Hero: physiotherapy in Brookvale, Book Physio + Call ----------- */
	$buttons = array( array( 'Book Physio', '#cliniko' ) );
	if ( $phone ) {
		$buttons[] = array( 'Call ' . esc_html( $phone ), '#phone', true );
	}
	$c .= solevo_c_hero( array(
		'eyebrow'   => 'Solevo Physio · Brookvale',
		'h1'        => esc_html( $page['h1'] ),
		'lead'      => 'One-on-one physiotherapy for pain, injury and sports rehab, with a rehab gym and Pilates studio on site. Hands-on treatment and a clear plan to get you back to what you enjoy.',
		'buttons'   => $buttons,
		'locations' => true,
		'trust'     => array( 'No GP referral needed', 'One-on-one appointments', 'Book online any time' ),
		'video'     => 'solevo-intro',
		'poster'    => 'solevo-intro-poster-sign',
	) );

	/* 2. Meet Emma, directly under the hero ----------------------------- */
	$c .= solevo_c_practitioner( array(
		'image'   => 'emma-docker',
		'eyebrow' => 'Meet your physio',
		'name'    => 'Emma Docker',
		'role'    => 'Physiotherapist · Bachelor of Sport &amp; Exercise Science · Master of Physiotherapy',
		'bio'     => 'Emma treats a wide range of muscle, joint and tendon problems, with a particular interest in sports injuries, overuse and running injuries, and rehab after surgery. She combines hands-on treatment, targeted exercise, movement retraining and clear education, and works with people of all ages and fitness levels.',
		'points'  => array( 'AHPRA-registered physiotherapist', 'Clinical Pilates trained', 'Works alongside The Foot Company podiatry' ),
		'link'    => array( 'Book with Emma', '#cliniko' ),
	) );

	/* 3. Google reviews (always visible; feed once Trustindex is connected) */
	$c .= solevo_b_section(
		solevo_c_head( 'Google reviews', 'What our clients say' ) . solevo_b_shortcode( '[solevo_reviews]' ),
		array( 'class' => 'solevo-c solevo-reviews2', 'anchor' => 'reviews' )
	);

	/* 4. Why choose Solevo Physio --------------------------------------- */
	$c .= solevo_c_why(
		solevo_c_head( 'Why Solevo', 'Why choose Solevo Physio?' ),
		array(
			array( 'Individualised one-on-one care', 'Every appointment is one-on-one with a physiotherapist, with a plan built around your body, work and goals.' ),
			array( 'Hands-on treatment and progressive rehab', 'Manual therapy to settle pain, then exercise that progresses with you, so you build capacity rather than chase short-term relief.' ),
			array( 'Fully equipped rehabilitation gym', 'Strength equipment and reformers on site in Brookvale, so rehab happens with your physio, not on a handout.' ),
			array( 'Physiotherapy and podiatry together', 'We share our Brookvale space with <a href="#tfc">The Foot Company podiatry</a>, so foot, heel and gait concerns can be managed in one joined-up plan.' ),
		),
		array( 'Book online any time', 'Two locations: Brookvale and Terrey Hills', 'No GP referral needed' )
	);

	/* 5. Physio services: links down to /physio and the five service pages */
	$c .= solevo_c_service_cards(
		solevo_c_head( 'Our physiotherapy', 'Physiotherapy services', 'From everyday aches and pains to sports injuries, pregnancy and rehab after surgery.' ),
		array(
			array( 'title' => 'General physiotherapy', 'text' => 'Assessment, hands-on treatment and strength-led rehab for back, neck, shoulder, hip and knee pain.', 'more' => array( 'Physiotherapy', home_url( '/physio' ) ), 'featured' => true ),
			array( 'title' => 'Sports physiotherapy', 'text' => 'Injury care and return-to-sport plans for active people, from weekend sport to competition.', 'more' => array( 'Sports physio', home_url( '/physio/sports-physiotherapy' ) ) ),
			array( 'title' => 'Pregnancy physiotherapy', 'text' => 'Care for back, pelvic and rib pain in pregnancy, and safe exercise through every trimester.', 'more' => array( 'Pregnancy physio', home_url( '/physio/pregnancy-physiotherapy' ) ) ),
			array( 'title' => 'Postnatal physiotherapy', 'text' => 'A postnatal check, abdominal and pelvic floor assessment and a clear plan back to exercise.', 'more' => array( 'Postnatal physio', home_url( '/physio/postnatal-physiotherapy' ) ) ),
			array( 'title' => 'Pelvic floor physiotherapy', 'text' => 'Private, one-on-one care for leakage, prolapse and pelvic floor recovery.', 'more' => array( 'Pelvic floor physio', home_url( '/physio/pelvic-floor-physiotherapy' ) ) ),
			array( 'title' => 'Physio for seniors', 'text' => 'Balance, strength and joint care to help you stay steady, active and independent.', 'more' => array( 'Seniors physio', home_url( '/physio/seniors-physiotherapy' ) ) ),
		),
		solevo_b_buttons( array( array( 'Book Physio', '#cliniko' ) ) )
	);

	/* 6. Conditions we treat ------------------------------------------- */
	$conditions = array( 'conditions/lower-back-pain', 'conditions/sciatica', 'conditions/herniated-disc', 'conditions/sports-injuries-rehab', 'conditions/pregnancy-back-pain', 'conditions/spinal-stenosis', 'conditions/osteoporosis-pilates', 'conditions/balance-falls-prevention', 'conditions/bladder-leakage-incontinence' );
	$c .= solevo_b_section(
		solevo_c_head( 'Conditions we treat', 'Not sure what is going on?', 'Read about common conditions, the warning signs that need a GP first, and how we treat them. Or book an assessment and we will work it out together.' )
		. solevo_b_list( array_map( 'solevo_c_link', $conditions ), 'is-style-pills' )
		. solevo_c_more( 'All conditions', home_url( '/conditions' ) ),
		array( 'class' => 'solevo-c solevo-related solevo-home-conds', 'anchor' => 'conditions' )
	);

	/* 7. Assessment and facilities ------------------------------------- */
	$c .= solevo_c_facilities(
		'Assessment and facilities',
		'We assess the whole body, <em>not just the painful area</em>',
		'Pain in one place is often driven by how another area moves or copes with load. A whole-body assessment means treatment targets the cause, and progress can be measured.',
		array(
			array( 'Movement assessment.', 'We watch how you walk, squat, bend or run to see what is overloading the sore area.' ),
			array( 'Strength testing.', 'We measure strength and compare sides, so progress is tracked in numbers rather than guesswork.' ),
			array( 'Gym-based rehabilitation.', 'Your exercises are taught, checked and progressed on real equipment, with your physio beside you.' ),
		),
		array( 'clinic-reformer-room' )
	);

	/* 8. Locations (NAP from Settings > Solevo) ------------------------- */
	$c .= solevo_c_locations( 'Locations', 'Physio in Brookvale and Terrey Hills', 'Choose the clinic that suits you when you book.', 'physio' );

	/* 9. Studio, kept small and below the physio journey --------------- */
	$c .= solevo_c_split( array(
		'eyebrow' => 'Solevo Studio',
		'title'   => 'Keep building strength next door',
		'paras'   => array(
			'Once you are moving well, our studio helps you keep progressing. Seniors Pilates builds balance, strength and bone health in small, physio-designed groups, and Clinical Pilates is run by our physiotherapists.',
		),
		'after_text' => solevo_b_list( array( solevo_c_link( 'pilates/seniors', 'Seniors Pilates' ), solevo_c_link( 'pilates/clinical-pilates', 'Clinical Pilates' ), solevo_c_link( 'pilates', 'All Pilates classes' ) ), 'is-style-pills' ),
		'image'   => 'clinic-studio-mats',
		'bg'      => 'surface',
		'anchor'  => 'studio',
	) );

	/* 10. Final Book Physio band comes from the front-page template (booking-band part). */
	return $c;
}
