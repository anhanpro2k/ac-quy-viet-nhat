<?php
/**
 * Undocumented function
 *
 * @return void
 */
function mona_regsiter_custom_post_types() {


	$tax_brand = [
		'labels'            => [
			'name'              => __( 'Thương Hiệu Ắc Quy', 'mona-admin' ),
			'singular_name'     => __( 'Thương Hiệu Ắc Quy', 'mona-admin' ),
			'search_items'      => __( 'Tìm kiếm', 'mona-admin' ),
			'all_items'         => __( 'Tất cả Thương Hiệu Ắc Quy', 'mona-admin' ),
			'parent_item'       => __( 'Thương Hiệu Ắc Quy', 'mona-admin' ),
			'parent_item_colon' => __( 'Thương Hiệu Ắc Quy', 'mona-admin' ),
			'edit_item'         => __( 'Chỉnh sửa Thương Hiệu Ắc Quy', 'mona-admin' ),
			'add_new'           => __( 'Thêm Thương Hiệu Ắc Quy', 'mona-admin' ),
			'update_item'       => __( 'Cập nhật Thương Hiệu Ắc Quy', 'mona-admin' ),
			'add_new_item'      => __( 'Thêm Thương Hiệu Ắc Quy', 'mona-admin' ),
			'new_item_name'     => __( 'Thêm Thương Hiệu Ắc Quy', 'mona-admin' ),
			'menu_name'         => __( 'Thương Hiệu Ắc Quy', 'mona-admin' ),
		],
		'hierarchical'      => true,
		'show_admin_column' => true,
		'has_archive'       => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,

		'show_ui'      => true,
		'public'       => true,
		'rewrite'      => array(
			'slug'       => 'thuong-hieu',
			'with_front' => true
		),
		'capabilities' => [
			'manage_terms' => 'publish_posts',
			'edit_terms'   => 'publish_posts',
			'delete_terms' => 'publish_posts',
			'assign_terms' => 'publish_posts',
		],
	];
	register_taxonomy( 'category_brand', 'product', $tax_brand );

	
	$tax_vehicle_brand = [
		'labels'            => [
			'name'              => __( 'Thương hiệu xe', 'mona-admin' ),
			'singular_name'     => __( 'Thương hiệu xe', 'mona-admin' ),
			'search_items'      => __( 'Tìm kiếm', 'mona-admin' ),
			'all_items'         => __( 'Tất cả Thương hiệu xe', 'mona-admin' ),
			'parent_item'       => __( 'Thương hiệu xe', 'mona-admin' ),
			'parent_item_colon' => __( 'Thương hiệu xe', 'mona-admin' ),
			'edit_item'         => __( 'Chỉnh sửa Thương hiệu xe', 'mona-admin' ),
			'add_new'           => __( 'Thêm Thương hiệu xe', 'mona-admin' ),
			'update_item'       => __( 'Cập nhật Thương hiệu xe', 'mona-admin' ),
			'add_new_item'      => __( 'Thêm Thương hiệu xe', 'mona-admin' ),
			'new_item_name'     => __( 'Thêm Thương hiệu xe', 'mona-admin' ),
			'menu_name'         => __( 'Thương hiệu xe', 'mona-admin' ),
		],
		'hierarchical'      => true,
		'show_admin_column' => true,
		'has_archive'       => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'sort'              => true, // bật sắp xếp

		'show_ui'      => true,
		'public'       => true,
		'rewrite'      => array(
			'slug'       => 'thuong-hieu-xe',
			'with_front' => true
		),
		'capabilities' => [
			'manage_terms' => 'publish_posts',
			'edit_terms'   => 'publish_posts',
			'delete_terms' => 'publish_posts',
			'assign_terms' => 'publish_posts',
		],
	];
	register_taxonomy( 'category_vehicle_brand', 'product', $tax_vehicle_brand );
	flush_rewrite_rules();
}

add_action( 'init', 'mona_regsiter_custom_post_types' );