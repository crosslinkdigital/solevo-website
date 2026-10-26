<?php
/**
 * Settings > Solevo: the business details and booking links used across the site.
 * One source of truth so name, address and phone stay identical everywhere (local SEO).
 *
 * @package Solevo
 */

defined( 'ABSPATH' ) || exit;

function solevo_setting_fields() {
	return array(
		'business_name' => array( 'label' => 'Business name', 'default' => 'Solevo Physio & Studio', 'type' => 'text' ),
		'address'       => array( 'label' => 'Address', 'default' => '4/42-46 Wattle Road, Brookvale NSW 2100', 'type' => 'text', 'help' => 'Street address, a comma, then suburb, state and postcode. Exactly as on the Google Business Profile.' ),
		'phone'         => array( 'label' => 'Phone (display)', 'default' => '1300 366 826', 'type' => 'text', 'help' => 'Shown in header, footer and Contact. Buttons linked to #phone call this number.' ),
		'email'         => array( 'label' => 'Email', 'default' => 'hello@solevo.com.au', 'type' => 'email' ),
		'hours'         => array( 'label' => 'Opening hours', 'default' => '', 'type' => 'textarea', 'help' => 'One line per day, e.g. "Mon to Fri: 6am to 7pm".' ),
		'location1_area'    => array( 'label' => 'Location 1: suburb', 'default' => 'Brookvale', 'type' => 'text', 'help' => 'Main location. Uses the business name, address, phone and opening hours above.' ),
		'location1_access'  => array( 'label' => 'Location 1: entry note', 'default' => 'Entry via Mitchell Road', 'type' => 'text', 'help' => 'Shown under the street address in the footer and on location cards. Kept out of the address itself so it still matches Google exactly. Leave empty to hide.' ),
		'location1_note'    => array( 'label' => 'Location 1: what runs here', 'default' => 'Physiotherapy, Clinical Pilates and Studio classes. Shared with The Foot Company podiatry.', 'type' => 'text' ),
		'location2_name'    => array( 'label' => 'Location 2: venue name', 'default' => 'Terrey Hills Medical Centre', 'type' => 'text', 'help' => 'Leave empty to hide the second location everywhere.' ),
		'location2_area'    => array( 'label' => 'Location 2: suburb', 'default' => 'Terrey Hills', 'type' => 'text' ),
		'location2_address' => array( 'label' => 'Location 2: address', 'default' => '17 Yulong Avenue, Terrey Hills NSW 2084', 'type' => 'text', 'help' => 'Full street address, exactly as on the Google Business Profile.' ),
		'location2_hours'   => array( 'label' => 'Location 2: physio hours', 'default' => 'Wednesday: 8:00am to 3:30pm', 'type' => 'textarea', 'help' => 'One line per day.' ),
		'location2_note'    => array( 'label' => 'Location 2: what runs here', 'default' => 'Physiotherapy only.', 'type' => 'text' ),
		'cliniko_url'   => array( 'label' => 'Cliniko booking URL (physio)', 'default' => '', 'type' => 'url', 'help' => 'Every button or link pointing to #cliniko uses this URL.' ),
		'cliniko_url_location1' => array( 'label' => 'Cliniko link: location 1', 'default' => '', 'type' => 'url', 'help' => 'Optional. In Cliniko, copy the online booking link for this business (and practitioner or appointment type if wanted). Used by #cliniko-location1 buttons. Falls back to the main Cliniko URL.' ),
		'cliniko_url_location2' => array( 'label' => 'Cliniko link: location 2', 'default' => '', 'type' => 'url', 'help' => 'Optional. Same for location 2. Used by #cliniko-location2 buttons.' ),
		'mindbody_url'  => array( 'label' => 'Mindbody booking URL (classes)', 'default' => '', 'type' => 'url', 'help' => 'Every button or link pointing to #mindbody uses this URL.' ),
		'mindbody_embed'=> array( 'label' => 'Mindbody timetable embed code', 'default' => '', 'type' => 'code', 'help' => 'Paste the widget code from Mindbody (Branded Web Tools). Shown wherever the Timetable block is used.' ),
		'google_reviews_url' => array( 'label' => 'Google reviews link', 'default' => '', 'type' => 'url', 'help' => 'The "Read reviews" link from the Solevo Google Business Profile. Used by the reviews section until the Trustindex feed is connected. Empty: links to Solevo on Google Maps.' ),
		'instagram_url' => array( 'label' => 'Instagram URL', 'default' => 'https://www.instagram.com/solevo.studio/', 'type' => 'url' ),
		'tfc_url'       => array( 'label' => 'The Foot Company URL', 'default' => '', 'type' => 'url' ),
		'suburbs'       => array( 'label' => 'Suburbs served', 'default' => 'Brookvale, Dee Why, Manly, Freshwater, Curl Curl, Allambie Heights, Frenchs Forest, Narraweena, Cromer, Collaroy', 'type' => 'textarea', 'help' => 'Comma separated. Listed as plain text on Contact.' ),
		'gtm_id'        => array( 'label' => 'Google Tag Manager ID', 'default' => '', 'type' => 'text', 'help' => 'Format GTM-XXXXXXX. Leave empty until GA4 is set up.' ),
	);
}

