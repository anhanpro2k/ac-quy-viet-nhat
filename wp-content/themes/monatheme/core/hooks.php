<?php

/**
 * Undocumented function
 *
 * @return void
 */
function my_custom_fonts() {
	echo '<style>

    .menu-item-bar .menu-item-handle {
    border: 1px solid #dcdcde;
    position: relative;
    padding: 10px 15px;
    height: auto;
    min-height: 20px;
    max-width: 100%;
    line-height: 2.30769230;
    overflow: hidden;
    word-wrap: break-word;
}
.menu-item-settings {
    display: block;
    max-width: 100%;
    padding: 10px;
    position: relative;
    z-index: 10;
    border: 1px solid #c3c4c7;
    border-top: none;
    box-shadow: 0 1px 1px rgba(0,0,0,.04);
}

  </style>';
}

add_action( 'admin_head', 'my_custom_fonts' );
function add_after_setup_theme() {
	// regsiter menu
	register_nav_menus(
		[
			'primary-menu' => __( 'Theme Main Menu', 'monamedia' ),
		]
	);

	// regsiter menu
	register_nav_menus(
		[
			'policy-menu'      => __( 'Policy Menu', 'monamedia' ),
			'poli-menu'        => __( 'Menu Chính sách', 'monamedia' ),
			'sp-menu'          => __( 'Menu Sản phẩm', 'monamedia' ),
			'service-menu'     => __( 'Menu Dịch vụ', 'monamedia' ),
			'menu-product-tax' => __( 'Danh mục sản phẩm', 'monamedia' ),
			'menu-mobile'      => __( 'Menu Mobile', 'monamedia' ),
		]
	);


	// add size image
	add_image_size( 'banner-desktop-image', 1920, 790, false );
	// add_image_size( 'banner-mobile-image', 400, 675, false );
	add_image_size( 'medium-square', 600, 600, false );
	add_image_size( '300x200', 300, 200, false );
	add_image_size( '100x100', 100, 100, false );
	add_image_size( '1728x460', 1730, 460, false );
	add_image_size( '1728x640', 1730, 640, false );
}

add_action( 'after_setup_theme', 'add_after_setup_theme' );

/**
 * Undocumented function
 *
 * @return void
 */
function mona_add_styles_scripts() {
	wp_enqueue_style( 'mona-custom', get_template_directory_uri() . '/public/helpers/css/mona-custom.css', array(), rand() );
	wp_enqueue_script( 'mona-frontend', get_template_directory_uri() . '/public/helpers/scripts/mona-frontend.js', array(), false, true );
	wp_enqueue_script( 'mona-frontend', get_template_directory_uri() . '/public/helpers/scripts/jquery-confirm.min.js', array(), false, true );
	wp_enqueue_style( 'mona-custom-l', get_template_directory_uri() . '/public/helpers/css/mona-custom-l.css', array(), rand() );
	wp_localize_script(
		'mona-frontend',
		'mona_ajax_url',
		[
			'ajaxURL' => admin_url( 'admin-ajax.php' ),
			'siteURL' => get_site_url(),
		]
	);
}

add_action( 'wp_enqueue_scripts', 'mona_add_styles_scripts' );

/**
 * Undocumented function
 *
 * @param [type] $tag
 * @param [type] $handle
 * @param [type] $src
 *
 * @return void
 */
function mona_add_module_to_my_script( $tag, $handle, $src ) {
	if ( 'mona-frontend' === $handle ) {
		$tag = '<script type="module" src="' . esc_url( $src ) . '"></script>';
	}

	return $tag;
}

add_filter( 'script_loader_tag', 'mona_add_module_to_my_script', 10, 3 );

/**
 * Undocumented function
 *
 * @return void
 */
function mona_redirect_external_after_logout() {
	wp_redirect( get_the_permalink( MONA_PAGE_HOME ) );
	exit();
}

