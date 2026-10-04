<?php
/**
 * Job applications: private storage and admin screens.
 *
 * Applications are saved as a private post type that only administrators can see.
 * Resumes live in a randomly named folder inside uploads that blocks direct web
 * access, and are downloaded through an admin-only handler.
 *
 * @package Sulekha_KPO
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Application statuses (key => label).
 *
 * @return array
 */
function sulekha_application_statuses() {
	return array(
		'new'         => __( 'New', 'sulekha-kpo' ),
		'reviewed'    => __( 'Reviewed', 'sulekha-kpo' ),
		'shortlisted' => __( 'Shortlisted', 'sulekha-kpo' ),
		'rejected'    => __( 'Rejected', 'sulekha-kpo' ),
	);
}

/**
 * Register the private Application post type (administrators only).
 */
function sulekha_register_applications() {
	$cap = 'manage_options';
	register_post_type(
		'kpo_application',
		array(
			'labels'              => array(
				'name'               => __( 'Applications', 'sulekha-kpo' ),
				'singular_name'      => __( 'Application', 'sulekha-kpo' ),
				'edit_item'          => __( 'Application', 'sulekha-kpo' ),
				'all_items'          => __( 'All Applications', 'sulekha-kpo' ),
				'search_items'       => __( 'Search Applications', 'sulekha-kpo' ),
				'not_found'          => __( 'No applications yet.', 'sulekha-kpo' ),
				'not_found_in_trash' => __( 'No applications in the trash.', 'sulekha-kpo' ),
			),
			'public'              => false,
			'publicly_queryable'  => false,
			'exclude_from_search' => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_rest'        => false,
			'menu_position'       => 26,
			'menu_icon'           => 'dashicons-id-alt',
			'supports'            => array( 'title' ),
			'map_meta_cap'        => false,
			'capabilities'        => array(
				'create_posts'           => 'do_not_allow',
				'edit_post'              => $cap,
				'read_post'              => $cap,
				'delete_post'            => $cap,
				'edit_posts'             => $cap,
				'edit_others_posts'      => $cap,
				'edit_published_posts'   => $cap,
				'edit_private_posts'     => $cap,
				'publish_posts'          => $cap,
				'read_private_posts'     => $cap,
				'delete_posts'           => $cap,
				'delete_others_posts'    => $cap,
				'delete_published_posts' => $cap,
				'delete_private_posts'   => $cap,
			),
		)
	);
}
add_action( 'init', 'sulekha_register_applications' );

/* -------------------------------------------------------------------------
 * Resume storage
 * ---------------------------------------------------------------------- */

/**
 * Absolute path of the protected resume folder, created on first use.
 *
 * @return string|false Folder path, or false if it can't be created.
 */
function sulekha_resume_dir() {
	$key = get_option( 'sulekha_resume_dir_key' );
	if ( ! $key ) {
		$key = strtolower( wp_generate_password( 20, false ) );
		update_option( 'sulekha_resume_dir_key', $key, false );
	}

	$uploads = wp_upload_dir( null, false );
	$dir     = trailingslashit( $uploads['basedir'] ) . 'sulekha-resumes-' . $key;

	if ( ! is_dir( $dir ) && ! wp_mkdir_p( $dir ) ) {
		return false;
	}

	// Block direct access on Apache/LiteSpeed; the random folder and file names cover other servers.
	if ( ! file_exists( $dir . '/.htaccess' ) ) {
		file_put_contents( $dir . '/.htaccess', "<IfModule mod_authz_core.c>\n\tRequire all denied\n</IfModule>\n<IfModule !mod_authz_core.c>\n\tDeny from all\n</IfModule>\n" ); // phpcs:ignore WordPress.WP.AlternativeFunctions
	}
	if ( ! file_exists( $dir . '/index.php' ) ) {
		file_put_contents( $dir . '/index.php', "<?php\n// Silence is golden.\n" ); // phpcs:ignore WordPress.WP.AlternativeFunctions
	}

	return $dir;
}

