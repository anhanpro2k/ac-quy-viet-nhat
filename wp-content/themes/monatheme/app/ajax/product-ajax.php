<?php


function mona_ajax_add_to_cart() {
	global $woocommerce;
	$form = array();
	parse_str( $_POST['formdata'], $form );

	$product_id = intval( $form['product_id'] );
	$quantity   = isset( $form['quantity'] ) ? intval( $form['quantity'] ) : 1;
	$product    = wc_get_product( $product_id );
	$type       = ! empty( $_POST['type'] ) ? $_POST['type'] : '';


	if ( empty( $product_id ) ) {
		wp_send_json_error(
			[
				'title'   => __( 'Thông báo!', 'monamedia' ),
				'message' => __( 'Sản phẩm đang được cập nhật! Vui lòng quay lại sau hoặc kiểm tra sản phẩm khác.', 'monamedia' ),
				'action'  => [
					'title'       => '<span class="text">' . __( 'Danh sách sản phẩm', 'monamedia' ) . '</span>',
					'url'         => get_the_permalink( MONA_WC_PRODUCTS ),
					'title_close' => __( 'Đóng', 'monamedia' ),
				],
			]
		);
		wp_die();
	} else {
		// add to cart
		$cart_data = $woocommerce->cart->add_to_cart( $product_id, $quantity );
		// response
		if ( $cart_data ) {
			echo wp_send_json_success(
				[
					'title'     => __( 'Thông báo!', 'monamedia' ),
					'message'   => __( 'Sản phẩm được thêm vào giỏ hàng thành công', 'monamedia' ),
					'action'    => [
						'title'       => '<span class="text">' . __( 'Thanh toán', 'monamedia' ) . '</span>',
						'url'         => get_the_permalink( MONA_WC_CHECKOUT ),
						'title_close' => '<span class="text">' . __( 'Đóng', 'monamedia' ) . '</span>',
					],
					'cart_data' => [
						'count' => $woocommerce->cart->cart_contents_count,
						'total' => $woocommerce->cart->get_cart_total(),
					],
					'redirect'  => $type == 'buy_now' ? get_the_permalink( MONA_WC_CHECKOUT ) : ''
				]
			);
			wp_die();
		} else {
			wp_send_json_error(
				[
					'title'   => __( 'Thông báo!', 'monamedia' ),
					'message' => __( 'Thêm vào giỏ hàng không thành công', 'monamedia' ),
					'action'  => [
						'title_close' => '<span class="text">' . __( 'Đóng', 'monamedia' ) . '</span>',
					],
				]
			);
			wp_die();
		}
	}
	wp_die();
}


add_action( 'wp_ajax_mona_ajax_add_to_cart', 'mona_ajax_add_to_cart' ); // login
add_action( 'wp_ajax_nopriv_mona_ajax_add_to_cart', 'mona_ajax_add_to_cart' ); // no login

