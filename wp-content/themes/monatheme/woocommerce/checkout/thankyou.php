<?php

/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;
?>


<div class="cart cart-order-check">
    <div class="order-check">
		<?php
		$mona_pay_thanks_desc = get_field( 'mona_pay_thanks_desc' );
		if ( ! empty( $mona_pay_thanks_desc ) ) {
			?>
            <h3 class="order-check-title">
                <span class="icon">
                    <img src="<?php echo get_site_url(); ?>/template/assets/images/p-icon-check.svg" alt="">
                </span>
				<?php
				echo $mona_pay_thanks_desc;
				?>
            </h3>
			<?php
		}
		?>
        <div class="order-check-inner">
            <div class="information-line">
                <h4 class="title"><?php _e( 'Thông tin đơn hàng', 'monamedia' ); ?></h4>
                <div class="inner-information-product">
                    <div class="wrapper-information">
                        <span class="item"><?php _e( 'Mã đơn hàng', 'monamedia' ); ?></span>
                        <span class="item"><?php _e( 'Phương thức thanh toán', 'monamedia' ); ?></span>
                        <span class="item"><?php _e( 'Ngày', 'monamedia' ); ?></span>
                    </div>
                    <div class="wrapper-information-modify">
						<?php
						$payment_method = $order->get_payment_method_title();
						?>
                        <span class="item"><?php echo $order->get_id(); ?></span>
                        <span class="item"><?php echo $payment_method; ?></span>
                        <span class="item">
                            <?php
                            $date = date_create( $order->get_date_created() );
                            echo date_format( $date, 'd/m/Y' );
                            ?>
                        </span>
                    </div>
                </div>
                <div class="wrapper-product-check">
                    <div class="inner-product-title">
                        <span class="item"><?php _e( 'Sản phẩm', 'monamedia' ); ?></span>
                        <span class="item"><?php _e( 'Số lượng', 'monamedia' ); ?></span>
                        <span class="item"><?php _e( 'Giá tiền', 'monamedia' ); ?></span>
                    </div>
                    <div class="inner-product-content">
						<?php
						$items = $order->get_items();
						foreach ( $items as $item ) {
							$product_id       = $item->get_product_id();
							$product          = $item->get_product();
							$product_name     = $product->get_name();
							$product_image_id = $product->get_image_id();
							$item_quantity    = $item->get_quantity();
							$sku              = $product->get_sku();
							$price            = $product->get_price();

							?>
                            <div class="product-content-item">
                                <div class="image">
									<?php
									echo wp_get_attachment_image( $product_image_id, 'full' );
									?>
                                </div>
                                <a href="#" class="name"><?php echo $product_name; ?></a>
                                <div class="quantity"><?php echo $item_quantity; ?></div>
                                <div class="price"><?php echo wc_price( $price ); ?></div>
                            </div>
							<?php
						}
						?>

                    </div>
                </div>
				<?php
				$subtotal       = $order->get_subtotal();
				$shipping_total = $order->get_shipping_total();

				$total = $order->get_total();
				?>
                <div class="wrapper-total-product">
                    <div class="item">
                        <span class="txt">Tạm tính</span>
                        <span class="number"><?php echo wc_price( $subtotal ); ?></span>
                    </div>
                    <!-- <div class="item">
                        <span class="txt"></span>
                        <span class="number">100,000 đ</span>
                    </div> -->
                    <div class="item total">
                        <span class="txt "><?php echo __( 'Tổng đơn', 'monamedia' ); ?></span>
                        <span class="number"><?php echo wc_price( $total ); ?></span>
                    </div>
                </div>
            </div>
			<?php
			$bacs_accounts = get_option( 'woocommerce_bacs_accounts' );
			if ( ! empty( $bacs_accounts ) && is_array( $bacs_accounts ) ) {
				?>
                <div class="bank-information">
                    <div class="wrapper-bank-information">
                        <h4 class="bank-information-title"><?php echo __( 'Thông tin ngân hàng', 'monamedia' ); ?></h4>
                        <div class="inner-bank-information">
							<?php
							$mona_pay_thanks_content_bacs = get_field( 'mona_pay_thanks_content_bacs' );
							foreach ( $bacs_accounts as $item_bacs ) {
								$name_acc_bank = $item_bacs['account_name'];
								$bank_name     = $item_bacs['bank_name'];
								$number_bank   = $item_bacs['account_number'];

								?>
                                <div class="bank-information-item">
                                    <div class="warpper-info-bank">
                                        <div class="item">
                                            <span class="txt-left"><?php echo __( 'Ngân hàng', 'monamedia' ); ?></span>
                                            <span class="txt-right"><?php echo __( 'Số tài khoản', 'monamedia' ); ?></span>
                                        </div>
                                        <div class="item">
                                            <span class="txt-left"><?php echo $bank_name; ?></span>
                                            <span class="txt-right"><?php echo $number_bank; ?></span>
                                        </div>
                                    </div>
                                    <div class="warpper-info-bank">
                                        <div class="item">
                                            <span class="txt-left"><?php echo __( 'Tên tài khoản', 'monamedia' ); ?></span>
                                            <span class="txt-right"><?php echo __( 'Nội dung', 'monamedia' ); ?></span>
                                        </div>
                                        <div class="item">
                                            <span class="txt-left"><?php echo $name_acc_bank; ?></span>
                                            <span class="txt-right"><?php echo $mona_pay_thanks_content_bacs; ?></span>
                                        </div>
                                    </div>
                                </div>
								<?php

							}
							?>
                        </div>
                    </div>
                    <a href="<?php echo get_home_url(); ?>" class="btn-pri">
                        <span class="txt"><?php echo __( 'Trở về trang chủ', 'monamedia' ); ?></span>
                    </a>
                </div>
				<?php
			}
			?>
        </div>
    </div>
</div>