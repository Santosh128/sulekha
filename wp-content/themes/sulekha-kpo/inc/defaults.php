<?php
/**
 * Default front-page content used until the site owner adds their own.
 *
 * @package Sulekha_KPO
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Default KPO services (shown when no Service posts exist).
 *
 * @return array
 */
function sulekha_default_services() {
	return array(
		array(
			'icon'  => 'chart',
			'title' => __( 'Data Analytics & BI', 'sulekha-kpo' ),
			'text'  => __( 'Dashboards, predictive models and reporting pipelines that turn raw operational data into decisions.', 'sulekha-kpo' ),
		),
		array(
			'icon'  => 'calculator',
			'title' => __( 'Finance & Accounting', 'sulekha-kpo' ),
			'text'  => __( 'Bookkeeping, AP/AR, reconciliations, FP&A support and month-end close handled by qualified accountants.', 'sulekha-kpo' ),
		),
		array(
			'icon'  => 'search',
			'title' => __( 'Market & Business Research', 'sulekha-kpo' ),
			'text'  => __( 'Competitive intelligence, industry reports, company profiling and primary research for strategy teams.', 'sulekha-kpo' ),
		),
		array(
			'icon'  => 'scale',
			'title' => __( 'Legal Process Outsourcing', 'sulekha-kpo' ),
			'text'  => __( 'Contract review, legal research, document summarisation and compliance support for firms and in-house counsel.', 'sulekha-kpo' ),
		),
		array(
			'icon'  => 'heart',
			'title' => __( 'Healthcare & Medical Coding', 'sulekha-kpo' ),
			'text'  => __( 'Certified medical coding, billing support, claims processing and clinical data abstraction.', 'sulekha-kpo' ),
		),
		array(
			'icon'  => 'database',
			'title' => __( 'Data Management & Processing', 'sulekha-kpo' ),
			'text'  => __( 'Data entry, cleansing, enrichment, catalogue management and document digitisation at scale.', 'sulekha-kpo' ),
		),
	);
}

/**
 * Default industries.
 *
 * @return array
 */
function sulekha_default_industries() {
	return array(
		array( 'icon' => 'bank', 'title' => __( 'Banking & Financial Services', 'sulekha-kpo' ) ),
		array( 'icon' => 'heart', 'title' => __( 'Healthcare & Life Sciences', 'sulekha-kpo' ) ),
		array( 'icon' => 'truck', 'title' => __( 'Logistics & Supply Chain', 'sulekha-kpo' ) ),
		array( 'icon' => 'cart', 'title' => __( 'Retail & eCommerce', 'sulekha-kpo' ) ),
		array( 'icon' => 'scale', 'title' => __( 'Legal & Professional Services', 'sulekha-kpo' ) ),
		array( 'icon' => 'cpu', 'title' => __( 'Technology & SaaS', 'sulekha-kpo' ) ),
	);
}

/**
 * Default engagement process steps.
 *
 * @return array
 */
