<?php
/** /contact  (General template) */
defined( 'ABSPATH' ) || exit;

return array(
	'eyebrow'   => 'Contact',
	'lead'      => 'Physiotherapy, Pilates and yoga in Brookvale, in the space we share with The Foot Company podiatry on Mitchell Road. Physiotherapy also runs at Terrey Hills Medical Centre on Wednesdays.',
	'buttons'   => array( array( 'Book Physio', '#cliniko' ), array( 'Book Studio', '#mindbody', true ) ),
	'locations' => false,
	'jump'      => array( array( 'Locations and hours', '#locations' ), array( 'Getting here', '#getting-here' ) ),
	'sections'  => array(
		solevo_c_locations( 'Locations', 'Our two locations', 'Opening hours, directions and booking for each clinic.' ),
		solevo_c_split( array(
			'eyebrow'    => 'Get in touch',
			'title'      => 'Contact details',
			'paras'      => array( 'For bookings, the fastest way is online. For questions about which appointment suits you, funding or referrals, call or email us.' ),
			'after_text' => solevo_b_shortcode( '[solevo_contact show="name,address,phone,email"]' ) . solevo_b_shortcode( '[solevo_hours]' ),
			'list_title' => 'Good to know',
			'list'       => array(
				'No GP referral needed for private physio',
				'Physio and Studio classes are booked separately',
				'Studio classes run at Brookvale only',
				'Foot and heel concerns: <a href="#tfc">The Foot Company podiatry</a>, in the same space',
			),
			'anchor'     => 'details',
			'bg'         => 'surface',
		) ),
		solevo_c_text( 'Getting here', 'Parking and access', array(
			'Our Brookvale clinic is at 4/42-46 Mitchell Rd, Brookvale, shared with The Foot Company podiatry.',
		), array( 'anchor' => 'getting-here', 'after' => solevo_c_todo( 'Add parking, public transport and accessibility details for Brookvale and Terrey Hills.' ) ) ),
		solevo_c_text( 'Areas we serve', 'Physio and Pilates for the Northern Beaches', array(
			'Clients visit us from across the Northern Beaches and surrounds, including:',
		), array( 'after' => solevo_b_shortcode( '[solevo_suburbs]' ) ) ),
	),
);
