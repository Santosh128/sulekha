<?php
/**
 * Site footer.
 *
 * @package Sulekha_KPO
 */

$sulekha_socials = array(
	'linkedin' => sulekha_mod( 'social_linkedin' ),
	'twitter'  => sulekha_mod( 'social_twitter' ),
	'facebook' => sulekha_mod( 'social_facebook' ),
);
?>
</main>

<footer class="site-footer">
	<svg class="footer-wave" viewBox="0 0 1440 60" preserveAspectRatio="none" aria-hidden="true"><path d="M0 60V28C240 4 480 0 720 18s480 36 720 10V60Z"/></svg>
	<div class="container footer-grid">
		<div class="footer-brand">
			<div class="footer-logo"><?php sulekha_logo(); ?></div>
			<p><?php echo esc_html( sulekha_mod( 'footer_about' ) ); ?></p>
			<?php if ( array_filter( $sulekha_socials ) ) : ?>
				<ul class="social-links">
					<?php foreach ( $sulekha_socials as $sulekha_network => $sulekha_url ) : ?>
						<?php if ( $sulekha_url ) : ?>
							<li><a href="<?php echo esc_url( $sulekha_url ); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr( ucfirst( $sulekha_network ) ); ?>"><?php echo sulekha_icon( $sulekha_network ); // phpcs:ignore WordPress.Security.EscapeOutput ?></a></li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>

		<div class="footer-col">
			<h3><?php esc_html_e( 'Services', 'sulekha-kpo' ); ?></h3>
			<ul>
				<?php foreach ( array_slice( sulekha_get_services(), 0, 6 ) as $sulekha_service ) : ?>
					<li><a href="<?php echo esc_url( $sulekha_service['url'] ? $sulekha_service['url'] : home_url( '/#services' ) ); ?>"><?php echo esc_html( $sulekha_service['title'] ); ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>

		<div class="footer-col">
			<h3><?php esc_html_e( 'Company', 'sulekha-kpo' ); ?></h3>
			<?php
			if ( has_nav_menu( 'footer' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'container'      => false,
						'depth'          => 1,
					)
				);
			} else {
				sulekha_menu_fallback();
			}
			?>
		</div>

		<div class="footer-col">
			<h3><?php esc_html_e( 'Get in touch', 'sulekha-kpo' ); ?></h3>
			<ul class="contact-list">
				<?php if ( sulekha_mod( 'contact_email' ) ) : ?>
					<li><?php echo sulekha_icon( 'mail' ); // phpcs:ignore WordPress.Security.EscapeOutput ?><a href="mailto:<?php echo esc_attr( antispambot( sulekha_mod( 'contact_email' ) ) ); ?>"><?php echo esc_html( antispambot( sulekha_mod( 'contact_email' ) ) ); ?></a></li>
				<?php endif; ?>
				<?php if ( sulekha_mod( 'contact_phone' ) ) : ?>
					<li><?php echo sulekha_icon( 'phone' ); // phpcs:ignore WordPress.Security.EscapeOutput ?><a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', sulekha_mod( 'contact_phone' ) ) ); ?>"><?php echo esc_html( sulekha_mod( 'contact_phone' ) ); ?></a></li>
				<?php endif; ?>
				<?php if ( sulekha_mod( 'contact_address' ) ) : ?>
					<li><?php echo sulekha_icon( 'pin' ); // phpcs:ignore WordPress.Security.EscapeOutput ?><span><?php echo nl2br( esc_html( sulekha_mod( 'contact_address' ) ) ); ?></span></li>
				<?php endif; ?>
			</ul>
		</div>
	</div>

	<div class="container footer-bottom">
		<p>&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All rights reserved.', 'sulekha-kpo' ); ?></p>
		<?php if ( function_exists( 'the_privacy_policy_link' ) ) : ?>
			<?php the_privacy_policy_link(); ?>
		<?php endif; ?>
	</div>
</footer>

<dialog class="quote-dialog" id="quote-dialog" aria-labelledby="quote-dialog-title">
	<div class="quote-dialog-inner">
		<div class="quote-dialog-aside">
			<div class="footer-logo"><?php sulekha_logo(); ?></div>
			<h2 id="quote-dialog-title"><?php esc_html_e( 'Get a tailored quote', 'sulekha-kpo' ); ?></h2>
			<p><?php esc_html_e( 'Share a few details and a solutions lead will reply within one business day.', 'sulekha-kpo' ); ?></p>
			<ul class="check-list">
				<li><?php echo sulekha_icon( 'check' ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php esc_html_e( 'Free scoping call', 'sulekha-kpo' ); ?></li>
				<li><?php echo sulekha_icon( 'check' ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php esc_html_e( 'Pilot before you commit', 'sulekha-kpo' ); ?></li>
				<li><?php echo sulekha_icon( 'check' ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php esc_html_e( 'NDA on request', 'sulekha-kpo' ); ?></li>
			</ul>
		</div>
		<?php get_template_part( 'template-parts/enquiry-form' ); ?>
	</div>
	<button class="quote-dialog-close" type="button" data-close-quote aria-label="<?php esc_attr_e( 'Close', 'sulekha-kpo' ); ?>"><?php echo sulekha_icon( 'close' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></button>
</dialog>

<div class="floating-actions">
	<?php $sulekha_wa = preg_replace( '/\D/', '', sulekha_mod( 'whatsapp' ) ); ?>
	<?php if ( $sulekha_wa ) : ?>
		<a class="fab fab-whatsapp" href="<?php echo esc_url( 'https://wa.me/' . $sulekha_wa ); ?>" target="_blank" rel="noopener" aria-label="<?php esc_attr_e( 'Chat on WhatsApp', 'sulekha-kpo' ); ?>"><?php echo sulekha_icon( 'whatsapp' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></a>
	<?php endif; ?>
	<a class="fab fab-top" href="#main" aria-label="<?php esc_attr_e( 'Back to top', 'sulekha-kpo' ); ?>"><?php echo sulekha_icon( 'arrow-up' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></a>
</div>

<?php wp_footer(); ?>
</body>
</html>
