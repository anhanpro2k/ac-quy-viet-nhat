<?php

/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

if ( ! wc_coupons_enabled() ) { // @codingStandardsIgnoreLine.
	return;
}

?>
<div class="wrapper-intro-pay">
    <div class="wrapper-intro-pay-item">
        <div class="inner-item">
            <div class="txt-wrap">
                <div class="icon">
                    <img src="<?php echo get_site_url(); ?>/template/assets/images/p-icon-persion.svg" alt="">
                </div>
				<?php if ( ! is_user_logged_in() ): ?>
                    <span class="txt">
				<?php echo __( 'Bạn đã đăng ký tài khoản chưa', 'monamedia' ); ?>?</span>
                    <a href="javascript:;"
                       class="link-pay header-top-login-wr">
						<?php echo __( 'Đăng ký ngay', 'monamedia' ); ?></a>
				<?php else : ?>
                    <span class="txt">
				<?php echo __( 'Bạn đang mua hàng với tài khoản', 'monamedia' ); ?></span>
                    <a href="<?php echo get_permalink( MONA_WC_MYACCOUNT ) ?>"
                       class="link-pay header-top-login-wr">
						<?php echo wp_get_current_user()->display_name; ?></a>
				<?php
				endif ?>
            </div>
        </div>
    </div>
    <div class="wrapper-intro-pay-item">
        <div class="inner-item">
            <div class="woocommerce-form-coupon-toggle txt-wrap">
                <div class="icon">
                    <img src="<?php echo get_site_url(); ?>/template/assets/images/p-icon-gif.svg" alt="">
                </div>
                <span class="txt">Bạn có mã giảm giá?</span>
                <a href="#" class="link-pay showcoupon">Nhấp vào đây</a>
            </div>
        </div>
    </div>
</div>

<form class="checkout_coupon woocommerce-form-coupon" method="post" style="display:none">

    <p><?php esc_html_e( 'If you have a coupon code, please apply it below.', 'woocommerce' ); ?></p>

    <p class="form-row form-row-first">
        <label for="coupon_code" class="screen-reader-text"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label>
        <input type="text" name="coupon_code" class="input-text"
               placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" id="coupon_code" value=""/>
    </p>

    <p class="form-row form-row-last">
        <button type="submit"
                class="button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>"
                name="apply_coupon"
                value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_html_e( 'Apply coupon', 'woocommerce' ); ?></button>
    </p>

    <div class="clear"></div>
</form>