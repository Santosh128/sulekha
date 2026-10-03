<?php
/**
 * Front page template.
 *
 * @package Sulekha_KPO
 */

get_header();

$sulekha_services = sulekha_get_services();
$sulekha_slides   = array();
for ( $sulekha_i = 1; $sulekha_i <= 3; $sulekha_i++ ) {
	if ( sulekha_mod( "slide{$sulekha_i}_title" ) ) {
		$sulekha_slides[] = array(
			'image'   => sulekha_mod( "slide{$sulekha_i}_image" ),
			'eyebrow' => sulekha_mod( "slide{$sulekha_i}_eyebrow" ),
			'title'   => sulekha_mod( "slide{$sulekha_i}_title" ),
			'text'    => sulekha_mod( "slide{$sulekha_i}_text" ),
		);
	}
}
$sulekha_img = SULEKHA_URI . '/assets/images/';
?>

<section class="hero" data-slider aria-roledescription="carousel" aria-label="<?php esc_attr_e( 'Highlights', 'sulekha-kpo' ); ?>">
	<?php foreach ( $sulekha_slides as $sulekha_n => $sulekha_slide ) : ?>
		<div class="hero-slide<?php echo 0 === $sulekha_n ? ' is-active' : ''; ?>" role="group" aria-roledescription="slide" aria-label="<?php echo esc_attr( ( $sulekha_n + 1 ) . ' / ' . count( $sulekha_slides ) ); ?>"<?php echo 0 === $sulekha_n ? '' : ' aria-hidden="true"'; ?>>
			<?php if ( $sulekha_slide['image'] ) : ?>
				<div class="hero-slide-bg" style="background-image:url('<?php echo esc_url( $sulekha_slide['image'] ); ?>')"></div>
			<?php endif; ?>
			<div class="container hero-inner">
				<div class="hero-copy">
					<p class="eyebrow eyebrow-light"><?php echo esc_html( $sulekha_slide['eyebrow'] ); ?></p>
					<?php if ( 0 === $sulekha_n ) : ?>
						<h1><?php echo sulekha_accent( $sulekha_slide['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h1>
					<?php else : ?>
						<h2 class="h1"><?php echo sulekha_accent( $sulekha_slide['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
					<?php endif; ?>
					<p class="lead"><?php echo esc_html( $sulekha_slide['text'] ); ?></p>
					<div class="btn-row">
						<a class="btn btn-amber" href="<?php echo esc_url( sulekha_mod( 'hero_cta_url' ) ); ?>"<?php echo 0 === $sulekha_n ? '' : ' tabindex="-1"'; ?>><?php echo esc_html( sulekha_mod( 'hero_cta_label' ) ); ?> <?php echo sulekha_icon( 'arrow-right' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></a>
						<a class="btn btn-ghost" href="<?php echo esc_url( sulekha_mod( 'hero_cta2_url' ) ); ?>"<?php echo 0 === $sulekha_n ? '' : ' tabindex="-1"'; ?>><?php echo esc_html( sulekha_mod( 'hero_cta2_label' ) ); ?></a>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach; ?>

	<?php if ( count( $sulekha_slides ) > 1 ) : ?>
		<div class="container hero-controls">
			<div class="hero-dots" role="tablist">
				<?php foreach ( $sulekha_slides as $sulekha_n => $sulekha_slide ) : ?>
					<button type="button" class="hero-dot<?php echo 0 === $sulekha_n ? ' is-active' : ''; ?>" data-slide="<?php echo esc_attr( $sulekha_n ); ?>" aria-label="<?php echo esc_attr( sprintf( /* translators: %d: slide number */ __( 'Go to slide %d', 'sulekha-kpo' ), $sulekha_n + 1 ) ); ?>"><span></span></button>
				<?php endforeach; ?>
			</div>
			<div class="hero-arrows">
				<button type="button" class="hero-arrow" data-prev aria-label="<?php esc_attr_e( 'Previous slide', 'sulekha-kpo' ); ?>"><?php echo sulekha_icon( 'chev-left' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></button>
				<button type="button" class="hero-arrow" data-next aria-label="<?php esc_attr_e( 'Next slide', 'sulekha-kpo' ); ?>"><?php echo sulekha_icon( 'chev-right' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></button>
			</div>
		</div>
	<?php endif; ?>

	<svg class="hero-wave" viewBox="0 0 1440 90" preserveAspectRatio="none" aria-hidden="true"><path d="M0 90V52c180-34 360-50 540-34s360 56 540 56 270-28 360-46v62Z"/></svg>
</section>

<section class="stats" aria-label="<?php esc_attr_e( 'Key numbers', 'sulekha-kpo' ); ?>">
	<div class="container"><div class="stats-grid">
		<?php for ( $sulekha_i = 1; $sulekha_i <= 4; $sulekha_i++ ) : ?>
			<?php if ( sulekha_mod( "stat{$sulekha_i}_value" ) ) : ?>
				<div class="stat reveal">
					<strong class="stat-value" data-count="<?php echo esc_attr( sulekha_mod( "stat{$sulekha_i}_value" ) ); ?>"><?php echo esc_html( sulekha_mod( "stat{$sulekha_i}_value" ) ); ?></strong>
					<span class="stat-label"><?php echo esc_html( sulekha_mod( "stat{$sulekha_i}_label" ) ); ?></span>
				</div>
			<?php endif; ?>
		<?php endfor; ?>
	</div></div>
</section>

<section class="section about" id="about">
	<div class="container split">
		<div class="about-visual reveal">
			<span class="about-ring" aria-hidden="true"></span>
			<span class="about-dots" aria-hidden="true"></span>
			<?php if ( sulekha_mod( 'about_image' ) ) : ?>
				<img class="about-main" src="<?php echo esc_url( sulekha_mod( 'about_image' ) ); ?>" alt="" loading="lazy" width="1000" height="667">
			<?php endif; ?>
			<?php if ( sulekha_mod( 'about_image2' ) ) : ?>
				<img class="about-inset" src="<?php echo esc_url( sulekha_mod( 'about_image2' ) ); ?>" alt="" loading="lazy" width="500" height="333">
			<?php endif; ?>
			<?php if ( sulekha_mod( 'about_badge' ) ) : ?>
				<div class="about-badge">
					<strong><?php echo esc_html( sulekha_mod( 'about_badge' ) ); ?></strong>
					<span><?php echo esc_html( sulekha_mod( 'about_badge_text' ) ); ?></span>
				</div>
			<?php endif; ?>
		</div>
		<div class="split-copy reveal">
			<p class="script-eyebrow"><?php echo esc_html( sprintf( /* translators: %s: site name */ __( 'Welcome to %s', 'sulekha-kpo' ), get_bloginfo( 'name' ) ) ); ?></p>
			<h2><?php echo sulekha_accent( sulekha_mod( 'about_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
			<p class="lead-sm"><?php echo esc_html( sulekha_mod( 'about_text' ) ); ?></p>
			<ul class="reason-list">
				<?php foreach ( sulekha_default_reasons() as $sulekha_reason ) : ?>
					<li>
						<span class="icon-badge icon-badge-sm"><?php echo sulekha_icon( $sulekha_reason['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
						<div>
							<h3><?php echo esc_html( $sulekha_reason['title'] ); ?></h3>
							<p><?php echo esc_html( $sulekha_reason['text'] ); ?></p>
						</div>
					</li>
				<?php endforeach; ?>
			</ul>
			<div class="about-actions">
				<a class="btn btn-primary" href="#services"><?php esc_html_e( 'Discover more', 'sulekha-kpo' ); ?> <?php echo sulekha_icon( 'arrow-right' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></a>
				<?php if ( sulekha_mod( 'contact_phone' ) ) : ?>
					<a class="call-chip" href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', sulekha_mod( 'contact_phone' ) ) ); ?>">
						<span class="call-chip-icon"><?php echo sulekha_icon( 'phone' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
						<span><small><?php esc_html_e( 'Call us anytime', 'sulekha-kpo' ); ?></small><strong><?php echo esc_html( sulekha_mod( 'contact_phone' ) ); ?></strong></span>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

<?php
if ( is_page() ) :
	while ( have_posts() ) :
		the_post();
		if ( '' !== trim( get_the_content() ) ) :
			?>
			<section class="section">
				<div class="container entry-content narrow">
					<?php the_content(); ?>
				</div>
			</section>
			<?php
		endif;
	endwhile;
endif;
?>

<section class="section services" id="services">
	<div class="container">
		<div class="section-head section-head-center reveal">
			<p class="script-eyebrow"><?php esc_html_e( 'What we offer', 'sulekha-kpo' ); ?></p>
			<h2><?php echo sulekha_accent( __( 'Knowledge services built around your *outcomes*', 'sulekha-kpo' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
			<p><?php esc_html_e( 'From one analyst to a full offshore centre of excellence, we take on high-judgement work that needs domain expertise, not just hands.', 'sulekha-kpo' ); ?></p>
		</div>
		<div class="card-grid">
			<?php foreach ( $sulekha_services as $sulekha_n => $sulekha_service ) : ?>
				<article class="service-card reveal">
					<span class="service-num" aria-hidden="true"><?php echo esc_html( str_pad( (string) ( $sulekha_n + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
					<span class="icon-badge"><?php echo sulekha_icon( $sulekha_service['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
					<h3>
						<?php if ( $sulekha_service['url'] ) : ?>
							<a href="<?php echo esc_url( $sulekha_service['url'] ); ?>" class="stretched-link"><?php echo esc_html( $sulekha_service['title'] ); ?></a>
						<?php else : ?>
							<?php echo esc_html( $sulekha_service['title'] ); ?>
						<?php endif; ?>
					</h3>
					<p><?php echo esc_html( wp_strip_all_tags( $sulekha_service['text'] ) ); ?></p>
					<span class="card-link"><?php esc_html_e( 'Learn more', 'sulekha-kpo' ); ?> <?php echo sulekha_icon( 'arrow-right' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<div class="marquee" aria-hidden="true">
	<div class="marquee-track">
		<?php for ( $sulekha_r = 0; $sulekha_r < 2; $sulekha_r++ ) : ?>
			<?php foreach ( sulekha_default_marquee() as $sulekha_word ) : ?>
				<span><?php echo esc_html( $sulekha_word ); ?></span><?php echo sulekha_icon( 'sparkle' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
			<?php endforeach; ?>
		<?php endfor; ?>
	</div>
</div>

<section class="approach" id="approach">
	<div class="approach-panel">
		<div class="approach-copy reveal">
			<p class="script-eyebrow script-eyebrow-light"><?php esc_html_e( 'Our approach', 'sulekha-kpo' ); ?></p>
			<h2><?php echo sulekha_accent( __( 'Built for *quality* at every step', 'sulekha-kpo' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
			<ul class="approach-list">
				<?php foreach ( sulekha_default_approach() as $sulekha_point ) : ?>
					<li>
						<span class="approach-icon"><?php echo sulekha_icon( $sulekha_point['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
						<div>
							<h3><?php echo esc_html( $sulekha_point['title'] ); ?></h3>
							<p><?php echo esc_html( $sulekha_point['text'] ); ?></p>
						</div>
					</li>
				<?php endforeach; ?>
			</ul>
			<a class="btn btn-amber" href="#contact" data-open-quote><?php esc_html_e( 'Start a pilot', 'sulekha-kpo' ); ?> <?php echo sulekha_icon( 'arrow-right' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></a>
		</div>
	</div>
	<div class="approach-media" style="background-image:url('<?php echo esc_url( sulekha_mod( 'approach_image' ) ); ?>')" role="img" aria-label="<?php esc_attr_e( 'Team collaborating at a whiteboard', 'sulekha-kpo' ); ?>"></div>
</section>

<section class="section" id="industries">
	<div class="container">
		<div class="section-head section-head-center reveal">
			<p class="script-eyebrow"><?php esc_html_e( 'Industries we serve', 'sulekha-kpo' ); ?></p>
			<h2><?php echo sulekha_accent( __( 'Deep expertise in the *sectors* we serve', 'sulekha-kpo' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
		</div>
		<div class="industry-grid">
			<?php foreach ( sulekha_default_industries() as $sulekha_industry ) : ?>
				<div class="industry reveal">
					<span class="industry-icon"><?php echo sulekha_icon( $sulekha_industry['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
					<span><?php echo esc_html( $sulekha_industry['title'] ); ?></span>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="section section-alt process-section" id="process">
	<div class="container">
		<div class="section-head section-head-center reveal">
			<p class="script-eyebrow"><?php esc_html_e( 'How we work', 'sulekha-kpo' ); ?></p>
			<h2><?php echo sulekha_accent( __( 'A proven path from first call to *steady state*', 'sulekha-kpo' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
		</div>
		<ol class="process">
			<?php foreach ( sulekha_default_process() as $sulekha_n => $sulekha_step ) : ?>
				<li class="process-step reveal">
					<span class="step-num"><?php echo esc_html( str_pad( (string) ( $sulekha_n + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
					<h3><?php echo esc_html( $sulekha_step['title'] ); ?></h3>
					<p><?php echo esc_html( $sulekha_step['text'] ); ?></p>
				</li>
			<?php endforeach; ?>
		</ol>
	</div>
</section>

<section class="gallery" aria-label="<?php esc_attr_e( 'Life at Sulekha', 'sulekha-kpo' ); ?>">
	<?php foreach ( sulekha_default_gallery() as $sulekha_file => $sulekha_caption ) : ?>
		<figure class="gallery-item">
			<img src="<?php echo esc_url( $sulekha_img . $sulekha_file ); ?>" alt="<?php echo esc_attr( $sulekha_caption ); ?>" loading="lazy" width="700" height="467">
			<figcaption><?php echo esc_html( $sulekha_caption ); ?></figcaption>
		</figure>
	<?php endforeach; ?>
</section>

<section class="section testimonials" id="testimonials">
	<div class="container testimonials-grid">
		<div class="testimonials-intro reveal">
			<p class="script-eyebrow"><?php esc_html_e( 'Client stories', 'sulekha-kpo' ); ?></p>
			<h2><?php echo sulekha_accent( __( 'What our clients are *saying*', 'sulekha-kpo' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
			<p><?php esc_html_e( 'See the difference through our clients’ eyes.', 'sulekha-kpo' ); ?></p>
			<div class="t-arrows">
				<button type="button" class="hero-arrow hero-arrow-dark" data-t-prev aria-label="<?php esc_attr_e( 'Previous testimonial', 'sulekha-kpo' ); ?>"><?php echo sulekha_icon( 'chev-left' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></button>
				<button type="button" class="hero-arrow hero-arrow-dark" data-t-next aria-label="<?php esc_attr_e( 'Next testimonial', 'sulekha-kpo' ); ?>"><?php echo sulekha_icon( 'chev-right' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></button>
			</div>
		</div>
		<div class="t-track" data-t-track tabindex="0" aria-label="<?php esc_attr_e( 'Testimonials', 'sulekha-kpo' ); ?>">
			<?php foreach ( sulekha_get_testimonials() as $sulekha_t ) : ?>
				<figure class="t-card">
					<span class="t-quote-mark"><?php echo sulekha_icon( 'quote' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
					<blockquote><p><?php echo esc_html( $sulekha_t['quote'] ); ?></p></blockquote>
					<figcaption>
						<?php if ( $sulekha_t['image'] ) : ?>
							<img class="t-avatar" src="<?php echo esc_url( $sulekha_t['image'] ); ?>" alt="" width="56" height="56" loading="lazy">
						<?php else : ?>
							<span class="t-avatar"><?php echo esc_html( sulekha_initials( $sulekha_t['name'] ) ); ?></span>
						<?php endif; ?>
						<span><strong><?php echo esc_html( $sulekha_t['name'] ); ?></strong><small><?php echo esc_html( $sulekha_t['role'] ); ?></small></span>
					</figcaption>
				</figure>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="trust" aria-label="<?php esc_attr_e( 'Security and compliance', 'sulekha-kpo' ); ?>">
	<div class="container trust-inner">
		<p class="trust-title"><?php echo sulekha_icon( 'shield' ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php esc_html_e( 'Your data, protected', 'sulekha-kpo' ); ?></p>
		<ul class="trust-list">
			<?php foreach ( sulekha_default_trust() as $sulekha_item ) : ?>
				<li><?php echo sulekha_icon( $sulekha_item['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php echo esc_html( $sulekha_item['title'] ); ?></li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>

<?php
$sulekha_insights = new WP_Query(
	array(
		'posts_per_page'      => 3,
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	)
);
if ( $sulekha_insights->have_posts() ) :
	?>
	<section class="section" id="insights">
		<div class="container">
			<div class="section-head section-head-row reveal">
				<div>
					<p class="script-eyebrow"><?php esc_html_e( 'Insights', 'sulekha-kpo' ); ?></p>
					<h2><?php echo sulekha_accent( __( 'Latest *updates*', 'sulekha-kpo' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
				</div>
				<?php if ( get_option( 'page_for_posts' ) ) : ?>
					<a class="btn btn-outline" href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>"><?php esc_html_e( 'View all', 'sulekha-kpo' ); ?></a>
				<?php endif; ?>
			</div>
			<div class="post-grid">
				<?php
				while ( $sulekha_insights->have_posts() ) :
					$sulekha_insights->the_post();
					get_template_part( 'template-parts/card', 'post' );
				endwhile;
				wp_reset_postdata();
				?>
			</div>
		</div>
	</section>
<?php endif; ?>

<section class="section contact" id="contact" style="--contact-bg:url('<?php echo esc_url( sulekha_mod( 'contact_image' ) ); ?>')">
	<div class="container contact-grid">
		<div class="contact-copy reveal">
			<p class="script-eyebrow script-eyebrow-light"><?php esc_html_e( 'Get in touch', 'sulekha-kpo' ); ?></p>
			<h2><?php echo sulekha_accent( sulekha_mod( 'contact_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
			<p><?php echo esc_html( sulekha_mod( 'contact_text' ) ); ?></p>
			<ul class="contact-cards">
				<?php if ( sulekha_mod( 'contact_email' ) ) : ?>
					<li><span class="contact-card-icon"><?php echo sulekha_icon( 'mail' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span><span><small><?php esc_html_e( 'Email us', 'sulekha-kpo' ); ?></small><a href="mailto:<?php echo esc_attr( antispambot( sulekha_mod( 'contact_email' ) ) ); ?>"><?php echo esc_html( antispambot( sulekha_mod( 'contact_email' ) ) ); ?></a></span></li>
				<?php endif; ?>
				<?php if ( sulekha_mod( 'contact_phone' ) ) : ?>
					<li><span class="contact-card-icon"><?php echo sulekha_icon( 'phone' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span><span><small><?php esc_html_e( 'Call us', 'sulekha-kpo' ); ?></small><a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', sulekha_mod( 'contact_phone' ) ) ); ?>"><?php echo esc_html( sulekha_mod( 'contact_phone' ) ); ?></a></span></li>
				<?php endif; ?>
				<?php if ( sulekha_mod( 'contact_hours' ) ) : ?>
					<li><span class="contact-card-icon"><?php echo sulekha_icon( 'clock' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span><span><small><?php esc_html_e( 'Working hours', 'sulekha-kpo' ); ?></small><?php echo esc_html( sulekha_mod( 'contact_hours' ) ); ?></span></li>
				<?php endif; ?>
			</ul>
		</div>
		<div class="reveal">
			<?php get_template_part( 'template-parts/enquiry-form', null, array( 'notice' => true ) ); ?>
		</div>
	</div>
</section>

<?php
get_footer();
