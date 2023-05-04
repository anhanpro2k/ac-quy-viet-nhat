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
?>
<form action="" id="formChangePass">
    <div class="account-infor">
        <div class="top">
            <p class="tt">
				<?php echo __( 'THAY ĐỔI MẬT KHẨU', 'monamedia' ); ?>
            </p>
        </div>
		<?php $account_change_pass_description = mona_get_option( 'account_change_pass_description' ); ?>
		<?php
		if ( ! empty( $account_change_pass_description ) ) {
			?>
            <p class="desc">
				<?php echo $account_change_pass_description; ?>
            </p>
			<?php
		}
		?>
        <div class="form row">
            <div class="form-ip col">
                <p class="form-name"><?php echo __( 'Mật khẩu cũ', 'monamedia' ); ?></p>
                <input type="password" name="password" placeholder="" required>
                <i class="seepassJS fas fa-eye"></i>
            </div>
            <div class="form-ip col">
                <p class="form-name"><?php echo __( 'Mật khẩu mới', 'monamedia' ); ?></p>
                <input pattern='/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*(),.?":{}|<>])[A-Za-z\d!@#$%^&*(),.?":{}|<>]{8,}$/'
                       title="<?php echo __( 'Vui lòng nhập mật khẩu đúng định dạng', 'monamedia' ); ?>" required
                       type="password" name="new_password" placeholder="">
                <i class="seepassJS fas fa-eye"></i>
            </div>
            <ul class="mona-password form-ip-note">
                <li class="mona-error-user-pass-length form-ip-note-txt">
					<?php echo __( 'Tối thiểu 8 chữ', 'monamedia' ); ?>
                </li>
                <li class="mona-error-user-pass-upper-case form-ip-note-txt">
					<?php echo __( 'Chứa chữ viết hoa', 'monamedia' ); ?>
                </li>
                <li class="mona-error-user-pass-numberic form-ip-note-txt">
					<?php echo __( 'Chứa số', 'monamedia' ); ?>
                </li>
                <li class="mona-error-user-pass-special form-ip-note-txt">
					<?php echo __( 'Ký tự đặc biệt', 'monamedia' ); ?>
                </li>
            </ul>
            <div class="form-ip col">
                <p class="form-name"><?php echo __( 'Xác nhận mật khẩu mới', 'monamedia' ); ?></p>
                <input pattern='/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*(),.?":{}|<>])[A-Za-z\d!@#$%^&*(),.?":{}|<>]{8,}$/'
                       title="<?php echo __( 'Vui lòng nhập mật khẩu đúng định dạng', 'monamedia' ); ?>" required
                       type="password" name="renew_password" placeholder="">
                <i class="seepassJS fas fa-eye"></i>
            </div>
            <ul class="mona-re-password form-ip-note">
                <li class="mona-error-user-pass-length form-ip-note-txt">
					<?php echo __( 'Tối thiểu 8 chữ', 'monamedia' ); ?>
                </li>
                <li class="mona-error-user-pass-upper-case form-ip-note-txt">
					<?php echo __( 'Chứa chữ viết hoa', 'monamedia' ); ?>
                </li>
                <li class="mona-error-user-pass-numberic form-ip-note-txt">
					<?php echo __( 'Chứa số', 'monamedia' ); ?>
                </li>
                <li class="mona-error-user-pass-special form-ip-note-txt">
					<?php echo __( 'Ký tự đặc biệt', 'monamedia' ); ?>
                </li>
            </ul>
            <div class="form-btn col">
                <button type="submit" class="btn-third col is-loading-btn">
                    <span class="txt"><?php echo __( 'Đổi mật khẩu', 'monamedia' ); ?></span>
                </button>
            </div>
        </div>
    </div>
</form>
