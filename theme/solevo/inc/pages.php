<?php
/**
 * The 30-page site map (Addendum, Week 1 list). One page = one search intent = one booking path.
 * Slugs follow the SEO foundations doc and must not change after launch (add a 301 if one does).
 *
 * type:    home | hub | campaign | service | condition | book | contact | about
 * booking: cliniko | mindbody | both
 *
 * @package Solevo
 */

defined( 'ABSPATH' ) || exit;

function solevo_site_pages() {
	return array(
		/* ---------- Core ---------- */
		array( 'path' => '', 'cta_title' => 'Book a physiotherapy assessment',  'title' => 'Home', 'h1' => 'Physiotherapy in Brookvale', 'type' => 'home', 'booking' => 'cliniko', 'keyword' => 'physio brookvale',
			'seo_title' => 'Physio Brookvale | Solevo Physio & Studio',
			'meta' => 'Physiotherapy in Brookvale and Terrey Hills for pain, injury and sports rehab. One-on-one care, no referral needed and a rehab gym on site. Book online.' ),
		array( 'path' => 'physio', 'cta_title' => 'Book a physiotherapy assessment',  'title' => 'Physio', 'h1' => 'Physiotherapy in Brookvale & Terrey Hills', 'type' => 'hub', 'booking' => 'cliniko', 'keyword' => 'physio close to me',
			'seo_title' => 'Physio Brookvale & Terrey Hills | Solevo Physio',
			'meta' => 'Physiotherapy in Brookvale and Terrey Hills for back, neck, shoulder, knee and sports injuries. One-on-one care and strength-based rehab. Book online.',
			'excerpt' => 'Assessment, hands-on treatment and strength-led rehab for pain and injury.' ),
		array( 'path' => 'pilates', 'title' => 'Pilates', 'h1' => 'Reformer Pilates in Brookvale', 'type' => 'hub', 'booking' => 'mindbody', 'keyword' => 'reformer pilates near me',
			'seo_title' => 'Reformer Pilates Brookvale | Max 6 Per Class | Solevo',
			'meta' => 'Boutique reformer Pilates, mat Pilates and yoga in Brookvale. Classes capped at six reformers, designed with physiotherapists. View the timetable and book.',
			'excerpt' => 'Reformer, mat and clinical Pilates plus yoga, in classes of six reformers max.' ),
		array( 'path' => 'conditions', 'cta_title' => 'Not sure what is causing your pain? Book an assessment',  'title' => 'Conditions', 'h1' => 'Conditions we treat', 'type' => 'hub', 'booking' => 'cliniko', 'keyword' => '(index)',
			'seo_title' => 'Conditions We Treat | Solevo Physio Brookvale',
			'meta' => 'Back pain, sciatica, sports injuries, pregnancy pain, balance and bone health. See how Solevo physios assess and treat each condition in Brookvale.',
			'excerpt' => 'What each condition is, how we treat it and when to book.' ),
		array( 'path' => 'book', 'title' => 'Book', 'h1' => 'Book physio or a class', 'type' => 'book', 'booking' => 'both', 'keyword' => '(utility)',
			'seo_title' => 'Book Physio or Pilates | Solevo Brookvale',
			'meta' => 'Book a physiotherapy appointment through Cliniko or a reformer Pilates, mat Pilates or yoga class through Mindbody at Solevo in Brookvale. Two clear paths.' ),
		array( 'path' => 'contact', 'title' => 'Contact us', 'h1' => 'Contact Solevo in Brookvale', 'type' => 'contact', 'booking' => 'both', 'keyword' => '(utility)',
			'seo_title' => 'Contact Solevo | Mitchell Rd, Brookvale NSW',
			'meta' => 'Find Solevo Physio & Studio at 4/42-46 Mitchell Rd, Brookvale. Opening hours, parking, suburbs we serve on the Northern Beaches and how to get in touch.' ),
		array( 'path' => 'about', 'title' => 'About', 'h1' => 'About Solevo', 'type' => 'about', 'booking' => 'both', 'keyword' => '(trust)',
			'seo_title' => 'About Solevo | Physio & Pilates Team Brookvale',
			'meta' => 'Meet the Solevo team: physiotherapists, Pilates and yoga instructors working together with The Foot Company podiatry in one performance hub in Brookvale.' ),

		/* ---------- Campaign (KPI landing pages, Google Ads targets) ---------- */
		array( 'path' => 'pilates/mums-and-bubs', 'title' => 'Mums and Bubs Pilates', 'h1' => 'Mums and Bubs Pilates in Brookvale', 'type' => 'campaign', 'booking' => 'mindbody', 'keyword' => 'mums and bubs pilates',
			'seo_title' => 'Mums and Bubs Pilates Brookvale | Solevo',
			'meta' => 'Six-week Mums and Bubs Pilates in Brookvale. A 1:1 assessment first, then small groups of six with three classes a week. A$79 per week. Book your spot.',
			'excerpt' => 'Six-week program in groups of six, starting with a 1:1 assessment.',
			'related' => array( 'pilates/pregnancy-pilates', 'pilates/postnatal-pilates', 'physio/pregnancy-physiotherapy', 'physio/postnatal-physiotherapy', 'physio/pelvic-floor-physiotherapy' ) ),
		array( 'path' => 'pilates/seniors', 'large_text' => true,  'title' => 'Seniors Pilates', 'h1' => 'Pilates for Seniors in Brookvale', 'type' => 'campaign', 'booking' => 'mindbody', 'keyword' => 'pilates for seniors near me',
			'seo_title' => 'Pilates for Seniors Brookvale | Solevo',
			'meta' => 'Pilates for seniors in Brookvale, designed with physiotherapists for balance, strength and bone health. Small groups and a 1:1 assessment first. Book now.',
			'excerpt' => 'Balance, strength and bone health in small, physio-designed groups.',
			'related' => array( 'pilates/over-50s-fitness', 'physio/seniors-physiotherapy', 'conditions/balance-falls-prevention', 'conditions/osteoporosis-pilates', 'conditions/spinal-stenosis' ) ),

		/* ---------- Pilates services ---------- */
		array( 'path' => 'pilates/clinical-pilates', 'title' => 'Clinical Pilates', 'h1' => 'Clinical Pilates in Brookvale', 'type' => 'service', 'booking' => 'cliniko', 'cta' => 'Book Clinical Pilates', 'keyword' => 'clinical pilates near me',
			'seo_title' => 'Clinical Pilates Brookvale | Physio-Led | Solevo',
			'meta' => 'Physio-led clinical Pilates in Brookvale. A 60-minute 1:1 assessment, then 1:1 sessions or small groups of six on the reformer. Rehab that builds strength.',
			'excerpt' => 'Physio-led Pilates that bridges treatment and training.',
			'related' => array( 'conditions/lower-back-pain', 'conditions/sciatica', 'conditions/herniated-disc', 'pilates/private-pilates' ) ),
		array( 'path' => 'pilates/pregnancy-pilates', 'title' => 'Pregnancy Pilates', 'h1' => 'Pregnancy Pilates in Brookvale', 'type' => 'service', 'booking' => 'mindbody', 'keyword' => 'prenatal pilates',
			'seo_title' => 'Pregnancy Pilates Brookvale | Prenatal Classes | Solevo',
			'meta' => 'Prenatal Pilates classes in Brookvale, designed by health professionals. Pelvic floor, core support and posture, with modifications for every trimester.',
			'excerpt' => 'Safe, supportive classes for every trimester.',
			'related' => array( 'pilates/postnatal-pilates', 'physio/pregnancy-physiotherapy', 'conditions/pregnancy-back-pain' ) ),
		array( 'path' => 'pilates/postnatal-pilates', 'title' => 'Postnatal Pilates', 'h1' => 'Postnatal Pilates in Brookvale', 'type' => 'service', 'booking' => 'mindbody', 'keyword' => 'postnatal pilates',
			'seo_title' => 'Postnatal Pilates Brookvale | Rebuild Your Core | Solevo',
			'meta' => 'Postnatal Pilates in Brookvale to rebuild core and pelvic floor strength safely after birth. Small classes, physio-designed programs. Book a class.',
			'excerpt' => 'Rebuild core and pelvic floor strength after birth.',
			'related' => array( 'pilates/pregnancy-pilates', 'physio/pregnancy-physiotherapy' ) ),
		array( 'path' => 'pilates/mat-pilates', 'title' => 'Mat Pilates', 'h1' => 'Mat Pilates in Brookvale', 'type' => 'service', 'booking' => 'mindbody', 'keyword' => 'mat pilates near me',
			'seo_title' => 'Mat Pilates Brookvale | Strength & Sculpt | Solevo',
			'meta' => 'Mat Pilates classes in Brookvale: Strength for deep core and hip control, Sculpt for a faster, metabolic session. 45 minutes, up to 14 places. Book now.',
			'excerpt' => 'Strength and Sculpt mat classes, 45 minutes, up to 14 places.',
			'related' => array( 'pilates/clinical-pilates', 'pilates/private-pilates' ) ),
		array( 'path' => 'pilates/private-pilates', 'title' => 'Private Pilates', 'h1' => 'Private Pilates in Brookvale', 'type' => 'service', 'booking' => 'mindbody', 'keyword' => 'private pilates class',
			'seo_title' => 'Private Pilates Brookvale | 1:1 & Duo | Solevo',
			'meta' => 'Private and duo reformer Pilates sessions in Brookvale, built around your body and goals. Single sessions or 5 and 10 packs available. Book a session.',
			'excerpt' => '1:1 and duo sessions built around your goals.',
			'related' => array( 'pilates/clinical-pilates', 'pilates/mat-pilates' ) ),
		array( 'path' => 'pilates/over-50s-fitness', 'title' => 'Over 50s Fitness', 'h1' => 'Over 50s Fitness in Brookvale', 'type' => 'service', 'booking' => 'mindbody', 'keyword' => 'senior fitness programs near me',
			'seo_title' => 'Over 50s Fitness Brookvale | Strength & Balance | Solevo',
			'meta' => 'Over 50s fitness in Brookvale: strength, balance and mobility classes designed with physiotherapists, in small groups at a pace that suits you. Book now.',
			'excerpt' => 'Strength, balance and mobility at a pace that suits you.',
			'related' => array( 'pilates/seniors', 'physio/seniors-physiotherapy', 'conditions/balance-falls-prevention' ) ),

		/* ---------- Physio services ---------- */
		array( 'path' => 'physio/sports-physiotherapy', 'cta_title' => 'Injured? Book a sports physio assessment',  'title' => 'Sports Physiotherapy', 'h1' => 'Sports Physiotherapy in Brookvale', 'type' => 'service', 'booking' => 'cliniko', 'keyword' => 'sports physiotherapy near me',
			'seo_title' => 'Sports Physio Brookvale | Return to Play | Solevo',
			'meta' => 'Sports physiotherapy in Brookvale for sprains, strains, tendon and running injuries. Gait analysis, force plate testing and return to play plans. Book now.',
			'excerpt' => 'Return to play programs for athletes and active people.',
			'related' => array( 'conditions/sports-injuries-rehab', 'conditions/shin-splints', 'pilates/clinical-pilates' ) ),
		array( 'path' => 'physio/shockwave-therapy', 'cta_title' => 'Book a shockwave assessment', 'cta_sub' => 'Your first appointment checks whether shockwave suits your injury before any treatment starts.', 'title' => 'Shockwave Therapy', 'h1' => 'Shockwave therapy in Brookvale', 'type' => 'service', 'booking' => 'cliniko', 'keyword' => 'shockwave therapy brookvale',
			'seo_title' => 'Shockwave Therapy Brookvale | Solevo Physio',
			'meta' => 'Shockwave therapy in Brookvale for stubborn tendon pain, including Achilles, patellar, gluteal and tennis elbow, combined with a strength program. Book online.',
			'excerpt' => 'Shockwave therapy for persistent tendon pain, alongside strength rehabilitation.',
			'related' => array( 'physio/sports-physiotherapy', 'conditions/sports-injuries-rehab', 'physio' ) ),
		array( 'path' => 'physio/pregnancy-physiotherapy', 'cta_title' => 'Book a pregnancy or postnatal physio appointment',  'title' => 'Pregnancy Physiotherapy', 'h1' => 'Pregnancy Physiotherapy in Brookvale', 'type' => 'service', 'booking' => 'cliniko', 'keyword' => 'pregnancy physiotherapy',
			'seo_title' => 'Pregnancy Physio Brookvale | Back & Pelvic Pain | Solevo',
			'meta' => 'Pregnancy physiotherapy in Brookvale for back, pelvic and rib pain. Hands-on care and safe exercise so you stay active through every trimester. Book now.',
			'excerpt' => 'Relief for back, pelvic and rib pain in pregnancy.',
			'related' => array( 'conditions/pregnancy-back-pain', 'pilates/pregnancy-pilates', 'pilates/postnatal-pilates' ) ),
		array( 'path' => 'physio/postnatal-physiotherapy', 'title' => 'Postnatal Physiotherapy', 'h1' => 'Postnatal Physiotherapy in Brookvale', 'type' => 'service', 'booking' => 'cliniko', 'keyword' => 'post natal physiotherapy near me',
			'seo_title' => 'Postnatal Physio Brookvale | Postnatal Check | Solevo',
			'meta' => 'Postnatal physiotherapy in Brookvale: a postnatal check, abdominal and pelvic floor assessment and a clear plan back to exercise. Book today.',
			'excerpt' => 'Postnatal check and a clear plan back to exercise.',
			'related' => array( 'physio/pelvic-floor-physiotherapy', 'pilates/postnatal-pilates', 'conditions/bladder-leakage-incontinence' ) ),
		array( 'path' => 'physio/pre-and-post-surgery-rehab', 'cta_title' => 'Booking surgery? Book a pre-op assessment', 'cta_sub' => 'Start before your operation, or book your first session after it once your surgeon has given the all clear.',  'title' => 'Pre and Post Surgery Rehab', 'h1' => 'Pre and post surgery physiotherapy in Brookvale', 'type' => 'service', 'booking' => 'cliniko', 'keyword' => 'post surgery physio brookvale',
			'seo_title' => 'Pre and Post Surgery Physio Brookvale | Solevo',
			'meta' => 'Physiotherapy in Brookvale before and after surgery: ACL, knee and hip replacement, shoulder and spinal surgery rehab that follows your surgeon\'s plan.',
			'excerpt' => 'Rehab before and after surgery, following your surgeon\'s plan.',
			'related' => array( 'physio/seniors-physiotherapy', 'physio/sports-physiotherapy', 'pilates/clinical-pilates' ) ),
		array( 'path' => 'physio/seniors-physiotherapy', 'large_text' => true, 'cta_title' => 'Book a seniors physio assessment',  'title' => 'Seniors Physiotherapy', 'h1' => 'Physiotherapy for Seniors in Brookvale', 'type' => 'service', 'booking' => 'cliniko', 'keyword' => 'aged care physio',
			'seo_title' => 'Physio for Seniors Brookvale | Balance & Falls | Solevo',
			'meta' => 'Physiotherapy for seniors in Brookvale: falls prevention, balance, arthritis and strength. Thorough assessments and exercise programs that keep you moving.',
			'excerpt' => 'Falls prevention, balance and arthritis care.',
			'related' => array( 'conditions/balance-falls-prevention', 'conditions/spinal-stenosis', 'conditions/osteoporosis-pilates', 'pilates/seniors' ) ),

		/* ---------- Conditions ---------- */
		array( 'path' => 'conditions/lower-back-pain', 'title' => 'Lower Back Pain', 'h1' => 'Lower Back Pain Physio in Brookvale', 'type' => 'condition', 'booking' => 'cliniko', 'keyword' => 'back pain', 'service' => 'physio',
			'seo_title' => 'Lower Back Pain Physio Brookvale | Solevo',
			'meta' => 'Lower back pain explained: common causes, red flags and how Solevo physios in Brookvale assess and treat it with hands-on care and strength-led rehab.',
			'excerpt' => 'Causes, red flags and strength-led treatment.',
			'related' => array( 'conditions/sciatica', 'conditions/herniated-disc', 'pilates/clinical-pilates' ) ),
		array( 'path' => 'conditions/pregnancy-back-pain', 'title' => 'Pregnancy Back Pain', 'h1' => 'Pregnancy Back Pain', 'type' => 'condition', 'booking' => 'both', 'keyword' => 'pregnancy back pain', 'service' => 'physio/pregnancy-physiotherapy',
			'seo_title' => 'Pregnancy Back Pain Relief | Physio Brookvale | Solevo',
			'meta' => 'Why back and pelvic pain happen in pregnancy, which symptoms need a doctor, and how physio and prenatal Pilates at Solevo in Brookvale can ease them.',
			'excerpt' => 'Why it happens and how physio and Pilates help.',
			'related' => array( 'physio/pregnancy-physiotherapy', 'pilates/pregnancy-pilates', 'pilates/postnatal-pilates' ) ),
		array( 'path' => 'conditions/sciatica', 'title' => 'Sciatica', 'h1' => 'Physiotherapy for Sciatica', 'type' => 'condition', 'booking' => 'cliniko', 'keyword' => 'physiotherapy for sciatica', 'service' => 'physio',
			'seo_title' => 'Physiotherapy for Sciatica Brookvale | Solevo',
			'meta' => 'Sciatica explained: symptoms, warning signs that need urgent care, and how physiotherapy at Solevo in Brookvale reduces nerve pain and rebuilds strength.',
			'excerpt' => 'Nerve pain down the leg, and how physio helps.',
			'related' => array( 'conditions/lower-back-pain', 'conditions/herniated-disc', 'pilates/clinical-pilates' ) ),
		array( 'path' => 'conditions/herniated-disc', 'title' => 'Herniated Disc', 'h1' => 'Physiotherapy for a Herniated Disc', 'type' => 'condition', 'booking' => 'cliniko', 'keyword' => 'physical therapy for herniated disc', 'service' => 'physio',
			'seo_title' => 'Herniated Disc Physio Brookvale | Solevo',
			'meta' => 'Herniated or bulging disc? Learn the symptoms, the red flags to act on, and how physio at Solevo in Brookvale helps you recover strength and movement.',
			'excerpt' => 'Bulging or herniated discs and the path back to strength.',
			'related' => array( 'conditions/sciatica', 'conditions/lower-back-pain', 'pilates/clinical-pilates' ) ),
		array( 'path' => 'conditions/sports-injuries-rehab', 'title' => 'Sports Injury Rehabilitation', 'h1' => 'Sports Injury Rehabilitation in Brookvale', 'type' => 'condition', 'booking' => 'cliniko', 'keyword' => 'physiotherapy sports injury clinic', 'service' => 'physio/sports-physiotherapy',
			'seo_title' => 'Sports Injury Rehabilitation Brookvale | Solevo',
			'meta' => 'Sports injury rehab in Brookvale for ankle sprains, muscle strains, ACL and running injuries. Assessment, force plate testing and a staged return to sport.',
			'excerpt' => 'Sprains, strains, ACL and running injuries.',
			'related' => array( 'physio/sports-physiotherapy', 'conditions/shin-splints' ) ),
		array( 'path' => 'conditions/shin-splints', 'title' => 'Shin Splints', 'h1' => 'Shin Splints', 'type' => 'condition', 'booking' => 'cliniko', 'keyword' => 'shin splints', 'service' => 'physio/sports-physiotherapy',
			'seo_title' => 'Shin Splints: Causes & Treatment | Solevo Brookvale',
			'meta' => 'Shin splints explained: what causes shin pain in runners, when it could be a stress fracture, and how gait analysis and rehab at Solevo get you running.',
			'excerpt' => 'Shin pain in runners, causes and treatment.',
			'related' => array( 'conditions/sports-injuries-rehab', 'physio/sports-physiotherapy' ) ),
		array( 'path' => 'conditions/spinal-stenosis', 'title' => 'Spinal Stenosis', 'h1' => 'Physio for Spinal Stenosis', 'type' => 'condition', 'booking' => 'cliniko', 'keyword' => 'physio for spinal stenosis', 'service' => 'physio/seniors-physiotherapy',
			'seo_title' => 'Physio for Spinal Stenosis Brookvale | Solevo',
			'meta' => 'Spinal stenosis explained: leg and back symptoms when walking, red flags, and how physio at Solevo in Brookvale helps you walk further with less pain.',
			'excerpt' => 'Walk further with less back and leg pain.',
			'related' => array( 'physio/seniors-physiotherapy', 'conditions/lower-back-pain', 'pilates/seniors' ) ),
		array( 'path' => 'conditions/osteoporosis-pilates', 'title' => 'Osteoporosis Pilates', 'h1' => 'Pilates for Osteoporosis', 'type' => 'condition', 'booking' => 'both', 'keyword' => 'pilates for osteoporosis', 'service' => 'pilates/seniors',
			'seo_title' => 'Pilates for Osteoporosis Brookvale | Solevo',
			'meta' => 'Safe Pilates for osteoporosis in Brookvale. Physio-designed exercise to build bone-loading strength and balance, with the movements to avoid. Book now.',
			'excerpt' => 'Safe, physio-designed exercise for bone health.',
			'related' => array( 'pilates/seniors', 'physio/seniors-physiotherapy', 'conditions/balance-falls-prevention' ) ),
		array( 'path' => 'conditions/balance-falls-prevention', 'title' => 'Balance and Falls Prevention', 'h1' => 'Balance and Falls Prevention', 'type' => 'condition', 'booking' => 'both', 'keyword' => 'fall prevention exercises for seniors', 'service' => 'physio/seniors-physiotherapy',
			'seo_title' => 'Falls Prevention & Balance Physio Brookvale | Solevo',
			'meta' => 'Falls prevention in Brookvale: balance testing, strength programs and Pilates for seniors that help you stay steady, confident and independent. Book now.',
			'excerpt' => 'Stay steady, confident and independent.',
			'related' => array( 'physio/seniors-physiotherapy', 'pilates/seniors', 'pilates/over-50s-fitness' ) ),
		array( 'path' => 'conditions/bladder-leakage-incontinence', 'title' => 'Bladder Leakage', 'h1' => 'Bladder Leakage and Incontinence', 'type' => 'condition', 'booking' => 'cliniko', 'keyword' => 'kegels for incontinence', 'service' => 'physio/pelvic-floor-physiotherapy',
			'seo_title' => 'Bladder Leakage Physio Brookvale | Pelvic Floor | Solevo',
			'meta' => 'Bladder leakage is common and treatable. Learn the types of incontinence, when to see a GP, and how pelvic floor physio at Solevo in Brookvale helps.',
			'excerpt' => 'Common, treatable, and how pelvic floor physio helps.',
			'related' => array( 'physio/pelvic-floor-physiotherapy', 'physio/postnatal-physiotherapy', 'pilates/postnatal-pilates' ) ),
	);
}

/** The pages.php entry for a page (by its path), or null. Defaults to the page being viewed. */
function solevo_page_def( $post = null ) {
	$post = $post ? get_post( $post ) : ( is_singular( 'page' ) ? get_queried_object() : null );
	if ( ! $post || 'page' !== $post->post_type ) {
		return null;
	}
	$path = (int) get_option( 'page_on_front' ) === $post->ID ? '' : get_page_uri( $post );
	foreach ( solevo_site_pages() as $page ) {
		if ( $page['path'] === $path ) {
			return $page;
		}
	}
	return null;
}

/** Booking path for the page being viewed: cliniko | mindbody | both. */
function solevo_page_booking() {
	$def = solevo_page_def();
	return $def['booking'] ?? 'both';
}

/** 1.3.16: larger, darker text on pages for older readers (Steph, 28 Oct). */
add_filter( 'body_class', function ( $classes ) {
	$def = solevo_page_def();
	if ( ! empty( $def['large_text'] ) ) {
		$classes[] = 'solevo-large-text';
	}
	return $classes;
} );
