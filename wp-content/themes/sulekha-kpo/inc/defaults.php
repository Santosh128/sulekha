<?php
/**
 * Default front-page content, taken from the Sulekha Enterprises company presentation.
 *
 * @package Sulekha_KPO
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Year operations started; used for "years in operation" figures.
 */
define( 'SULEKHA_FOUNDED', 2017 );

/**
 * Whole years in operation, e.g. "9+".
 *
 * @return string
 */
function sulekha_years_in_operation() {
	return max( 1, (int) wp_date( 'Y' ) - SULEKHA_FOUNDED ) . '+';
}

/**
 * Default services (shown when no Service posts exist).
 *
 * @return array
 */
function sulekha_default_services() {
	return array(
		array(
			'icon'  => 'file',
			'title' => __( 'Export Documentation', 'sulekha-kpo' ),
			'text'  => __( 'Preparation of the export documents your shipments need, handled by a dedicated back-office team.', 'sulekha-kpo' ),
		),
		array(
			'icon'  => 'search',
			'title' => __( 'Document Review', 'sulekha-kpo' ),
			'text'  => __( 'Every document is identified, checked against our review method and corrected before it is released.', 'sulekha-kpo' ),
		),
		array(
			'icon'  => 'clock',
			'title' => __( 'On-Time Delivery', 'sulekha-kpo' ),
			'text'  => __( 'Documents prepared on schedule so your cargo moves without avoidable detention.', 'sulekha-kpo' ),
		),
		array(
			'icon'  => 'users',
			'title' => __( 'Trained Resources', 'sulekha-kpo' ),
			'text'  => __( 'Staff trained in international trade, provided to match your team’s needs.', 'sulekha-kpo' ),
		),
		array(
			'icon'  => 'globe',
			'title' => __( 'Multi-Origin Coverage', 'sulekha-kpo' ),
			'text'  => __( 'Australia, Black Sea and Canada origins, shipped to India, China, Pakistan, Bangladesh, Egypt and Algeria.', 'sulekha-kpo' ),
		),
		array(
			'icon'  => 'phone',
			'title' => __( 'BPO Calling Process', 'sulekha-kpo' ),
			'text'  => __( 'A calling process added in 2021 to support our clients’ operations alongside documentation.', 'sulekha-kpo' ),
		),
	);
}

/**
 * Trade lanes: origins and destinations handled.
 *
 * @return array
 */
function sulekha_trade_lanes() {
	return array(
		'origins'      => array(
			__( 'Australia', 'sulekha-kpo' ),
			__( 'Black Sea', 'sulekha-kpo' ),
			__( 'Canada', 'sulekha-kpo' ),
		),
		'destinations' => array(
			__( 'India', 'sulekha-kpo' ),
			__( 'China', 'sulekha-kpo' ),
			__( 'Pakistan', 'sulekha-kpo' ),
			__( 'Bangladesh', 'sulekha-kpo' ),
			__( 'Egypt', 'sulekha-kpo' ),
			__( 'Algeria', 'sulekha-kpo' ),
		),
	);
}

/**
 * Resource training steps.
 *
 * @return array
 */
function sulekha_default_process() {
	return array(
		array(
			'title' => __( 'Identify', 'sulekha-kpo' ),
			'text'  => __( 'We select people under 24 with sound MS Office skills and the ability to learn quickly.', 'sulekha-kpo' ),
		),
		array(
			'title' => __( 'Train', 'sulekha-kpo' ),
			'text'  => __( 'Training in international trade: Incoterms, documents, methods of payment and supply chain.', 'sulekha-kpo' ),
		),
		array(
			'title' => __( 'Develop', 'sulekha-kpo' ),
			'text'  => __( 'They learn to identify each document, its review method and how to prepare it.', 'sulekha-kpo' ),
		),
		array(
			'title' => __( 'Review', 'sulekha-kpo' ),
			'text'  => __( 'Stage-wise reviews after every module, before anyone is allocated live shipments.', 'sulekha-kpo' ),
		),
	);
}

/**
 * Capabilities shown in the scrolling marquee.
 *
 * @return array
 */
function sulekha_default_marquee() {
	return array(
		__( 'Export Documentation', 'sulekha-kpo' ),
		__( 'Incoterms', 'sulekha-kpo' ),
		__( 'Methods of Payment', 'sulekha-kpo' ),
		__( 'Supply Chain', 'sulekha-kpo' ),
		__( 'Document Review', 'sulekha-kpo' ),
		__( 'Australia', 'sulekha-kpo' ),
		__( 'Black Sea', 'sulekha-kpo' ),
		__( 'Canada', 'sulekha-kpo' ),
	);
}

/**
 * Mission, vision and goals.
 *
 * @return array
 */
function sulekha_default_approach() {
	return array(
		array(
			'icon'  => 'target',
			'title' => __( 'Mission', 'sulekha-kpo' ),
			'text'  => __( 'Create and provide cost-effective export back-office operations tailored to our customers’ needs.', 'sulekha-kpo' ),
		),
		array(
			'icon'  => 'globe',
			'title' => __( 'Vision', 'sulekha-kpo' ),
			'text'  => __( 'Put Jamshedpur on the world map as a leading export back-office operations centre.', 'sulekha-kpo' ),
		),
		array(
			'icon'  => 'award',
			'title' => __( 'Our goals', 'sulekha-kpo' ),
			'text'  => __( 'Prepare documents on time to avoid detention, and provide trained resources as per client needs.', 'sulekha-kpo' ),
		),
	);
}

