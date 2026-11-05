<?php
/**
 * GA4 Google tag (gtag.js) and optional Google Tag Manager container (IDs in Settings > Solevo).
 * GA4 only loads on the live domain (solevo.com.au), so staging visits never reach the live property.
 * Click events pushed to the dataLayer by assets/js/site.js:
 *   click_book_physio, click_book_class, click_call, click_email, form_submit
 *
 * @package Solevo
 */

defined( 'ABSPATH' ) || exit;

function solevo_is_live_host() {
	$host = strtolower( preg_replace( '/:\d+$/', '', $_SERVER['HTTP_HOST'] ?? '' ) );
	return in_array( $host, array( 'solevo.com.au', 'www.solevo.com.au' ), true );
}

add_action( 'wp_head', function () {
	$id = solevo_opt( 'ga4_id' );
	if ( ! $id || ! solevo_is_live_host() || is_user_logged_in() && current_user_can( 'edit_pages' ) ) {
		return; // Staging, and editors browsing the live site, are not counted.
	}
	?>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr( $id ); ?>"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());
gtag('config', '<?php echo esc_js( $id ); ?>');
</script>
	<?php
}, 2 );

add_action( 'wp_head', function () {
	$id = solevo_opt( 'gtm_id' );
	if ( ! $id || is_user_logged_in() && current_user_can( 'edit_pages' ) ) {
		return; // Editors browsing the site are not counted.
	}
	?>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','<?php echo esc_js( $id ); ?>');</script>
	<?php
}, 3 );

add_action( 'wp_body_open', function () {
	$id = solevo_opt( 'gtm_id' );
	if ( ! $id || is_user_logged_in() && current_user_can( 'edit_pages' ) ) {
		return;
	}
	printf( '<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=%s" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>', esc_attr( $id ) );
} );
