<?php
add_action( 'wp_logout', 'auto_redirect_after_logout' );
function auto_redirect_after_logout() {
	wp_safe_redirect( home_url() );
	exit;
}

// add_filter( 'woocommerce_billing_fields', 'mona_custom_billing_fields' );
// function mona_custom_billing_fields( $fields = [] ) {

//     if( is_wc_endpoint_url( 'edit-address' ) ) {

//         unset($fields['billing_first_name']);
//         unset($fields['billing_last_name']);
//         unset($fields['billing_phone']);
//         unset($fields['billing_email']);
//         unset($fields['billing_address_2']);
//         // unset($fields['billing_country']);
//         unset($fields['billing_postcode']);

//         unset($fields['billing_email']['label']);
//         unset($fields['billing_last_name']['label']);
//         unset($fields['billing_phone']['label']);
//         unset($fields['billing_address_1']['label']);
//         unset($fields['billing_city']['label']);
//         unset($fields['billing_country']['label']);
//         unset($fields['billing_state']['label']);

//         $priority = 1;
//         $fields['billing_first_name']['priority'] = $priority++;
//         $fields['billing_address_1']['priority'] = $priority++;
//         $fields['billing_state']['priority'] = $priority++;
//         $fields['billing_city']['priority'] = $priority++;
//         $fields['billing_country']['priority'] = $priority++;
//         $fields['billing_state']['placeholder'] = __( 'Chọn tỉnh/thành', 'monamedia' );
//         $fields['billing_city']['placeholder'] = __( 'Chọn quận', 'monamedia' );

//     }else{

//         /**Gỡ field */
//         unset( $fields['billing_last_name'] );
//         unset( $fields['billing_company'] );
//         unset( $fields['billing_postcode'] );
//         unset( $fields['billing_address_2'] );
//         unset( $fields['shipping_first_name'] );
//         unset( $fields['order']['shipping_last_name'] );
//         unset( $fields['shipping_company'] );
//         unset( $fields['shipping_address_2'] );
//         unset( $fields['shipping_postcode'] );

//         /** Gỡ label */
//         //unset( $fields['billing_first_name']['label'] );
//         // unset( $fields['billing_email']['label'] );
//         // unset( $fields['billing_phone']['label'] );
//         // unset( $fields['billing_address_1']['label'] );
//         // unset( $fields['billing_city']['label'] );
//         // unset( $fields['billing_country']['label'] );
//         // unset( $fields['billing_state']['label'] );

//         $fields['billing_first_name']['label'] = __('Họ tên khách hàng','monamedia');
//         $fields['billing_email']['label'] = __('Email','monamedia');
//         $fields['billing_phone']['label'] = __('Số điện thoại','monamedia');
//         $fields['billing_address_1']['label'] = __('Địa chỉ chi tiết','monamedia');

//         /**Placeholder */
//         // $fields['billing_first_name']['placeholder'] = __( 'Họ và tên khách hàng *', 'monamedia' );
//         // $fields['billing_address_1']['placeholder'] = __( 'Địa chỉ chi tiết', 'monamedia' );
//         // $fields['billing_phone']['placeholder'] = __( 'Số điện thoại', 'monamedia' );
//         // $fields['billing_email']['placeholder'] = __( 'Email', 'monamedia' );

//     }


//     return $fields;
// }

// add_filter( 'woocommerce_checkout_fields',  'mona_and_order_fields_checkout');
// function mona_and_order_fields_checkout( $checkout_fields = [] ) {
//     $priority = 1;
//     $checkout_fields['billing']['billing_first_name']['priority'] = $priority++;
//     $checkout_fields['billing']['billing_email']['priority'] = $priority++;
//     $checkout_fields['billing']['billing_phone']['priority'] = $priority++;
//     $checkout_fields['billing']['billing_address_1']['priority'] = $priority++;
//     $checkout_fields['billing']['billing_state']['priority'] = $priority++;
//     $checkout_fields['billing']['billing_city']['priority'] = $priority++;
//     $checkout_fields['billing']['billing_country']['priority'] = $priority++;
//     $checkout_fields['order']['order_comments']['label'] = 'Note';
//     return $checkout_fields;
// }

