<?php
/**
 * The template for displaying page template.
 *
 * @package Monamedia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
while ( have_posts() ):
	the_post();
	mona_set_post_view();
	$current = get_queried_object();
	?>
	<?php if ( is_page( MONA_WC_MYACCOUNT ) ) { ?>
    <main class="main">
        <section class="sec-bn">
			<?php
			$mona_post_banner = get_field( 'mona_post_banner' );
			?>
			<?php
			if ( content_exists( $mona_post_banner ) ) { ?>
                <div class="banner bannerlog">
                    <div class="banner-img load-img">
						<?php
						$banner_desktop = $mona_post_banner['banner_image'];
						$banner_mobile  = $mona_post_banner['banner_image_mobile'];
						$banner_url     = "";
						if ( wp_is_mobile() && ! empty( $banner_mobile ) ) {
							$banner_url = wp_get_attachment_image_url( $banner_mobile, 'banner-mobile-image' );
						} else if ( ! wp_is_mobile() && ! empty( $banner_desktop ) ) {
							$banner_url = wp_get_attachment_image_url( $banner_desktop, 'banner-desktop-image' );
						} else {
							$banner_url = get_template_directory_uri() . '/public/helpers/images/grey-banner-default.png';
						}
						?>
                        <img src="<?php echo esc_url( $banner_url ); ?>" alt=""></div>
                    <div class="container">
                        <div class="banner-wr">
                            <div class="banner-content">
                                <h1 class="title blur white load-img"><?php if ( ! empty( $mona_post_banner['banner_title'] ) ) {
										?>
										<?php echo $mona_post_banner['banner_title']; ?>
										<?php
									} else { ?>
										<?php the_title(); ?>
										<?php
									} ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
				<?php
			} ?>
        </section>
		<?php the_content(); ?>
    </main>
<?php } elseif ( is_page( MONA_WC_CART ) ) { ?>
<?php } elseif ( is_page( MONA_WC_CHECKOUT ) ) { ?>
<?php } else { ?>
    <main class="main">
        <div class="new">
			<?php
			$mona_post_banner = get_field( 'mona_post_banner' );
			?>
			<?php
			if ( content_exists( $mona_post_banner ) ) {
				?>
                <section class="sec-bn">
                    <div class="banner">
                        <div class="banner-img load-img">
							<?php
							$banner_desktop = $mona_post_banner['banner_image'];
							$banner_mobile  = $mona_post_banner['banner_image_mobile'];
							$banner_url     = "";
							if ( wp_is_mobile() && ! empty( $banner_mobile ) ) {
								$banner_url = wp_get_attachment_image_url( $banner_mobile, 'banner-mobile-image' );
							} else if ( ! wp_is_mobile() && ! empty( $banner_desktop ) ) {
								$banner_url = wp_get_attachment_image_url( $banner_desktop, 'banner-desktop-image' );
							} else {
								$banner_url = get_template_directory_uri() . '/public/helpers/images/grey-banner-default.png';
							}
							?>
                            <img src="<?php echo esc_url( $banner_url ); ?>" alt="">
                        </div>
                        <div class="container">
                            <div class="banner-wr">
                                <div class="banner-content">
                                    <h1 class="title blur white load-img">
										<?php echo $mona_post_banner['banner_title']; ?>
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
				<?php
			}
			?>
            <div class="container">
				<?php
				/**
				 * GET TEMPLATE PART
				 * BREADCRUMB
				 */
				$slug = '/partials/breadcrumb';
				echo get_template_part( $slug );
				?>
            </div>
            <section class="sec-new sec-pd">
                <div class="new-dt">
                    <div class="container">
                        <div class="new-dt-wr row">
                            <div class="new-dt-main col-8">
                                <div class="days">
                                    <div class="icon">
                                        <img src="<?php echo get_site_url(); ?>/template/assets/images/clock.svg"
                                             alt="">
                                    </div>
                                    <p class="txt">
										<?php echo date_i18n( 'd \t\h\á\n\g m, Y', strtotime( get_the_date() ) ); ?>
                                    </p>
                                </div>
                                <div class="mona-content">
									<?php the_content(); ?>
                                </div>
                                <div class="new-social">
                                    <p class="text">
										<?php echo __( 'Chia sẻ bài viết', 'monamedia' ); ?>:
                                    </p>
                                    <ul class="new-social-list">
                                        <li class="new-social-item">
                                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( get_the_permalink() ); ?>&t=<?php the_title(); ?>"
                                               onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=500');
                    return false;" class="new-social-link">
                                                <img src="<?php echo get_site_url(); ?>/template/assets/images/fb.png"
                                                     alt="">
                                            </a>
                                        </li>
                                        <li class="new-social-item">
                                            <a href="https://www.linkedin.com/cws/share?url=<?php echo urlencode( get_the_permalink() ); ?>&title=<?php the_title(); ?>"
                                               onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=500');
                return false;" class="new-social-link">
                                                <img src="<?php echo get_site_url(); ?>/template/assets/images/iconlinked.svg"
                                                     alt="">
                                            </a>
                                        </li>
                                        <li class="new-social-item">
                                            <a href="http://www.twitter.com/share?url=<?php echo urlencode( get_the_permalink() ); ?>"
                                               onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=500');
                    return false;" class="new-social-link">
                                                <img src="<?php echo get_site_url(); ?>/template/assets/images/twitter.png"
                                                     alt="">
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="new-dt-side col-4">
                                <div class="new-daily-side-item">
									<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'sidebar_news' ) ) : ?><?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
			<?php
			/**
			 * GET TEMPLATE PART
			 * POLICY GLOBAL
			 */
			$slug = '/partials/global/global';
			$name = 'policy';
			echo get_template_part( $slug, $name );
			?>
        </div>
    </main>
<?php } ?>


<?php
endwhile;
get_footer();
