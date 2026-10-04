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
		'slide1_eyebrow'   => array( 'section' => 'sulekha_hero', 'label' => __( 'Slide 1 eyebrow', 'sulekha-kpo' ), 'default' => __( 'Export Documentation Back Office', 'sulekha-kpo' ) ),
		'slide1_title'     => array( 'section' => 'sulekha_hero', 'label' => __( 'Slide 1 heading (wrap a word in *asterisks* to highlight)', 'sulekha-kpo' ), 'default' => __( 'Export documents, prepared *on time*, every time', 'sulekha-kpo' ), 'type' => 'textarea' ),
		'slide1_text'      => array( 'section' => 'sulekha_hero', 'label' => __( 'Slide 1 text', 'sulekha-kpo' ), 'default' => __( 'Since 2017 we have handled export documentation for Australia, Black Sea and Canada origin shipments to India, China, Pakistan, Bangladesh, Egypt and Algeria.', 'sulekha-kpo' ), 'type' => 'textarea' ),
		'slide2_image'     => array( 'section' => 'sulekha_hero', 'label' => __( 'Slide 2 image', 'sulekha-kpo' ), 'default' => $img . 'hero-2.jpg', 'type' => 'image' ),
		'slide2_eyebrow'   => array( 'section' => 'sulekha_hero', 'label' => __( 'Slide 2 eyebrow', 'sulekha-kpo' ), 'default' => __( 'Our goal', 'sulekha-kpo' ) ),
		'slide2_title'     => array( 'section' => 'sulekha_hero', 'label' => __( 'Slide 2 heading', 'sulekha-kpo' ), 'default' => __( 'On-time documents that help you *avoid detention*', 'sulekha-kpo' ), 'type' => 'textarea' ),
		'slide2_text'      => array( 'section' => 'sulekha_hero', 'label' => __( 'Slide 2 text', 'sulekha-kpo' ), 'default' => __( 'Documents prepared on schedule and reviewed before release, so your shipments keep moving.', 'sulekha-kpo' ), 'type' => 'textarea' ),
		'slide3_image'     => array( 'section' => 'sulekha_hero', 'label' => __( 'Slide 3 image', 'sulekha-kpo' ), 'default' => $img . 'hero-3.jpg', 'type' => 'image' ),
		'slide3_eyebrow'   => array( 'section' => 'sulekha_hero', 'label' => __( 'Slide 3 eyebrow', 'sulekha-kpo' ), 'default' => __( 'Trained resources', 'sulekha-kpo' ) ),
		'slide3_title'     => array( 'section' => 'sulekha_hero', 'label' => __( 'Slide 3 heading', 'sulekha-kpo' ), 'default' => __( 'Trained teams built around *your* needs', 'sulekha-kpo' ), 'type' => 'textarea' ),
		'slide3_text'      => array( 'section' => 'sulekha_hero', 'label' => __( 'Slide 3 text', 'sulekha-kpo' ), 'default' => __( 'Our people are trained in Incoterms, documents, methods of payment and supply chain, and reviewed stage by stage before they handle live shipments.', 'sulekha-kpo' ), 'type' => 'textarea' ),
		'hero_cta_label'   => array( 'section' => 'sulekha_hero', 'label' => __( 'Primary button label', 'sulekha-kpo' ), 'default' => __( 'Talk to our team', 'sulekha-kpo' ) ),
		'hero_cta_url'     => array( 'section' => 'sulekha_hero', 'label' => __( 'Primary button link', 'sulekha-kpo' ), 'default' => '#contact', 'type' => 'url' ),
		'hero_cta2_label'  => array( 'section' => 'sulekha_hero', 'label' => __( 'Secondary button label', 'sulekha-kpo' ), 'default' => __( 'Explore services', 'sulekha-kpo' ) ),
		'hero_cta2_url'    => array( 'section' => 'sulekha_hero', 'label' => __( 'Secondary button link', 'sulekha-kpo' ), 'default' => '#services', 'type' => 'url' ),

		// Stats.
		'stat1_value'      => array( 'section' => 'sulekha_stats', 'label' => __( 'Stat 1 value', 'sulekha-kpo' ), 'default' => sulekha_years_in_operation() ),
		'stat1_label'      => array( 'section' => 'sulekha_stats', 'label' => __( 'Stat 1 label', 'sulekha-kpo' ), 'default' => __( 'Years in operation', 'sulekha-kpo' ) ),
		'stat2_value'      => array( 'section' => 'sulekha_stats', 'label' => __( 'Stat 2 value', 'sulekha-kpo' ), 'default' => '3' ),
		'stat2_label'      => array( 'section' => 'sulekha_stats', 'label' => __( 'Stat 2 label', 'sulekha-kpo' ), 'default' => __( 'Origins handled', 'sulekha-kpo' ) ),
		'stat3_value'      => array( 'section' => 'sulekha_stats', 'label' => __( 'Stat 3 value', 'sulekha-kpo' ), 'default' => '6' ),
		'stat3_label'      => array( 'section' => 'sulekha_stats', 'label' => __( 'Stat 3 label', 'sulekha-kpo' ), 'default' => __( 'Major destination countries', 'sulekha-kpo' ) ),
		'stat4_value'      => array( 'section' => 'sulekha_stats', 'label' => __( 'Stat 4 value', 'sulekha-kpo' ), 'default' => '2,000+' ),
		'stat4_label'      => array( 'section' => 'sulekha_stats', 'label' => __( 'Stat 4 label', 'sulekha-kpo' ), 'default' => __( 'Shipments in our busiest year', 'sulekha-kpo' ) ),

		// About.
		'about_title'      => array( 'section' => 'sulekha_about', 'label' => __( 'Heading', 'sulekha-kpo' ), 'default' => __( 'Export expertise, built from the *inside*', 'sulekha-kpo' ) ),
		'about_text'       => array( 'section' => 'sulekha_about', 'label' => __( 'Text', 'sulekha-kpo' ), 'default' => __( 'Souvik completed his Master’s in International Business in 2014 and went on to work in the export teams of multinational companies across pulses, polymers and petrochemicals. In 2017 he started this back office. Within two years it had grown, recruited more people and expanded the business.', 'sulekha-kpo' ), 'type' => 'textarea' ),
		'about_image'      => array( 'section' => 'sulekha_about', 'label' => __( 'Main image', 'sulekha-kpo' ), 'default' => $img . 'about-team.jpg', 'type' => 'image' ),
		'about_image2'     => array( 'section' => 'sulekha_about', 'label' => __( 'Small inset image', 'sulekha-kpo' ), 'default' => $img . 'about-partner.jpg', 'type' => 'image' ),
		'about_badge'      => array( 'section' => 'sulekha_about', 'label' => __( 'Badge number (leave empty to hide)', 'sulekha-kpo' ), 'default' => sulekha_years_in_operation() ),
		'about_badge_text' => array( 'section' => 'sulekha_about', 'label' => __( 'Badge label', 'sulekha-kpo' ), 'default' => __( 'Years of export expertise', 'sulekha-kpo' ) ),
		'approach_image'   => array( 'section' => 'sulekha_about', 'label' => __( '"Mission & vision" image', 'sulekha-kpo' ), 'default' => $img . 'approach.jpg', 'type' => 'image' ),
		'contact_image'    => array( 'section' => 'sulekha_contact', 'label' => __( 'Contact background image', 'sulekha-kpo' ), 'default' => $img . 'security.jpg', 'type' => 'image' ),

		// Contact.
		'contact_title'    => array( 'section' => 'sulekha_contact', 'label' => __( 'Contact heading', 'sulekha-kpo' ), 'default' => __( 'Have questions? We’ll be *happy* to answer them', 'sulekha-kpo' ) ),
		'contact_text'     => array( 'section' => 'sulekha_contact', 'label' => __( 'Contact text', 'sulekha-kpo' ), 'default' => __( 'Tell us about your shipments: the origin, the destination and the documents you need. We will get back to you within one business day.', 'sulekha-kpo' ), 'type' => 'textarea' ),
		'contact_email'    => array( 'section' => 'sulekha_contact', 'label' => __( 'Email', 'sulekha-kpo' ), 'default' => 'info@sulekhaenterprises.com', 'type' => 'email' ),
		'contact_phone'    => array( 'section' => 'sulekha_contact', 'label' => __( 'Phone', 'sulekha-kpo' ), 'default' => '+91 00000 00000' ),
		'contact_address'  => array( 'section' => 'sulekha_contact', 'label' => __( 'Address', 'sulekha-kpo' ), 'default' => __( 'Jamshedpur, Jharkhand, India', 'sulekha-kpo' ), 'type' => 'textarea' ),
		'contact_hours'    => array( 'section' => 'sulekha_contact', 'label' => __( 'Working hours (top bar)', 'sulekha-kpo' ), 'default' => __( 'Mon – Sat: 9:00 – 19:00 IST', 'sulekha-kpo' ) ),
		'whatsapp'         => array( 'section' => 'sulekha_contact', 'label' => __( 'WhatsApp number with country code, digits only (shows floating button)', 'sulekha-kpo' ), 'default' => '' ),
		'enquiry_to'       => array( 'section' => 'sulekha_contact', 'label' => __( 'Send enquiries to (defaults to admin email)', 'sulekha-kpo' ), 'default' => '', 'type' => 'email' ),

		// Careers.
		'careers_title'    => array( 'section' => 'sulekha_careers', 'label' => __( 'Heading (wrap a word in *asterisks* to highlight)', 'sulekha-kpo' ), 'default' => __( 'Build your career in *export documentation*', 'sulekha-kpo' ) ),
		'careers_text'     => array( 'section' => 'sulekha_careers', 'label' => __( 'Text', 'sulekha-kpo' ), 'default' => __( 'We are always looking for quick learners to join our back office in Jamshedpur. We train you in international trade and review your progress at every stage, so you can grow with a team that has been expanding since 2017.', 'sulekha-kpo' ), 'type' => 'textarea' ),
		'careers_to'       => array( 'section' => 'sulekha_careers', 'label' => __( 'Send resumes to (defaults to the enquiry email, then the admin email)', 'sulekha-kpo' ), 'default' => '', 'type' => 'email' ),

		// Social / footer.
		'social_linkedin'  => array( 'section' => 'sulekha_footer', 'label' => __( 'LinkedIn URL', 'sulekha-kpo' ), 'default' => '', 'type' => 'url' ),
		'social_twitter'   => array( 'section' => 'sulekha_footer', 'label' => __( 'X / Twitter URL', 'sulekha-kpo' ), 'default' => '', 'type' => 'url' ),
		'social_facebook'  => array( 'section' => 'sulekha_footer', 'label' => __( 'Facebook URL', 'sulekha-kpo' ), 'default' => '', 'type' => 'url' ),
		'footer_about'     => array( 'section' => 'sulekha_footer', 'label' => __( 'Footer blurb', 'sulekha-kpo' ), 'default' => __( 'Sulekha Enterprises is an export documentation back office in Jamshedpur, India, handling documents for Australia, Black Sea and Canada origin shipments since 2017.', 'sulekha-kpo' ), 'type' => 'textarea' ),
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
		'sulekha_careers' => __( 'Careers', 'sulekha-kpo' ),
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
