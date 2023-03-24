<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;
$current = get_queried_object();
?>

<form action="">
	<?php
	if ( is_wc_endpoint_url( 'orders' ) ) {
		$slug = wc_get_account_endpoint_url( 'orders' );
	}
	?>
    <div class="account-infor">
        <div class="top">
            <p class="tt">
				<?php echo __( 'Lịch sử mua hàng', 'monamedia' ); ?>
            </p>
        </div>
        <div class="account-table">
            <table>
                <thead>
                <tr>
                    <th><?php echo __( 'Mã đơn hàng', 'monamedia' ); ?></th>
                    <th><?php echo __( 'Ngày mua', 'monamedia' ); ?></th>
                    <th><?php echo __( 'Đơn giá', 'monamedia' ); ?></th>
                    <th><?php echo __( 'Tình trạng', 'monamedia' ); ?></th>
                </tr>
                </thead>
                <tbody>
				<?php
				$current_page    = max( 1, get_query_var( 'paged' ) );
				$orders_per_page = 5;
				$offset          = ( $current_page - 1 ) * $orders_per_page;

				$args = array(
					'customer' => get_current_user_id(),
					'limit'    => $orders_per_page,
					'offset'   => $offset,
					'paged'    => $current_page
				);


				$customer_orders = wc_get_orders( $args );
				foreach ( $customer_orders as $customer_order ) {
					$order_id           = $customer_order->get_id();
					$order_date_created = $customer_order->get_date_created();
					$order_total        = $customer_order->get_total();
					$order_status       = $customer_order->get_status();

					$order_number = $customer_order->get_order_number();
					?>
                    <tr>
                        <td data-title="Mã đơn hàng">#<?php echo $order_number; ?></td>
                        <td data-title="Ngày mua"><?php echo $order_date_created->format( 'd-m-Y' ); ?></td>
                        <td data-title="Đơn giá"><span class="price"><?php echo wc_price( $order_total ); ?></span>
                        </td>
                        <td data-title="Tình trạng">
                                <span class="account-table-status <?php echo esc_attr( $order_status ); ?>">
                                    <?php echo wc_get_order_status_name( $order_status ); ?>
                                </span>
                        </td>
                    </tr>
				<?php }
				?>
                </tbody>
            </table>
			<?php
			if ( empty( $customer_orders ) ) { ?>
                <div class="mona-mess-expired">
					<?php echo __( 'Không có đơn hàng nào!', 'monamedia' ); ?>
                </div>
				<?php
			}
			?>
        </div>
        <!--		--><?php
		//		$total_pages = ceil( wc_get_customer_order_count( get_current_user_id() ) / 5 );
		//		if ( $total_pages > 1 ) :
		//			$current_page = 2;
		//			?>
        <!--            <div class="account-pagi">-->
        <!--                <div class="account-pagi-left">-->
        <!--                    <span class="current">--><?php //echo $current_page; ?><!--</span>-->
        <!--                    <span class="total">--><?php //echo $total_pages; ?><!--</span>-->
        <!--                </div>-->
        <!--                <div class="account-pagi-right">-->
        <!--					--><?php
		//					$prev_link = get_pagenum_link( $current_page - 1 );
		//					$next_link = get_pagenum_link( $current_page + 1 );
		//					?>
        <!--                    <a href="--><?php //echo $prev_link; ?><!--"-->
        <!--                       class="btn-prev--><?php //echo ( $current_page == 1 ) ? ' current' : ''; ?><!--">-->
        <!--                        <i class="far fa-chevron-left"></i>-->
        <!--                    </a>-->
        <!--                    <a href="--><?php //echo $next_link; ?><!--"-->
        <!--                       class="btn-next-->
		<?php //echo ( $current_page == $total_pages ) ? ' current' : ''; ?><!--">-->
        <!--                        <i class="far fa-chevron-right"></i>-->
        <!--                    </a>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--		--><?php //endif; ?>

    </div>
</form>