<?php
/**
 * /conditions/lower-back-pain  (Condition template reference page)
 * Plain-language, no outcome promises. Red flags per Australian low back pain guidance.
 *
 * @package Solevo
 */

defined( 'ABSPATH' ) || exit;

return array(
	'lead'       => 'Most lower back pain is not caused by serious damage, and it usually improves with the right mix of movement, strength and reassurance. Our physiotherapists in Brookvale and Terrey Hills find what is driving your pain and build a plan to get you moving with confidence.',
	'what_title' => 'What is lower back pain?',
	'what'       => array(
		'Lower back pain is pain, stiffness or tightness between the bottom of your ribs and the top of your legs. It is one of the most common reasons people see a physiotherapist, and it affects desk workers, parents, tradies and athletes alike.',
		'In most cases there is no single structure to blame. Pain often comes from a mix of sensitive tissues, reduced strength or endurance, changes in load (a new job, a house move, more training) and factors such as sleep and stress. That is why a good assessment looks at the whole picture, not just the spine.',
	),
	'symptoms'   => array(
		'Aching, stiffness or sharp pain in the lower back',
		'Pain that changes with sitting, bending, lifting or standing',
		'Stiffness first thing in the morning that eases as you move',
		'Muscle spasm or a feeling that the back has "locked"',
		'Pain spreading into the buttock or thigh',
	),
	'causes'     => array(
		array( 'Sudden or unfamiliar load', 'Lifting, gardening, moving house or a jump in training can overload tissues that are not used to it.' ),
		array( 'Long periods in one position', 'Sitting or standing for hours without a break often leaves the back stiff and sore.' ),
		array( 'Reduced strength and endurance', 'Hips, trunk and legs that tire quickly can leave the lower back doing more of the work.' ),
		array( 'Disc and joint irritation', 'Discs and small spinal joints can become sensitive. This is common and often settles with the right loading.' ),
		array( 'Sleep, stress and general health', 'Poor sleep, stress and low activity levels can all make back pain more sensitive and slower to settle.' ),
		array( 'Pregnancy and life changes', 'Pregnancy, a new baby or getting older change how the back is loaded day to day.' ),
	),
	'help_intro' => 'Treatment is matched to what we find, and the aim is always to get you doing more, not less.',
	'steps'      => array(
		array( 'Assessment', 'We ask about your pain, work, sleep and goals, check for warning signs, then test how you move, bend and lift and how strong your hips and trunk are.' ),
		array( 'Settle the pain', 'Hands-on treatment, short-term changes to aggravating activities and simple exercises to calm things down and keep you moving.' ),
		array( 'Build strength and confidence', 'A progressive strength program, in our rehab gym or at home, so your back copes with the things you need to do. Many people continue in Clinical Pilates.' ),
	),
	'expect'     => array(
		array( 'Scans', 'Most people do not need an X-ray or MRI. We will tell you if your symptoms suggest a scan or a GP review is needed.' ),
		array( 'Rest or move?', 'Staying gently active usually helps more than bed rest. We will show you what is safe to keep doing.' ),
		array( 'How long', 'Many episodes improve within weeks. Pain that keeps coming back usually needs a longer strength plan.' ),
		array( 'At home', 'You leave with a short, clear exercise plan and advice on sitting, lifting and sleep.' ),
	),
	'services'   => array( 'physio', 'pilates/clinical-pilates', 'physio/sports-physiotherapy' ),
	'flags'      => array(
		'Numbness or tingling around the groin, inner thighs or buttocks (saddle area)',
		'New difficulty passing urine, loss of bladder or bowel control',
		'Weakness in a leg or foot that is getting worse',
		'Back pain with fever, feeling very unwell or unexplained weight loss',
		'A history of cancer, or pain after a significant fall or accident',
		'Severe pain at night that does not ease with any position',
	),
	'flags_note' => 'Numbness in the saddle area or changes to bladder or bowel control need same-day medical care: go to an emergency department or call 000. For the other signs, see your GP before booking.',
	'faq'        => array(
		array( 'Do I need a scan before I see a physio?', 'Usually not. Most lower back pain can be assessed and treated without imaging, and scans often show changes that are normal for your age. If anything in your assessment suggests a scan or a GP review, we will tell you.' ),
		array( 'Should I rest or keep moving?', 'For most people, gentle movement and staying at work or normal activities, with some changes, helps more than bed rest. Your physio will show you which movements are safe and how to build back up.' ),
		array( 'How many sessions will I need?', 'It depends on how long you have had pain, how much it affects you and your goals. Your physio will explain the likely plan at your first appointment and review it as you progress.' ),
		array( 'Can Clinical Pilates help with back pain?', 'Clinical Pilates is physio-led exercise on the reformer. It is one way to build trunk, hip and leg strength after your pain has settled, and is tailored to you after an assessment.' ),
		array( 'Do I need a referral?', 'No. You can book a private physio appointment directly. You only need a referral if you are using Medicare, workers compensation or a CTP claim.' ),
	),
	'related'    => array( 'conditions/sciatica', 'conditions/herniated-disc', 'conditions/spinal-stenosis', 'conditions/pregnancy-back-pain' ),
);