/**
 * Full path of an application's stored resume, if it still exists.
 *
 * @param int $post_id Application ID.
 * @return string|false
 */
function sulekha_application_resume_path( $post_id ) {
	$file = get_post_meta( $post_id, '_resume_file', true );
	$dir  = sulekha_resume_dir();
	if ( ! $file || ! $dir ) {
		return false;
	}
	$path = $dir . '/' . basename( $file );
	return file_exists( $path ) ? $path : false;
}

/**
 * Admin-only download URL for an application's resume.
 *
 * @param int $post_id Application ID.
 * @return string
 */
function sulekha_resume_download_url( $post_id ) {
	return wp_nonce_url( admin_url( 'admin-post.php?action=sulekha_resume&id=' . (int) $post_id ), 'sulekha_resume_' . (int) $post_id );
}

/**
 * Stream a resume to an administrator.
 */
function sulekha_download_resume() {
	$id = isset( $_GET['id'] ) ? absint( $_GET['id'] ) : 0;

	if ( ! $id || ! current_user_can( 'manage_options' ) || ! check_admin_referer( 'sulekha_resume_' . $id ) ) {
		wp_die( esc_html__( 'You are not allowed to download this file.', 'sulekha-kpo' ), 403 );
	}
	if ( 'kpo_application' !== get_post_type( $id ) ) {
		wp_die( esc_html__( 'Application not found.', 'sulekha-kpo' ), 404 );
	}

	$path = sulekha_application_resume_path( $id );
	if ( ! $path ) {
		wp_die( esc_html__( 'The resume file is no longer available.', 'sulekha-kpo' ), 404 );
	}

	$ext   = strtolower( pathinfo( $path, PATHINFO_EXTENSION ) );
	$mimes = sulekha_resume_mimes();
	$name  = 'resume-' . sanitize_file_name( sanitize_title( get_the_title( $id ) ) ) . '.' . $ext;

	nocache_headers();
	header( 'Content-Type: ' . ( isset( $mimes[ $ext ] ) ? $mimes[ $ext ] : 'application/octet-stream' ) );
	header( 'Content-Disposition: attachment; filename="' . $name . '"' );
	header( 'Content-Length: ' . filesize( $path ) );
	header( 'X-Content-Type-Options: nosniff' );
	readfile( $path ); // phpcs:ignore WordPress.WP.AlternativeFunctions
	exit;
}
add_action( 'admin_post_sulekha_resume', 'sulekha_download_resume' );

/**
 * Delete the resume file when an application is permanently deleted.
 *
 * @param int $post_id Post ID.
 */
function sulekha_delete_application_resume( $post_id ) {
	if ( 'kpo_application' !== get_post_type( $post_id ) ) {
		return;
	}
	$path = sulekha_application_resume_path( $post_id );
	if ( $path ) {
		wp_delete_file( $path );
	}
}
add_action( 'before_delete_post', 'sulekha_delete_application_resume' );

/* -------------------------------------------------------------------------
 * Admin list screen
 * ---------------------------------------------------------------------- */

/**
 * Columns for the applications list.
 *
 * @return array
 */
function sulekha_application_columns() {
	return array(
		'cb'         => '<input type="checkbox">',
		'title'      => __( 'Name', 'sulekha-kpo' ),
		'contact'    => __( 'Contact', 'sulekha-kpo' ),
		'role'       => __( 'Area of interest', 'sulekha-kpo' ),
		'experience' => __( 'Experience', 'sulekha-kpo' ),
		'status'     => __( 'Status', 'sulekha-kpo' ),
		'resume'     => __( 'Resume', 'sulekha-kpo' ),
		'date'       => __( 'Received', 'sulekha-kpo' ),
	);
}
add_filter( 'manage_kpo_application_posts_columns', 'sulekha_application_columns' );

/**
 * Status badge HTML.
 *
 * @param string $status Status key.
 * @return string
 */
