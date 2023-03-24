<?php
/**
 * The template for displaying search.
 *
 * @package Monamedia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
?>
    <div class="main">
		<?php
		$mona_product_section_banner_ads = get_field( 'mona_product_section_banner_ads', MONA_WC_PRODUCTS );
		?>
        <section class="sec-cate">
            <div class="cate">
                <div class="cate-prod sec-pd">
                    <div class="container">
                        <form id="mona-form-product" class="banner-wr product-submit-form-js">
                            <div class="cate-prod-row">
                                <div class="cate-prod-list">
                                    <div class="head load-img">
                                        <h1>
                                            <div class="head-tt">
												<?php echo __( 'Kết quả tìm kiếm cho từ khóa "', 'monamedia' ) . esc_html( $_GET['s'] ) . '"'; ?>
                                            </div>
                                        </h1>
                                        <div class="cate-prod-filt-btn">
                                            <div class="side-open">
                                                <i class="fas fa-sliders-h"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cate-prod-filt">
                                    <span class="txt">
                                        <?php echo __( 'Sắp xếp theo', 'monamedia' ); ?>:
                                    </span>
                                        <div class="cate-prod-filtbar scrollDeskJS">
                                            <ul class="cate-prod-filtbar-list mona-filter">
                                                <input type="hidden" name="sort" value="">
                                                <li class="cate-prod-filtbar-item">
                                                    <a href="javascript:void(0)" class="cate-prod-filtbar-link"
                                                       data-name="sort"
                                                       data-value="name-asc"><?php echo __( 'Tên A - Z', 'monamedia' ); ?></a>
                                                </li>
                                                <li class="cate-prod-filtbar-item">
                                                    <a href="javascript:void(0)" class="cate-prod-filtbar-link"
                                                       data-name="sort"
                                                       data-value="name-desc"><?php echo __( 'Tên Z - A', 'monamedia' ); ?></a>
                                                </li>
                                                <li class="cate-prod-filtbar-item">
                                                    <a href="javascript:void(0)" class="cate-prod-filtbar-link"
                                                       data-name="sort"
                                                       data-value="price-asc"><?php echo __( 'Giá tăng dần', 'monamedia' ); ?></a>
                                                </li>
                                                <li class="cate-prod-filtbar-item">
                                                    <a href="javascript:void(0)" class="cate-prod-filtbar-link"
                                                       data-name="sort"
                                                       data-value="price-desc"><?php echo __( 'Giá giảm dần', 'monamedia' ); ?></a>
                                                </li>
                                                <li class="cate-prod-filtbar-item">
                                                    <a href="javascript:void(0)" class="cate-prod-filtbar-link"
                                                       data-name="sort"
                                                       data-value="new"><?php echo __( 'Hàng mới', 'monamedia' ); ?></a>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>
									<?php
									$current_page = get_query_var( 'paged' );
									$current_page = max( 1, $current_page );
									$offset_start = 0;
									$order        = 'DESC';
									$per_page     = 12;
									$offset       = ( $current_page - 1 ) * $per_page + $offset_start;
									$argsProduct  = array(
										'post_type'      => 'product',
										'paged'          => $current_page,
										'offset'         => $offset,
										'post_status'    => 'publish',
										'posts_per_page' => $per_page,
										'order'          => $order,
									);
									if ( isset( $_GET['s'] ) ) {
										$argsProduct['s'] = esc_html( @$_GET['s'] );
									}

									$loop = new WP_Query( $argsProduct );
									?>

									<?php if ( $loop->have_posts() ): ?>
                                        <div class="is-loading-group" id="monaProductsList">
                                            <div class="home-prodbox-list">
												<?php
												while ( $loop->have_posts() ) {
													$loop->the_post();
													?>
                                                    <div class="home-prodbox-item">
                                                        <div class="col">
															<?php
															/**
															 * GET TEMPLATE PART
															 * BOX PRODUCT
															 */
															$slug = '/partials/loop/box';
															$name = 'product';
															echo get_template_part( $slug, $name );
															?>
                                                        </div>
                                                    </div>
													<?php
												}
												wp_reset_query();
												?>
                                            </div>
                                            <div class="pagimain pagination-products-ajax">
												<?php mona_pagination_links_products( $loop, $current_page ); ?>
                                            </div>
                                        </div>
									<?php else : ?>
                                        <div class="mona-mess-empty">
                                            <p><?php echo __( 'Không tìm thấy sản phẩm nào phù hợp', 'monamedia' ) ?></p>
                                        </div>
									<?php endif ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </div>

<?php get_footer();