/**
 * Shipments handled per year. Values were read from an unlabelled bar chart in the
 * company presentation, so they are approximate.
 *
 * @return array Year => shipments.
 */
function sulekha_shipments() {
	return array(
		2018 => 1450,
		2019 => 2200,
		2020 => 1270,
		2021 => 1950,
	);
}

/**
 * Company milestones.
 *
 * @return array
 */
function sulekha_milestones() {
	return array(
		array( 'year' => '2017', 'title' => __( 'Started operation', 'sulekha-kpo' ), 'text' => __( 'Export documentation back office opens for Australia-origin shipments.', 'sulekha-kpo' ) ),
		array( 'year' => '2019', 'title' => __( 'Team expansion', 'sulekha-kpo' ), 'text' => __( 'The back office grows bigger and recruits more people.', 'sulekha-kpo' ) ),
		array( 'year' => '2020', 'title' => __( 'Uninterrupted operation', 'sulekha-kpo' ), 'text' => __( 'Work continued without interruption through the lockdowns.', 'sulekha-kpo' ) ),
		array( 'year' => '2021', 'title' => __( 'BPO calling process', 'sulekha-kpo' ), 'text' => __( 'A calling process is implemented alongside documentation.', 'sulekha-kpo' ) ),
	);
}

/**
 * Gallery strip captions (image file => caption).
 *
 * @return array
 */
function sulekha_default_gallery() {
	return array(
		'gallery-1.jpg' => __( 'Collaborative delivery', 'sulekha-kpo' ),
		'gallery-2.jpg' => __( 'Training sessions', 'sulekha-kpo' ),
		'gallery-3.jpg' => __( 'Shipment tracking', 'sulekha-kpo' ),
		'gallery-4.jpg' => __( 'Our workspace', 'sulekha-kpo' ),
		'gallery-5.jpg' => __( 'Client reviews', 'sulekha-kpo' ),
	);
}

/**
 * "Why clients rely on us" strip.
 *
 * @return array
 */
function sulekha_default_trust() {
	return array(
		/* translators: %d: year operations started */
		array( 'icon' => 'award', 'title' => sprintf( __( 'Operating since %d', 'sulekha-kpo' ), SULEKHA_FOUNDED ) ),
		array( 'icon' => 'shield', 'title' => __( 'Uninterrupted through lockdowns', 'sulekha-kpo' ) ),
		array( 'icon' => 'search', 'title' => __( 'Stage-wise document review', 'sulekha-kpo' ) ),
		array( 'icon' => 'users', 'title' => __( 'Trained resources', 'sulekha-kpo' ) ),
		array( 'icon' => 'pin', 'title' => __( 'Jamshedpur, India', 'sulekha-kpo' ) ),
	);
}

/**
 * Placeholder testimonials, shown until real ones are added under Testimonials.
 *
 * @return array
 */
function sulekha_default_testimonials() {
	return array(
		array(
			'quote' => __( 'Replace this with a quote from a real client. Add testimonials under Testimonials in the dashboard and these placeholders disappear.', 'sulekha-kpo' ),
			'name'  => __( 'Client name', 'sulekha-kpo' ),
			'role'  => __( 'Role, Company', 'sulekha-kpo' ),
		),
		array(
			'quote' => __( 'A good testimonial names a specific result: documents always on time, fewer amendments or detention avoided, in the client’s own words.', 'sulekha-kpo' ),
			'name'  => __( 'Client name', 'sulekha-kpo' ),
			'role'  => __( 'Role, Company', 'sulekha-kpo' ),
		),
		array(
			'quote' => __( 'Two to four sentences works best. Ask the client for permission before publishing their name and company.', 'sulekha-kpo' ),
			'name'  => __( 'Client name', 'sulekha-kpo' ),
			'role'  => __( 'Role, Company', 'sulekha-kpo' ),
		),
	);
}

/**
 * "Why Sulekha" points in the about section.
 *
 * @return array
 */
function sulekha_default_reasons() {
	return array(
		array(
			'icon'  => 'award',
			'title' => __( 'Founded by an export professional', 'sulekha-kpo' ),
			'text'  => __( 'Hands-on experience in the export teams of multinational companies.', 'sulekha-kpo' ),
		),
		array(
			'icon'  => 'rocket',
			'title' => __( 'Quick to adapt', 'sulekha-kpo' ),
			'text'  => __( 'We adapt quickly to change, helping businesses grow and compete.', 'sulekha-kpo' ),
		),
		array(
			'icon'  => 'shield',
			'title' => __( 'Reliable under pressure', 'sulekha-kpo' ),
			'text'  => __( 'Operations ran without interruption through the 2020 lockdowns.', 'sulekha-kpo' ),
		),
		array(
			'icon'  => 'check',
			'title' => __( 'Reviewed before going live', 'sulekha-kpo' ),
			'text'  => __( 'Every team member passes stage-wise reviews before handling live shipments.', 'sulekha-kpo' ),
		),
	);
}