function sulekha_status_badge( $status ) {
	$labels = sulekha_application_statuses();
	$status = isset( $labels[ $status ] ) ? $status : 'new';
	return sprintf( '<span class="sulekha-status sulekha-status-%1$s">%2$s</span>', esc_attr( $status ), esc_html( $labels[ $status ] ) );
}

/**
 * Column contents.
 *
 * @param string $column  Column key.
 * @param int    $post_id Post ID.
 */
function sulekha_application_column( $column, $post_id ) {
	switch ( $column ) {
		case 'contact':
			$email = get_post_meta( $post_id, '_email', true );
			$phone = get_post_meta( $post_id, '_phone', true );
			if ( $email ) {
				printf( '<a href="mailto:%1$s">%2$s</a>', esc_attr( $email ), esc_html( $email ) );
			}
			if ( $phone ) {
				printf( '<br><a href="tel:%1$s">%2$s</a>', esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ), esc_html( $phone ) );
			}
			break;
		case 'role':
			echo esc_html( get_post_meta( $post_id, '_role', true ) );
			break;
		case 'experience':
			echo esc_html( get_post_meta( $post_id, '_experience', true ) );
			break;
		case 'status':
			echo sulekha_status_badge( get_post_meta( $post_id, '_status', true ) ); // phpcs:ignore WordPress.Security.EscapeOutput
			break;
		case 'resume':
			if ( sulekha_application_resume_path( $post_id ) ) {
				printf( '<a class="button button-small" href="%1$s">%2$s</a>', esc_url( sulekha_resume_download_url( $post_id ) ), esc_html__( 'Download', 'sulekha-kpo' ) );
			} else {
				echo '&mdash;';
			}
			break;
	}
}
add_action( 'manage_kpo_application_posts_custom_column', 'sulekha_application_column', 10, 2 );

/**
 * Status filter above the list.
 *
 * @param string $post_type Post type.
 */
function sulekha_application_status_filter( $post_type ) {
	if ( 'kpo_application' !== $post_type ) {
		return;
	}
	$current = isset( $_GET['app_status'] ) ? sanitize_key( $_GET['app_status'] ) : ''; // phpcs:ignore WordPress.Security.NonceVerification
	echo '<select name="app_status"><option value="">' . esc_html__( 'All statuses', 'sulekha-kpo' ) . '</option>';
	foreach ( sulekha_application_statuses() as $key => $label ) {
		printf( '<option value="%1$s" %2$s>%3$s</option>', esc_attr( $key ), selected( $current, $key, false ), esc_html( $label ) );
	}
	echo '</select>';
}
add_action( 'restrict_manage_posts', 'sulekha_application_status_filter' );

/**
 * Apply the status filter, and let search match email and phone as well as name.
 *
 * @param WP_Query $query Query.
 */
function sulekha_application_list_query( $query ) {
	if ( ! is_admin() || ! $query->is_main_query() || 'kpo_application' !== $query->get( 'post_type' ) ) {
		return;
	}
	$status = isset( $_GET['app_status'] ) ? sanitize_key( $_GET['app_status'] ) : ''; // phpcs:ignore WordPress.Security.NonceVerification
	if ( $status && array_key_exists( $status, sulekha_application_statuses() ) ) {
		$query->set( 'meta_query', array( array( 'key' => '_status', 'value' => $status ) ) );
	}
}
add_action( 'pre_get_posts', 'sulekha_application_list_query' );

/**
 * Remove "Quick Edit" and "View" row actions.
 *
 * @param array   $actions Actions.
 * @param WP_Post $post    Post.
 * @return array
 */
function sulekha_application_row_actions( $actions, $post ) {
	if ( 'kpo_application' === $post->post_type ) {
		unset( $actions['inline hide-if-no-js'], $actions['view'] );
		$actions = array( 'open' => sprintf( '<a href="%1$s">%2$s</a>', esc_url( get_edit_post_link( $post->ID ) ), esc_html__( 'Open', 'sulekha-kpo' ) ) ) + $actions;
		unset( $actions['edit'] );
	}
	return $actions;
}
add_filter( 'post_row_actions', 'sulekha_application_row_actions', 10, 2 );

