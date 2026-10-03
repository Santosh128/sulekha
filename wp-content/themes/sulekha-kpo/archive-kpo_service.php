<?php
/**
 * Services archive (/services/).
 *
 * @package Sulekha_KPO
 */

get_header();

get_template_part(
	'template-parts/page-hero',
	null,
	array(
		'eyebrow' => __( 'What we do', 'sulekha-kpo' ),
		'title'   => __( 'Our services', 'sulekha-kpo' ),
		'text'    => __( 'Specialist knowledge teams for research, analytics, finance, legal and healthcare operations.', 'sulekha-kpo' ),
	)
);
?>
<section class="section">
	<div class="container">
		<div class="card-grid">
			<?php foreach ( sulekha_get_services() as $sulekha_service ) : ?>
				<article class="service-card reveal">
					<span class="icon-badge"><?php echo sulekha_icon( $sulekha_service['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
					<h3>
						<?php if ( $sulekha_service['url'] ) : ?>
							<a href="<?php echo esc_url( $sulekha_service['url'] ); ?>" class="stretched-link"><?php echo esc_html( $sulekha_service['title'] ); ?></a>
						<?php else : ?>
							<?php echo esc_html( $sulekha_service['title'] ); ?>
						<?php endif; ?>
					</h3>
					<p><?php echo esc_html( wp_strip_all_tags( $sulekha_service['text'] ) ); ?></p>
					<?php if ( $sulekha_service['url'] ) : ?>
						<span class="card-link"><?php esc_html_e( 'Learn more', 'sulekha-kpo' ); ?> <?php echo sulekha_icon( 'arrow-right' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
					<?php endif; ?>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php
get_footer();
