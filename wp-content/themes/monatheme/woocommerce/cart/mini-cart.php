<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_mini_cart' ); ?>

<?php if ( ! WC()->cart->is_empty() ) : ?>
    <ul class="woocommerce-mini-cart cart_list product_list_widget header-cart-list <?php echo esc_attr( $args['list_class'] ); ?>">
		<?php
		do_action( 'woocommerce_before_mini_cart_contents' );

		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
				$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
				$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
				$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
				?>
                <li class="woocommerce-mini-cart-item header-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
                    <div class="inner">

                        <div class="img">
                            <a class="img-inner" href="
						<?php echo esc_url( $product_permalink ); ?>">
								<?php echo $thumbnail; ?>
                            </a>
                        </div>
                        <div class="info">
                            <a href="<?php echo esc_url( $product_permalink ); ?>"
                               class="info-name">
								<?php echo wp_kses_post( $product_name ); ?></a>
                            <p class="info-bottom">
                                                        <span class="info-quan"><?php echo __( 'SL', 'monamedia' ); ?>:
						<?php echo $cart_item['quantity']; ?></span>
                                <span class="info-price"><?php echo __( 'Giá', 'monamedia' ); ?>:
						<?php echo $product_price ?></span>
                            </p>
                        </div>
                        <div class="hidden">
							<?php if ( empty( $product_permalink ) ) : ?>
								<?php echo $thumbnail . wp_kses_post( $product_name ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<?php else : ?>
                                <a href="<?php echo esc_url( $product_permalink ); ?>">
									<?php echo $thumbnail . wp_kses_post( $product_name ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                                </a>
							<?php endif; ?>
							<?php echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity"' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                        </div>
                        <span class="delete">
							<?php
							echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								'woocommerce_cart_item_remove_link',
								sprintf(
									'<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">' . '<img src="' . get_site_url() . '/template/assets/images/trash.svg' . '">' . '</a>',
									esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
									esc_attr__( 'Remove this item', 'woocommerce' ),
									esc_attr( $product_id ),
									esc_attr( $cart_item_key ),
									esc_attr( $_product->get_sku() )
								),
								$cart_item_key
							); ?>
                        </span>
                    </div>

                </li>
				<?php
			}
		}

		do_action( 'woocommerce_mini_cart_contents' );
		?>
    </ul>
    <div class="header-cart-total">
        <div class="top">
        <span class="top-txt">
            <?php echo __( 'Tổng tiền', 'monamedia' ); ?>:
        </span>
            <span class="top-price">
            <?php wc_cart_totals_subtotal_html(); ?>
        </span>
        </div>

        <div class="button">
            <a href="<?php echo get_permalink( MONA_WC_CHECKOUT ) ?>" class="btn-white">
                <span class="txt"><?php echo __( 'Thanh toán', 'monamedia' ); ?></span>
            </a>
            <a href="<?php echo get_permalink( MONA_WC_CART ) ?>" class="btn-third">
                <span class="txt"><?php echo __( 'Xem giỏ hàng', 'monamedia' ); ?></span>
            </a>
        </div>
    </div>
<?php else : ?>
    <div class="empty-cart-wrap">

        <!-- /******************************************** */ -->

        <div class="cart-mini-list empty">
            <div class="woocommerce-mini-cart__empty-image">
                <img src="http://whey.monamedia.net/wp-content/themes/monatheme/public/images/no-shopping-cart.png">
            </div>
            <p class="woocommerce-mini-cart__empty-message">
				<?php echo __( 'Chưa có sản phẩm trong giỏ hàng', 'monamedia' ); ?>. </p>
        </div>

    </div>
<?php endif; ?>


<?php do_action( 'woocommerce_after_mini_cart' ); ?>



