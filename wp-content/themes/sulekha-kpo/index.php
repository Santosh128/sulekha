<?php
/**
 * Blog, archive and search listing.
 *
 * @package Sulekha_KPO
 */

get_header();

if ( is_search() ) {
	/* translators: %s: search query */
	$sulekha_title   = sprintf( __( 'Results for “%s”', 'sulekha-kpo' ), esc_html( get_search_query() ) );
	$sulekha_eyebrow = __( 'Search', 'sulekha-kpo' );
	$sulekha_text    = '';
} elseif ( is_archive() ) {
	$sulekha_title   = get_the_archive_title();
	$sulekha_eyebrow = __( 'Archive', 'sulekha-kpo' );
	$sulekha_text    = get_the_archive_description();
} elseif ( is_home() && get_option( 'page_for_posts' ) ) {
	$sulekha_title   = get_the_title( get_option( 'page_for_posts' ) );
	$sulekha_eyebrow = __( 'Insights', 'sulekha-kpo' );
	$sulekha_text    = '';
} else {
	$sulekha_title   = __( 'Insights', 'sulekha-kpo' );
	$sulekha_eyebrow = get_bloginfo( 'name' );
	$sulekha_text    = get_bloginfo( 'description' );
}

get_template_part(
	'template-parts/page-hero',
	null,
	array(
		'eyebrow' => $sulekha_eyebrow,
		'title'   => $sulekha_title,
		'text'    => $sulekha_text,
	)
);
?>

<section class="section">
	<div class="container">
		<?php if ( have_posts() ) : ?>
			<div class="post-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/card', 'post' );
				endwhile;
				?>
			</div>
			<?php sulekha_pagination(); ?>
		<?php else : ?>
			<div class="empty-state narrow">
				<h2><?php esc_html_e( 'Nothing found', 'sulekha-kpo' ); ?></h2>
				<p><?php esc_html_e( 'Try a different search term.', 'sulekha-kpo' ); ?></p>
				<?php get_search_form(); ?>
			</div>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();
