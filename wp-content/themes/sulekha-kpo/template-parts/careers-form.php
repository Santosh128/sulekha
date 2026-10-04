<?php
/**
 * Resume submission form.
 *
 * @package Sulekha_KPO
 */

$sulekha_status = isset( $_GET['application'] ) ? sanitize_key( $_GET['application'] ) : ''; // phpcs:ignore WordPress.Security.NonceVerification
$sulekha_max    = size_format( sulekha_resume_max_size() );
$sulekha_notes  = array(
	'sent'     => array( 'success', __( 'Thank you for applying! We’ll review your resume and get in touch if there’s a fit.', 'sulekha-kpo' ) ),
	'invalid'  => array( 'error', __( 'Please fill in your name and a valid email, and tick the consent box.', 'sulekha-kpo' ) ),
	'nofile'   => array( 'error', __( 'Please attach your resume.', 'sulekha-kpo' ) ),
	/* translators: %s: maximum file size */
	'toolarge' => array( 'error', sprintf( __( 'Your resume is too large. Please upload a file under %s.', 'sulekha-kpo' ), $sulekha_max ) ),
	'filetype' => array( 'error', __( 'Please upload your resume as a PDF, DOC or DOCX file.', 'sulekha-kpo' ) ),
	'error'    => array( 'error', __( 'Sorry, your application could not be sent. Please try again or email us directly.', 'sulekha-kpo' ) ),
);
$sulekha_accept = '.' . implode( ',.', array_keys( sulekha_resume_mimes() ) ) . ',' . implode( ',', sulekha_resume_mimes() );
?>
<form class="enquiry-form careers-form" method="post" enctype="multipart/form-data" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
	<?php if ( isset( $sulekha_notes[ $sulekha_status ] ) ) : ?>
		<p class="form-notice form-notice-<?php echo esc_attr( $sulekha_notes[ $sulekha_status ][0] ); ?>" role="status"><?php echo esc_html( $sulekha_notes[ $sulekha_status ][1] ); ?></p>
	<?php endif; ?>

	<input type="hidden" name="action" value="sulekha_application">
	<input type="hidden" name="sulekha_application_nonce" value="<?php echo esc_attr( wp_create_nonce( 'sulekha_application' ) ); ?>">
	<input type="hidden" name="_wp_http_referer" value="<?php echo esc_attr( wp_unslash( $_SERVER['REQUEST_URI'] ?? '' ) ); ?>">
	<div class="hp" aria-hidden="true"><label>Website <input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>

	<div class="form-row">
		<label><span><?php esc_html_e( 'Full name', 'sulekha-kpo' ); ?> *</span><input type="text" name="name" required autocomplete="name"></label>
		<label><span><?php esc_html_e( 'Email', 'sulekha-kpo' ); ?> *</span><input type="email" name="email" required autocomplete="email"></label>
	</div>
	<div class="form-row">
		<label><span><?php esc_html_e( 'Phone', 'sulekha-kpo' ); ?></span><input type="tel" name="phone" autocomplete="tel"></label>
		<label><span><?php esc_html_e( 'Experience', 'sulekha-kpo' ); ?></span>
			<select name="experience">
				<?php foreach ( sulekha_career_experience() as $sulekha_level ) : ?>
					<option><?php echo esc_html( $sulekha_level ); ?></option>
				<?php endforeach; ?>
			</select>
		</label>
	</div>
	<label><span><?php esc_html_e( 'Area of interest', 'sulekha-kpo' ); ?></span>
		<select name="role">
			<?php foreach ( sulekha_career_roles() as $sulekha_role ) : ?>
				<option><?php echo esc_html( $sulekha_role ); ?></option>
			<?php endforeach; ?>
		</select>
	</label>

	<div class="file-drop" data-file-drop data-max="<?php echo esc_attr( sulekha_resume_max_size() ); ?>">
		<input class="file-drop-input" type="file" name="resume" id="sulekha-resume" accept="<?php echo esc_attr( $sulekha_accept ); ?>" required aria-describedby="sulekha-resume-hint">
		<span class="file-drop-icon"><?php echo sulekha_icon( 'upload' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
		<span class="file-drop-text" data-file-label><strong><?php esc_html_e( 'Drop your resume here', 'sulekha-kpo' ); ?></strong> <?php esc_html_e( 'or click to browse', 'sulekha-kpo' ); ?></span>
		<span class="file-drop-hint" id="sulekha-resume-hint">
			<?php
			/* translators: %s: maximum file size */
			echo esc_html( sprintf( __( 'PDF, DOC or DOCX · max %s', 'sulekha-kpo' ), $sulekha_max ) );
			?>
		</span>
	</div>

	<label><span><?php esc_html_e( 'Anything you’d like us to know?', 'sulekha-kpo' ); ?></span><textarea name="message" rows="3"></textarea></label>

	<label class="check-field">
		<input type="checkbox" name="consent" value="1" required>
		<span><?php esc_html_e( 'I agree that Sulekha Enterprises may use my details and resume to assess my application.', 'sulekha-kpo' ); ?> *</span>
	</label>

	<button type="submit" class="btn btn-primary btn-block"><?php esc_html_e( 'Submit application', 'sulekha-kpo' ); ?> <?php echo sulekha_icon( 'arrow-right' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></button>
</form>
