<?php

/**
 * The template for displaying index.
 *
 * @package Monamedia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * define acf
 */
if ( get_current_user_id() == 1 ) {
	define( 'ACF_LITE', false );
} else {
	define( 'ACF_LITE', true );
}


/**
 * define theme page
 */
define( 'MONA_PAGE_HOME', get_option( 'page_on_front', true ) );
define( 'MONA_PAGE_BLOG', get_option( 'page_for_posts', true ) );
define( 'MONA_PAGE_ABOUT', url_to_postid( get_the_permalink( 185 ) ) );

// Woocommerce
define( 'MONA_WC_PRODUCTS', get_option( 'woocommerce_shop_page_id' ) );
define( 'MONA_WC_CART', get_option( 'woocommerce_cart_page_id' ) );
define( 'MONA_WC_CHECKOUT', get_option( 'woocommerce_checkout_page_id' ) );
define( 'MONA_WC_MYACCOUNT', get_option( 'woocommerce_myaccount_page_id' ) );
define( 'MONA_WC_THANKYOU', get_option( 'woocommerce_thanks_page_id' ) );


require_once( get_template_directory() . '/__autoload.php' );

function mona_pagination_link_news( $wp_query = '' ) {
	if ( $wp_query == '' ) {
		global $wp_query;
	}
	$bignum = 999999999;
	if ( $wp_query->max_num_pages <= 1 ) {
		return;
	}
	echo '<div class="paginations">';
	echo paginate_links(
		[
			'base'      => str_replace( $bignum, '%#%', esc_url( get_pagenum_link( $bignum ) ) ) . "#mona-daily-news",
			'format'    => '',
			'current'   => max( 1, get_query_var( 'paged' ) ),
			'total'     => $wp_query->max_num_pages,
			'prev_text' => '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
			'next_text' => '<i class="fa fa-arrow-right" aria-hidden="true"></i>',
			'type'      => 'list',
			'end_size'  => 3,
			'mid_size'  => 3
		]
	);
	echo '</div>';
}

remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
add_action( 'woocommerce_checkout_after_customer_details', 'woocommerce_checkout_payment', 20 );

add_filter( 'woocommerce_billing_fields', 'mona_custom_billing_fields' );
function mona_custom_billing_fields( $fields = [] ) {
	unset( $fields['billing_first_name'] );
	unset( $fields['billing_last_name'] );
	unset( $fields['billing_phone'] );
	unset( $fields['billing_email'] );
	unset( $fields['billing_address_2'] );
	unset( $fields['billing_country'] );
	unset( $fields['billing_postcode'] );
	unset( $fields['billing_company'] );

	unset( $fields['billing_email']['label'] );
	unset( $fields['billing_last_name']['label'] );
	unset( $fields['billing_phone']['label'] );
	unset( $fields['billing_address_1']['label'] );
	unset( $fields['billing_city']['label'] );
	unset( $fields['billing_country']['label'] );
	unset( $fields['billing_state']['label'] );
	unset( $fields['billing_company']['label'] );

	$priority = 1;
	// $fields['billing_first_name']['priority'] = $priority++;
	$fields['billing_address_1']['priority'] = $priority ++;
	$fields['billing_state']['priority']     = $priority ++;
	$fields['billing_city']['priority']      = $priority ++;

	// $fields['billing_first_name']['label'] = __('Họ và tên', 'monamedia');
	// $fields['billing_phone']['label'] = __('Số điện thoại', 'monamedia');
	// $fields['billing_state']['label'] = __('Tỉnh / Thành phố', 'monamedia');
	// $fields['billing_city']['label'] = __('Quận / Huyện', 'monamedia');
	// $fields['billing_country']['label'] = __('Xã / Phường', 'monamedia');
	// $fields['billing_address_1']['label'] = __('Địa chỉ chi tiết', 'monamedia');

	$fields['billing_first_name']['required'] = true;
	$fields['billing_phone']['required']      = true;

	$fields['billing_first_name']['input_class'] = array( 'form-input' );
	$fields['billing_phone']['input_class']      = array( 'form-input' );
	$fields['billing_address_1']['input_class']  = array( 'form-input' );

	$fields['billing_country'] = array(
		'type'     => 'select',
		// 'label' => __('Tỉnh / Thành phố', 'monamedia'),
		'options'  => array(
			'' => __( 'Chọn Tỉnh / Thành phố', 'monamedia' ),
		),
		'required' => true,
		'class'    => array( 'form-control', 'three-w', 'city' ),
		'priority' => 50
	);

	$fields['billing_state'] = array(
		'type'     => 'select',
		// 'label' => __('Quận / Huyện', 'monamedia'),
		'options'  => array(
			'' => __( 'Chọn Quận / Huyện', 'monamedia' )
		),
		'required' => true,
		'class'    => array( 'form-control', 'three-w' ),
		'priority' => 60
	);

	$fields['billing_city'] = array(
		'type'     => 'select',
		// 'label' => __('Xã / Phường', 'monamedia'),
		'options'  => array(
			'' => __( 'Chọn Phường / Xã', 'monamedia' )
		),
		'required' => true,
		'class'    => array( 'form-control', 'three-w' ),
		'priority' => 70
	);


	// Class
	$fields['billing_first_name']['class'] = array( 'form-control' );
	$fields['billing_phone']['class']      = array( 'form-control' );
	$fields['billing_state']['class']      = array( 'form-control', 'three-w', 'city' );
	$fields['billing_city']['class']       = array( 'form-control', 'three-w' );
	$fields['billing_country']['class']    = array( 'form-control', 'three-w' );
	$fields['billing_address_1']['class']  = array( 'form-control', 'full-w' );

	/**Placeholder */
	$fields['billing_first_name']['placeholder'] = __( 'Họ và tên', 'monamedia' );
	$fields['billing_phone']['placeholder']      = __( 'Số điện thoại', 'monamedia' );
	$fields['billing_state']['placeholder']      = __( 'Chọn Tỉnh / Thành phố', 'monamedia' );
	$fields['billing_city']['placeholder']       = __( 'Chọn Quận / Huyện', 'monamedia' );
	$fields['billing_country']['placeholder']    = __( 'Phường / Xã', 'monamedia' );
	$fields['billing_address_1']['placeholder']  = __( 'Địa chỉ chi tiết', 'monamedia' );

	$fields['orders_comment'] = array(
		'type'        => 'textarea',
		// 'label' => __('Ghi chú', 'monamedia'),
		'placeholder' => __( 'Nội dung', 'monamedia' ),
		'required'    => false,
		'class'       => array( 'form-control full-w' ),
		'input_class' => array( 'form-text' ),
		'priority'    => $priority ++,
		'input_attrs' => array(
			'rows' => 7,
			'cols' => 20
		)

	);


	return $fields;
}
// // Thêm mã vận chuyển vào trang Review Order
// add_action( 'woocommerce_review_order_before_shipping', 'my_shipping_review_order', 10 );

// function my_shipping_review_order() {
//     $chosen_methods = WC()->session->get( 'chosen_shipping_methods' );
//     $chosen_shipping = $chosen_methods[0];
//     $shipping_methods = WC()->shipping()->get_shipping_methods();
//     $shipping_method = $shipping_methods[$chosen_shipping];
//     echo '<div class="shipping-code">';
//     printf( __( 'Shipping Code: %s', 'woocommerce' ), $shipping_method->get_instance_option( 'code' ) );
//     echo '</div>';
// }
