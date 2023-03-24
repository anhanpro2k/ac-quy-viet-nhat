<?php
add_action( 'wp_ajax_mona_ajax_custommer_register', 'mona_ajax_custommer_register' ); // login
add_action( 'wp_ajax_nopriv_mona_ajax_custommer_register', 'mona_ajax_custommer_register' ); // no login
function mona_ajax_custommer_register() {

	$form = array();
	parse_str( $_POST['form'], $form );
	$user_phone     = esc_attr( $form['user_phone'] );
	$user_email     = esc_attr( $form['user_email'] );
	$user_full_name = esc_attr( $form['user_full_name'] );
//	$user_bod       = esc_attr( $form['user_bod'] );
//	$user_gender    = esc_attr( $form['user_gender'] );
	// $user_first_name    = esc_attr( $form['user_first_name']  );
	// $user_last_name     = esc_attr( $form['user_last_name']  );
	$error = [];
	// verify
	if ( ! wp_verify_nonce( $form['register_nonce_field'], 'register_action' ) ) {
		echo wp_send_json_error(
			[

				'title'       => __( 'Thông báo', 'monamedia' ),
				'message'     => __( 'Hành động của bạn chưa được xác thực', 'monamedia' ),
				'title_close' => __( 'Đóng', 'monamedia' )

			]
		);
		wp_die();
	}


	if ( ! mona_validate_phone( $form['user_phone'] ) ) {
		$error['mona-error-user-phone'] = __( 'Số điện thoại không hợp lệ!', 'monamedia' );
	}


	if ( empty( $form['user_full_name'] ) ) {
		$error['mona-error-user-full-name'] = __( 'Vui lòng nhập tên đầy đủ của bạn!', 'monamedia' );
	}

	if ( email_exists( $user_email ) ) {
		$error['mona-error-user-email'] = __( 'Email này đã được đăng ký bởi người dùng khác!', 'monamedia' );
		echo wp_send_json_error(
			[
				'error' => $error,
			]
		);
		wp_die();
	}

	if ( empty( $user_email ) ) {
		$error['mona-error-user-email'] = __( 'Vui lòng nhập địa chỉ email!', 'monamedia' );
		echo wp_send_json_error(
			[
				'error' => $error,
			]
		);
		wp_die();
	}


	if ( ! filter_var( $user_email, FILTER_VALIDATE_EMAIL ) ) {
		$error['mona-error-user-email'] = __( 'Địa chỉ email không hợp lệ!', 'monamedia' );
		echo wp_send_json_error(
			[
				'error' => $error,
			]
		);
		wp_die();
	}

	if ( ! preg_match( '/^(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z\d])[\S]{8,}$/', $form['password'] ) ) {
		$error['mona-error-user-pass'] = __( 'Mật khẩu không đáp ứng yêu cầu bảo mật!', 'monamedia' );
	}


	if ( $form['password'] == '' || $form['password'] != $form['repassword'] ) {
		$error['mona-error-user-repass'] = __( 'Mật khẩu và mật khẩu xác nhận không khớp!', 'monamedia' );
	}


	if ( empty( $error ) ) {


		if ( ! empty ( $user_email ) ) {
			$getEmail = explode( '@', $user_email );
			if ( ! empty ( $getEmail ) ) {
				$user_login = $getEmail[0];
			}
		}

		// $user_name = $user_first_name . ' ' . $user_last_name;
		$user_name = $user_full_name;

		$args_regsiter = [
			'user_login'   => $user_login,
			'user_email'   => $user_email,
			'user_pass'    => $form['password'],
			'display_name' => $user_name,
			'nickname'     => $user_name,
		];

		$user = wp_insert_user( $args_regsiter );
		if ( is_wp_error( $user ) ) {
			echo wp_send_json_error(
				[

					'title'       => __( 'Thông báo', 'monamedia' ),
					'message'     => $user->get_error_message(),
					'title_close' => __( 'Đóng', 'monamedia' )

				]
			);
			wp_die();

		} else {
			add_user_meta( $user, 'user_phone', $user_phone ); // add the meta

//			update_field( 'mona_user_gender', $user_gender, 'user_' . $user );
//			update_field( 'mona_user_bod', $user_bod, 'user_' . $user );
			update_user_meta( $user, 'first_name', $user_full_name );
			// update_user_meta(   $user, 'first_name'         , $user_first_name  );
			// update_user_meta(   $user, 'last_name'          , $user_last_name  );
			// update_user_meta(   $user, 'billing_first_name' , $user_first_name  );
			// update_user_meta(   $user, 'billing_last_name'  , $user_last_name  );
			update_user_meta( $user, 'billing_phone', $user_phone );
			update_user_meta( $user, 'billing_email', $user_email );
		}

		$newLogin = get_user_by( 'login', $user_login );
		if ( ! empty ( $newLogin ) ) {
			$argsl = [
				'user_login'    => @$newLogin->user_login,
				'user_password' => @$form['password'],
			];
			$on    = wp_signon( $argsl );
			echo wp_send_json_success(
				[
					'title'       => __( 'Thông báo', 'monamedia' ),
					'message'     => __( 'Bạn đã đăng ký thành công tài khoản!', 'monamedia' ),
					'redirect'    => $form['redirect'] ? $form['redirect'] : get_the_permalink( MONA_PAGE_HOME ),
					'title_close' => __( 'Đóng', 'monamedia' )
				]
			);
			wp_die();
		}

	} else {

		echo wp_send_json_error(
			[
				'error' => $error,
			]
		);
		wp_die();
	}
}

