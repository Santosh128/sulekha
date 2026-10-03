<?php
/**
 * Services post type with an icon picker.
 *
 * @package Sulekha_KPO
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the Service post type.
 */
function sulekha_register_post_types() {
	register_post_type(
		'kpo_service',
		array(
			'labels'       => array(
				'name'          => __( 'Services', 'sulekha-kpo' ),
				'singular_name' => __( 'Service', 'sulekha-kpo' ),
				'add_new_item'  => __( 'Add New Service', 'sulekha-kpo' ),
				'edit_item'     => __( 'Edit Service', 'sulekha-kpo' ),
				'all_items'     => __( 'All Services', 'sulekha-kpo' ),
			),
			'public'       => true,
			'has_archive'  => 'services',
			'rewrite'      => array( 'slug' => 'services' ),
			'menu_icon'    => 'dashicons-analytics',
			'show_in_rest' => true,
			'supports'     => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
		)
	);

	register_post_type(
		'kpo_testimonial',
		array(
			'labels'              => array(
				'name'          => __( 'Testimonials', 'sulekha-kpo' ),
				'singular_name' => __( 'Testimonial', 'sulekha-kpo' ),
				'add_new_item'  => __( 'Add New Testimonial', 'sulekha-kpo' ),
				'edit_item'     => __( 'Edit Testimonial', 'sulekha-kpo' ),
			),
			'description'         => __( 'Title = client name, Excerpt = role and company, Content = the quote.', 'sulekha-kpo' ),
			'public'              => false,
			'show_ui'             => true,
			'exclude_from_search' => true,
			'menu_icon'           => 'dashicons-format-quote',
			'show_in_rest'        => true,
			'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
		)
	);
}

/**
 * Hint on the testimonial edit screen.
 *
 * @param string  $text Placeholder.
 * @param WP_Post $post Post.
 * @return string
 */
function sulekha_testimonial_title_placeholder( $text, $post ) {
	return 'kpo_testimonial' === $post->post_type ? __( 'Client name', 'sulekha-kpo' ) : $text;
}
add_filter( 'enter_title_here', 'sulekha_testimonial_title_placeholder', 10, 2 );

/**
 * Testimonials: real posts if any, otherwise placeholders.
 *
 * @return array Each item: quote, name, role, image.
 */
function sulekha_get_testimonials() {
	$posts = get_posts(
		array(
			'post_type'      => 'kpo_testimonial',
			'posts_per_page' => 8,
			'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'DESC' ),
		)
	);

	if ( ! $posts ) {
		return array_map(
			function ( $t ) {
				$t['image'] = '';
				return $t;
			},
			sulekha_default_testimonials()
		);
	}

	$items = array();
	foreach ( $posts as $p ) {
		$items[] = array(
			'quote' => wp_strip_all_tags( $p->post_content ),
			'name'  => get_the_title( $p ),
			'role'  => $p->post_excerpt,
			'image' => get_the_post_thumbnail_url( $p, 'thumbnail' ),
		);
	}
	return $items;
}

/**
 * Initials for avatar placeholders.
 *
 * @param string $name Name.
 * @return string
 */
function sulekha_initials( $name ) {
	$parts    = preg_split( '/\s+/', trim( $name ) );
	$initials = '';
	foreach ( array_slice( $parts, 0, 2 ) as $part ) {
		$initials .= function_exists( 'mb_substr' ) ? mb_substr( $part, 0, 1 ) : substr( $part, 0, 1 );
	}
	return strtoupper( $initials );
}
add_action( 'init', 'sulekha_register_post_types' );

/**
 * Flush rewrite rules on theme activation so /services/ works.
 */
function sulekha_flush_rewrites() {
	sulekha_register_post_types();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'sulekha_flush_rewrites' );

/**
 * Icon meta box.
 */
function sulekha_service_meta_box() {
	add_meta_box( 'sulekha_service_icon', __( 'Service icon', 'sulekha-kpo' ), 'sulekha_service_icon_box', 'kpo_service', 'side' );
}
add_action( 'add_meta_boxes', 'sulekha_service_meta_box' );

/**
 * Render icon meta box.
 *
 * @param WP_Post $post Post.
 */
function sulekha_service_icon_box( $post ) {
	wp_nonce_field( 'sulekha_service_icon', 'sulekha_service_icon_nonce' );
	$current = get_post_meta( $post->ID, '_sulekha_icon', true );
	$skip    = array( 'arrow-right', 'arrow-left', 'arrow-up', 'chev-left', 'chev-right', 'menu', 'close', 'linkedin', 'twitter', 'facebook', 'whatsapp', 'quote', 'sparkle' );
	echo '<select name="sulekha_icon" style="width:100%">';
	foreach ( array_keys( sulekha_icon_paths() ) as $name ) {
		if ( in_array( $name, $skip, true ) ) {
			continue;
		}
		printf( '<option value="%1$s" %2$s>%1$s</option>', esc_attr( $name ), selected( $current, $name, false ) );
	}
	echo '</select>';
}

/**
 * Save icon meta.
 *
 * @param int $post_id Post ID.
 */
function sulekha_save_service_icon( $post_id ) {
	if ( ! isset( $_POST['sulekha_service_icon_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['sulekha_service_icon_nonce'] ), 'sulekha_service_icon' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	if ( isset( $_POST['sulekha_icon'] ) ) {
		$icon = sanitize_key( $_POST['sulekha_icon'] );
		if ( array_key_exists( $icon, sulekha_icon_paths() ) ) {
			update_post_meta( $post_id, '_sulekha_icon', $icon );
		}
	}
}
add_action( 'save_post_kpo_service', 'sulekha_save_service_icon' );

/**
 * Services for the front page: real posts if any, otherwise defaults.
 *
 * @return array Each item: icon, title, text, url.
 */
function sulekha_get_services() {
	$posts = get_posts(
		array(
			'post_type'      => 'kpo_service',
			'posts_per_page' => 9,
			'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'ASC' ),
		)
	);

	if ( ! $posts ) {
		return array_map(
			function ( $s ) {
				$s['url'] = '';
				return $s;
			},
			sulekha_default_services()
		);
	}

	$items = array();
	foreach ( $posts as $p ) {
		$items[] = array(
			'icon'  => get_post_meta( $p->ID, '_sulekha_icon', true ) ? get_post_meta( $p->ID, '_sulekha_icon', true ) : 'layers',
			'title' => get_the_title( $p ),
			'text'  => get_the_excerpt( $p ),
			'url'   => get_permalink( $p ),
		);
	}
	return $items;
}
