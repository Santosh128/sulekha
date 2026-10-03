<?php
/**
 * Site header.
 *
 * @package Sulekha_KPO
 */

$sulekha_email = sulekha_mod( 'contact_email' );
$sulekha_phone = sulekha_mod( 'contact_phone' );
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'sulekha-kpo' ); ?></a>

<div class="topbar">
	<div class="container topbar-inner">
		<ul class="topbar-contact">
			<?php if ( $sulekha_phone ) : ?>
				<li><?php echo sulekha_icon( 'phone' ); // phpcs:ignore WordPress.Security.EscapeOutput ?><a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $sulekha_phone ) ); ?>"><?php echo esc_html( $sulekha_phone ); ?></a></li>
			<?php endif; ?>
			<?php if ( $sulekha_email ) : ?>
				<li><?php echo sulekha_icon( 'mail' ); // phpcs:ignore WordPress.Security.EscapeOutput ?><a href="mailto:<?php echo esc_attr( antispambot( $sulekha_email ) ); ?>"><?php echo esc_html( antispambot( $sulekha_email ) ); ?></a></li>
			<?php endif; ?>
			<?php if ( sulekha_mod( 'contact_address' ) ) : ?>
				<li class="topbar-hide-sm"><?php echo sulekha_icon( 'pin' ); // phpcs:ignore WordPress.Security.EscapeOutput ?><span><?php echo esc_html( strtok( sulekha_mod( 'contact_address' ), "\n" ) ); ?></span></li>
			<?php endif; ?>
		</ul>
		<div class="topbar-right">
			<?php if ( sulekha_mod( 'contact_hours' ) ) : ?>
				<span class="topbar-hours"><?php echo sulekha_icon( 'clock' ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php echo esc_html( sulekha_mod( 'contact_hours' ) ); ?></span>
			<?php endif; ?>
			<?php foreach ( array( 'linkedin', 'twitter', 'facebook' ) as $sulekha_network ) : ?>
				<?php if ( sulekha_mod( 'social_' . $sulekha_network ) ) : ?>
					<a class="topbar-social" href="<?php echo esc_url( sulekha_mod( 'social_' . $sulekha_network ) ); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr( ucfirst( $sulekha_network ) ); ?>"><?php echo sulekha_icon( $sulekha_network ); // phpcs:ignore WordPress.Security.EscapeOutput ?></a>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
	</div>
</div>

<header class="site-header" id="site-header">
	<div class="container header-inner">
		<div class="site-branding">
			<?php sulekha_logo(); ?>
		</div>

		<button class="nav-toggle" aria-controls="primary-nav" aria-expanded="false">
			<span class="nav-toggle-open"><?php echo sulekha_icon( 'menu' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
			<span class="nav-toggle-close"><?php echo sulekha_icon( 'close' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
			<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'sulekha-kpo' ); ?></span>
		</button>

		<nav class="primary-nav" id="primary-nav" aria-label="<?php esc_attr_e( 'Primary', 'sulekha-kpo' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'menu',
					'fallback_cb'    => 'sulekha_menu_fallback',
					'depth'          => 2,
				)
			);
			?>
			<a class="btn btn-amber btn-sm header-cta" href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" data-open-quote><?php esc_html_e( 'Get a quote', 'sulekha-kpo' ); ?> <?php echo sulekha_icon( 'arrow-right' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></a>
		</nav>
	</div>
</header>

<main id="main" class="site-main">