add_action( 'wp_ajax_mona_ajax_custommer_login', 'mona_ajax_custommer_login' ); // login
add_action( 'wp_ajax_nopriv_mona_ajax_custommer_login', 'mona_ajax_custommer_login' ); // no login
function mona_ajax_custommer_login() {
	$form = array();
	parse_str( $_POST['form'], $form );
	$error = [];

	if ( ! isset( $form['login_nonce_field'] ) || ! wp_verify_nonce( $form['login_nonce_field'], 'login_action' ) ) {

		echo wp_send_json_error(
			[

				'title'       => __( 'Thông báo', 'monamedia' ),
				'message'     => __( 'Hành động của bạn chưa được xác thực', 'monamedia' ),
				'title_close' => __( 'Đóng', 'monamedia' )

			]
		);
		wp_die();

	}

	if ( is_email( $form['user_login'] ) ) {
		$user = get_user_by( 'email', $form['user_login'] );

		// }elseif ( is_numeric( $form['user_login'] ) && !mona_validate_phone( $form['user_login'] ) ){
		//     $error['mona-error-user-login'] = __( 'Số điện thoại tối đa 10 số!', 'monamedia' );
		// }elseif( is_numeric( $form['user_login'] ) && mona_validate_phone( $form['user_login'] ) ){
		//     // check user by phone number
		//     global $wpdb;
		//     $tbl_usermeta = $wpdb->prefix.'usermeta';
		//     $user_id = $wpdb->get_var( $wpdb->prepare( "SELECT user_id FROM $tbl_usermeta WHERE meta_key=%s AND meta_value=%s", 'user_phone', $form['user_login'] ) );
		//     $user = get_user_by( 'ID', $user_id );
		//     if ( empty ( $user ) ) {
		//         $error['mona-error-user-login'] = __( 'Số điện thoại này không tồn tại!', 'monamedia' );
		//     }

	} elseif ( ! is_email( $form['user_login'] ) && ! empty( $form['user_login'] ) ) {
		$user = get_user_by( 'login', $form['user_login'] );
	}

	if ( ! empty ( $user ) ) {
		$user_login = $user->user_login;
	} else {
		$error['mona-error-user-login'] = __( "Tài khoản không tồn tại!", 'monamedia' );
		echo wp_send_json_error(
			[
				'error' => $error,
			]
		);
		wp_die();
	}

	$args = [
		'user_login'    => @$user_login,
		'user_password' => @$form['password'],
//		'remember'      => ( @$form['user_remember'] ? true : false )
	];

	$on = wp_signon( $args );
	if ( is_wp_error( $on ) ) {
		$error['mona-error-user-password'] = __( 'Sai mật khẩu!', 'monamedia' );
	}

	if ( empty( $error ) ) {

		$_SESSION['has_destroy'] = 'no';
		echo wp_send_json_success(
			[
				'title'       => __( 'Alert', 'monamedia' ),
				'message'     => __( 'Logged in successfully', 'monamedia' ),
				'redirect'    => @$form['redirect'] ? $form['redirect'] : get_the_permalink( MONA_PAGE_HOME ),
				'title_close' => __( 'Close', 'monamedia' )
			]
		);
		wp_die();

	} else {

		echo wp_send_json_error(
			[
				'error' => $error
			]
		);
		wp_die();

	}


}

