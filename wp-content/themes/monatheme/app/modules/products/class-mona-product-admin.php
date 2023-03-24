<?php 
// require_once( get_template_directory() . '/app/modules/products/class-mona-order-action.php' );
require_once( get_template_directory() . '/app/modules/products/class-mona-product-hooks.php' );
require_once( get_template_directory() . '/app/modules/products/class-mona-product-variations.php' );
require_once( get_template_directory() . '/app/modules/products/class-mona-product-data.php' );
require_once( get_template_directory() . '/app/modules/products/class-mona-product-attributes-acf.php' );

/**
 * function CHECK PRODUCT has bought by Customer */
function is_product_has_bought_by_customer( $product_id ){

    if( empty($product_id) ){
        return false;
    }
        
    global $woocommerce;
    $user_id = get_current_user_id();
    $current_user= wp_get_current_user();
    $customer_email = $current_user->email;

    if ( wc_customer_bought_product( $customer_email, $user_id, $product_id) ){
        return true;
    }

    return false;
}

/**
 * function GET PERCENSALE
 */
function mona_type_percensale( $price_sale, $price ) {
    $x = ( ($price_sale) / ($price) ) * 100;
    $percent = 100 - $x;
    return $percent;
}

/**
 * function CHECK PRODUCT ID IS EXSIST IN CART */
function is_matched_cart_items( $search_products ) {
    $count = 0; // Initializing

    if ( ! WC()->cart->is_empty() ) {
        // Loop though cart items
        foreach(WC()->cart->get_cart() as $cart_item ) {
            
            $cart_item_ids = array($cart_item['product_id'], $cart_item['variation_id']);

            if( ( is_array($search_products) && array_intersect($search_products, $cart_item_ids) ) 
            || ( !is_array($search_products) && in_array($search_products, $cart_item_ids) ) )
                $count++;
        }
    }
    return $count;
}

function get_coupon_ids( $product_id ){
    $couponsResult = []; 
    $coupons = get_posts( array(
        'posts_per_page'   => -1,
        'post_type'        => 'shop_coupon',
        'post_status'      => 'publish',
    ) );
    if( !empty( $coupons ) && !empty( $product_id ) ){
        foreach ($coupons as $key => $coupon) {
            $product_ids = get_post_meta( $coupon->ID, 'product_ids', true );
            if( !empty( $product_ids ) ){
                // convert from comma separated string to array
                $id_list = explode( ',', $product_ids );
                if( is_array( $id_list ) && in_array( $product_id, $id_list ) ){
                    $couponsResult[] = $coupon->ID;
                }
            }
        }
    }

    return $couponsResult;
} 