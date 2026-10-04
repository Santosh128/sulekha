<?php
/**
 * Careers: resume submission handler.
 *
 * Resumes are emailed as attachments and deleted from the server straight after,
 * so applicants' personal documents are never stored in the public uploads folder.
 *
 * @package Sulekha_KPO
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Allowed resume file types (extension => MIME type).
 *
 * @return array
 */
function sulekha_resume_mimes() {
	return array(
		'pdf'  => 'application/pdf',
		'doc'  => 'application/msword',
		'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
	);
}

/**
 * Largest resume accepted, in bytes: 5 MB or the server's upload limit, whichever is smaller.
 *
 * @return int
 */
function sulekha_resume_max_size() {
	return (int) min( 5 * MB_IN_BYTES, wp_max_upload_size() );
}

/**
 * Roles applicants can choose from.
 *
 * @return array
 */
function sulekha_career_roles() {
	return array(
		__( 'Export documentation', 'sulekha-kpo' ),
		__( 'BPO calling process', 'sulekha-kpo' ),
		__( 'Other / general application', 'sulekha-kpo' ),
	);
}

/**
 * Experience levels applicants can choose from.
 *
 * @return array
 */
function sulekha_career_experience() {
	return array(
		__( 'Fresher', 'sulekha-kpo' ),
		__( '1–2 years', 'sulekha-kpo' ),
		__( '3+ years', 'sulekha-kpo' ),
	);
}

/**
 * Redirect back to the careers section with a status code.
 *
 * @param string $status Status key.
 */
function sulekha_application_redirect( $status ) {
	$back = wp_get_referer() ? wp_get_referer() : home_url( '/' );
	$back = remove_query_arg( array( 'application', 'enquiry' ), $back );
	wp_safe_redirect( add_query_arg( 'application', $status, $back ) . '#careers' );
	exit;
}

/**
 * Handle resume submissions.
 */
function sulekha_handle_application() {
	// PHP drops the whole POST body when it exceeds post_max_size.
	if ( empty( $_POST ) && ! empty( $_SERVER['CONTENT_LENGTH'] ) ) {
		sulekha_application_redirect( 'toolarge' );
	}

	if ( ! isset( $_POST['sulekha_application_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['sulekha_application_nonce'] ), 'sulekha_application' ) ) {
		sulekha_application_redirect( 'error' );
	}

	// Honeypot: bots fill hidden fields.
	if ( ! empty( $_POST['website'] ) ) {
		sulekha_application_redirect( 'sent' );
	}

	$name       = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
	$email      = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$phone      = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
	$role       = isset( $_POST['role'] ) ? sanitize_text_field( wp_unslash( $_POST['role'] ) ) : '';
	$experience = isset( $_POST['experience'] ) ? sanitize_text_field( wp_unslash( $_POST['experience'] ) ) : '';
	$message    = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';
	$consent    = ! empty( $_POST['consent'] );

	if ( '' === $name || ! is_email( $email ) || ! $consent ) {
		sulekha_application_redirect( 'invalid' );
	}

	// Validate the uploaded resume.
	$file = isset( $_FILES['resume'] ) ? $_FILES['resume'] : null; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput
	if ( ! $file || ! isset( $file['error'] ) || is_array( $file['error'] ) ) {
		sulekha_application_redirect( 'nofile' );
	}
	if ( in_array( $file['error'], array( UPLOAD_ERR_INI_SIZE, UPLOAD_ERR_FORM_SIZE ), true ) || (int) $file['size'] > sulekha_resume_max_size() ) {
		sulekha_application_redirect( 'toolarge' );
	}
	if ( UPLOAD_ERR_OK !== $file['error'] || ! is_uploaded_file( $file['tmp_name'] ) ) {
		sulekha_application_redirect( UPLOAD_ERR_NO_FILE === $file['error'] ? 'nofile' : 'error' );
	}

	$check = wp_check_filetype_and_ext( $file['tmp_name'], $file['name'], sulekha_resume_mimes() );
	if ( empty( $check['ext'] ) || empty( $check['type'] ) ) {
		sulekha_application_redirect( 'filetype' );
	}

	// Move into a private temp folder under a clean name so the attachment is readable.
	$dir = trailingslashit( get_temp_dir() ) . 'sulekha-resume-' . wp_generate_password( 16, false );
	if ( ! wp_mkdir_p( $dir ) ) {
		sulekha_application_redirect( 'error' );
	}
	$slug = sanitize_file_name( sanitize_title( $name ) );
	$path = $dir . '/resume-' . ( $slug ? $slug : 'applicant' ) . '.' . $check['ext'];
	if ( ! move_uploaded_file( $file['tmp_name'], $path ) ) {
		@rmdir( $dir ); // phpcs:ignore WordPress.PHP.NoSilencedErrors
		sulekha_application_redirect( 'error' );
	}

	$to = sulekha_mod( 'careers_to' );
	if ( ! is_email( $to ) ) {
		$to = is_email( sulekha_mod( 'enquiry_to' ) ) ? sulekha_mod( 'enquiry_to' ) : get_option( 'admin_email' );
	}

	/* translators: 1: applicant name, 2: role */
	$subject = sprintf( __( 'Job application: %1$s (%2$s)', 'sulekha-kpo' ), $name, $role ? $role : __( 'General', 'sulekha-kpo' ) );
	$body    = implode(
		"\n",
		array(
			__( 'Name', 'sulekha-kpo' ) . ': ' . $name,
			__( 'Email', 'sulekha-kpo' ) . ': ' . $email,
			__( 'Phone', 'sulekha-kpo' ) . ': ' . $phone,
			__( 'Role', 'sulekha-kpo' ) . ': ' . $role,
			__( 'Experience', 'sulekha-kpo' ) . ': ' . $experience,
			'',
			$message,
			'',
			__( 'The resume is attached. It has not been stored on the website.', 'sulekha-kpo' ),
		)
	);
	$headers = array( 'Reply-To: ' . $name . ' <' . $email . '>' );

	$sent = wp_mail( $to, $subject, $body, $headers, array( $path ) );

	wp_delete_file( $path );
	@rmdir( $dir ); // phpcs:ignore WordPress.PHP.NoSilencedErrors

	sulekha_application_redirect( $sent ? 'sent' : 'error' );
}
add_action( 'admin_post_nopriv_sulekha_application', 'sulekha_handle_application' );
add_action( 'admin_post_sulekha_application', 'sulekha_handle_application' );
