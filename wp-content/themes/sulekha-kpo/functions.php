<?php
/**
 * Sulekha KPO theme functions.
 *
 * @package Sulekha_KPO
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'SULEKHA_VERSION', '1.0.0' );
define( 'SULEKHA_DIR', get_template_directory() );
define( 'SULEKHA_URI', get_template_directory_uri() );

require SULEKHA_DIR . '/inc/icons.php';
require SULEKHA_DIR . '/inc/defaults.php';
require SULEKHA_DIR . '/inc/customizer.php';
require SULEKHA_DIR . '/inc/post-types.php';
require SULEKHA_DIR . '/inc/enquiry.php';
require SULEKHA_DIR . '/inc/careers.php';

/**
 * Theme setup.
 */
function sulekha_setup() {
	load_theme_textdomain( 'sulekha-kpo', SULEKHA_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 169,
			'width'       => 298,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	add_image_size( 'sulekha-card', 720, 460, true );

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'sulekha-kpo' ),
			'footer'  => __( 'Footer Menu', 'sulekha-kpo' ),
		)
	);
}
add_action( 'after_setup_theme', 'sulekha_setup' );

/**
 * Content width.
 */
function sulekha_content_width() {
	$GLOBALS['content_width'] = 820;
}
add_action( 'after_setup_theme', 'sulekha_content_width', 0 );

/**
 * Version string for a theme asset, based on its last-modified time, so browsers
 * and caches fetch the new file whenever it changes.
 *
 * @param string $path Path relative to the theme folder.
 * @return string
 */
function sulekha_asset_version( $path ) {
	$mtime = file_exists( SULEKHA_DIR . '/' . $path ) ? filemtime( SULEKHA_DIR . '/' . $path ) : false;
	return $mtime ? SULEKHA_VERSION . '.' . $mtime : SULEKHA_VERSION;
}

/**
 * Enqueue styles and scripts.
 */
function sulekha_assets() {
	wp_enqueue_style( 'sulekha-fonts', 'https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&family=Inter:wght@400;500;600&family=Playfair+Display:ital,wght@1,500;1,600&display=swap', array(), null );
	wp_enqueue_style( 'sulekha-main', SULEKHA_URI . '/assets/css/main.css', array(), sulekha_asset_version( 'assets/css/main.css' ) );
	wp_enqueue_script( 'sulekha-main', SULEKHA_URI . '/assets/js/main.js', array(), sulekha_asset_version( 'assets/js/main.js' ), array( 'strategy' => 'defer', 'in_footer' => true ) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'sulekha_assets' );

/**
 * Flag JS support early so scroll-reveal content is only hidden when JS can reveal it.
 */
function sulekha_js_class() {
	echo "<script>document.documentElement.classList.add('js');</script>\n";
}
add_action( 'wp_head', 'sulekha_js_class', 0 );

/**
 * Preconnect to Google Fonts.
 *
 * @param array  $urls          URLs.
 * @param string $relation_type Relation type.
 * @return array
 */
function sulekha_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = array( 'href' => 'https://fonts.gstatic.com', 'crossorigin' );
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'sulekha_resource_hints', 10, 2 );

/**
 * Footer widget areas.
 */
function sulekha_widgets() {
	register_sidebar(
		array(
			'name'          => __( 'Blog Sidebar', 'sulekha-kpo' ),
			'id'            => 'sidebar-1',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'sulekha_widgets' );

/**
 * Output the site logo (custom logo or bundled brand logo).
 */
function sulekha_logo() {
	if ( has_custom_logo() ) {
		the_custom_logo();
		return;
	}
	printf(
		'<a href="%1$s" class="custom-logo-link" rel="home"><img src="%2$s" class="custom-logo" width="298" height="169" alt="%3$s"></a>',
		esc_url( home_url( '/' ) ),
		esc_url( SULEKHA_URI . '/assets/images/logo.jpg' ),
		esc_attr( get_bloginfo( 'name' ) )
	);
}

/**
 * Fallback primary menu when none is assigned.
 */
function sulekha_menu_fallback() {
	$front = home_url( '/' );
	$items = array(
		__( 'About', 'sulekha-kpo' )       => $front . '#about',
		__( 'Services', 'sulekha-kpo' )    => $front . '#services',
		__( 'Trade lanes', 'sulekha-kpo' ) => $front . '#trade-lanes',
		__( 'Training', 'sulekha-kpo' )    => $front . '#process',
		__( 'Careers', 'sulekha-kpo' )     => $front . '#careers',
		__( 'Contact', 'sulekha-kpo' )     => $front . '#contact',
	);
	echo '<ul class="menu">';
	foreach ( $items as $label => $url ) {
		printf( '<li class="menu-item"><a href="%1$s">%2$s</a></li>', esc_url( $url ), esc_html( $label ) );
	}
	echo '</ul>';
}

/**
 * Shorter excerpts.
 */
add_filter(
	'excerpt_length',
	function () {
		return 24;
	}
);
add_filter(
	'excerpt_more',
	function () {
		return '&hellip;';
	}
);

/**
 * Estimated reading time.
 *
 * @param int|null $post_id Post ID.
 * @return string
 */
function sulekha_reading_time( $post_id = null ) {
	$words   = str_word_count( wp_strip_all_tags( get_post_field( 'post_content', $post_id ) ) );
	$minutes = max( 1, (int) ceil( $words / 220 ) );
	/* translators: %d: minutes */
	return sprintf( _n( '%d min read', '%d min read', $minutes, 'sulekha-kpo' ), $minutes );
}

/**
 * Pagination wrapper.
 */
function sulekha_pagination() {
	the_posts_pagination(
		array(
			'mid_size'  => 1,
			'prev_text' => sulekha_icon( 'arrow-left' ) . '<span class="screen-reader-text">' . __( 'Previous', 'sulekha-kpo' ) . '</span>',
			'next_text' => '<span class="screen-reader-text">' . __( 'Next', 'sulekha-kpo' ) . '</span>' . sulekha_icon( 'arrow-right' ),
		)
	);
}
