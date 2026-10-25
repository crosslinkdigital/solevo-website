<?php
/** /about  (General template) */
defined( 'ABSPATH' ) || exit;

return array(
	'eyebrow'   => 'About Solevo',
	'lead'      => 'Solevo brings physiotherapy, Clinical Pilates, reformer and mat Pilates and yoga together in one space in Brookvale, alongside The Foot Company podiatry, to help you move better, recover well and build lasting strength.',
	'buttons'   => array( array( 'Book Physio', '#cliniko' ), array( 'Book Studio', '#mindbody', true ) ),
	'image'     => 'yoga-stretch',
	'jump'      => array( array( 'Our team', '#team' ), array( 'Working with The Foot Company', '#tfc-partner' ) ),
	'sections'  => array(
		solevo_c_split( array(
			'eyebrow'    => 'Our approach',
			'title'      => 'Movement, rehabilitation and strength',
			'paras'      => array(
				'Whether you are recovering from injury, returning to sport, improving mobility or simply wanting to move and feel better, our team provides expert guidance in a supportive one-on-one or small-group setting.',
				'We believe movement should be intentional and progressive, helping you build strength, confidence and resilience for life so you can keep doing the things you love.',
			),
			'list_title' => 'Under one roof',
			'list'       => array( 'Physiotherapy and sports rehabilitation', 'Clinical Pilates', 'Reformer Pilates, limited to six per class', 'Mat Pilates and yoga', 'Integrated care with podiatry' ),
		) ),
		solevo_c_practitioner( array(
			'image'   => 'emma-docker',
			'eyebrow' => 'Our team',
			'name'    => 'Emma Docker',
			'role'    => 'Physiotherapist · Bachelor of Sport &amp; Exercise Science · Master of Physiotherapy',
			'bio'     => 'Emma grew up playing basketball and netball and has a passion for treating sports-related injuries and guiding clients through rehab in a way that keeps them moving and builds confidence. She manages a wide range of musculoskeletal conditions, with particular interest in acute sporting injuries, overuse and running injuries and post-operative rehabilitation, using hands-on treatment, targeted exercise, movement retraining and education.',
			'points'  => array( 'AHPRA-registered physiotherapist', 'Clinical Pilates trained', 'Sports physiotherapy, ankle and ACL, shoulder and running injuries' ),
		) ),
		solevo_c_why( solevo_c_head( 'Why Solevo', 'What makes Solevo different' ), array(
			array( 'Individualised care', 'One-on-one physiotherapy and small classes, so you are never just a number.' ),
			array( 'Treatment to training', 'A clear path from physio, to Clinical Pilates, to Studio classes.' ),
			array( 'Fully equipped space', 'A rehab gym and reformer studio in Brookvale.' ),
			array( 'Physio and podiatry together', 'Shared care with The Foot Company for foot, ankle and running concerns.' ),
		) ),
		solevo_c_text( 'Partners', 'Working with The Foot Company', array(
			'Solevo shares its Brookvale space with The Foot Company podiatry. For foot, heel, ankle and running concerns, our physiotherapists and the podiatry team can work together on one plan. <a href="#tfc">Visit The Foot Company podiatry</a>.',
		), array( 'anchor' => 'tfc-partner' ) ),
		solevo_c_instagram( 'Follow along', 'Behind the scenes at Solevo Physio and Studio.' ),
	),
	'todo'      => array( 'Add the Solevo story (who founded it and why) in "Our approach" if Steph wants it.' ),
);
