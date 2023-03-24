<?php

/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined('ABSPATH') || exit;
?>
<div class="shop_table woocommerce-checkout-review-order-table cart-Payment-content">
    <div class="wrapper-content-payment">
        <?php
        do_action('woocommerce_review_order_before_cart_contents');

        foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
            $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);

            if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key)) {
                $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
        ?>
                <div class="<?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?> payment-item">
                    <div class="image">
                        <?php
                        $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);

                        if (!$product_permalink) {
                            echo $thumbnail; // PHPCS: XSS ok.
                        } else {
                            printf('<a class="image" href="%s">%s</a>', esc_url(get_the_permalink($cart_item['product_id'])), $thumbnail); // PHPCS: XSS ok.
                        }
                        ?>
                    </div>
                    <div class="product-name name">
                        <?php echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key)) . '&nbsp;'; ?>
                        <?php echo apply_filters('woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity">' . sprintf('&times;&nbsp;%s', $cart_item['quantity']) . '</strong>', $cart_item, $cart_item_key); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                        ?>
                        <?php echo wc_get_formatted_cart_item_data($cart_item); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                        ?>
                    </div>
                    <div class="quantity"><?php _e('SL:', 'monamedia'); ?> <span class="number"><?php echo $cart_item['quantity']; ?></span></div>
                    <div class="price">
                        <span class="txt"><?php _e('Giá:', 'monamedia'); ?></span>
                        <span class="number"><?php echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                                                ?></span>
                    </div>
                    <div class="product-total">
                        <?php echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                        ?>
                    </div>
                </div>
        <?php
            }
        }

        do_action('woocommerce_review_order_after_cart_contents');
        ?>
    </div>
    <div class="cart-Payment-total">

        <div class="cart-subtotal rovisional">
            <span class="txt"><?php esc_html_e('Subtotal', 'woocommerce'); ?></span>
            <span class="number"><?php wc_cart_totals_subtotal_html(); ?></span>
        </div>

        <?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
            <tr class="cart-discount coupon-<?php echo esc_attr(sanitize_title($code)); ?>">
                <th><?php wc_cart_totals_coupon_label($coupon); ?></th>
                <td><?php wc_cart_totals_coupon_html($coupon); ?></td>
            </tr>
        <?php endforeach; ?>

        <?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>

            <?php do_action('woocommerce_review_order_before_shipping'); ?>

            <?php wc_cart_totals_shipping_html(); ?>

            <?php do_action('woocommerce_review_order_after_shipping'); ?>

        <?php endif; ?>

        <?php foreach (WC()->cart->get_fees() as $fee) : ?>
            <div class="fee vat">
                <div class="txt"><?php echo esc_html($fee->name); ?></div>
                <div class="number"><?php wc_cart_totals_fee_html($fee); ?></div>
            </div>
        <?php endforeach; ?>

        <?php if (wc_tax_enabled() && !WC()->cart->display_prices_including_tax()) : ?>
            <?php if ('itemized' === get_option('woocommerce_tax_total_display')) : ?>
                <?php foreach (WC()->cart->get_tax_totals() as $code => $tax) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited 
                ?>
                    <tr class="tax-rate tax-rate-<?php echo esc_attr(sanitize_title($code)); ?>">
                        <th><?php echo esc_html($tax->label); ?></th>
                        <td><?php echo wp_kses_post($tax->formatted_amount); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr class="tax-total">
                    <th><?php echo esc_html(WC()->countries->tax_or_vat()); ?></th>
                    <td><?php wc_cart_totals_taxes_total_html(); ?></td>
                </tr>
            <?php endif; ?>
        <?php endif; ?>

        <?php do_action('woocommerce_review_order_before_order_total'); ?>

        <!-- <tr class="order-total">
            <th><?php esc_html_e('Total', 'woocommerce'); ?></th>
            <td><?php wc_cart_totals_order_total_html(); ?></td>
        </tr> -->

        <?php do_action('woocommerce_review_order_after_order_total'); ?>
        <button type="submit" class="btn-second button alt <?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : '') ?>" name="woocommerce_checkout_place_order" id="place_order">
            <span class="txt">Thanh toán</span>
        </button>

    </div>
</div>