function sulekha_default_process() {
	return array(
		array(
			'title' => __( 'Discover', 'sulekha-kpo' ),
			'text'  => __( 'We map your current processes, volumes, quality benchmarks and pain points.', 'sulekha-kpo' ),
		),
		array(
			'title' => __( 'Design', 'sulekha-kpo' ),
			'text'  => __( 'A delivery model, SLAs, team structure and security controls tailored to your work.', 'sulekha-kpo' ),
		),
		array(
			'title' => __( 'Transition', 'sulekha-kpo' ),
			'text'  => __( 'Pilot, knowledge transfer and parallel runs so nothing slips during hand-over.', 'sulekha-kpo' ),
		),
		array(
			'title' => __( 'Deliver & improve', 'sulekha-kpo' ),
			'text'  => __( 'Steady-state delivery with monthly reviews, automation and continuous improvement.', 'sulekha-kpo' ),
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
		__( 'Financial Analysis', 'sulekha-kpo' ),
		__( 'Market Research', 'sulekha-kpo' ),
		__( 'Business Intelligence', 'sulekha-kpo' ),
		__( 'Contract Review', 'sulekha-kpo' ),
		__( 'Medical Coding', 'sulekha-kpo' ),
		__( 'Data Management', 'sulekha-kpo' ),
		__( 'Bookkeeping', 'sulekha-kpo' ),
		__( 'Competitive Intelligence', 'sulekha-kpo' ),
	);
}

/**
 * "Our approach" points for the split section.
 *
 * @return array
 */
function sulekha_default_approach() {
	return array(
		array(
			'icon'  => 'users',
			'title' => __( 'Dedicated teams, not a shared pool', 'sulekha-kpo' ),
			'text'  => __( 'Your analysts work only on your account, so knowledge stays with your business and quality compounds over time.', 'sulekha-kpo' ),
		),
		array(
			'icon'  => 'layers',
			'title' => __( 'Process documented from day one', 'sulekha-kpo' ),
			'text'  => __( 'Every task is captured in playbooks and checklists that you own, making scale-up and audits straightforward.', 'sulekha-kpo' ),
		),
		array(
			'icon'  => 'rocket',
			'title' => __( 'Automation where it pays off', 'sulekha-kpo' ),
			'text'  => __( 'We automate repetitive steps and keep people on the judgement calls, passing the savings on to you.', 'sulekha-kpo' ),
		),
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
		'gallery-2.jpg' => __( 'Knowledge sharing', 'sulekha-kpo' ),
		'gallery-3.jpg' => __( 'Analytics & reporting', 'sulekha-kpo' ),
		'gallery-4.jpg' => __( 'Modern workspace', 'sulekha-kpo' ),
		'gallery-5.jpg' => __( 'Client reviews', 'sulekha-kpo' ),
	);
}

/**
 * Security and compliance practices.
 *
 * @return array
 */
function sulekha_default_trust() {
	return array(
		array( 'icon' => 'file', 'title' => __( 'NDA-bound teams', 'sulekha-kpo' ) ),
		array( 'icon' => 'shield', 'title' => __( 'Role-based access', 'sulekha-kpo' ) ),
		array( 'icon' => 'database', 'title' => __( 'Encrypted data transfer', 'sulekha-kpo' ) ),
		array( 'icon' => 'search', 'title' => __( 'Full audit trails', 'sulekha-kpo' ) ),
		array( 'icon' => 'clock', 'title' => __( 'Business continuity', 'sulekha-kpo' ) ),
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
			'quote' => __( 'A good testimonial names a specific result: time saved, accuracy improved or costs reduced, in the client’s own words.', 'sulekha-kpo' ),
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
 * Default "why us" points.
 *
 * @return array
 */
function sulekha_default_reasons() {
	return array(
		array(
			'icon'  => 'users',
			'title' => __( 'Domain-trained analysts', 'sulekha-kpo' ),
			'text'  => __( 'Graduates, CAs, lawyers and certified coders, not generalists.', 'sulekha-kpo' ),
		),
		array(
			'icon'  => 'shield',
			'title' => __( 'Secure by default', 'sulekha-kpo' ),
			'text'  => __( 'NDA-bound staff, access controls and data-handling aligned to ISO 27001 and GDPR practice.', 'sulekha-kpo' ),
		),
		array(
			'icon'  => 'target',
			'title' => __( 'SLA-driven quality', 'sulekha-kpo' ),
			'text'  => __( 'Multi-level QA with accuracy and turnaround targets written into every contract.', 'sulekha-kpo' ),
		),
		array(
			'icon'  => 'clock',
			'title' => __( 'Follow-the-sun delivery', 'sulekha-kpo' ),
			'text'  => __( 'Shifts that overlap your business hours, whatever your time zone.', 'sulekha-kpo' ),
		),
	);
}
