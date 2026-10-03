<?php
/**
 * Single post / service template.
 *
 * @package Sulekha_KPO
 */

get_header();

while ( have_posts() ) :
	the_post();
	$sulekha_is_service = 'kpo_service' === get_post_type();

	if ( $sulekha_is_service ) {
		$sulekha_eyebrow = __( 'Service', 'sulekha-kpo' );
		$sulekha_text    = has_excerpt() ? get_the_excerpt() : '';
	} else {
		$sulekha_cat     = get_the_category();
		$sulekha_eyebrow = $sulekha_cat ? $sulekha_cat[0]->name : __( 'Insights', 'sulekha-kpo' );
		$sulekha_text    = sprintf( '%1$s &middot; %2$s', esc_html( get_the_date() ), esc_html( sulekha_reading_time() ) );
	}

	get_template_part(
		'template-parts/page-hero',
		null,
		array(
			'eyebrow' => $sulekha_eyebrow,
			'title'   => get_the_title(),
			'text'    => $sulekha_text,
		)
	);
	?>
	<section class="section">
		<div class="container narrow">
			<?php if ( has_post_thumbnail() ) : ?>
				<figure class="featured-image"><?php the_post_thumbnail( 'large' ); ?></figure>
			<?php endif; ?>

			<div class="entry-content">
				<?php
				the_content();
				wp_link_pages();
				?>
			</div>

			<?php if ( $sulekha_is_service ) : ?>
				<div class="inline-cta">
					<div>
						<h2><?php esc_html_e( 'Ready to get started?', 'sulekha-kpo' ); ?></h2>
						<p><?php esc_html_e( 'Tell us about your requirements and we’ll propose a pilot.', 'sulekha-kpo' ); ?></p>
					</div>
					<a class="btn btn-primary" href="<?php echo esc_url( home_url( '/#contact' ) ); ?>"><?php esc_html_e( 'Talk to our team', 'sulekha-kpo' ); ?></a>
				</div>
			<?php else : ?>
				<?php
				the_tags( '<p class="tag-list">', '', '</p>' );
				the_post_navigation(
					array(
						'prev_text' => '<small>' . __( 'Previous', 'sulekha-kpo' ) . '</small><span>%title</span>',
						'next_text' => '<small>' . __( 'Next', 'sulekha-kpo' ) . '</small><span>%title</span>',
					)
				);
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
				?>
			<?php endif; ?>
		</div>
	</section>
	<?php
endwhile;

get_footer();
