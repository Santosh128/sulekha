<?php
/**
 * Inner-page banner.
 *
 * Expects $args with 'title', optional 'eyebrow' and 'text'.
 *
 * @package Sulekha_KPO
 */

$sulekha_args = wp_parse_args(
	$args,
	array(
		'eyebrow' => '',
		'title'   => '',
		'text'    => '',
	)
);
$sulekha_bg   = sulekha_mod( 'slide1_image' );
?>
<section class="page-hero"<?php echo $sulekha_bg ? ' style="--page-hero-bg:url(\'' . esc_url( $sulekha_bg ) . '\')"' : ''; ?>>
	<div class="container">
		<nav class="breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'sulekha-kpo' ); ?>">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'sulekha-kpo' ); ?></a>
			<?php echo sulekha_icon( 'chev-right' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
			<span aria-current="page"><?php echo esc_html( $sulekha_args['eyebrow'] ? $sulekha_args['eyebrow'] : wp_strip_all_tags( $sulekha_args['title'] ) ); ?></span>
		</nav>
		<h1><?php echo wp_kses_post( $sulekha_args['title'] ); ?></h1>
		<?php if ( $sulekha_args['text'] ) : ?>
			<p class="lead"><?php echo wp_kses_post( $sulekha_args['text'] ); ?></p>
		<?php endif; ?>
	</div>
	<svg class="hero-wave" viewBox="0 0 1440 90" preserveAspectRatio="none" aria-hidden="true"><path d="M0 90V52c180-34 360-50 540-34s360 56 540 56 270-28 360-46v62Z"/></svg>
</section>
