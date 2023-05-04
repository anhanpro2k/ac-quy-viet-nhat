<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$allowed_html     = array(
	'a' => array(
		'href' => array(),
	),
);
$user_id          = get_current_user_id();
$account          = get_userdata( $user_id );
$mona_user_avatar = get_field( 'mona_user_avatar', $account );
$Account          = new Account();
?>
    <form id="formUser" method="post" action="">
        <div class="account-infor">
            <div class="top">
                <div class="avatar preview-img">
					<?php
					if ( ! empty( $mona_user_avatar ) ) {
						?>
						<?php echo wp_get_attachment_image( $mona_user_avatar, '300x200' ); ?>
						<?php
					} else { ?>
						<?php echo get_avatar( $user_id, 32 ); ?>
						<?php
					} ?>
                </div>
                <div class="infor">
                    <p class="infor-name"><?php echo $account->display_name; ?></p>
                    <p class="infor-role">
						<?php if ( current_user_can( 'shop_manager' ) ) { ?>
							<?php echo __( 'Quản lý cửa hàng', 'monamedia' ); ?>
						<?php } elseif ( current_user_can( 'subscriber' ) ) { ?>
							<?php echo __( 'Khách hàng', 'monamedia' ); ?>
						<?php } elseif ( current_user_can( 'contributor' ) ) { ?>
							<?php echo __( 'Cộng tác viên', 'monamedia' ); ?>
						<?php } elseif ( current_user_can( 'author' ) ) { ?>
							<?php echo __( 'Tác giả', 'monamedia' ); ?>
						<?php } elseif ( current_user_can( 'editor' ) ) { ?>
							<?php echo __( 'Biên tập viên', 'monamedia' ); ?>
						<?php } elseif ( current_user_can( 'administrator' ) ) { ?>
							<?php echo __( 'Quản trị viên', 'monamedia' ); ?>
						<?php } else { ?>
							<?php echo __( 'Khách hàng', 'monamedia' ); ?>
						<?php } ?>
                    </p>
                </div>

                <a href="" class="link">

                </a>
                <label class="label-wrap mona-pointer">
                    <span class="link"><?php echo __( 'Thay đổi', 'monamedia' ); ?></span>
                    <input type="file" class="upload-image" name="user_avatar">
                </label>
            </div>
            <div class="form row">
                <div class="form-ip col">
                    <p class="form-name"><?php echo __( 'Họ và Tên', 'monamedia' ); ?></p>
                    <input type="text" value="<?php echo $account->display_name; ?>"
                           placeholder="" name="user_full_name" required>
                </div>
                <div class="form-ip col">
                    <p class="form-name"><?php echo __( 'Số điện thoại', 'monamedia' ); ?></p>
                    <input type="text"
                           value="<?php $Account->userMeta( 'billing_phone' )->display() ?>"
                           placeholder="" name="user_phone" required>
                    <div class="mona-error mona-error-user-phone"></div>
                </div>
                <div class="form-ip col">
                    <p class="form-name"><?php echo __( 'Email', 'monamedia' ); ?></p>
                    <input type="email"
                           value="<?php $Account->userMeta( 'user_email' )->display() ?>"
                           placeholder="" name="user_email" readonly>
                </div>
                <div class="form-ip col">
                    <p class="form-name"><?php echo __( 'Địa chỉ', 'monamedia' ); ?></p>
                    <input type="text"
                           value="<?php $Account->userMeta( 'billing_address_1' )->display() ?>"
                           placeholder="" name="user_address" required>
                </div>
                <div class="form-btn col">
					<?php wp_nonce_field( 'update_action', 'update_nonce_field' ); ?>
                    <button type="submit" class="btn-third col is-loading-btn">
                        <span class="txt"><?php echo __( 'Thay đổi thông tin', 'monamedia' ); ?></span>
                    </button>
                </div>
            </div>
        </div>
    </form>
<?php
/**
 * My Account dashboard.
 *
 * @since 2.6.0
 */
do_action( 'woocommerce_account_dashboard' );

/**
 * Deprecated woocommerce_before_my_account action.
 *
 * @deprecated 2.6.0
 */
do_action( 'woocommerce_before_my_account' );

/**
 * Deprecated woocommerce_after_my_account action.
 *
 * @deprecated 2.6.0
 */
do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
