<?php

/**
 * The template for displaying header.
 *
 * @package Monamedia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

<head>
    <!-- Meta
                ================================================== -->
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport"
          content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php wp_site_icon(); ?>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>
    <!-- <link rel="stylesheet" href="<?php echo get_site_url() ?>/template/css/style.css"> -->
	<?php wp_head(); ?>
    <link rel="stylesheet" href="<?php echo get_site_url(); ?>/template/css/style.css">
    <link rel="stylesheet" href="<?php echo get_site_url(); ?>/template/css/backdoor.css">
</head>
<?php
if ( wp_is_mobile() ) {
	$body = 'mobile-detect';
} else {
	$body = 'desktop-detect';
}
?>

<body <?php body_class( $body ); ?>>
<header class="header">
    <div class="header-wrapper">
        <div class="header-top">
            <div class="container">
                <div class="header-top-wr">
                    <div class="header-top-phone">
                            <span class="icon">
                                <img src="<?php echo get_site_url(); ?>/template/assets/images/phone-call.svg" alt="">
                            </span>
                        <span class="txt"><?php echo __( 'Hỗ trợ', 'monamedia' ); ?></span>
						<?php
						$footer_phone = mona_get_option( 'section_info_phone' );
						?>
						<?php
						if ( ! empty( $footer_phone ) ) {
							?>
                            <div class="link">
								<?php echo $footer_phone ?>
                            </div>
							<?php
						}
						?>
                    </div>
                    <div class="header-top-search">
                        <form action="<?php echo get_home_url() ?>">
                            <div class="header-top-search-wr">
                                <button type="submit" class="icon">
                                    <img src="
<?php echo get_site_url(); ?>/template/assets/images/search.svg" alt="">
                                </button>
                                <input type="text"
                                       name="s" <?php echo isset( $_GET['s'] ) ? 'value="' . esc_html( $_GET['s'] ) . '"' : '' ?>
                                       placeholder="<?php echo __( 'Tìm sản phẩm', 'monamedia' ); ?>">
                            </div>
                        </form>
                    </div>
                    <div class="header-top-login <?php echo( is_user_logged_in() ? 'logged' : '' ) ?>">
                        <div class="header-top-login-wr <?php echo( is_user_logged_in() ? 'logged' : '' ) ?>">
							<?php if ( is_user_logged_in() ) {
								$user_id          = get_current_user_id();
								$account          = get_userdata( $user_id );
								$mona_user_avatar = get_field( 'mona_user_avatar', $account );
								?>

                                <a href="<?php echo ! wp_is_mobile() ? get_permalink( MONA_WC_MYACCOUNT ) : 'javascript:;' ?>"
                                   class="avatar">
									<?php
									if ( ! empty( $mona_user_avatar ) ) {
										?>
										<?php echo wp_get_attachment_image( $mona_user_avatar, '300x200' ); ?>
										<?php
									} else {
										echo get_avatar( $user_id );
									}
									?>

                                </a>

                                <a href="<?php echo get_permalink( MONA_WC_MYACCOUNT ) ?>" class="txt mona-name">
									<?php echo $account->display_name; ?>
                                </a>

                                <div class="icon">
                                    <i class="fas fa-angle-down"></i>
                                </div>

                                <div class="header-login-infor">
                                    <ul class="header-login-list">
                                        <li class="header-login-item">
                                            <a href="<?php echo get_permalink( MONA_WC_MYACCOUNT ) ?>"
                                               class="header-login-link"><?php echo __( 'Tài khoản', 'monamedia' ); ?></a>
                                        </li>
                                        <li class="header-login-item">
                                            <a href="<?php echo esc_url( wc_get_account_endpoint_url( 'orders' ) ) ?>"
                                               class="header-login-link"><?php echo __( 'Đơn hàng', 'monamedia' ); ?></a>
                                        </li>
                                        <li class="header-login-item">
                                            <a href="<?php echo esc_url( wc_get_account_endpoint_url( 'thay-doi-mat-khau' ) ) ?>"
                                               class="header-login-link"><?php echo __( 'Thay đổi mật khẩu', 'monamedia' ); ?></a>
                                        </li>
                                        <li class="header-login-item">
                                            <a href="<?php echo esc_url( wc_get_account_endpoint_url( 'customer-logout' ) ); ?>"
                                               class="header-login-link"><?php echo __( 'Đăng xuất', 'monamedia' ); ?></a>
                                        </li>
                                    </ul>
                                </div>
							<?php } else { ?>
								<?php
								if ( wp_is_mobile() ) {
									?>
                                    <a href="javascript:;" class="mona-image-login">
                                        <img src="<?php echo get_template_directory_uri() ?>/public/helpers/images/icons8-male_user.svg"
                                             alt="">
                                    </a>
									<?php
								} ?>
                                <span class="txt">
                                    <?php echo __( 'Đăng nhập', 'monamedia' ); ?>
                                </span>
                                <div class="icon">
                                    <i class="fas fa-angle-down"></i>
                                </div>
                                <div class="header-login tabJS">
                                    <div class="header-login-top">
                                        <div class="log tabBtn">
											<?php echo __( 'Đăng nhập', 'monamedia' ); ?>
                                        </div>
                                        <div class="regis tabBtn">
											<?php echo __( 'Đăng ký tài khoản', 'monamedia' ); ?>
                                        </div>
                                    </div>
                                    <form id="frmForgot">
                                        <div class="header-login-forgot">
                                            <div class="forgotCloseJS">
                                                <i class="fas fa-times"></i>
                                            </div>
                                            <p class="note">
												<?php echo __( 'Hãy nhập địa chỉ gmail của bạn dưới đây hệ thống sẽ gửi cho bạn một liên kết
                                            để đặt lại mật khẩu', 'monamedia' ); ?>
                                            </p>
                                            <div class="input">
                                                <input type="text" name="redirect"
                                                       value="<?php echo get_the_permalink( get_the_ID() ) ?>" hidden>
                                                <input type="text" name="user_login"
                                                       placeholder="Nhập gmail của bạn">
                                            </div>
											<?php wp_nonce_field( 'forgot_action', 'forgot_nonce_field' ); ?>
                                            <div style="display: none;" class="mona-notice error"></div>
                                            <div style="display: none;" class="mona-notice success"></div>
                                            <button type="submit" class="btn-pri is-loading-btn">
                                            <span class="txt">
                                                <?php echo __( 'Gửi', 'monamedia' ); ?>
                                            </span>
                                            </button>
                                        </div>
                                    </form>
                                    <div class="header-login-body">
                                        <div class="header-login-form tabPanel">
                                            <div class="contentTab">
                                                <form id="formLogin">
													<?php
													if ( is_home() ) {
														$redirect = get_the_permalink( MONA_PAGE_BLOG );
													} elseif ( is_tax() ) {
														$current_taxonomy = get_queried_object();
														$redirect         = get_term_link( $current_taxonomy->term_id, $current_taxonomy->taxonomy );
													} else {
														$redirect = get_the_permalink();
													}
													?>
                                                    <div class="header-login-wr">
                                                        <div class="input">
                                                            <input type="text" placeholder="Email" name="user_login"
                                                                   class="login-ctr required" required>
                                                            <div class="mona-error mona-error-user-login"></div>
                                                        </div>
                                                        <div class="input">
                                                            <input type="password" placeholder="Mật khẩu"
                                                                   name="password" class="login-ctr required" required>
                                                            <i class="seepassJS fas fa-eye"></i>
                                                            <div class="mona-error mona-error-user-password "></div>
                                                        </div>
														<?php wp_nonce_field( 'login_action', 'login_nonce_field' ); ?>
                                                        <button type="submit" class="btn-pri is-loading-btn">
                                                            <span
                                                                    class="txt"><?php echo __( 'Đăng nhập', 'monamedia' ); ?></span>
                                                        </button>

                                                        <div class="txt forgotJS">
															<?php echo __( 'Quên mật khẩu', 'monamedia' ); ?>
                                                            ?
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="header-regis-form tabPanel">
                                            <div class="contentTab">
                                                <form id="formRegister">
                                                    <div class="header-login-wr">
                                                        <div class="input">
                                                            <input type="text" id="user_full_name" required
                                                                   name="user_full_name" placeholder="Họ và Tên *">
                                                            <div class="mona-error mona-error-user-full-name"></div>
                                                        </div>
                                                        <div class="input">
                                                            <input type="phone" name="user_phone" id="user_phone"
                                                                   required placeholder="Số điện thoại *">
                                                            <div class="mona-error mona-error-user-phone"></div>
                                                        </div>
                                                        <div class="input">
                                                            <input type="email" name="user_email" id="user_email"
                                                                   required placeholder="Email *">
                                                            <div class="mona-error mona-error-user-email"></div>
                                                        </div>
                                                        <div class="input">
                                                            <input type="password"
                                                                   pattern='^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*(),.?":{}|<>]).{8,}$'
                                                                   name="password" id="password" required
                                                                   placeholder="Mật khẩu *">
                                                            <i class="seepassJS fas fa-eye"></i>
                                                            <div class="mona-error mona-error-user-pass"></div>
                                                        </div>
                                                        <p class="header-login-note">
                                                            <span class="text mona-error-user-pass-length hidden">
                                                                <?php echo __( 'Tối thiểu 8 ký tự', 'monamedia' ); ?></span>
                                                            <span class="text mona-error-user-pass-upper-case hidden">
                                                                <?php echo __( 'Chứa 1 ký tự viết hoa', 'monamedia' ); ?></span>
                                                            <span class="text mona-error-user-pass-numberic hidden">
                                                                <?php echo __( 'Ít nhất 1 ký tự số', 'monamedia' ); ?></span>
                                                            <span class="text mona-error-user-pass-special hidden">
                                                                <?php echo __( 'Chứa 1 ký tự đặc biệt', 'monamedia' ); ?></span>
                                                        </p>
                                                        <div class="input">
                                                            <input type="password"
                                                                   pattern='^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*(),.?":{}|<>]).{8,}$'
                                                                   name="repassword" id="repassword" required
                                                                   placeholder="Nhập lại mật khẩu *">
                                                            <i class="seepassJS fas fa-eye"></i>
                                                            <div class="mona-error mona-error-user-repass"></div>
                                                        </div>
														<?php wp_nonce_field( 'register_action', 'register_nonce_field' ); ?>
                                                        <button type="submit" class="btn-pri is-loading-btn">
                                                            <span class="txt">
                                                                <?php echo __( 'Đăng ký', 'monamedia' ); ?></span>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- login hover information -->
                                </div>
								<?php
							} ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom">
            <div class="container">
                <div class="header-bottom-wr">
                    <div class="header-logo">
                        <a href="<?php echo get_home_url(); ?>" class="custom-logo-link">
                            <img src="
<?php echo get_site_url(); ?>/template/assets/images/logo.png" alt="">
                        </a>
                    </div>
                    <div class="header-burger">
                        <div class="burger">
                            <div class="hamburger" id="hamburger">
                                <span class="line"></span>
                                <span class="line"></span>
                                <span class="line"></span>
                            </div>
                        </div>
                        <div class="header-burger-btn">
                            <div class="icon">
                                <div class="icon-burger">
                                    <span class="line"></span>
                                    <span class="line"></span>
                                    <span class="line"></span>
                                </div>
                            </div>
                            <div class="txt">
								<?php
								wp_nav_menu( array(
									'container'       => false,
									'container_class' => '',
									'menu_class'      => '',
									'theme_location'  => 'menu-product-tax',
									'before'          => '',
									'after'           => '',
									'link_before'     => '',
									'link_after'      => '',
									'fallback_cb'     => false,
									'walker'          => new Mona_Walker_Nav_Menu_Product,
								) );
								?>
								<?php //_e('Danh mục sản phẩm', 'monamedia');
								?>
                            </div>
                        </div>
                    </div>
                    <div class="header-nav">
                        <div class="menu-nav">
							<?php
							wp_nav_menu( array(
								'container'       => false,
								'container_class' => '',
								'menu_class'      => 'menu-list',
								'theme_location'  => 'primary-menu',
								'before'          => '',
								'after'           => '',
								'link_before'     => '',
								'link_after'      => '',
								'fallback_cb'     => false,
								'walker'          => new Mona_Walker_Nav_Menu,
							) );
							?>
                        </div>
                    </div>

                    <div class="header-cart">
                        <a class="mona-cart-link"
                           href="<?php echo wp_is_mobile() ? 'javascript:;' : get_permalink( MONA_WC_CART ) ?>">
                                <span class="icon">
                                    <img src="<?php echo get_site_url(); ?>/template/assets/images/shopping-cart.svg"
                                         alt="">
                                </span>
                            <span class="txt"><?php echo __( 'Giỏ hàng', 'monamedia' ); ?></span>
                        </a>
                        <span id="monaCartQty" class="num">
                                <?php echo WC()->cart->get_cart_contents_count() ?>
                            </span>
                        <div class="header-cart-box">
                            <div class="widget_shopping_cart_content is-loading-group">
								<?php woocommerce_mini_cart(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="mobile-overlay"></div>
    <div class="mobile">
        <div class="mobile-con">
            <div class="mobile-wr">
                <div class="mobile-nav">
                    <div class="menu-nav  menu-have-icon">
                        <div class="menu-nav menu-have-icon">
							<?php
							wp_nav_menu( array(
								'container'       => false,
								'container_class' => '',
								'menu_class'      => 'menu-list',
								'theme_location'  => 'menu-mobile',
								'before'          => '',
								'after'           => '',
								'link_before'     => '',
								'link_after'      => '',
								'fallback_cb'     => false,
								'walker'          => new Mona_Walker_Nav_Menu,
							) );
							?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="megas-overlay"></div>
</header>