function solevo_opt( $key ) {
	$fields = solevo_setting_fields();
	$all    = get_option( 'solevo_settings', array() );
	$value  = isset( $all[ $key ] ) && '' !== $all[ $key ] ? $all[ $key ] : ( $fields[ $key ]['default'] ?? '' );
	return is_string( $value ) ? $value : '';
}

add_action( 'admin_menu', function () {
	add_options_page( 'Solevo settings', 'Solevo', 'manage_options', 'solevo-settings', 'solevo_render_settings_page' );
} );

add_action( 'admin_init', function () {
	register_setting( 'solevo_settings', 'solevo_settings', array(
		'type'              => 'array',
		'sanitize_callback' => 'solevo_sanitize_settings',
	) );
} );

function solevo_sanitize_settings( $input ) {
	$clean = array();
	foreach ( solevo_setting_fields() as $key => $field ) {
		$value = isset( $input[ $key ] ) ? wp_unslash( $input[ $key ] ) : '';
		switch ( $field['type'] ) {
			case 'url':
				$clean[ $key ] = esc_url_raw( trim( $value ) );
				break;
			case 'email':
				$clean[ $key ] = sanitize_email( $value );
				break;
			case 'textarea':
				$clean[ $key ] = sanitize_textarea_field( $value );
				break;
			case 'code':
				// Only admins with unfiltered_html may store raw embed code.
				$clean[ $key ] = current_user_can( 'unfiltered_html' ) ? $value : wp_kses_post( $value );
				break;
			default:
				$clean[ $key ] = sanitize_text_field( $value );
		}
	}
	if ( $clean['gtm_id'] && ! preg_match( '/^GTM-[A-Z0-9]+$/', $clean['gtm_id'] ) ) {
		add_settings_error( 'solevo_settings', 'gtm', 'The Tag Manager ID should look like GTM-XXXXXXX. It was not saved.' );
		$clean['gtm_id'] = '';
	}
	return $clean;
}

function solevo_render_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$all = get_option( 'solevo_settings', array() );
	?>
	<div class="wrap">
		<h1>Solevo settings</h1>
		<p>These details appear in the header, footer, Contact page and every booking button. Change them here once and the whole site updates.</p>
		<?php settings_errors( 'solevo_settings' ); ?>
		<form method="post" action="options.php">
			<?php settings_fields( 'solevo_settings' ); ?>
			<table class="form-table" role="presentation">
				<?php foreach ( solevo_setting_fields() as $key => $field ) :
					$value = $all[ $key ] ?? $field['default'];
					$id    = 'solevo_' . $key;
					$name  = 'solevo_settings[' . $key . ']';
					?>
					<tr>
						<th scope="row"><label for="<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $field['label'] ); ?></label></th>
						<td>
							<?php if ( in_array( $field['type'], array( 'textarea', 'code' ), true ) ) : ?>
								<textarea class="large-text <?php echo 'code' === $field['type'] ? 'code' : ''; ?>" rows="<?php echo 'code' === $field['type'] ? 6 : 3; ?>" id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>"><?php echo esc_textarea( $value ); ?></textarea>
							<?php else : ?>
								<input class="regular-text" type="<?php echo esc_attr( $field['type'] ); ?>" id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $value ); ?>">
							<?php endif; ?>
							<?php if ( ! empty( $field['help'] ) ) : ?>
								<p class="description"><?php echo esc_html( $field['help'] ); ?></p>
							<?php endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</table>
			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}
