<?php
/**
 * Title: Hero with locations
 * Slug: solevo/c-hero
 * Categories: solevo-components
 * Description: Service or condition hero: H1, lead, booking buttons, both location chips and a photo.
 * Viewport width: 1400
 */
echo solevo_c_hero( array( 'eyebrow' => 'Solevo Physio', 'h1' => '[Service] in Brookvale', 'lead' => '[One or two sentences: who it is for and what they get.]', 'buttons' => array( array( 'Book Physio', '#cliniko' ), array( 'Learn more', '#services', true ) ), 'locations' => true, 'trust' => array( 'No GP referral needed', 'One-on-one appointments' ), 'image' => 'emma-docker' ) ); // phpcs:ignore
