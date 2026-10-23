<?php
/**
 * Title: Practitioner and trust
 * Slug: solevo/c-practitioner
 * Categories: solevo-components
 * Description: Photo, name, qualifications and compliant trust points. No testimonials.
 * Viewport width: 1400
 */
echo solevo_c_practitioner( array( 'image' => 'emma-docker', 'eyebrow' => 'Your physiotherapist', 'name' => 'Emma Docker', 'role' => 'Physiotherapist · Bachelor of Sport &amp; Exercise Science · Master of Physiotherapy', 'bio' => '[Two sentences on why this practitioner suits this service.]', 'points' => array( 'AHPRA-registered physiotherapist' ), 'link' => array( 'Meet the team', home_url( '/about' ) ) ) ); // phpcs:ignore
