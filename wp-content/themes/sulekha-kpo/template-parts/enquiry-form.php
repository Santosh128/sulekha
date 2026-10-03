<?php
/**
 * Enquiry form, used in the contact section and the quote popup.
 *
 * @package Sulekha_KPO
 */

$sulekha_status = isset( $_GET['enquiry'] ) ? sanitize_key( $_GET['enquiry'] ) : ''; // phpcs:ignore WordPress.Security.NonceVerification
$sulekha_notes  = array(
	'sent'    => array( 'success', __( 'Thank you! We’ll be in touch within one business day.', 'sulekha-kpo' ) ),
	'invalid' => array( 'error', __( 'Please fill in your name, a valid email and a message.', 'sulekha-kpo' ) ),
	'error'   => array( 'error', __( 'Sorry, your message could not be sent. Please email us directly.', 'sulekha-kpo' ) ),
);
$sulekha_show_notice = ! empty( $args['notice'] ) && isset( $sulekha_notes[ $sulekha_status ] );
?>
<form class="enquiry-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
	<?php if ( $sulekha_show_notice ) : ?>
		<p class="form-notice form-notice-<?php echo esc_attr( $sulekha_notes[ $sulekha_status ][0] ); ?>" role="status"><?php echo esc_html( $sulekha_notes[ $sulekha_status ][1] ); ?></p>
	<?php endif; ?>

	<input type="hidden" name="action" value="sulekha_enquiry">
	<?php // Manual nonce field: the form appears twice per page, so avoid wp_nonce_field()'s fixed id. ?>
	<input type="hidden" name="sulekha_enquiry_nonce" value="<?php echo esc_attr( wp_create_nonce( 'sulekha_enquiry' ) ); ?>">
	<input type="hidden" name="_wp_http_referer" value="<?php echo esc_attr( wp_unslash( $_SERVER['REQUEST_URI'] ?? '' ) ); ?>">
	<div class="hp" aria-hidden="true"><label>Website <input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>

	<div class="form-row">
		<label><span><?php esc_html_e( 'Full name', 'sulekha-kpo' ); ?> *</span><input type="text" name="name" required autocomplete="name"></label>
		<label><span><?php esc_html_e( 'Work email', 'sulekha-kpo' ); ?> *</span><input type="email" name="email" required autocomplete="email"></label>
	</div>
	<div class="form-row">
		<label><span><?php esc_html_e( 'Company', 'sulekha-kpo' ); ?></span><input type="text" name="company" autocomplete="organization"></label>
		<label><span><?php esc_html_e( 'Service of interest', 'sulekha-kpo' ); ?></span>
			<select name="service">
				<option value=""><?php esc_html_e( 'Select a service', 'sulekha-kpo' ); ?></option>
				<?php foreach ( sulekha_get_services() as $sulekha_service ) : ?>
					<option><?php echo esc_html( $sulekha_service['title'] ); ?></option>
				<?php endforeach; ?>
				<option><?php esc_html_e( 'Something else', 'sulekha-kpo' ); ?></option>
			</select>
		</label>
	</div>
	<label><span><?php esc_html_e( 'How can we help?', 'sulekha-kpo' ); ?> *</span><textarea name="message" rows="4" required></textarea></label>
	<button type="submit" class="btn btn-primary btn-block"><?php esc_html_e( 'Send enquiry', 'sulekha-kpo' ); ?> <?php echo sulekha_icon( 'arrow-right' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></button>
</form>
