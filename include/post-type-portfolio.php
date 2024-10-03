<?php 

/**
 * Register a custom post type called "Portfolio".
 *
 * @see get_post_type_labels() for label keys.
 */
function myblogger_portfolio_post_type() {
	$labels = array(
		'name'                  => _x( 'Portfolios', 'Post type general name', 'textdomain' ),
		'singular_name'         => _x( 'Portfolio', 'Post type singular name', 'textdomain' ),
		'menu_name'             => _x( 'Portfolios', 'Admin Menu text', 'textdomain' ),
		'name_admin_bar'        => _x( 'Portfolio', 'Add New on Toolbar', 'textdomain' ),
		'add_new'               => __( 'Add New', 'textdomain' ),
		'add_new_item'          => __( 'Add New Portfolio', 'textdomain' ),
		'new_item'              => __( 'New Portfolio', 'textdomain' ),
		'edit_item'             => __( 'Edit Portfolio', 'textdomain' ),
		'view_item'             => __( 'View Portfolio', 'textdomain' ),
		'all_items'             => __( 'All Portfolios', 'textdomain' ),
		'search_items'          => __( 'Search Portfolios', 'textdomain' ),
		'parent_item_colon'     => __( 'Parent Portfolios:', 'textdomain' ),
		'not_found'             => __( 'No Portfolios found.', 'textdomain' ),
		'not_found_in_trash'    => __( 'No Portfolios found in Trash.', 'textdomain' ),
		'featured_image'        => _x( 'Portfolio Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
		'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
		'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
		'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
		'archives'              => _x( 'Portfolio archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
		'insert_into_item'      => _x( 'Insert into Portfolio', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
		'uploaded_to_this_item' => _x( 'Uploaded to this Portfolio', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
		'filter_items_list'     => _x( 'Filter Portfolios list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
		'items_list_navigation' => _x( 'Portfolios list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
		'items_list'            => _x( 'Portfolios list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'Portfolio' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
	);

	register_post_type( 'portfolio', $args );

    $labels = array(
		'name'              => _x( 'Portfolios', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Portfolio', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Portfolios', 'textdomain' ),
		'all_items'         => __( 'All Portfolios', 'textdomain' ),
		'parent_item'       => __( 'Parent Portfolio', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Portfolio:', 'textdomain' ),
		'edit_item'         => __( 'Edit Portfolio', 'textdomain' ),
		'update_item'       => __( 'Update Portfolio', 'textdomain' ),
		'add_new_item'      => __( 'Add New Portfolio', 'textdomain' ),
		'new_item_name'     => __( 'New Portfolio Name', 'textdomain' ),
		'menu_name'         => __( 'Portfolio Category', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'portfolio' ),
	);

	register_taxonomy( 'portfolio-cat', array( 'portfolio' ), $args );
}

add_action( 'init', 'myblogger_portfolio_post_type' );
