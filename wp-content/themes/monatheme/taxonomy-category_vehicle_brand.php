<?php
/**
 * The template for displaying taxonomy.
 *
 * @package Monamedia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
$current_taxonomy = get_queried_object(); ?>
    <!-- MAIN -->
    <main class="main">
		<?php
		$mona_product_section_banner_ads = get_field( 'mona_product_section_banner_ads', $current_taxonomy );
		?>

		<?php
		if ( content_exists( $mona_product_section_banner_ads ) ) {
			?>
            <div class="chitiet-sanpham">
                <section class="sec-bn">
                    <div class="banner banner-style-02">
                        <div class="banner-img load-img">
							<?php
							if ( ! empty( $mona_product_section_banner_ads['ads_background'] ) ) {
								?>
								<?php echo wp_get_attachment_image( $mona_product_section_banner_ads['ads_background'], 'banner-desktop-image', '', [ 'class' => '' ] ); ?>
								<?php
							}
							?>
                        </div>
                        <div class="container">
                            <div class="banner-wr">
                                <div class="banner-content">
                                    <div class="title sub-title-top white" data-aos="fade-right"
                                         data-aos-delay="200"><?php echo $mona_product_section_banner_ads['ads_title_1']; ?> </div>
                                    <p class="title title-scale white load-img" data-aos="fade-right"
                                       data-aos-delay="500">
										<?php echo $mona_product_section_banner_ads['ads_title_2']; ?>
                                    </p>
                                    <div class="title sub-title-bottom white" data-aos="fade-right"
                                         data-aos-delay="800">
										<?php echo $mona_product_section_banner_ads['ads_title_3']; ?>
                                    </div>
                                    <div class="btn-viewall" data-aos="fade-right" data-aos-delay="1000">
										<?php
										if ( ! empty( $mona_product_section_banner_ads['ads_link'] ) ) {
											?>
                                            <a href="<?php echo $mona_product_section_banner_ads['ads_link']['url']; ?>"
                                               class="btn-third">
										<span
                                                class="txt"><?php echo $mona_product_section_banner_ads['ads_link']['title']; ?></span>
                                                <div class="icon">
                                                    <img
                                                            src="<?php echo get_site_url(); ?>/template/assets/images/chevrons-right.svg"
                                                            alt="">
                                                </div>
                                            </a>
											<?php
										}
										?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="block-skew-top">
                            <div class="wrapper-skew">
                                <div class="skew-item"></div>
                                <div class="skew-item"></div>
                                <div class="skew-item"></div>
                                <div class="skew-item"></div>
                                <div class="skew-item"></div>
                                <div class="skew-item"></div>
                                <div class="skew-item"></div>
                                <div class="skew-item"></div>
                                <div class="skew-item"></div>
                            </div>

                        </div>
                        <div class="block-skew-bottom">
                            <div class="wrapper-skew">
                                <div class="skew-item"></div>
                                <div class="skew-item"></div>
                                <div class="skew-item"></div>
                                <div class="skew-item"></div>
                                <div class="skew-item"></div>
                                <div class="skew-item"></div>
                            </div>
                            <div class="block-skew-bottom-border"></div>
                        </div>
                        <div class="backround-modify">
                            <div class="image">
                                <img src="<?php echo get_site_url(); ?>/template/assets/images/p-backround-modify.png"
                                     alt="">
                            </div>
                        </div>
                        <div class="background-acquy" data-aos="zoom-in">
                            <div class="image">
								<?php echo wp_get_attachment_image( $mona_product_section_banner_ads['ads_product'], 'medium-square', '', [ 'class' => '' ] ); ?>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
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
			$name = 'breadcrumb';
			echo get_template_part( $slug, $name );
			?>
        </div>
        <section class="sec-cate">
            <div class="cate">
                <div class="cate-prod sec-pd">
                    <div class="container">
                        <form id="mona-form-product" class="banner-wr product-submit-form-js">
							<?php
							// Kiểm tra nếu là post type
							if ( is_singular( 'product' ) ) {
								$name  = 'post-type';
								$value = 'product';
							} // Kiểm tra nếu là taxonomy
                            elseif ( is_tax() ) {
								$taxonomy = get_queried_object();
								$name     = $taxonomy->taxonomy;
								$value    = $taxonomy->name;
							} // Không phải post type hay taxonomy
							else {
								$name  = '';
								$value = '';
							}
							?>

                            <!-- Tạo input hidden -->
                            <input type="hidden" name="<?php echo $name; ?>" value="<?php echo $value; ?>">
                            <div class="cate-prod-row">
                                <div class="cate-prod-side">
                                    <div class="side-fixed">
                                        <div class="side-fixed-wrap">
                                            <div class="cate-prod-side-inner">
                                                <div class="head">
                                                <span class="icon">
                                                    <img src="<?php echo get_site_url(); ?>/template/assets/images/filter.svg"
                                                         alt="">
                                                </span>
                                                    <p class="tt"><?php echo __( 'Bộ lọc', 'monamedia' ); ?></p>
                                                </div>
                                                <div class="content">
                                                    <div class="cate-block">
                                                        <p class="cate-block-tt"><?php echo __( 'DANH MỤC SẢN PHẨM', 'monamedia' ); ?></p>
														<?php
														$args       = array(
															'taxonomy'   => 'product_cat',
															'parent'     => 0,
															'hide_empty' => false
														);
														$categories = get_categories( $args );
														if ( $categories ) {
															?>
                                                            <div class="cate-block-collapse collapse-blockf">
																<?php foreach ( $categories as $category ) { ?>
                                                                    <div class="cate-block-item collapse-itemf">
                                                                        <div class="collapse-headf">
                                                                            <a href="<?php echo get_category_link( $category->term_id ); ?>"
                                                                               class="collapse-headf-link"><?php echo $category->name; ?></a>
																			<?php
																			$sub_args       = array(
																				'taxonomy'   => 'product_cat',
																				'parent'     => $category->term_id,
																				'hide_empty' => false
																			);
																			$sub_categories = get_categories( $sub_args );

																			?>
																			<?php if ( content_exists( $sub_categories ) ): ?>
                                                                                <div class="icon">
                                                                                    <span class="line"></span>
                                                                                    <span class="line"></span>
                                                                                </div>
																			<?php endif ?>
                                                                        </div>
                                                                        <div class="collapse-bodyf">
                                                                            <ul class="cate-block-list">
																				<?php
																				foreach ( $sub_categories as $sub_category ) { ?>
                                                                                    <li class="cate-block-list-it">
                                                                                        <a href="<?php echo get_category_link( $sub_category->term_id ); ?>"
                                                                                           class="cate-block-link"><?php echo $sub_category->name; ?></a>
                                                                                    </li>
																				<?php } ?>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
																<?php } ?>
                                                            </div>
														<?php } ?>
                                                    </div>
                                                    <div class="cate-block">
                                                        <p class="cate-block-tt"><?php echo __( 'CHỌN HÃNG XE', 'monamedia' ); ?></p>
														<?php
														$args             = array(
															'taxonomy'   => 'category_vehicle_brand',
															'parent'     => 0,
															'hide_empty' => false
														);
														$categories_brand = get_categories( $args );
														?>
														<?php if ( $categories ): ?>
                                                            <div class="cate-block-collapse collapse-blockf">
																<?php
																foreach ( $categories_brand as $key_brand => $item_brand ) {
																	?>
                                                                    <div class="cate-block-item collapse-itemf">
                                                                        <div class="collapse-headf  <?php echo $current_taxonomy->term_id == $item_brand->term_id || $current_taxonomy->parent == $item_brand->term_id ? 'active' : '' ?>">
                                                                            <a href="<?php echo get_category_link( $item_brand->term_id ); ?>"
                                                                               class="collapse-headf-link"><?php echo $item_brand->name; ?></a>
                                                                            <div class="icon">
                                                                                <span class="line"></span>
                                                                                <span class="line"></span>
                                                                            </div>
                                                                        </div>
																		<?php
																		$sub_args   = array(
																			'taxonomy'   => 'category_vehicle_brand',
																			'parent'     => $item_brand->term_id,
																			'hide_empty' => false
																		);
																		$sub_brands = get_categories( $sub_args );
																		?>
																		<?php if ( content_exists( ( $sub_brands ) ) ): ?>
                                                                            <div class="collapse-bodyf">
                                                                                <ul class="cate-block-list">
																					<?php
																					foreach ( $sub_brands as $key_sub_brand => $item_sub_brand ) {
																						?>
                                                                                        <li class="cate-block-list-it  <?php echo $current_taxonomy->term_id == $item_sub_brand->term_id ? 'active' : '' ?>">
                                                                                            <a href="<?php echo get_category_link( $item_sub_brand->term_id ); ?>"
                                                                                               class="cate-block-link"><?php echo $item_sub_brand->name; ?></a>
                                                                                        </li>
																						<?php
																					}
																					?>
                                                                                </ul>
                                                                            </div>
																		<?php endif ?>
                                                                    </div>
																	<?php
																}
																?>
                                                            </div>
														<?php endif ?>
                                                    </div>

													<?php
													$terms = get_terms( array(
														'taxonomy'   => 'pa_dung-luong',
														'hide_empty' => false,
													) );
													?>
                                                    <div class="cate-block">
                                                        <p class="cate-block-tt"><?php echo __( 'DUNG LƯỢNG', 'monamedia' ); ?></p>
                                                        <div class="cate-block-check recheck-block load-container"
                                                             data-load-init="6" data-load-sl="99">
															<?php foreach ( $terms as $term ) { ?>
                                                                <div class="load-item">
                                                                    <div class="cate-block-check-item recheck-item">
                                                                        <input type="checkbox"
                                                                               class="recheck-input mona-check-input"
                                                                               name="pa_dung_luong[]"
                                                                               value="<?php echo esc_attr( $term->slug ); ?>">
                                                                        <span class="icon">
                                                                        <img src="<?php echo get_site_url(); ?>/template/assets/images/check.svg"
                                                                             alt="">
                                                                            <img src="<?php echo get_template_directory_uri(); ?>/public/helpers/images/unchecked.svg"
                                                                                 alt="">
                                                                    </span>
                                                                        <p class="txt"><?php echo $term->name; ?></p>
                                                                    </div>
                                                                </div>
															<?php } ?>
                                                            <div class="load-btn">
                                                                <span class="text"><?php echo __( 'Xem thêm', 'monamedia' ); ?></span>
                                                                <i class="far fa-chevron-down"></i>
                                                            </div>
                                                        </div>
                                                    </div>

													<?php
													$terms = get_terms( array(
														'taxonomy'   => 'pa_dien-ap',
														'hide_empty' => false,
													) );
													?>
                                                    <div class="cate-block">
                                                        <p class="cate-block-tt"><?php echo __( 'ĐIỆN ÁP', 'monamedia' ); ?></p>
                                                        <div class="cate-block-check recheck-block load-container"
                                                             data-load-init="6" data-load-sl="99">
															<?php foreach ( $terms as $term ) { ?>
                                                                <div class="load-item">
                                                                    <div class="cate-block-check-item recheck-item">
                                                                        <input type="checkbox"
                                                                               class="recheck-input mona-check-input"
                                                                               name="pa_dien_ap[]"
                                                                               value="<?php echo esc_attr( $term->slug ); ?>">
                                                                        <span class="icon">
                                                                        <img src="<?php echo get_site_url(); ?>/template/assets/images/check.svg"
                                                                             alt="">
                                                                            <img src="<?php echo get_template_directory_uri(); ?>/public/helpers/images/unchecked.svg"
                                                                                 alt="">
                                                                    </span>
                                                                        <p class="txt"><?php echo $term->name; ?></p>
                                                                    </div>
                                                                </div>
															<?php } ?>
                                                            <div class="load-btn">
                                                                <span class="text"><?php echo __( 'Xem thêm', 'monamedia' ); ?></span>
                                                                <i class="far fa-chevron-down"></i>
                                                            </div>
                                                        </div>
                                                    </div>
													<?php
													$terms = get_terms( array(
														'taxonomy'   => 'pa_coc-binh',
														'hide_empty' => false,
													) );
													?>
                                                    <div class="cate-block">
                                                        <p class="cate-block-tt"><?php echo __( 'CỌC BÌNH', 'monamedia' ); ?></p>
                                                        <div class="cate-block-check recheck-block load-container"
                                                             data-load-init="6" data-load-sl="99">
															<?php foreach ( $terms as $term ) { ?>
                                                                <div class="load-item">
                                                                    <div class="cate-block-check-item recheck-item">
                                                                        <input type="checkbox"
                                                                               class="recheck-input mona-check-input"
                                                                               name="pa_coc_binh[]"
                                                                               value="<?php echo esc_attr( $term->slug ); ?>">
                                                                        <span class="icon">
                                                                        <img src="<?php echo get_site_url(); ?>/template/assets/images/check.svg"
                                                                             alt="">
                                                                            <img src="<?php echo get_template_directory_uri(); ?>/public/helpers/images/unchecked.svg"
                                                                                 alt="">
                                                                    </span>
                                                                        <p class="txt"><?php echo $term->name; ?></p>
                                                                    </div>
                                                                </div>
															<?php } ?>
                                                            <div class="load-btn">
                                                                <span class="text"><?php echo __( 'Xem thêm', 'monamedia' ); ?></span>
                                                                <i class="far fa-chevron-down"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="side-close">
                                            <i class="fas fa-times icon"></i>
                                        </div>
                                    </div>
                                    <div class="side-overlay"></div>
                                </div>
                                <div class="cate-prod-list">
                                    <div class="head load-img">
                                        <h1>
                                            <div class="head-tt">
												<?php
												if ( get_taxonomy_level( $current_taxonomy->term_id, 'category_vehicle_brand' ) === 3 ) {
													if ( $current_taxonomy->parent ) {
														$parent_term = get_term( $current_taxonomy->parent, 'category_vehicle_brand' ); // Get the parent term object
														echo $parent_term->name . ' - ' . $current_taxonomy->name;
													}
												} else {
													echo $current_taxonomy->name;
												} ?>

                                            </div>
                                        </h1>
                                        <div class="cate-prod-filt-btn">
                                            <div class="side-open">
                                                <i class="fas fa-sliders-h"></i>
                                            </div>
                                        </div>
                                    </div>
									<?php
									if ( get_taxonomy_level( $current_taxonomy->term_id, 'category_vehicle_brand' ) <= 1 ) {
										?>
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
										<?php
									} else { ?>

										<?php
										$current_taxonomy_id    = $current_taxonomy->term_id; // ID của taxonomy hiện tại
										$current_taxonomy_level = get_taxonomy_level( $current_taxonomy_id, 'category_vehicle_brand' ); // Lấy cấp của taxonomy hiện tại

										$child_terms = array(); // Danh sách các taxonomy con

										if ( $current_taxonomy_level == 2 ) {
											// Nếu taxonomy hiện tại là cấp 2, lấy toàn bộ các taxonomy con của nó
											$child_terms = get_terms( array(
												'taxonomy' => $current_taxonomy->taxonomy,
												'parent'   => $current_taxonomy_id
											) );
										} elseif ( $current_taxonomy_level == 3 ) {
											// Nếu taxonomy hiện tại là cấp 3, lấy toàn bộ các taxonomy con của cha nó
											$parent_term = get_term( $current_taxonomy->parent, $current_taxonomy->taxonomy );
											$child_terms = get_terms( array(
												'taxonomy'   => $current_taxonomy->taxonomy,
												'parent'     => $parent_term->term_id,
												'hide_empty' => false,
											) );
										}


										?>

										<?php
										if ( ! empty( $child_terms ) ) {
											?>
                                            <div class="cate-prod-filt">
                                                <span class="txt">
                                                    <?php echo __( 'Dòng đời', 'monamedia' ); ?>:
                                                </span>
                                                <div class="cate-prod-filtbar scrollDeskJS">
                                                    <ul class="cate-prod-filtbar-list">
														<?php
														foreach ( $child_terms as $term ) {
															$term_link    = get_term_link( $term );
															$active_class = $current_taxonomy->term_id == $term->term_id ? 'active' : '';
															?>
                                                            <li class="cate-prod-filtbar-item ">
                                                                <a href="<?php echo esc_url( $term_link ); ?>"
                                                                   class="cate-prod-filtbar-link <?php echo esc_attr( $active_class ); ?>">
																	<?php echo esc_html( $term->name ); ?>
                                                                </a>
                                                            </li>
															<?php
														}
														?>
                                                    </ul>
                                                </div>
                                            </div>
											<?php
										}
										?>


										<?php
									} ?>

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
										'tax_query'      => [
											'relation' => 'AND',
											[
												'taxonomy' => 'category_vehicle_brand',
												'field'    => 'slug',
												'terms'    => $current_taxonomy->slug,
											]
										]
									);

									if ( isset( $_GET['danhmuc'] ) ) {
										$argsProduct['tax_query'][] = array(
											'relation' => 'AND',
											array(
												'taxonomy' => 'product_cat',
												'field'    => 'slug',
												'terms'    => @$_GET['danhmuc'],
											),
										);
									}
									$loop = new WP_Query( $argsProduct );
									?>
									<?php if ( $loop->have_posts() ): ?>
                                        <div class="is-loading-group" id="monaProductsList">
                                            <div class="home-prodbox-list">
												<?php
												$mona_product_key = get_field( 'mona_product_key', $current_taxonomy );
												$product_ID       = $mona_product_key[0];
												$product_key      = wc_get_product( $product_ID );
												?>
												<?php
												if ( ! empty( $product_key ) && $current_page == 1 ) {
													?>
                                                    <div class="home-prodbox-item big">
                                                        <div class="info">
                                                            <div class="info-tag">
																<?php
																$regular_price = $product_key->get_regular_price();
																$sale_price    = $product_key->get_sale_price();
																if ( $product_key->is_on_sale() ) {
																	$discount_percentage = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
																}
																?>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="tag">
																			<?php
																			$product_tags = get_field( 'mona_product_tag', $product_ID );
																			if ( content_exists( $product_tags ) ) :
																				foreach ( $product_tags as $tag ) { ?>
                                                                                    <span class="tag-item"
                                                                                          style="color: <?php echo ! empty( $tag['tag_color'] ) ? $tag['tag_color'] : 'grey'; ?>;background-color: <?php echo ! empty( $tag['tag_background'] ) ? $tag['tag_background'] : 'grey' ?>">
                                                                                    <?php echo $tag['tag_name'] ?>
                                                                                </span>
																					<?php
																				}
																			endif;
																			?>
																			<?php if ( ! $product_key->is_in_stock() ) : ?>
                                                                                <span class="tag-item gray"><?php echo __( 'Hết hàng', 'monamedia' ); ?></span>
																			<?php endif; ?>
                                                                        </div>
                                                                    </div>
																	<?php if ( ! empty( $discount_percentage ) ): ?>
                                                                        <div class="col">
                                                            <span
                                                                    class="info-tag-item dis">-<?php echo $discount_percentage; ?>%</span>
                                                                        </div>
																	<?php endif ?>
                                                                </div>
                                                            </div>
                                                            <h3>
                                                                <a class="info-tt"
                                                                   href="<?php echo get_permalink( $product_ID ) ?>"><?php echo get_the_title( $product_ID ) ?></a>
                                                            </h3>
                                                            <span class="info-prices">
                                                    <?php if ( $product_key->is_on_sale() ) :
	                                                    echo wc_price( $product_key->get_sale_price() );
                                                    else:
	                                                    echo wc_price( $product_key->get_regular_price() );
	                                                    echo '<style>.info-old-prices {display: none;}</style>';
                                                    endif; ?>
                                                </span>
															<?php if ( $product_key->is_on_sale() ) : ?>
                                                                <span class="info-old-prices">	<?php echo wc_price( $product_key->get_regular_price() ); ?></span>
															<?php endif; ?>
                                                            <form class="frmAddProductCart">
                                                                <input type="hidden" name="product_id"
                                                                       value="<?php echo $product_ID ?>">
                                                                <a href="<?php echo get_permalink( $product_ID ) ?>"
                                                                   class="btn-third mona-add-to-cart-list is-loading-btn">
                                                                    <span class="txt"><?php echo __( 'Mua ngay', 'monamedia' ); ?></span>
                                                                </a>
                                                            </form>
                                                        </div>
                                                        <div class="home-prodbox-item-img">
                                                            <div class="inner">
                                                                <a href="<?php echo get_permalink( $product_ID ) ?>">
																	<?php if ( has_post_thumbnail( $product_ID ) ) {
																		echo get_the_post_thumbnail( $product_ID, 'medium-square' );
																	} else { ?>
                                                                        <img src="<?php echo get_template_directory_uri() ?>/public/helpers/images/default-thumbnail.jpg"
                                                                             alt="">
																	<?php } ?>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
													<?php
												}
												?>
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
                                            <div class="pagimain">
												<?php mona_pagination_links( $loop ); ?>
                                            </div>
                                        </div>
									<?php else: ?>
                                        <div class="mona-mess-empty">
                                            <p><?php echo __( 'Nội dung đang được cập nhật', 'monamedia' ) ?></p>
                                        </div>
									<?php endif ?>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
		<?php
		$mona_product_section_banner_ads2 = get_field( 'mona_product_section_banner_ads2', $current_taxonomy );
		?>

		<?php
		if ( content_exists( $mona_product_section_banner_ads2 ) ) {
			?>
            <div class="chitiet-sanpham">
                <section class="sec-bn">
                    <div class="banner banner-style-02">
                        <div class="banner-img load-img">
							<?php
							if ( ! empty( $mona_product_section_banner_ads2['ads2_background'] ) ) {
								?>
								<?php echo wp_get_attachment_image( $mona_product_section_banner_ads2['ads2_background'], 'banner-desktop-image', '', [ 'class' => '' ] ); ?>
								<?php
							}
							?>
                        </div>
                        <div class="container">
                            <div class="banner-wr">
                                <div class="banner-content">
                                    <div class="title sub-title-top white" data-aos="fade-right"
                                         data-aos-delay="200"><?php echo $mona_product_section_banner_ads2['ads2_title_1']; ?> </div>
                                    <p class="title title-scale white load-img" data-aos="fade-right"
                                       data-aos-delay="500">
										<?php echo $mona_product_section_banner_ads2['ads2_title_2']; ?>
                                    </p>
                                    <div class="title sub-title-bottom white" data-aos="fade-right"
                                         data-aos-delay="800">
										<?php echo $mona_product_section_banner_ads2['ads2_title_3']; ?>
                                    </div>
                                    <div class="btn-viewall" data-aos="fade-right" data-aos-delay="1000">
										<?php
										if ( ! empty( $mona_product_section_banner_ads2['ads2_link'] ) ) {
											?>
                                            <a href="<?php echo $mona_product_section_banner_ads2['ads2_link']['url']; ?>"
                                               class="btn-third">
										<span
                                                class="txt"><?php echo $mona_product_section_banner_ads2['ads2_link']['title']; ?></span>
                                                <div class="icon">
                                                    <img
                                                            src="<?php echo get_site_url(); ?>/template/assets/images/chevrons-right.svg"
                                                            alt="">
                                                </div>
                                            </a>
											<?php
										}
										?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="block-skew-top">
                            <div class="wrapper-skew">
                                <div class="skew-item"></div>
                                <div class="skew-item"></div>
                                <div class="skew-item"></div>
                                <div class="skew-item"></div>
                                <div class="skew-item"></div>
                                <div class="skew-item"></div>
                                <div class="skew-item"></div>
                                <div class="skew-item"></div>
                                <div class="skew-item"></div>
                            </div>

                        </div>
                        <div class="block-skew-bottom">
                            <div class="wrapper-skew">
                                <div class="skew-item"></div>
                                <div class="skew-item"></div>
                                <div class="skew-item"></div>
                                <div class="skew-item"></div>
                                <div class="skew-item"></div>
                                <div class="skew-item"></div>
                            </div>
                            <div class="block-skew-bottom-border"></div>
                        </div>
                        <div class="backround-modify">
                            <div class="image">
                                <img src="<?php echo get_site_url(); ?>/template/assets/images/p-backround-modify.png"
                                     alt="">
                            </div>
                        </div>
                        <div class="background-acquy" data-aos="zoom-in">
                            <div class="image">
								<?php echo wp_get_attachment_image( $mona_product_section_banner_ads['ads_product'], 'medium-square', '', [ 'class' => '' ] ); ?>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
			<?php
		}
		?>

		<?php
		$mona_product_section_content = get_field( 'mona_product_section_content', $current_taxonomy );
		?>
		<?php
		if ( ! empty( $mona_product_section_content ) ) {
			?>
            <section class="sec-details">
                <div class="details sec-pd8">
                    <div class="decor" data-aos="fade-right">
                        <img src="<?php echo get_site_url(); ?>/template/assets/images/decorDetails.svg" alt="">
                    </div>
                    <div class="container">
                        <div class="details-wr row">
                            <div class="details-content col-7">
                                <div class="mona-content" data-aos="fade-left">
									<?php echo $mona_product_section_content; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
			<?php
		}
		?>
    </main>

<?php
get_footer();
