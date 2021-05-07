<?php

/**
 * Registers the `movie` post type.
 */
function movie_init() {
	register_post_type( 'movie', array(
		'labels'                => array(
			'name'                  => __( 'Movies', 'movie' ),
			'singular_name'         => __( 'Movie', 'movie' ),
			'all_items'             => __( 'All Movies', 'movie' ),
			'archives'              => __( 'Movie Archives', 'movie' ),
			'attributes'            => __( 'Movie Attributes', 'movie' ),
			'insert_into_item'      => __( 'Insert into Movie', 'movie' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Movie', 'movie' ),
			'featured_image'        => _x( 'Featured Image', 'movie', 'movie' ),
			'set_featured_image'    => _x( 'Set featured image', 'movie', 'movie' ),
			'remove_featured_image' => _x( 'Remove featured image', 'movie', 'movie' ),
			'use_featured_image'    => _x( 'Use as featured image', 'movie', 'movie' ),
			'filter_items_list'     => __( 'Filter Movies list', 'movie' ),
			'items_list_navigation' => __( 'Movies list navigation', 'movie' ),
			'items_list'            => __( 'Movies list', 'movie' ),
			'new_item'              => __( 'New Movie', 'movie' ),
			'add_new'               => __( 'Add New', 'movie' ),
			'add_new_item'          => __( 'Add New Movie', 'movie' ),
			'edit_item'             => __( 'Edit Movie', 'movie' ),
			'view_item'             => __( 'View Movie', 'movie' ),
			'view_items'            => __( 'View Movies', 'movie' ),
			'search_items'          => __( 'Search Movies', 'movie' ),
			'not_found'             => __( 'No Movies found', 'movie' ),
			'not_found_in_trash'    => __( 'No Movies found in trash', 'movie' ),
			'parent_item_colon'     => __( 'Parent Movie:', 'movie' ),
			'menu_name'             => __( 'Movies', 'movie' ),
		),
		'public'                => true,
		'hierarchical'          => false,
		'show_ui'               => true,
		'show_in_nav_menus'     => true,
		'supports'              => array( 'title', 'editor' ),
		'has_archive'           => true,
		'rewrite'               => true,
		'query_var'             => true,
		'menu_position'         => null,
		'menu_icon'             => 'dashicons-admin-post',
		'show_in_rest'          => true,
		'rest_base'             => 'movie',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	) );

}
add_action( 'init', 'movie_init' );

/**
 * Sets the post updated messages for the `movie` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `movie` post type.
 */
function movie_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['movie'] = array(
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Movie updated. <a target="_blank" href="%s">View Movie</a>', 'movie' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'movie' ),
		3  => __( 'Custom field deleted.', 'movie' ),
		4  => __( 'Movie updated.', 'movie' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Movie restored to revision from %s', 'movie' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Movie published. <a href="%s">View Movie</a>', 'movie' ), esc_url( $permalink ) ),
		7  => __( 'Movie saved.', 'movie' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Movie submitted. <a target="_blank" href="%s">Preview Movie</a>', 'movie' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Movie scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Movie</a>', 'movie' ),
		date_i18n( __( 'M j, Y @ G:i', 'movie' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Movie draft updated. <a target="_blank" href="%s">Preview Movie</a>', 'movie' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'movie_updated_messages' );