// add_action( 'wp', 'set_user_visited_product_cookie');
// remove_action('template_redirect', 'set_user_visited_product_cookie', 20);
// add_action( 'template_redirect', 'set_user_visited_product_cookie', 20 );
// function set_user_visited_product_cookie() {
//     global $post;

//     if ( is_product() ) {

//         if ( empty( $_COOKIE['woocommerce_recently_viewed'] ) ) { // @codingStandardsIgnoreLine.
//             $viewed_products = array();
//         } else {
//             $viewed_products = wp_parse_id_list( (array) explode( '|', wp_unslash( $_COOKIE['woocommerce_recently_viewed'] ) ) ); // @codingStandardsIgnoreLine.
//         }

//         $keys = array_flip( $viewed_products );

//         if ( isset( $keys[ $post->ID ] ) ) {
//             unset( $viewed_products[ $keys[ $post->ID ] ] );
//         }

//         $viewed_products[] = $post->ID;

//         if ( count( $viewed_products ) > 15 ) {
//             array_shift( $viewed_products );
//         }

//         // Store for session only.
//         wc_setcookie( 'woocommerce_recently_viewed', implode( '|', $viewed_products ) );

//     }
// }

// /**
//  * remove form cupon checkout
//  */
// add_action( 'woocommerce_before_checkout_form', 'remove_checkout_coupon_form', 9 );
// function remove_checkout_coupon_form(){
//     remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
//}

/**
 * Hook
 */
// remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
// add_action( 'woocommerce_after_order_notes', 'woocommerce_checkout_payment', 20 );


// /**
// *  Add Custom Icon 
// */ 

// function custom_gateway_icon( $icon, $id ) {
//     if ( $id === 'cod' ) {
//         return '<img src="'.get_site_url().'/template/assets/images/paym-icon-1.svg" class="icon">'; 
//     } elseif ( $id == 'bacs' ) {
//         return '<img src="'.get_site_url().'/template/assets/images/paym-icon-5.svg" class="icon">'; 
//     } else {
//         return $icon;
//     }
// }
// add_filter( 'woocommerce_gateway_icon', 'custom_gateway_icon', 10, 2 );

add_filter( 'woocommerce_product_variation_title_include_attributes', 'mona_product_variation_title_include_attributes', 10, 2 );
function mona_product_variation_title_include_attributes( $should_include_attributes, $product ) {
	// Returning false messes up My Account/Downloads page - thanks for Leandro for reporting.
	if ( is_account_page() ) {
		return $should_include_attributes;
	}

	return false;
}

// add_action('init', 'mona_start_session', 1);
// function mona_start_session() {
//     if (! session_id() ) {
//         session_start();
//     }
// }

// change cart count number after remove item
add_filter( 'woocommerce_add_to_cart_fragments', 'iconic_cart_count_fragments', 10, 2 );
function iconic_cart_count_fragments( $fragments ) {
	$fragments['#monaCartQty']    = '<span class="number" id="monaCartQty">' . WC()->cart->get_cart_contents_count() . '</span>';
	$fragments['#mona-mini-cart'] = '<div class="header-cart-box" id="mona-mini-cart"><div class="widget_shopping_cart_content">' . woocommerce_mini_cart() . '</div></div>';

	return $fragments;
}

// hook rename label on-hold status woo
add_filter( 'wc_order_statuses', 'wc_renaming_order_status' );
function wc_renaming_order_status( $order_statuses ) {
	foreach ( $order_statuses as $key => $status ) {
		if ( 'wc-on-hold' === $key ) {
			$order_statuses['wc-on-hold'] = _x( 'Chờ xác minh thanh toán', 'Order status', 'woocommerce' );
		}
	}

	return $order_statuses;
}