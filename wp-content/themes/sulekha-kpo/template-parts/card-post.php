<?php
/**
 * Post card used in grids.
 *
 * @package Sulekha_KPO
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card reveal' ); ?>>
	<a class="post-card-media" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'sulekha-card', array( 'loading' => 'lazy', 'alt' => '' ) ); ?>
		<?php else : ?>
			<span class="post-card-placeholder"><?php echo sulekha_icon( 'layers' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
		<?php endif; ?>
		<time class="date-badge" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><strong><?php echo esc_html( get_the_date( 'd' ) ); ?></strong><?php echo esc_html( get_the_date( 'M' ) ); ?></time>
	</a>
	<div class="post-card-body">
		<p class="meta">
			<?php
			$sulekha_cat = get_the_category();
			if ( $sulekha_cat ) {
				echo '<span class="meta-cat">' . esc_html( $sulekha_cat[0]->name ) . '</span>';
			}
			?>
			<span><?php echo esc_html( sulekha_reading_time() ); ?></span>
		</p>
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<p><?php echo esc_html( get_the_excerpt() ); ?></p>
		<a class="card-link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more', 'sulekha-kpo' ); ?> <?php echo sulekha_icon( 'arrow-right' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></a>
	</div>
</article>