//add_action( 'wp_ajax_nopriv_mona_ajax_custommer_forget_password', 'mona_ajax_custommer_forget_password' ); // no login
//function mona_ajax_custommer_forget_password() {
//
//	$form = array();
//	parse_str( $_POST['form'], $form );
//	$error = [];
//
//	if ( ! isset( $form['forgot_nonce_field'] ) || ! wp_verify_nonce( $form['forgot_nonce_field'], 'forgot_action' ) ) {
//
//		echo wp_send_json_error(
//			[
//
//				'title'       => __( 'Alert', 'monamedia' ),
//				'message'     => __( 'Your action is not authenticated!', 'monamedia' ),
//				'title_close' => __( 'Close', 'monamedia' )
//
//			]
//		);
//		wp_die();
//
//	}
//
//	if ( is_email( $form['user_login'] ) ) {
//		// check user by email
//		$user = get_user_by( 'email', $form['user_login'] );
//	} else {
//		// check user by username
//		$user = get_user_by( 'login', $form['user_login'] );
//	}
//
//	if ( ! empty ( $user ) ) {
//		$user_login = $user->user_login;
//	} else {
//		$error['mona-error-user-login'] = __( "The account doesn't exist!", 'monamedia' );
//		echo wp_send_json_error(
//			[
//				'error' => $error
//			]
//		);
//		wp_die();
//	}
//
//	// if ( is_numeric( $form['user_login'] ) && !mona_validate_phone( $form['user_login'] ) ){
//	//     $error['mona-error-user-login'] = __( 'Số điện thoại tối đa 10 số!', 'monamedia' );
//	// }elseif( is_numeric( $form['user_login'] ) && mona_validate_phone( $form['user_login'] ) ){
//	//     // check user by phone number
//	//     global $wpdb;
//	//     $tbl_usermeta = $wpdb->prefix.'usermeta';
//	//     $user_id = $wpdb->get_var( $wpdb->prepare( "SELECT user_id FROM $tbl_usermeta WHERE meta_key=%s AND meta_value=%s", 'user_phone', $form['user_login'] ) );
//	//     $user_exsist = get_user_by( 'ID', $user_id );
//	//     if ( empty ( $user_exsist ) ) {
//	//         $error['mona-error-user-login'] = __( 'Số điện thoại này không tồn tại!', 'monamedia' );
//	//     }
//	// }
//
//	if ( empty( $error ) ) {
//		$user_login = $user->user_login;
//		$user_email = $user->user_email;
//		$key        = get_password_reset_key( $user );
//
//		$message = __( 'Dear ' . $user->data->display_name . ', ' ) . "\r\n\r\n";
//		$message .= __( 'You have requested to reset the password for the above account ' ) . get_bloginfo( 'name' ) . "\r\n\r";
//		$message .= __( 'To retrieve the password. Please click on the link below:' ) . "\r\n";
//
//		if ( empty( $form['redirect'] ) ) {
//			$message .= '<' . get_the_permalink( MONA_PAGE_FORGOT ) . "?reset&key=$key&login=" . rawurlencode( $user_login ) . ">\r\n";
//		} else {
//			$message .= '<' . get_the_permalink( MONA_PAGE_FORGOT ) . "?reset&key=$key&login=" . rawurlencode( $user_login ) . "&redirect=" . $form['redirect'] . ">\r\n";
//		}
//
//		if ( $message && ! wp_mail( $user_email, wp_specialchars_decode( get_bloginfo( 'name' ) . ' Đặt lại mật khẩu' ), $message ) ) {
//
//			$error['mona-error-user-login'] = __( 'Cannot send email. Please contact admin to learn more', 'monamedia' );
//			echo wp_send_json_error(
//				[
//					'error' => $error
//				]
//			);
//			wp_die();
//
//		} else {
//
//			echo wp_send_json_success(
//				[
//					'message' => __( 'Password change email has been sent to your email! Please check your mailbox', 'monamedia' )
//				]
//			);
//			wp_die();
//
//		}
//
//	} else {
//		echo wp_send_json_error(
//			[
//				'error' => $error
//			]
//		);
//		wp_die();
//	}
//}
//
//add_action( 'wp_ajax_nopriv_mona_ajax_custommer_reset_password', 'mona_ajax_custommer_reset_password' ); // no login
//function mona_ajax_custommer_reset_password() {
//
//	$form = array();
//	parse_str( $_POST['form'], $form );
//	$error = [];
//
//	if ( ! isset( $form['reset_nonce_field'] ) || ! wp_verify_nonce( $form['reset_nonce_field'], 'reset_action' ) ) {
//
//		echo wp_send_json_error(
//			[
//
//				'title'       => __( 'Alert', 'monamedia' ),
//				'message'     => __( 'Your action is not authenticated!', 'monamedia' ),
//				'title_close' => __( 'Close', 'monamedia' )
//
//			]
//		);
//		wp_die();
//
//	}
//
//	$check = check_password_reset_key( @$form['key'], @$form['login'] );
//	if ( is_wp_error( $check ) ) {
//
//		echo wp_send_json_error(
//			[
//				'title'       => __( 'Alert', 'monamedia' ),
//				'message'     => __( 'Expired path!', 'monamedia' ),
//				'title_close' => __( 'Close', 'monamedia' )
//			]
//		);
//		wp_die();
//
//	}
//
//	if ( strlen( $form['new_password'] ) < 6 ) {
//
//		$error['mona-error-new-password'] = __( 'Password must be at least 6 characters!', 'monamedia' );
//		echo wp_send_json_error(
//			[
//				'error' => $error
//			]
//		);
//		wp_die();
//
//	}
//
//	if ( @$form['new_password'] !== @$form['renew_password'] ) {
//
//		$error['mona-error-renew-password'] = __( 'Password and confirmation password do not match!', 'monamedia' );
//		echo wp_send_json_error(
//			[
//				'error' => $error
//			]
//		);
//		wp_die();
//
//	}
//
//	$user_data = get_user_by( 'login', $form['login'] );
//	reset_password( $user_data, @$form['new_password'] );
//
//	// if ( $user_data ) {
//
//	//     wp_clear_auth_cookie();
//	//     wp_set_auth_cookie( $user_data->ID, true );
//	//     do_action( 'wp_login', $user_data->user_login, $user_data );
//
//	// }
//
//	if ( ! isset( $form['redirect'] ) ) {
//		$redirect = get_the_permalink( MONA_PAGE_LOGIN );
//	} else {
//		$redirect = get_the_permalink( MONA_PAGE_LOGIN ) . '?redirect=' . $form['redirect'];
//	}
//
//	echo wp_send_json_success(
//		[
//			'title'       => __( 'Alert', 'monamedia' ),
//			'message'     => __( 'Change password successfully!', 'monamedia' ),
//			'redirect'    => $redirect,
//			'title_close' => __( 'Close', 'monamedia' )
//		]
//	);
//	wp_die();
//
//}
//
add_action( 'wp_ajax_mona_ajax_update_account', 'mona_ajax_update_account' ); // login
function mona_ajax_update_account() {
	$form = array();
	parse_str( $_POST['formdata'], $form );
	$Account = wp_get_current_user();

	if ( ! isset( $form['update_nonce_field'] ) || ! wp_verify_nonce( $form['update_nonce_field'], 'update_action' ) ) {
		echo wp_send_json_error(
			[

				'title'       => __( 'Thông báo', 'monamedia' ),
				'message'     => __( 'Hành động của bạn chưa được xác thực', 'monamedia' ),
				'title_close' => __( 'Đóng', 'monamedia' )

			]
		);
		wp_die();
	}
	if ( isset ( $_FILES ) && ! empty( $_FILES ) ) {
		$listFileupload = $_FILES;
		foreach ( $listFileupload as $key => $itemFile ) {
			$itemFiletype    = $itemFile['type'];
			$itemFilesize    = $itemFile['size'];
			$alow_extensions = array( 'image/jpeg', 'image/jpg', 'image/png' );
			if ( ! function_exists( 'wp_handle_upload' ) ) {
				require_once( ABSPATH . 'wp-admin/includes/file.php' );
			}
			if ( ! in_array( $itemFiletype, $alow_extensions ) ) {
				echo wp_send_json_error(
					[
						'title'       => __( 'Thông báo', 'monamedia' ),
						'message'     => __( 'File được sử dụng: jpeg, jpg, png', 'monamedia' ),
						'title_close' => __( 'Đóng', 'monamedia' )
					]
				);
				wp_die();
			} elseif ( $itemFilesize > 5000000 ) {
				echo wp_send_json_error(
					[
						'title'       => __( 'Thông báo', 'monamedia' ),
						'message'     => __( 'Kích thước ảnh <= 5MB', 'monamedia' ),
						'title_close' => __( 'Đóng', 'monamedia' )
					]
				);
				wp_die();
			} else {
				$itemFileobject = wp_handle_upload( $itemFile, array( 'test_form' => false ) );
				if ( $itemFileobject && ! isset( $itemFileobject['error'] ) ) {
					$wp_upload_dir = wp_upload_dir();
					$attachment    = [
						'guid'           => $wp_upload_dir['url'] . '/' . basename( $itemFileobject['file'] ),
						'post_mime_type' => $itemFileobject['type'],
						'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $itemFileobject['file'] ) ),
						'post_content'   => '',
						'post_status'    => 'inherit'
					];
					$attach_id     = wp_insert_attachment( $attachment, $itemFileobject['file'] );
					require_once( ABSPATH . 'wp-admin/includes/image.php' );
					$attach_data = wp_generate_attachment_metadata( $attach_id, $itemFileobject['file'] );
					wp_update_attachment_metadata( $attach_id, $attach_data );
					// update
					if ( $key == 'user_avatar' ) {
						update_field( 'mona_user_avatar', $attach_id, 'user_' . $Account->ID );
					} elseif ( $key == 'user_background' ) {
						update_field( 'mona_user_background', $attach_id, 'user_' . $Account->ID );
					}
				} else {
					echo wp_send_json_error(
						[
							'title'       => __( 'Thông báo', 'monamedia' ),
							'message'     => __( 'Đã xảy ra lỗi trong quá trình upload ảnh!', 'monamedia' ),
							'title_close' => __( 'Đóng', 'monamedia' )
						]
					);
					wp_die();
				}
			}
		}
	}

	// $firstName = $form['user_firstname'];
	// $lastName  = $form['user_lastname'];
	// $fullname  = $firstName . ' ' . $lastName;
	$fullname = $form['user_full_name'];

	if ( ! mona_validate_phone( $form['user_phone'] ) ) {
		$error['mona-error-user-phone'] = __( 'Số điện thoại không hợp lệ!', 'monamedia' );
	}

	// update data
	//if( !isset( $form['act'] ) ){

	if ( empty( $error ) ) {

		wp_update_user( [
			'ID'           => $Account->ID,
			'first_name'   => sanitize_text_field( $fullname ),
			// 'last_name'     => sanitize_text_field( $lastName ),
			'display_name' => sanitize_text_field( $fullname ),
			'nickname'     => sanitize_text_field( $fullname ),
		] );
		//}


		update_user_meta( $Account->ID, 'user_phone', $form['user_phone'] ); // add the meta
		// $billing_first_name = $form['billing_first_name'];
		// $billing_last_name  = $form['billing_last_name'];
		$billing_phone = $form['billing_phone'];

		update_user_meta( $Account->ID, 'billing_phone', $form['user_phone'] ); // add the meta
//		update_user_meta( $Account->ID, 'billing_email', $form['user_email'] ); // add the meta
		update_user_meta( $Account->ID, 'billing_address_1', $form['user_address'] ); // add the meta


//		if ( ! isset( $formdata['act'] ) ) {
		//     update_user_meta( $Account->ID, 'billing_first_name'    , sanitize_text_field( $firstName ) );
		//     update_user_meta( $Account->ID, 'billing_last_name'     , sanitize_text_field( $lastName ) );
//			update_user_meta( $Account->ID, 'billing_phone', sanitize_text_field( $form['user_phone'] ) );
//		} elseif ( isset( $formdata['act'] ) && $formdata['act'] == 'billing' ) {
		//     update_user_meta( $Account->ID, 'billing_first_name'    , sanitize_text_field( $billing_first_name ) );
		//     update_user_meta( $Account->ID, 'billing_last_name'     , sanitize_text_field( $billing_last_name ) );
		//     update_user_meta( $Account->ID, 'billing_phone'         , sanitize_text_field( $billing_phone ) );
		//     update_user_meta( $Account->ID, 'billing_email'         , sanitize_text_field( $billing_email ) );
//		}

		// result
		echo wp_send_json_success(
			[
				'message' => __( 'Bạn đã thay đổi thông tin tài khoản thành công!', 'monamedia' ),
			]
		);
		wp_die();

	} else {

		echo wp_send_json_error(
			[
				'error' => $error,
			]
		);
		wp_die();

	}
}

