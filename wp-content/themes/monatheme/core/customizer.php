<?php

if ( class_exists( 'Kirki' ) ) {

	/**
	 * Add sections
	 */
	function kirki_demo_scripts() {
		wp_enqueue_style( 'kirki-demo', get_stylesheet_uri(), array(), time() );
	}

	add_action( 'wp_enqueue_scripts', 'kirki_demo_scripts' );

	$priority = 1;

	/**
	 * Add panel
	 */
	// Kirki::add_panel( 'panel_contacts',
	//     [
	//         'title'     => __( 'Liên hệ', 'mona-admin' ),
	//         'priority'   => $priority++,
	//         'capability' => 'edit_theme_options',
	//     ]
	// );

	/**
	 * Add section
	 */
	Kirki::add_section( 'section_account',
		[
			'title'      => __( 'Tài Khoản', 'mona-admin' ),
			'priority'   => $priority ++,
			'capability' => 'edit_theme_options',
		]
	);

	/**
	 * Add field
	 */
	Kirki::add_field( 'mona_setting',
		[
			'type'        => 'textarea',
			'settings'    => 'account_change_pass_description',
			'label'       => __( 'Mô tả trang đổi mật khẩu', 'mona-admin' ),
			'description' => '',
			'help'        => '',
			'section'     => 'section_account',
			'default'     => '',
			'priority'    => $priority ++,
		]
	);

	/**
	 * Add field
	 */
	// kirki::add_field( 'mona_setting', [
	//     'type'        => 'repeater',
	//     'label'       => __( 'Danh sách liên kết', 'mona-admin' ),
	//     'section'     => 'section_contact_socials',
	//     'priority'    =>  $priority++,
	//     'row_label' => [
	//         'type'  => 'text',
	//         'value' => __( 'Liên kết', 'mona-admin' ),

	//     ],
	//     'button_label' => __( 'Thêm mới', 'mona-admin' ),
	//     'settings'     => 'contact_social_items',
	//     'fields' => [
	//         'icon' => [
	//             'type'        => 'image',
	//             'label'       => __( 'Icon', 'mona-admin' ),
	//             'description' => '',
	//             'default'     => '',
	//         ],
	//         'link' => [
	//             'type'        => 'text',
	//             'label'       => __( 'Link', 'mona-admin' ),
	//             'description' => '',
	//             'default'     => '',
	//         ],
	//     ]
	// ]);

}

if ( ! function_exists( 'mona_option' ) ) {

	/**
	 * Undocumented function
	 *
	 * @param [type] $setting
	 * @param string $default
	 *
	 * @return void
	 */
	function mona_option( $setting, $default = '' ) {
		echo mona_get_option( $setting, $default );
	}

	/**
	 * Undocumented function
	 *
	 * @param [type] $setting
	 * @param string $default
	 *
	 * @return void
	 */
	function mona_get_option( $setting, $default = '' ) {

		if ( class_exists( 'Kirki' ) ) {

			$value = $default;

			$options = get_option( 'option_name', array() );
			$options = get_theme_mod( $setting, $default );

			if ( isset ( $options ) ) {
				$value = $options;
			}

			return $value;
		}

		return $default;
	}

}
