<?php
// Custom Post Type: Blocks
function jdf_render_block() {

	$labels = array(
		'name'                  => _x( 'Blocks', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Block', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Blocks', 'text_domain' ),
		'name_admin_bar'        => __( 'Block', 'text_domain' ),
		'archives'              => __( 'Block Archives', 'text_domain' ),
		'attributes'            => __( 'Block Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Block:', 'text_domain' ),
		'all_items'             => __( 'All Blocks', 'text_domain' ),
		'add_new_item'          => __( 'Add New Block', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Block', 'text_domain' ),
		'edit_item'             => __( 'Edit Block', 'text_domain' ),
		'update_item'           => __( 'Update Block', 'text_domain' ),
		'view_item'             => __( 'View Block', 'text_domain' ),
		'view_items'            => __( 'View Blocks', 'text_domain' ),
		'search_items'          => __( 'Search Block', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into Block', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Block', 'text_domain' ),
		'items_list'            => __( 'Blocks list', 'text_domain' ),
		'items_list_navigation' => __( 'Blocks list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter Blocks list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Block', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'revisions' ),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'menu_icon'				=> 'dashicons-block-default'
	);

	register_post_type( 'blocks', $args ); // Registered post type name must not exceed 20 characters.

}
add_action( 'init', 'jdf_render_block', 0 );
?>