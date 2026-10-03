<?php
/**
 * Front-page enquiry form handler.
 *
 * @package Sulekha_KPO
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Handle enquiry submissions.
 */
function sulekha_handle_enquiry() {
	$back = wp_get_referer() ? wp_get_referer() : home_url( '/' );
	$back = remove_query_arg( 'enquiry', $back );

	if ( ! isset( $_POST['sulekha_enquiry_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['sulekha_enquiry_nonce'] ), 'sulekha_enquiry' ) ) {
		wp_safe_redirect( add_query_arg( 'enquiry', 'error', $back ) . '#contact' );
		exit;
	}

	// Honeypot: bots fill hidden fields.
	if ( ! empty( $_POST['website'] ) ) {
		wp_safe_redirect( add_query_arg( 'enquiry', 'sent', $back ) . '#contact' );
		exit;
	}

	$name    = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
	$email   = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$company = isset( $_POST['company'] ) ? sanitize_text_field( wp_unslash( $_POST['company'] ) ) : '';
	$service = isset( $_POST['service'] ) ? sanitize_text_field( wp_unslash( $_POST['service'] ) ) : '';
	$message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

	if ( '' === $name || ! is_email( $email ) || '' === $message ) {
		wp_safe_redirect( add_query_arg( 'enquiry', 'invalid', $back ) . '#contact' );
		exit;
	}

	$to = sulekha_mod( 'enquiry_to' );
	if ( ! is_email( $to ) ) {
		$to = get_option( 'admin_email' );
	}

	/* translators: 1: name, 2: site name */
	$subject = sprintf( __( 'New enquiry from %1$s via %2$s', 'sulekha-kpo' ), $name, get_bloginfo( 'name' ) );
	$body    = implode(
		"\n",
		array(
			__( 'Name', 'sulekha-kpo' ) . ': ' . $name,
			__( 'Email', 'sulekha-kpo' ) . ': ' . $email,
			__( 'Company', 'sulekha-kpo' ) . ': ' . $company,
			__( 'Service', 'sulekha-kpo' ) . ': ' . $service,
			'',
			$message,
		)
	);
	$headers = array( 'Reply-To: ' . $name . ' <' . $email . '>' );

	$sent = wp_mail( $to, $subject, $body, $headers );

	wp_safe_redirect( add_query_arg( 'enquiry', $sent ? 'sent' : 'error', $back ) . '#contact' );
	exit;
}
add_action( 'admin_post_nopriv_sulekha_enquiry', 'sulekha_handle_enquiry' );
add_action( 'admin_post_sulekha_enquiry', 'sulekha_handle_enquiry' );
