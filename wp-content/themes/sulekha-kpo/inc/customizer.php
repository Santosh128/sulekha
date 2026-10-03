<?php
/**
 * Customizer settings for the front page and contact details.
 *
 * @package Sulekha_KPO
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * All customizable settings with their defaults.
 *
 * @return array
 */
function sulekha_settings() {
	$img = SULEKHA_URI . '/assets/images/';

	return array(
		// Hero slides. Wrap a word in *asterisks* to highlight it.
		'slide1_image'     => array( 'section' => 'sulekha_hero', 'label' => __( 'Slide 1 image', 'sulekha-kpo' ), 'default' => $img . 'hero-1.jpg', 'type' => 'image' ),
		'slide1_eyebrow'   => array( 'section' => 'sulekha_hero', 'label' => __( 'Slide 1 eyebrow', 'sulekha-kpo' ), 'default' => __( 'Knowledge Process Outsourcing', 'sulekha-kpo' ) ),
		'slide1_title'     => array( 'section' => 'sulekha_hero', 'label' => __( 'Slide 1 heading (wrap a word in *asterisks* to highlight)', 'sulekha-kpo' ), 'default' => __( 'Expert knowledge work, delivered at *global* scale', 'sulekha-kpo' ), 'type' => 'textarea' ),
		'slide1_text'      => array( 'section' => 'sulekha_hero', 'label' => __( 'Slide 1 text', 'sulekha-kpo' ), 'default' => __( 'A dedicated team of analysts, accountants, researchers and domain specialists, so your people can focus on the decisions that matter.', 'sulekha-kpo' ), 'type' => 'textarea' ),
		'slide2_image'     => array( 'section' => 'sulekha_hero', 'label' => __( 'Slide 2 image', 'sulekha-kpo' ), 'default' => $img . 'hero-2.jpg', 'type' => 'image' ),
		'slide2_eyebrow'   => array( 'section' => 'sulekha_hero', 'label' => __( 'Slide 2 eyebrow', 'sulekha-kpo' ), 'default' => __( 'Data Analytics & Research', 'sulekha-kpo' ) ),
		'slide2_title'     => array( 'section' => 'sulekha_hero', 'label' => __( 'Slide 2 heading', 'sulekha-kpo' ), 'default' => __( 'Turn raw data into *decisions* you can trust', 'sulekha-kpo' ), 'type' => 'textarea' ),
		'slide2_text'      => array( 'section' => 'sulekha_hero', 'label' => __( 'Slide 2 text', 'sulekha-kpo' ), 'default' => __( 'Dashboards, market intelligence and research reports built by analysts who understand your industry.', 'sulekha-kpo' ), 'type' => 'textarea' ),
		'slide3_image'     => array( 'section' => 'sulekha_hero', 'label' => __( 'Slide 3 image', 'sulekha-kpo' ), 'default' => $img . 'hero-3.jpg', 'type' => 'image' ),
		'slide3_eyebrow'   => array( 'section' => 'sulekha_hero', 'label' => __( 'Slide 3 eyebrow', 'sulekha-kpo' ), 'default' => __( 'Finance & Accounting', 'sulekha-kpo' ) ),
		'slide3_title'     => array( 'section' => 'sulekha_hero', 'label' => __( 'Slide 3 heading', 'sulekha-kpo' ), 'default' => __( 'Close your books *faster*, with fewer errors', 'sulekha-kpo' ), 'type' => 'textarea' ),
		'slide3_text'      => array( 'section' => 'sulekha_hero', 'label' => __( 'Slide 3 text', 'sulekha-kpo' ), 'default' => __( 'Qualified accountants handling AP/AR, reconciliations and reporting against strict SLAs.', 'sulekha-kpo' ), 'type' => 'textarea' ),
		'hero_cta_label'   => array( 'section' => 'sulekha_hero', 'label' => __( 'Primary button label', 'sulekha-kpo' ), 'default' => __( 'Talk to our team', 'sulekha-kpo' ) ),
		'hero_cta_url'     => array( 'section' => 'sulekha_hero', 'label' => __( 'Primary button link', 'sulekha-kpo' ), 'default' => '#contact', 'type' => 'url' ),
		'hero_cta2_label'  => array( 'section' => 'sulekha_hero', 'label' => __( 'Secondary button label', 'sulekha-kpo' ), 'default' => __( 'Explore services', 'sulekha-kpo' ) ),
		'hero_cta2_url'    => array( 'section' => 'sulekha_hero', 'label' => __( 'Secondary button link', 'sulekha-kpo' ), 'default' => '#services', 'type' => 'url' ),

		// Stats.
		'stat1_value'      => array( 'section' => 'sulekha_stats', 'label' => __( 'Stat 1 value', 'sulekha-kpo' ), 'default' => '250+' ),
		'stat1_label'      => array( 'section' => 'sulekha_stats', 'label' => __( 'Stat 1 label', 'sulekha-kpo' ), 'default' => __( 'Domain specialists', 'sulekha-kpo' ) ),
		'stat2_value'      => array( 'section' => 'sulekha_stats', 'label' => __( 'Stat 2 value', 'sulekha-kpo' ), 'default' => '99.5%' ),
		'stat2_label'      => array( 'section' => 'sulekha_stats', 'label' => __( 'Stat 2 label', 'sulekha-kpo' ), 'default' => __( 'Accuracy across SLAs', 'sulekha-kpo' ) ),
		'stat3_value'      => array( 'section' => 'sulekha_stats', 'label' => __( 'Stat 3 value', 'sulekha-kpo' ), 'default' => '12' ),
		'stat3_label'      => array( 'section' => 'sulekha_stats', 'label' => __( 'Stat 3 label', 'sulekha-kpo' ), 'default' => __( 'Countries served', 'sulekha-kpo' ) ),
		'stat4_value'      => array( 'section' => 'sulekha_stats', 'label' => __( 'Stat 4 value', 'sulekha-kpo' ), 'default' => '40%' ),
		'stat4_label'      => array( 'section' => 'sulekha_stats', 'label' => __( 'Stat 4 label', 'sulekha-kpo' ), 'default' => __( 'Average cost reduction', 'sulekha-kpo' ) ),

		// About.
		'about_title'      => array( 'section' => 'sulekha_about', 'label' => __( 'Heading', 'sulekha-kpo' ), 'default' => __( 'A knowledge *partner*, not just a vendor', 'sulekha-kpo' ) ),
		'about_text'       => array( 'section' => 'sulekha_about', 'label' => __( 'Text', 'sulekha-kpo' ), 'default' => __( 'We build dedicated teams that learn your business, your systems and your standards. Every engagement is run by an experienced delivery manager, measured against agreed SLAs and reviewed with you every month.', 'sulekha-kpo' ), 'type' => 'textarea' ),
		'about_image'      => array( 'section' => 'sulekha_about', 'label' => __( 'Main image', 'sulekha-kpo' ), 'default' => $img . 'about-team.jpg', 'type' => 'image' ),
		'about_image2'     => array( 'section' => 'sulekha_about', 'label' => __( 'Small inset image', 'sulekha-kpo' ), 'default' => $img . 'about-partner.jpg', 'type' => 'image' ),
		'about_badge'      => array( 'section' => 'sulekha_about', 'label' => __( 'Badge number (leave empty to hide)', 'sulekha-kpo' ), 'default' => '10+' ),
		'about_badge_text' => array( 'section' => 'sulekha_about', 'label' => __( 'Badge label', 'sulekha-kpo' ), 'default' => __( 'Years of expertise', 'sulekha-kpo' ) ),
		'approach_image'   => array( 'section' => 'sulekha_about', 'label' => __( '"Our approach" image', 'sulekha-kpo' ), 'default' => $img . 'approach.jpg', 'type' => 'image' ),
		'contact_image'    => array( 'section' => 'sulekha_contact', 'label' => __( 'Contact background image', 'sulekha-kpo' ), 'default' => $img . 'security.jpg', 'type' => 'image' ),

		// Contact.
		'contact_title'    => array( 'section' => 'sulekha_contact', 'label' => __( 'Contact heading', 'sulekha-kpo' ), 'default' => __( 'Let’s scope your first project', 'sulekha-kpo' ) ),
		'contact_text'     => array( 'section' => 'sulekha_contact', 'label' => __( 'Contact text', 'sulekha-kpo' ), 'default' => __( 'Tell us what you want to outsource. A solutions lead will reply within one business day with next steps and a pilot proposal.', 'sulekha-kpo' ), 'type' => 'textarea' ),
		'contact_email'    => array( 'section' => 'sulekha_contact', 'label' => __( 'Email', 'sulekha-kpo' ), 'default' => 'info@sulekhaenterprises.com', 'type' => 'email' ),
		'contact_phone'    => array( 'section' => 'sulekha_contact', 'label' => __( 'Phone', 'sulekha-kpo' ), 'default' => '+91 00000 00000' ),
		'contact_address'  => array( 'section' => 'sulekha_contact', 'label' => __( 'Address', 'sulekha-kpo' ), 'default' => __( 'India', 'sulekha-kpo' ), 'type' => 'textarea' ),
		'contact_hours'    => array( 'section' => 'sulekha_contact', 'label' => __( 'Working hours (top bar)', 'sulekha-kpo' ), 'default' => __( 'Mon – Sat: 9:00 – 19:00 IST', 'sulekha-kpo' ) ),
		'whatsapp'         => array( 'section' => 'sulekha_contact', 'label' => __( 'WhatsApp number with country code, digits only (shows floating button)', 'sulekha-kpo' ), 'default' => '' ),
		'enquiry_to'       => array( 'section' => 'sulekha_contact', 'label' => __( 'Send enquiries to (defaults to admin email)', 'sulekha-kpo' ), 'default' => '', 'type' => 'email' ),

		// Social / footer.
		'social_linkedin'  => array( 'section' => 'sulekha_footer', 'label' => __( 'LinkedIn URL', 'sulekha-kpo' ), 'default' => '', 'type' => 'url' ),
		'social_twitter'   => array( 'section' => 'sulekha_footer', 'label' => __( 'X / Twitter URL', 'sulekha-kpo' ), 'default' => '', 'type' => 'url' ),
		'social_facebook'  => array( 'section' => 'sulekha_footer', 'label' => __( 'Facebook URL', 'sulekha-kpo' ), 'default' => '', 'type' => 'url' ),
		'footer_about'     => array( 'section' => 'sulekha_footer', 'label' => __( 'Footer blurb', 'sulekha-kpo' ), 'default' => __( 'Sulekha Enterprises delivers research, analytics, finance, legal and healthcare knowledge services to businesses worldwide.', 'sulekha-kpo' ), 'type' => 'textarea' ),
	);
}

