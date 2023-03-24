<?php
// add_action('wp_logout','auto_redirect_after_logout');
// function auto_redirect_after_logout(){
//     wp_redirect( home_url() );
//     exit();
// }


add_filter( 'woocommerce_account_menu_items', 'mona_new_menu_items' );
function mona_new_menu_items( $items ) {

	//unset( $items['edit-account'] );
	// $count = 1;
	// foreach ($items as $key => $item) {
	//     if( $key == 'dashboard' ){

	//         $items = array_slice($items, 0, $count, true) +
	//         array('edit-account' => __( 'Thay đổi mật khẩu', 'monamedia' )) +
	//         array_slice($items, $count, count($items) - 1, true) ;

	//     }
	//     $count++;
	// }
	// $count = 1;
	// foreach ($items as $key => $item) {
	//     if( $key == 'edit-account' ){

	//         $items = array_slice($items, 0, $count, true) +
	//         array('san-pham-yeu-thich' => __( 'Sản phẩm yêu thích', 'monamedia' )) +
	//         array_slice($items, $count, count($items) - 1, true) ;
	//     }
	//     $count++;
	// }
	// $count = 1;
	// foreach ($items as $key => $item) {
	//     if( $key == 'san-pham-yeu-thich' ){

	//         $items = array_slice($items, 0, $count, true) +
	//         array('phieu-thi-luc' => __( 'Phiếu thị lực', 'monamedia' )) +
	//         array_slice($items, $count, count($items) - 1, true) ;
	//     }
	//     $count++;
	// }
	// $count = 1;
	// foreach ($items as $key => $item) {
	//     if( $key == 'edit-address' ){

	//         $items = array_slice($items, 0, $count, true) +
	//         array('the-thanh-toan' => __( 'Thẻ thanh toán', 'monamedia' )) +
	//         array_slice($items, $count, count($items) - 1, true) ;
	//     }
	//     $count++;
	// }

	$items = array(
		'dashboard'         => array(
			'label' => __( 'Thông tin tài khoản', 'monamedia' )
		),
		'thay-doi-mat-khau' => array(
			'label' => __( 'Thay đổi mật khẩu', 'monamedia' )
		),
		'orders'            => array(
			'label' => __( 'Lịch sử đơn hàng', 'monamedia' )
		),
		'customer-logout'   => array(
			'label' => __( 'Đăng xuất', 'monamedia' )
		)
	);


	return $items;
}

add_filter( 'woocommerce_account_menu_items', 'mona_customize_account_menu_items' );
function mona_customize_account_menu_items( $menu_items ) {
	//unset( $menu_items['dashboard'] ); // Remove Dashboard from My Account Menu
	//unset( $menu_items['orders'] ); // Remove Orders from My Account Menu
	unset( $menu_items['downloads'] ); // Remove Downloads from My Account Menu
	//unset( $menu_items['edit-account'] ); // Remove Account details from My Account Menu
	unset( $menu_items['payment-methods'] ); // Remove Payment Methods from My Account Menu
	unset( $menu_items['edit-address'] ); // Addresses from My Account Menu
	//unset( $menu_items['customer-logout'] ); // Remove Logout link from My Account Menu
	return $menu_items;
}

// add_filter ( 'woocommerce_account_menu_items', 'mona_rename_customize_account_menu_items');
// function mona_rename_customize_account_menu_items( $menu_items ){
//     $menu_items['dashboard']        = __( 'Thông tin tài khoản', 'monamedia' );
//     $menu_items['edit-address']     = __( 'Thay đổi mật khẩu', 'monamedia' ); 
//     $menu_items['edit-account']     = __( 'Thay đổi mật khẩu', 'monamedia' );  
//     $menu_items['orders']           = __( 'Lịch sử đơn hàng', 'monamedia' );
//     $menu_items['customer-logout']  = __( 'Đăng xuất', 'monamedia' );
//     return $menu_items;
// }