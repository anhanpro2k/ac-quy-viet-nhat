<?php
/**
 * Template name: Tài khoản Page
 * @author : Hy Hý
 */
if ( ! is_user_logged_in() ) {
	wp_redirect( get_the_permalink( MONA_PAGE_HOME ) );
	die();
}
get_header();
while ( have_posts() ):
	the_post();
	$user_id          = get_current_user_id();
	$account          = get_userdata( $user_id );
	$mona_user_avatar = get_field( 'mona_user_avatar', $account );
	$Account          = new Account();
	?>
    <main class="main">
        <section class="sec-bn">
            <div class="banner bannerlog">
                <div class="banner-img load-img">
                    <img src="<?php echo get_site_url(); ?>/template/assets/images/bannerlog.jpg" alt="">
                </div>
                <div class="container">
                    <div class="banner-wr">
                        <div class="banner-content">
                            <h1 class="title blur white load-img">
                                Các chính sách
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="sec-account sec-pdb">
            <div class="account">
                <div class="container">
                    <div class="account-wr row">
                        <div class="account-side col-4">
							<?php
							/**
							 * GET TEMPLATE PART
							 * SIDEBAR ACCOUNT
							 */
							$slug = '/partials/global/global';
							$name = 'sidebar-account';
							echo get_template_part( $slug, $name );
							?>
                        </div>
                        <div class="account-main col-8">
                            <div class="account-main-panel">
                                <form id="formUser" action="">
                                    <div class="account-infor">
                                        <div class="top">
                                            <div class="avatar preview-img">
												<?php echo get_avatar( $account->ID ); ?>
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
                                            <label for="">
                                                <span><?php echo __( 'Thay đổi2', 'monamedia' ); ?></span>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php
endwhile;
get_footer();