add_action( 'wp_ajax_mona_ajax_user_change_password', 'mona_ajax_user_change_password' ); // login


function mona_ajax_user_change_password() {
	$form = array();
	parse_str( $_POST['formdata'], $form );
	$Account = wp_get_current_user();

	if ( empty( $form['password'] ) ) {
		echo wp_send_json_error(
			[ 'message' => __( 'Vui lòng nhập mật khẩu cũ', 'monamedia' ), ]
		);
		wp_die();
	}

	if ( ! wp_check_password( $form['password'], $Account->user_pass, $Account->ID ) ) {
		echo wp_send_json_error(
			[
				'message' => __( 'Mật khẩu hiện tại không chính xác!', 'monamedia' ),
			]
		);
		wp_die();
	}

	if ( ! preg_match( '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/', $form['new_password'] ) ) {
		echo wp_send_json_error( [ 'message' => __( 'Vui lòng nhập mật khẩu đúng định dạng!', 'monamedia' ) ] );
		wp_die();
	}

	if ( @$form['new_password'] != @$form['renew_password'] ) {
		echo wp_send_json_error(
			[
				'message' => __( 'Mật khẩu và mật khẩu xác nhận không khớp!', 'monamedia' ),
			]
		);
		wp_die();
	}

	$userData = get_user_by( 'login', $Account->user_login );
	reset_password( $userData, @$form['new_password'] );

	echo wp_send_json_success(
		[
			'message'  => __( 'Đổi mật khẩu thành công', 'monamedia' ),
			'redirect' => get_the_permalink( MONA_PAGE_HOME ),
		]
	);
	wp_die();
}
