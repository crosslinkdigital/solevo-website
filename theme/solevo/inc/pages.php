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
		array( 'path' => 'conditions', 'cta_title' => 'Not sure what is causing your pain? Book an assessment',  'title' => 'Conditions', 'h1' => 'Conditions We Treat', 'type' => 'hub', 'booking' => 'cliniko', 'keyword' => '(index)',
			'seo_title' => 'Conditions We Treat | Solevo Physio Brookvale',
			'meta' => 'Back pain, sciatica, sports injuries, pregnancy pain, balance and bone health. See how Solevo physios assess and treat each condition in Brookvale.',
			'excerpt' => 'What each condition is, how we treat it and when to book.' ),
		array( 'path' => 'book', 'title' => 'Book', 'h1' => 'Book Physio or a Class', 'type' => 'book', 'booking' => 'both', 'keyword' => '(utility)',
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
			'related' => array( 'pilates/postnatal-pilates', 'conditions/pregnancy-back-pain' ) ),
		array( 'path' => 'faq', 'title' => 'FAQs', 'h1' => 'Frequently Asked Questions', 'type' => 'about', 'booking' => 'both', 'keyword' => '(utility)',
			'seo_title' => 'FAQs | Physio, Pilates, Funding & Bookings | Solevo Brookvale',
			'meta' => 'Answers to common questions about physiotherapy, Pilates classes, health funds, Medicare, WorkCover, NDIS and booking at Solevo in Brookvale and Terrey Hills.',
			'excerpt' => 'Physio, classes, funding and bookings in one place.' ),
		// Hayo/Steph, 4 Nov: Seniors Pilates becomes Active Seniors (slug kept: Google Ads lands here).
		array( 'path' => 'pilates/seniors', 'large_text' => true,  'title' => 'Active Seniors', 'h1' => 'Active Seniors Exercise Program in Brookvale', 'type' => 'campaign', 'booking' => 'mindbody', 'keyword' => 'seniors exercise classes',
			'seo_title' => 'Active Seniors Exercise Classes Brookvale | Solevo',
			'meta' => 'Physiotherapist-led seniors exercise classes in Brookvale for strength, balance, bone health and mobility. Small groups on Mondays and Fridays.',
			'excerpt' => 'Physiotherapist-led classes for strength, balance and bone health.',
			'related' => array( 'physio/seniors-physiotherapy', 'conditions/balance-falls-prevention', 'conditions/osteoporosis' ) ),

		/* ---------- Pilates services ---------- */
		array( 'path' => 'pilates/clinical-pilates', 'title' => 'Clinical Pilates', 'h1' => 'Clinical Pilates in Brookvale', 'type' => 'service', 'booking' => 'cliniko', 'cta' => 'Book Clinical Pilates', 'keyword' => 'clinical pilates near me',
			'seo_title' => 'Clinical Pilates Brookvale | Physio-Led | Solevo',
			'meta' => 'Physio-led clinical Pilates in Brookvale. A 60-minute 1:1 assessment, then 1:1 sessions or small groups of six on the reformer. Rehab that builds strength.',
			'excerpt' => 'Physio-led Pilates that bridges treatment and training.',
			'related' => array( 'conditions/lower-back-pain', 'conditions/sciatica' ) ),
		array( 'path' => 'pilates/postnatal-pilates', 'title' => 'Postnatal Pilates', 'h1' => 'Postnatal Pilates in Brookvale', 'type' => 'service', 'booking' => 'mindbody', 'keyword' => 'postnatal pilates',
			'seo_title' => 'Postnatal Pilates Brookvale | Rebuild Your Core | Solevo',
			'meta' => 'Postnatal Pilates in Brookvale to rebuild core and pelvic floor strength safely after birth. Small classes, physio-designed programs. Book a class.',
			'excerpt' => 'Rebuild core and pelvic floor strength after birth.',
			'related' => array( 'pilates/clinical-pilates', 'pilates' ) ),
		array( 'path' => 'pilates/mat-pilates', 'title' => 'Mat Pilates', 'h1' => 'Mat Pilates in Brookvale', 'type' => 'service', 'booking' => 'mindbody', 'keyword' => 'mat pilates near me',
			'seo_title' => 'Mat Pilates Brookvale | Strength & Sculpt | Solevo',
			'meta' => 'Mat Pilates classes in Brookvale: Strength for deep core and hip control, Sculpt for a faster, metabolic session. 45 minutes, up to 14 places. Book now.',
			'excerpt' => 'Strength and Sculpt mat classes, 45 minutes, up to 14 places.',
			'related' => array( 'pilates/clinical-pilates', 'pilates' ) ),

		/* ---------- Physio services ---------- */
		array( 'path' => 'physio/sports-physiotherapy', 'cta_title' => 'Injured? Book a sports physio assessment',  'title' => 'Sports Physiotherapy', 'h1' => 'Sports Physiotherapy in Brookvale', 'type' => 'service', 'booking' => 'cliniko', 'keyword' => 'sports physiotherapy near me',
			'seo_title' => 'Sports Physio Brookvale | Return to Play | Solevo',
			'meta' => 'Sports physiotherapy in Brookvale for sprains, strains, tendon and running injuries. Gait analysis, force plate testing and return to play plans. Book now.',
			'excerpt' => 'Return to play programs for athletes and active people.',
			'related' => array( 'conditions/sports-injuries-rehab', 'conditions/shin-splints', 'pilates/clinical-pilates' ) ),
		array( 'path' => 'physio/shockwave-therapy', 'cta_title' => 'Book a shockwave assessment', 'cta_sub' => 'Your first appointment checks whether shockwave suits your injury before any treatment starts.', 'title' => 'Shockwave Therapy', 'h1' => 'Shockwave Therapy in Brookvale', 'type' => 'service', 'booking' => 'cliniko', 'keyword' => 'shockwave therapy brookvale',
			'seo_title' => 'Shockwave Therapy Brookvale | Solevo Physio',
			'meta' => 'Shockwave therapy in Brookvale for stubborn tendon pain, including Achilles, patellar, gluteal and tennis elbow, combined with a strength program. Book online.',
			'excerpt' => 'Shockwave therapy for persistent tendon pain, alongside strength rehabilitation.',
			'related' => array( 'physio/sports-physiotherapy', 'conditions/sports-injuries-rehab', 'physio' ) ),
		array( 'path' => 'physio/postnatal-physiotherapy', 'title' => 'Postnatal Physiotherapy', 'h1' => 'Postnatal Physiotherapy in Brookvale', 'type' => 'service', 'booking' => 'cliniko', 'keyword' => 'post natal physiotherapy near me',
			'seo_title' => 'Postnatal Physio Brookvale | Postnatal Check | Solevo',
			'meta' => 'Postnatal physiotherapy in Brookvale: a postnatal check, abdominal and pelvic floor assessment and a clear plan back to exercise. Book today.',
			'excerpt' => 'Postnatal check and a clear plan back to exercise.',
			'related' => array( 'physio/pelvic-floor-physiotherapy', 'pilates/postnatal-pilates', 'conditions/bladder-leakage-incontinence' ) ),
		array( 'path' => 'physio/pre-and-post-surgery-rehab', 'cta_title' => 'Booking surgery? Book a pre-op assessment', 'cta_sub' => 'Start before your operation, or book your first session after it once your surgeon has given the all clear.',  'title' => 'Pre and Post Surgery Rehab', 'h1' => 'Pre and Post Surgery Physiotherapy in Brookvale', 'type' => 'service', 'booking' => 'cliniko', 'keyword' => 'post surgery physio brookvale',
			'seo_title' => 'Pre and Post Surgery Physio Brookvale | Solevo',
			'meta' => 'Physiotherapy in Brookvale before and after surgery: ACL, knee and hip replacement, shoulder and spinal surgery rehab that follows your surgeon\'s plan.',
			'excerpt' => 'Rehab before and after surgery, following your surgeon\'s plan.',
			'related' => array( 'physio/seniors-physiotherapy', 'physio/sports-physiotherapy', 'pilates/clinical-pilates' ) ),
		array( 'path' => 'physio/seniors-physiotherapy', 'large_text' => true, 'cta_title' => 'Book a seniors physio assessment',  'title' => 'Seniors Physiotherapy', 'h1' => 'Physiotherapy for Seniors in Brookvale', 'type' => 'service', 'booking' => 'cliniko', 'keyword' => 'aged care physio',
			'seo_title' => 'Physio for Seniors Brookvale | Balance & Falls | Solevo',
			'meta' => 'Physiotherapy for seniors in Brookvale: falls prevention, balance, arthritis and strength. Thorough assessments and exercise programs that keep you moving.',
			'excerpt' => 'Falls prevention, balance and arthritis care.',
			'related' => array( 'conditions/balance-falls-prevention', 'conditions/osteoporosis', 'pilates/seniors' ) ),
		array( 'path' => 'physio/workers-compensation', 'cta_title' => 'Injured at work? Book a physiotherapy assessment', 'cta_sub' => 'Bring your claim number and insurer details to your first appointment.', 'title' => 'WorkCover Physiotherapy', 'h1' => 'WorkCover Physiotherapy in Brookvale & Terrey Hills', 'h1_lines' => array( 'WorkCover physiotherapy in', 'Brookvale & Terrey Hills' ), 'type' => 'service', 'booking' => 'cliniko', 'keyword' => 'workcover physio northern beaches',
			'seo_title' => 'WorkCover Physio Brookvale & Terrey Hills | Solevo',
			'meta' => 'Physiotherapy for work injuries in Brookvale and Terrey Hills. Assessment, treatment and rehab tailored to your job, for workers compensation clients. Book online.',
			'excerpt' => 'Assessment, treatment and rehab for workplace injuries.',
			'related' => array( 'physio', 'conditions/lower-back-pain', 'physio/pre-and-post-surgery-rehab' ) ),
		array( 'path' => 'physio/ndis', 'cta_title' => 'Book an NDIS physiotherapy assessment', 'cta_sub' => 'For NDIS participants with self-managed or plan-managed funding.', 'title' => 'NDIS Physiotherapy', 'h1' => 'NDIS Physiotherapy in Brookvale', 'type' => 'service', 'booking' => 'cliniko', 'keyword' => 'ndis physio northern beaches',
			'seo_title' => 'NDIS Physio Brookvale & Terrey Hills | Self & Plan Managed | Solevo',
			'meta' => 'NDIS physiotherapy in Brookvale and Terrey Hills for self-managed and plan-managed participants. Strength, mobility and balance programs built around your goals.',
			'excerpt' => 'Physiotherapy for self-managed and plan-managed NDIS participants.',
			'related' => array( 'physio/seniors-physiotherapy', 'pilates/clinical-pilates', 'physio' ) ),
		// Hayo, 4 Nov: a service in the Services menu, built in the condition layout Steph's copy is written for.
		array( 'path' => 'physio/adolescent-sports-physiotherapy', 'cta_title' => 'Book an adolescent sports physio assessment', 'title' => 'Adolescent Sports Injuries', 'h1' => 'Adolescent Sports Injuries & Physiotherapy in Brookvale', 'type' => 'condition', 'booking' => 'cliniko', 'keyword' => 'adolescent sports injury physio', 'service' => 'physio/sports-physiotherapy',
			'seo_title' => 'Adolescent Sports Injury Physio Brookvale | Solevo',
			'meta' => 'Physio for active children and teenagers in Brookvale: Osgood-Schlatter, Sever\'s disease, sprains and strains, with a safe, staged return to sport.',
			'excerpt' => 'Growth-related pain and sports injuries in children and teens.',
			'related' => array( 'physio/sports-physiotherapy', 'conditions/knee-pain', 'conditions/foot-ankle' ) ),

		/* ---------- Conditions ---------- */
		array( 'path' => 'conditions/lower-back-pain', 'title' => 'Lower Back Pain', 'h1' => 'Lower Back Pain Physio in Brookvale', 'type' => 'condition', 'booking' => 'cliniko', 'keyword' => 'back pain', 'service' => 'physio',
			'seo_title' => 'Lower Back Pain Physio Brookvale | Solevo',
			'meta' => 'Lower back pain explained: common causes, red flags and how Solevo physios in Brookvale assess and treat it with hands-on care and strength-led rehab.',
			'excerpt' => 'Causes, red flags and strength-led treatment.',
			'related' => array( 'conditions/sciatica', 'pilates/clinical-pilates' ) ),
		array( 'path' => 'conditions/pregnancy-back-pain', 'title' => 'Pregnancy Back Pain', 'h1' => 'Pregnancy Back Pain', 'type' => 'condition', 'booking' => 'cliniko', 'keyword' => 'pregnancy back pain', 'service' => 'physio',
			'seo_title' => 'Pregnancy Back Pain Relief | Physio Brookvale | Solevo',
			'meta' => 'Why back and pelvic pain happen in pregnancy, which symptoms need a doctor, and how physio and prenatal Pilates at Solevo in Brookvale can ease them.',
			'excerpt' => 'Why it happens and how physio and Pilates help.',
			'related' => array( 'physio', 'pilates/postnatal-pilates' ) ),
		array( 'path' => 'conditions/sciatica', 'title' => 'Sciatica', 'h1' => 'Physiotherapy for Sciatica', 'type' => 'condition', 'booking' => 'cliniko', 'keyword' => 'physiotherapy for sciatica', 'service' => 'physio',
			'seo_title' => 'Physiotherapy for Sciatica Brookvale | Solevo',
			'meta' => 'Sciatica explained: symptoms, warning signs that need urgent care, and how physiotherapy at Solevo in Brookvale reduces nerve pain and rebuilds strength.',
			'excerpt' => 'Nerve pain down the leg, and how physio helps.',
			'related' => array( 'conditions/lower-back-pain', 'pilates/clinical-pilates' ) ),
		array( 'path' => 'conditions/herniated-disc', 'title' => 'Herniated Disc', 'h1' => 'Physiotherapy for a Herniated Disc', 'type' => 'condition', 'booking' => 'cliniko', 'keyword' => 'physical therapy for herniated disc', 'service' => 'physio',
			'seo_title' => 'Herniated Disc Physio Brookvale | Solevo',
			'meta' => 'Herniated or bulging disc? Learn the symptoms, the red flags to act on, and how physio at Solevo in Brookvale helps you recover strength and movement.',
			'excerpt' => 'Bulging or herniated discs and the path back to strength.',
			'related' => array( 'conditions/sciatica', 'conditions/lower-back-pain', 'pilates/clinical-pilates' ) ),
		/* 1.4.6: Areas we treat pages from Steph's doc (4 Nov). */
		array( 'path' => 'conditions/neck-pain-headaches', 'title' => 'Neck Pain & Headaches', 'h1' => 'Neck Pain & Headaches Physiotherapy in Brookvale', 'type' => 'condition', 'booking' => 'cliniko', 'keyword' => 'neck pain physio', 'service' => 'physio',
			'seo_title' => 'Neck Pain & Headache Physio Brookvale | Solevo',
			'meta' => 'Neck pain, stiffness and neck-related headaches assessed and treated by physios in Brookvale, with hands-on care, exercise and practical advice.',
			'excerpt' => 'Neck pain, stiffness and neck-related headaches.',
			'related' => array( 'conditions/shoulder-arm-pain', 'conditions/lower-back-pain' ) ),
		array( 'path' => 'conditions/shoulder-arm-pain', 'title' => 'Shoulder & Arm Pain', 'h1' => 'Shoulder & Arm Pain Physiotherapy in Brookvale', 'type' => 'condition', 'booking' => 'cliniko', 'keyword' => 'shoulder physio', 'service' => 'physio',
			'seo_title' => 'Shoulder & Arm Pain Physio Brookvale | Solevo',
			'meta' => 'Rotator cuff injuries, frozen shoulder, tennis elbow and tendon pain treated by physios in Brookvale to reduce pain, restore movement and rebuild strength.',
			'excerpt' => 'Rotator cuff, frozen shoulder, tennis elbow and tendon pain.',
			'related' => array( 'conditions/neck-pain-headaches', 'conditions/sports-injuries-rehab' ) ),
		array( 'path' => 'conditions/hip-groin-pain', 'title' => 'Hip & Groin Pain', 'h1' => 'Hip & Groin Pain Physiotherapy in Brookvale', 'type' => 'condition', 'booking' => 'cliniko', 'keyword' => 'hip pain physio', 'service' => 'physio',
			'seo_title' => 'Hip & Groin Pain Physio Brookvale | Solevo',
			'meta' => 'Hip bursitis, gluteal tendinopathy, groin strains and hip arthritis treated by physios in Brookvale, with strength-led rehab for walking, running and sport.',
			'excerpt' => 'Hip bursitis, gluteal tendons, groin strains and hip arthritis.',
			'related' => array( 'conditions/knee-pain', 'conditions/lower-back-pain' ) ),
		array( 'path' => 'conditions/knee-pain', 'title' => 'Knee Pain & Injury', 'h1' => 'Knee Pain & Injury Physiotherapy in Brookvale', 'type' => 'condition', 'booking' => 'cliniko', 'keyword' => 'knee physio', 'service' => 'physio/sports-physiotherapy',
			'seo_title' => 'Knee Pain & Injury Physio Brookvale | Solevo',
			'meta' => 'Knee arthritis, meniscus and ligament injuries, runner\'s knee and rehab after surgery. Physio in Brookvale to reduce pain and rebuild knee strength.',
			'excerpt' => 'Arthritis, meniscus and ligament injuries, and rehab after surgery.',
			'related' => array( 'conditions/hip-groin-pain', 'conditions/foot-ankle' ) ),
		array( 'path' => 'conditions/foot-ankle', 'title' => 'Foot & Ankle', 'h1' => 'Foot & Ankle Physiotherapy in Brookvale', 'type' => 'condition', 'booking' => 'cliniko', 'keyword' => 'ankle physio', 'service' => 'physio/sports-physiotherapy',
			'seo_title' => 'Foot & Ankle Physio Brookvale | Solevo',
			'meta' => 'Ankle sprains, Achilles pain, shin splints and calf strains treated by physios in Brookvale, working alongside The Foot Company\'s podiatrist when needed.',
			'excerpt' => 'Ankle sprains, Achilles pain, shin splints and calf strains.',
			'related' => array( 'conditions/shin-splints', 'conditions/sports-injuries-rehab' ) ),
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
		// Hayo, 4 Nov: osteoporosis stays a condition page; new URL (301 from osteoporosis-pilates) and Steph's copy.
		array( 'path' => 'conditions/osteoporosis', 'title' => 'Osteoporosis', 'h1' => 'Exercise for Osteoporosis in Brookvale', 'type' => 'condition', 'booking' => 'both', 'keyword' => 'exercise for osteoporosis', 'service' => 'pilates/seniors',
			'seo_title' => 'Exercise for Osteoporosis Brookvale | Solevo Physio',
			'meta' => 'Physiotherapy and exercise programs for osteoporosis in Brookvale: strength, balance and bone health, with guidance on which movements to modify.',
			'excerpt' => 'Strength, balance and bone health, with guidance on what to modify.',
			'related' => array( 'pilates/seniors', 'physio/seniors-physiotherapy', 'conditions/balance-falls-prevention' ) ),
		array( 'path' => 'conditions/balance-falls-prevention', 'title' => 'Balance and Falls Prevention', 'h1' => 'Balance and Falls Prevention', 'type' => 'condition', 'booking' => 'both', 'keyword' => 'fall prevention exercises for seniors', 'service' => 'physio/seniors-physiotherapy',
			'seo_title' => 'Falls Prevention & Balance Physio Brookvale | Solevo',
			'meta' => 'Falls prevention in Brookvale: balance testing, strength programs and Pilates for seniors that help you stay steady, confident and independent. Book now.',
			'excerpt' => 'Stay steady, confident and independent.',
			'related' => array( 'physio/seniors-physiotherapy', 'pilates/seniors' ) ),
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
	// 1.4.13: blog posts and the blog index book physio.
	if ( function_exists( 'solevo_is_blog' ) && solevo_is_blog() ) {
		return 'cliniko';
	}
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
