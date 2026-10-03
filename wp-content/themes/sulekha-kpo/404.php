<?php
/**
 * 404 template.
 *
 * @package Sulekha_KPO
 */

get_header();
get_template_part(
	'template-parts/page-hero',
	null,
	array(
		'eyebrow' => '404',
		'title'   => __( 'Page not found', 'sulekha-kpo' ),
		'text'    => __( 'The page you’re looking for may have moved. Try searching, or head back home.', 'sulekha-kpo' ),
	)
);
?>
<section class="section">
	<div class="container narrow empty-state">
		<?php get_search_form(); ?>
		<p><a class="btn btn-primary" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to home', 'sulekha-kpo' ); ?></a></p>
	</div>
</section>
<?php
get_footer();