//add_action( 'wp_logout', 'mona_redirect_external_after_logout' );

/**
 * Undocumented function
 *
 * @param [type] $query
 *
 * @return void
 */
function mona_parse_request_post_type( $query ) {
	if ( ! is_admin() ) {
		$query->set( 'ignore_sticky_posts', true );
		$ptype = $query->get( 'post_type', true );
		$ptype = (array) $ptype;

		// if ( isset( $_GET['s'] ) ) {
		//     $ptype[] = 'post';
		//     $query->set('post_type', $ptype);
		//     $query->set( 'posts_per_page' , 12);
		// }

		if ( $query->is_main_query() && $query->is_tax( 'category_library' ) ) {
			$ptype[] = 'mona_library';
			$query->set( 'post_type', $ptype );
			$query->set( 'posts_per_page', 12 );
		}
	}

	return $query;
}

add_filter( 'pre_get_posts', 'mona_parse_request_post_type' );

/**
 * Undocumented function
 *
 * @return void
 */
function mona_register_sidebars() {
	register_sidebar(
		[
			'id'            => 'sidebar_news',
			'name'          => __( 'Sidebar Tin Tức', 'mona-admin' ),
			'description'   => __( 'Sidebar tin tức.', 'mona-admin' ),
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
		]
	);
	register_sidebar(
		[
			'id'            => 'sidebar_menu_sp',
			'name'          => __( 'Menu Sản phẩm', 'mona-admin' ),
			'description'   => __( 'Menu Sản phẩm', 'mona-admin' ),
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<p class="footer-item-tt">',
			'after_title'   => '</p>',
		]
	);
	register_sidebar(
		[
			'id'            => 'sidebar_menu_pol',
			'name'          => __( 'Chính sách', 'mona-admin' ),
			'description'   => __( 'Chính sách', 'mona-admin' ),
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<p class="footer-item-tt">',
			'after_title'   => '</p>',
		]
	);
	register_sidebar(
		[
			'id'            => 'sidebar_menu_service',
			'name'          => __( 'Dịch vụ', 'mona-admin' ),
			'description'   => __( 'Dịch vụ', 'mona-admin' ),
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<p class="footer-item-tt">',
			'after_title'   => '</p>',
		]
	);
}

add_action( 'widgets_init', 'mona_register_sidebars' );

/**
 * Undocumented function
 *
 * @param [type] $post_states
 * @param [type] $post
 *
 * @return void
 */
function mona_add_post_state( $post_states, $post ) {
	if ( $post->ID == MONA_PAGE_HOME ) {
		$post_states[] = __( 'PAGE - Trang chủ', 'mona-admin' );
	}
	if ( $post->ID == MONA_PAGE_BLOG ) {
		$post_states[] = __( 'PAGE - Trang Tin tức', 'mona-admin' );
	}

	return $post_states;
}

add_filter( 'display_post_states', 'mona_add_post_state', 10, 2 );

/**
 * Undocumented function
 *
 * @param [type] $html
 *
 * @return void
 */
function mona_change_logo_class( $html ) {
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$html           = sprintf(
		'<a href="%1$s" class="header-icon" rel="home" itemprop="url"><div class="icon">%2$s</div></a>',
		esc_url( home_url() ),
		wp_get_attachment_image(
			$custom_logo_id,
			'full',
			false,
			[
				'class' => 'header-logo-image',
			]
		)
	);

	return $html;
}

//add_filter( 'get_custom_logo', 'mona_change_logo_class' );

/**
 * Undocumented function
 *
 * @param [type] $url
 * @param [type] $path
 * @param [type] $blog_id
 *
 * @return void
 */
function mona_filter_admin_url( $url, $path, $blog_id ) {
	if ( $path === 'admin-ajax.php' && ! is_admin() ) {
		$url .= '?mona-ajax';
	}

	return $url;
}

add_filter( 'admin_url', 'mona_filter_admin_url', 999, 3 );