/**
 * Show the number of new applications as a badge on the admin menu.
 */
function sulekha_application_menu_badge() {
	global $menu;
	if ( ! current_user_can( 'manage_options' ) || ! is_array( $menu ) ) {
		return;
	}
	$new = new WP_Query(
		array(
			'post_type'      => 'kpo_application',
			'post_status'    => 'publish',
			'meta_key'       => '_status', // phpcs:ignore WordPress.DB.SlowDBQuery
			'meta_value'     => 'new', // phpcs:ignore WordPress.DB.SlowDBQuery
			'fields'         => 'ids',
			'posts_per_page' => 1,
		)
	);
	if ( ! $new->found_posts ) {
		return;
	}
	foreach ( $menu as $i => $item ) {
		if ( 'edit.php?post_type=kpo_application' === $item[2] ) {
			$menu[ $i ][0] .= sprintf( ' <span class="awaiting-mod count-%1$d"><span class="pending-count">%1$d</span></span>', (int) $new->found_posts ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride
			break;
		}
	}
}
add_action( 'admin_menu', 'sulekha_application_menu_badge', 99 );

/* -------------------------------------------------------------------------
 * Single application screen
 * ---------------------------------------------------------------------- */

/**
 * Mark an application as reviewed the first time an admin opens it.
 */
function sulekha_mark_application_reviewed() {
	$id = isset( $_GET['post'] ) ? absint( $_GET['post'] ) : 0; // phpcs:ignore WordPress.Security.NonceVerification
	if ( $id && 'kpo_application' === get_post_type( $id ) && 'new' === get_post_meta( $id, '_status', true ) && current_user_can( 'manage_options' ) ) {
		update_post_meta( $id, '_status', 'reviewed' );
	}
}
add_action( 'load-post.php', 'sulekha_mark_application_reviewed' );

/**
 * Details meta box.
 */
function sulekha_application_meta_boxes() {
	add_meta_box( 'sulekha_application_details', __( 'Application details', 'sulekha-kpo' ), 'sulekha_application_details_box', 'kpo_application', 'normal', 'high' );
	add_meta_box( 'sulekha_application_status', __( 'Status', 'sulekha-kpo' ), 'sulekha_application_status_box', 'kpo_application', 'side', 'high' );
}
add_action( 'add_meta_boxes', 'sulekha_application_meta_boxes' );

/**
 * Render the details box.
 *
 * @param WP_Post $post Post.
 */
function sulekha_application_details_box( $post ) {
	$email   = get_post_meta( $post->ID, '_email', true );
	$phone   = get_post_meta( $post->ID, '_phone', true );
	$rows    = array(
		__( 'Email', 'sulekha-kpo' )            => $email ? sprintf( '<a href="mailto:%1$s">%2$s</a>', esc_attr( $email ), esc_html( $email ) ) : '&mdash;',
		__( 'Phone', 'sulekha-kpo' )            => $phone ? sprintf( '<a href="tel:%1$s">%2$s</a>', esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ), esc_html( $phone ) ) : '&mdash;',
		__( 'Area of interest', 'sulekha-kpo' ) => esc_html( get_post_meta( $post->ID, '_role', true ) ),
		__( 'Experience', 'sulekha-kpo' )       => esc_html( get_post_meta( $post->ID, '_experience', true ) ),
		__( 'Received', 'sulekha-kpo' )         => esc_html( get_the_date( get_option( 'date_format' ) . ' ' . get_option( 'time_format' ), $post ) ),
		__( 'Email notification', 'sulekha-kpo' ) => get_post_meta( $post->ID, '_mail_sent', true ) ? esc_html__( 'Sent', 'sulekha-kpo' ) : '<strong style="color:#b32d2e">' . esc_html__( 'Not sent (check your site’s email settings)', 'sulekha-kpo' ) . '</strong>',
	);
	echo '<table class="form-table" role="presentation"><tbody>';
	foreach ( $rows as $label => $value ) {
		printf( '<tr><th scope="row">%1$s</th><td>%2$s</td></tr>', esc_html( $label ), $value ); // phpcs:ignore WordPress.Security.EscapeOutput
	}
	$message = get_post_meta( $post->ID, '_message', true );
	printf( '<tr><th scope="row">%1$s</th><td>%2$s</td></tr>', esc_html__( 'Message', 'sulekha-kpo' ), $message ? nl2br( esc_html( $message ) ) : '&mdash;' );
	echo '</tbody></table>';

	if ( sulekha_application_resume_path( $post->ID ) ) {
		printf( '<p><a class="button button-primary button-large" href="%1$s"><span class="dashicons dashicons-download" style="margin:4px 4px 0 -2px"></span>%2$s</a></p>', esc_url( sulekha_resume_download_url( $post->ID ) ), esc_html__( 'Download resume', 'sulekha-kpo' ) );
	} else {
		echo '<p><em>' . esc_html__( 'No resume file is stored for this application.', 'sulekha-kpo' ) . '</em></p>';
	}
	if ( $email ) {
		printf( '<p><a class="button" href="mailto:%1$s">%2$s</a></p>', esc_attr( $email ), esc_html__( 'Reply by email', 'sulekha-kpo' ) );
	}
}