// AJAX ADD TO CART LIST
function mona_ajax_add_to_cart_list() {
	if ( ! class_exists( 'woocommerce' ) || ! WC()->cart ) {
		return;
	}

	global $woocommerce;
	$product_id = intval( $_POST['product_id'] );

	$quantity = $_POST['quantity'] ? intval( $_POST['quantity'] ) : 1;

	$cart_item_data = [];

	$label = __( 'Sản phẩm', 'monamedia' );

	if ( empty( $product_id ) ) {

		wp_send_json_error(
			[
				'title'     => $label . ' ' . __( 'không tồn tại hoặc đã có lỗi xảy ra..', 'monamedia' ),
				'cart-open' => false,
				'message'   => __( 'Xảy ra lỗi! Vui lòng thử lại sau', 'monamedia' ),
				'action'    => [
					'title'       => __( 'Thử lại', 'monamedia' ),
					'title_close' => __( 'Đóng', 'monamedia' ),
				],
			]
		);
		wp_die();

	} else {

		$_product = wc_get_product( $product_id );

		if ( $_product->is_type( 'variable' ) ) {

			$mona_attr = [];

			if ( is_array( $_product->get_attributes() ) ) {

				foreach ( $_product->get_attributes() as $attribute_name => $attribute ) {

					if ( empty( $form[ $attribute_name ] ) ) {

						wp_send_json_error(
							[
								'title'     => __( 'Bạn chưa chọn thuộc tính', 'monamedia' ),
								'cart-open' => false,
								'message'   => __( 'Vui lòng chọn thuộc tính', 'monamedia' ),
								'action'    => [
									'title'       => __( 'Thử lại', 'monamedia' ),
									'title_close' => __( 'Đóng', 'monamedia' ),
								],
							]
						);
						wp_die();

					}
					$term                                        = get_term_by( 'slug', $form[ $attribute_name ], $attribute_name );
					$mona_attr[ 'attribute_' . $attribute_name ] = $term->slug;

				}

			}

			$variation  = [];
			$data_store = WC_Data_Store::load( 'product' );
			$varid      = $data_store->find_matching_product_variation( new \WC_Product( $product_id ), $mona_attr );
			$cart_data  = WC()->cart->add_to_cart( $product_id, $quantity, $varid, $mona_attr, [ 'mona_data' => $cart_item_data ] );

			if ( $cart_data ) {

				echo wp_send_json_success(
					[
						'title'     => __( 'Thông báo!', 'monamedia' ),
						'message'   => __( 'Sản phẩm được thêm thành công vào giỏ hàng', 'monamedia' ),
						'title_btn' => __( 'Đã thêm vào giỏ hàng', 'monamedia' ),
						'action'    => [
							'title'       => get_the_title( MONA_WC_CART ),
							'url'         => get_the_permalink( MONA_WC_CART ),
							'title_close' => __( 'Đóng', 'monamedia' ),
						],
						'cart_data' => [
							'count' => $woocommerce->cart->cart_contents_count,
							'total' => $woocommerce->cart->get_cart_total(),
						],
					]
				);
				wp_die();

			} else {

				wp_send_json_error(
					[
						'title'   => __( 'Thông báo!', 'monamedia' ),
						'message' => __( 'Sản phẩm hiện đang hết hàng hoặc xảy ra lỗi! Khách hàng vui lòng liên hệ trực tiếp để được hỗ trợ', 'monamedia' ),
						'action'  => [
							'title'       => __( 'Thử lại', 'monamedia' ),
							'title_close' => __( 'Đóng', 'monamedia' ),
						],
					]
				);
				wp_die();

			}
		} else {

			$cart_data = WC()->cart->add_to_cart( $product_id, $quantity, false, false, [ 'mona_data' => $cart_item_data ] );
			if ( $cart_data ) {

				echo wp_send_json_success(
					[
						'title'     => __( 'Thông báo!', 'monamedia' ),
						'message'   => __( 'Sản phẩm được thêm thành công vào giỏ hàng', 'monamedia' ),
						'title_btn' => __( 'Đã thêm vào giỏ hàng', 'monamedia' ),
						'action'    => [
							'title'       => get_the_title( MONA_WC_CART ),
							'url'         => get_the_permalink( MONA_WC_CART ),
							'title_close' => __( 'Đóng', 'monamedia' ),
						],
						'cart_data' => [
							'count' => $woocommerce->cart->cart_contents_count,
							'total' => $woocommerce->cart->get_cart_total(),
						],
					]
				);
				wp_die();

			} else {

				wp_send_json_error(
					[
						'title'   => __( 'Thông báo!', 'monamedia' ),
						'message' => __( 'Sản phẩm hiện đang hết hàng hoặc xảy ra lỗi! Khách hàng vui lòng liên hệ trực tiếp để được hỗ trợ', 'monamedia' ),
						'action'  => [
							'title'       => __( 'Thử lại', 'monamedia' ),
							'title_close' => __( 'Đóng', 'monamedia' ),
						],
					]
				);
				wp_die();

			}
		}
	}
	wp_die();
}

add_action( 'wp_ajax_mona_ajax_add_to_cart_list', 'mona_ajax_add_to_cart_list' ); // login
add_action( 'wp_ajax_nopriv_mona_ajax_add_to_cart_list', 'mona_ajax_add_to_cart_list' ); // no login


add_action( 'wp_ajax_mona_ajax_loading_cart', 'mona_ajax_loading_cart' ); // login
add_action( 'wp_ajax_nopriv_mona_ajax_loading_cart', 'mona_ajax_loading_cart' ); // no login
function mona_ajax_loading_cart() {
	ob_start(); ?>
	<?php woocommerce_mini_cart(); ?>
	<?php
	echo wp_send_json_success(
		[
			'title'       => __( 'Thông báo!', 'monamedia' ),
			'message'     => __( 'Load lại giỏ hàng thành công!', 'monamedia' ),
			'title_close' => __( 'Đóng', 'monamedia' ),
			'cart_html'   => ob_get_clean()
		]
	);
	wp_die();
}