/**
 * Get a theme mod with the registered default.
 *
 * @param string $key Setting key.
 * @return string
 */
function sulekha_mod( $key ) {
	$settings = sulekha_settings();
	$default  = isset( $settings[ $key ] ) ? $settings[ $key ]['default'] : '';
	return get_theme_mod( 'sulekha_' . $key, $default );
}

/**
 * Escape text and turn *word* into a highlighted <em>word</em>.
 *
 * @param string $text Plain text.
 * @return string Safe HTML.
 */
function sulekha_accent( $text ) {
	return preg_replace( '/\*([^*]+)\*/', '<em>$1</em>', esc_html( $text ) );
}

/**
 * Register Customizer panel, sections, settings and controls.
 *
 * @param WP_Customize_Manager $wp_customize Manager.
 */
function sulekha_customize_register( $wp_customize ) {
	$wp_customize->add_panel(
		'sulekha_panel',
		array(
			'title'    => __( 'Sulekha KPO Options', 'sulekha-kpo' ),
			'priority' => 30,
		)
	);

	$sections = array(
		'sulekha_hero'    => __( 'Hero', 'sulekha-kpo' ),
		'sulekha_stats'   => __( 'Key numbers', 'sulekha-kpo' ),
		'sulekha_about'   => __( 'About', 'sulekha-kpo' ),
		'sulekha_contact' => __( 'Contact & enquiries', 'sulekha-kpo' ),
		'sulekha_footer'  => __( 'Footer & social', 'sulekha-kpo' ),
	);
	foreach ( $sections as $id => $title ) {
		$wp_customize->add_section( $id, array( 'title' => $title, 'panel' => 'sulekha_panel' ) );
	}

	foreach ( sulekha_settings() as $key => $args ) {
		$type     = isset( $args['type'] ) ? $args['type'] : 'text';
		$sanitize = 'sanitize_text_field';
		if ( 'textarea' === $type ) {
			$sanitize = 'sanitize_textarea_field';
		} elseif ( 'email' === $type ) {
			$sanitize = 'sanitize_email';
		} elseif ( 'url' === $type || 'image' === $type ) {
			$sanitize = 'esc_url_raw';
		}

		$wp_customize->add_setting(
			'sulekha_' . $key,
			array(
				'default'           => $args['default'],
				'sanitize_callback' => $sanitize,
			)
		);

		if ( 'image' === $type ) {
			$wp_customize->add_control(
				new WP_Customize_Image_Control(
					$wp_customize,
					'sulekha_' . $key,
					array(
						'label'   => $args['label'],
						'section' => $args['section'],
					)
				)
			);
		} else {
			$wp_customize->add_control(
				'sulekha_' . $key,
				array(
					'label'   => $args['label'],
					'section' => $args['section'],
					'type'    => 'url' === $type ? 'text' : $type,
				)
			);
		}
	}
}
add_action( 'customize_register', 'sulekha_customize_register' );