/**
 * Render the status box.
 *
 * @param WP_Post $post Post.
 */
function sulekha_application_status_box( $post ) {
	wp_nonce_field( 'sulekha_application_status', 'sulekha_application_status_nonce' );
	$current = get_post_meta( $post->ID, '_status', true );
	echo '<select name="sulekha_status" style="width:100%">';
	foreach ( sulekha_application_statuses() as $key => $label ) {
		printf( '<option value="%1$s" %2$s>%3$s</option>', esc_attr( $key ), selected( $current, $key, false ), esc_html( $label ) );
	}
	echo '</select><p class="description">' . esc_html__( 'Click Update to save.', 'sulekha-kpo' ) . '</p>';
}

/**
 * Save the status.
 *
 * @param int $post_id Post ID.
 */
function sulekha_save_application_status( $post_id ) {
	if ( ! isset( $_POST['sulekha_application_status_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['sulekha_application_status_nonce'] ), 'sulekha_application_status' ) ) {
		return;
	}
	if ( ! current_user_can( 'manage_options' ) || ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) ) {
		return;
	}
	$status = isset( $_POST['sulekha_status'] ) ? sanitize_key( $_POST['sulekha_status'] ) : '';
	if ( array_key_exists( $status, sulekha_application_statuses() ) ) {
		update_post_meta( $post_id, '_status', $status );
	}
}
add_action( 'save_post_kpo_application', 'sulekha_save_application_status' );

/**
 * Admin styles for status badges.
 */
function sulekha_application_admin_css() {
	$screen = get_current_screen();
	if ( ! $screen || 'kpo_application' !== $screen->post_type ) {
		return;
	}
	echo '<style>
		.sulekha-status{display:inline-block;padding:3px 10px;border-radius:999px;font-size:12px;font-weight:600;line-height:1.6}
		.sulekha-status-new{background:#fcf0d4;color:#8a5a00}
		.sulekha-status-reviewed{background:#e5eaf6;color:#3a4f8e}
		.sulekha-status-shortlisted{background:#e3f4ea;color:#146c43}
		.sulekha-status-rejected{background:#f0f0f1;color:#50575e}
		.column-status,.column-resume,.column-experience{width:120px}
		.post-type-kpo_application .page-title-action{display:none}
	</style>';
}
add_action( 'admin_head', 'sulekha_application_admin_css' );
