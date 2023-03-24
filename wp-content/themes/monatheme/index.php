<?php
/**
 * The template for displaying index.
 *
 * @package Monamedia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
$current = get_queried_object();
?>
    <main class="main">
        <div class="new">
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
            <section class="sec-nb sec-pd">
                <div class="new-nb">
                    <div class="container">
                        <div class="new-nb-wr">
							<?php
							$mona_blog_featured_title = get_field( 'mona_blog_featured_title', MONA_PAGE_BLOG );
							?>
							<?php
							if ( ! empty( $mona_blog_featured_title ) ) {
								?>
                                <h2 class="title mb4 blur load-img">
									<?php echo $mona_blog_featured_title; ?>
                                </h2>
								<?php
							}
							?>
							<?php
							$current_page = get_query_var( 'paged' );
							$current_page = max( 1, $current_page );
							$offset_start = 0;
							$order        = 'DESC';
							$per_page     = 5;
							$offset       = ( $current_page - 1 ) * $per_page + $offset_start;
							$argsNews     = array(
								'post_type'      => 'post',
								'paged'          => $current_page,
								'offset'         => $offset,
								'post_status'    => 'publish',
								'posts_per_page' => $per_page,
								'meta_key'       => '_mona_post_view',
								'orderby'        => 'meta_value_num',
								'order'          => 'DESC'
							);
							// if ( isset(condition) ) {
							//     argsProduct['tax_query'][] = [
							//         'taxonomy' => 'category_country',
							//             'field' => 'slug',
							//             'terms' => term->country,
							//     ];
							// }

							$loop = new WP_Query( $argsNews );
							?>
                            <div class="new-nb-box row">
                                <div class="new-nb-big col-6">
									<?php if ( $loop->have_posts() ):
										$loop->the_post();
										global $post;
										?>
                                        <div class="inner">
                                            <div class="img">
                                                <a href="<?php echo get_permalink( $post->ID ) ?>"
                                                   class="img-inner img-animated load-img">
													<?php if ( has_post_thumbnail() ) { ?>
														<?php the_post_thumbnail( 'medium-square' ); ?>
													<?php } else { ?>
                                                        <img src="<?php echo get_template_directory_uri() ?>/public/helpers/images/default-thumbnail.jpg"
                                                             alt="">
													<?php } ?>
                                                </a>
                                            </div>
                                            <div class="info">
                                                <div class="info-inner">
                                                    <div class="topitem">
                                                        <p class="by">
															<?php echo __( 'Đăng bởi', 'monamedia' ); ?>
                                                            <strong><?php the_author(); ?></strong>
                                                        </p>
                                                        <p class="date">
															<?php echo get_the_date( 'd/m/Y', $post->ID ) ?>
                                                        </p>
                                                    </div>
                                                    <h3>
                                                        <a href="<?php echo get_permalink( $post->ID ) ?>" class="tt">
															<?php the_title(); ?>
                                                        </a>
                                                    </h3>
                                                    <p class="desc">
														<?php echo get_the_excerpt(); ?>
                                                    </p>
                                                    <a href="<?php echo get_permalink( $post->ID ) ?>" class="btn-pri">
                                                        <span class="txt">
                                                          <?php echo __( 'Đọc tiếp', 'monamedia' ); ?>
                                                        </span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

									<?php endif ?>
                                </div>
                                <div class="new-nb-multi col-6">
                                    <div class="new-nb-list row">
										<?php
										while ( $loop->have_posts() ) {
											$loop->the_post();
											?>
                                            <div class="new-nb-item col">
												<?php
												/**
												 * GET TEMPLATE PART
												 * BOX NEWS
												 */
												$slug = '/partials/loop/box';
												$name = 'featured-news';
												echo get_template_part( $slug, $name );
												?>
                                            </div>
											<?php
										}
										wp_reset_query();
										?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="mona-daily-news" class="sec-daily sec-pdb">
                <div class="new-daily">
                    <div class="container">
                        <div class="new-daily-wr row">
                            <div class="new-daily-main col-8">
								<?php
								$current_page = get_query_var( 'paged' );
								$current_page = max( 1, $current_page );
								$offset_start = 0;
								$order        = 'DESC';
								$per_page     = 7;
								$offset       = ( $current_page - 1 ) * $per_page + $offset_start;
								$argsNews     = array(
									'post_type'      => 'post',
									'paged'          => $current_page,
									'offset'         => $offset,
									'post_status'    => 'publish',
									'posts_per_page' => $per_page,
									'order'          => $order,
								);

								$loop = new WP_Query( $argsNews );
								?>
								<?php
								$mona_blog_title = get_field( 'mona_blog_title' );
								?>
                                <h1 class="title blur mb4 load-img"><?php
									if ( ! empty( $mona_blog_title ) ) {
										echo $mona_blog_title;
									} else {
										echo $current->post_title;
									}
									?></h1>
                                <div class="new-daily-list row">
									<?php
									while ( $loop->have_posts() ) {
										$loop->the_post();
										?>
                                        <div class="new-daily-item col">
											<?php
											/**
											 * GET TEMPLATE PART
											 * BOX NEWS
											 */
											$slug = '/partials/loop/box';
											$name = 'news';
											echo get_template_part( $slug, $name );
											?>
                                        </div>
										<?php
									}
									wp_reset_query();
									?>

                                </div>
                                <div class="pagimain">
									<?php mona_pagination_link_news( $loop ); ?>
                                </div>
                            </div>
                            <div class="new-daily-side col-4">
                                <div class="new-daily-side-item">
									<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'sidebar_news' ) ) : ?><?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="sec-policy">
                <div class="policy sec-pd8">
                    <div class="container">
                        <div class="policy-wr">
                            <h2 class="title center mb4 blur load-img">CHÍNH SÁCH BẢO HÀNH</h2>
                            <div class="swiper">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="policy-item">
                                            <div class="icon">
                                                <img src="<?php echo get_site_url(); ?>/template/assets/images/iconpd.svg"
                                                     alt="">
                                            </div>
                                            <div class="desc">
                                                <p class="desc-txt">
                                                    Sản phẩm
                                                    nhập khẩu 100%
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="policy-item">
                                            <div class="icon">
                                                <img src="<?php echo get_site_url(); ?>/template/assets/images/iconclick.svg"
                                                     alt="">
                                            </div>
                                            <div class="desc">
                                                <p class="desc-txt">
                                                    Mua hàng online
                                                    dễ dàng thanh toán
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="policy-item">
                                            <div class="icon">
                                                <img src="<?php echo get_site_url(); ?>/template/assets/images/icondollar.svg"
                                                     alt="">
                                            </div>
                                            <div class="desc">
                                                <p class="desc-txt">
                                                    1 đổi 1 với
                                                    chính sách đổi trả
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="policy-item">
                                            <div class="icon">
                                                <img src="<?php echo get_site_url(); ?>/template/assets/images/iconship.svg"
                                                     alt="">
                                            </div>
                                            <div class="desc">
                                                <p class="desc-txt">
                                                    Giao hàng toàn quốc
                                                    miễn phí lắp đặt
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

<?php
get_footer();