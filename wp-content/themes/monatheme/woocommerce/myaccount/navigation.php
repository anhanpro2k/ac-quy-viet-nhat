<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_account_navigation' );
$Account = new Account();
?>
<div class="account-title">
    <h1 class="title blur white load-img"><?php echo __( 'HỒ SƠ NGƯỜI DÙNG', 'monamedia' ); ?></h1>
</div>
<div class="account-side-list">
	<?php foreach ( wc_get_account_menu_items() as $endpoint => $item ) : ?>
        <a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>" class="account-side-item">
                <span class="icon">
                    <?php if ( $endpoint == 'dashboard' ) : ?>
                        <img src="<?php echo get_site_url(); ?>/template/assets/images/user.svg" alt="">
                    <?php elseif ( $endpoint == 'thay-doi-mat-khau' ) : ?>
                        <img src="<?php echo get_site_url(); ?>/template/assets/images/lock.svg" alt="">
                    <?php elseif ( $endpoint == 'orders' ) : ?>
                        <img src="<?php echo get_site_url(); ?>/template/assets/images/clock.svg" alt="">
                    <?php elseif ( $endpoint == 'customer-logout' ) : ?>
                        <img src="<?php echo get_template_directory_uri() ?>/public/helpers/images/sign-out-svgrepo-com.svg"
                             alt="">
                    <?php endif; ?>
                </span>
            <span class="text"><?php echo esc_html( $item['label'] ); ?></span>
        </a>
	<?php
	endforeach; ?>
</div>
<?php do_action( 'woocommerce_after_account_navigation' ); ?>
