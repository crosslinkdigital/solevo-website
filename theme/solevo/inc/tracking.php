<?php
/**
 * Google Tag Manager container (ID set in Settings > Solevo).
 * Click events pushed to the dataLayer by assets/js/site.js:
 *   click_book_physio, click_book_class, click_call, click_email, form_submit
 *
 * @package Solevo
 */

defined( 'ABSPATH' ) || exit;

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
