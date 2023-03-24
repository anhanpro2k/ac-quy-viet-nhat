<?php
/**
 * Section name: NEW PRODUCT SECTION
 * Description:
 * Author: Monamedia
 * Order: 2
 */
?>

<?php
$mona_home_section_new = get_field( 'mona_home_section_new' );
?>
<div class="home-prod ss-pd">
    <div class="container">
        <div class="home-prod-title load-img">
                            <span class="decor-left">
                                <img src="<?php echo get_site_url(); ?>/template/assets/images/triplestarL.svg" alt="">
                            </span>
            <h2 class="title blur load-img">SẢN PHẨM MỚI NHẤT</h2>
            <span class="decor-right">
                                <img src="<?php echo get_site_url(); ?>/template/assets/images/triplestarR.svg" alt="">
                            </span>
        </div>
    </div>
    <div class="home-prod-box" data-aos="fade-up">
        <div class="home-prod-bg">
            <img src="<?php echo get_site_url(); ?>/template/assets/images/home-prod-box.svg" alt="">
        </div>
        <div class="home-prod-inner">
            <div class="container">
				<?php
				$new_date = $mona_home_section_new['new_date'];
				?>
                <div class="inner-head">
					<?php
					if ( ! empty( $new_date ) ) {
						?>
                        <div class="home-prod-time" data-time="<?php echo esc_attr( $new_date ); ?> 23:59">
                            <div class="home-prod-time-item"><span
                                        id="days"></span> <?php echo __( 'Ngày', 'monamedia' ); ?> :
                            </div>
                            <div class="home-prod-time-item"><span
                                        id="hours"></span> <?php echo __( 'Giờ', 'monamedia' ); ?> :
                            </div>
                            <div class="home-prod-time-item"><span
                                        id="mins"></span> <?php echo __( 'Phút', 'monamedia' ); ?> :
                            </div>
                            <div class="home-prod-time-item"><span
                                        id="seconds"></span> <?php echo __( 'Giây', 'monamedia' ); ?></div>
                        </div>

						<?php
						if ( ! empty( $mona_home_section_new['new_date_label'] ) ) {
							?>
                            <div class="home-prod-time-tt">
								<?php echo $mona_home_section_new['new_date_label']; ?>
                            </div>
							<?php
						}
						?>
						<?php
					}
					?>
                    <div class="home-prod-box-btn">
						<?php
						$new_link = $mona_home_section_new ['new_link'];
						if ( isset( $new_link['url'] ) && ! empty( $new_link['url'] ) && isset( $new_link['title'] ) && ! empty( $new_link['title'] ) ) {
							$link_url   = esc_url( $new_link['url'] );
							$link_title = esc_html( $new_link['title'] );
							?>
                            <a href="<?php echo $link_url; ?>" class="btn-seeall">
                                <span class="txt"><?php echo $link_title; ?></span>
                                <i class="fas fa-chevron-double-right"></i>
                            </a>
						<?php } ?>
                    </div>
                </div>
				<?php
				$new_product = $mona_home_section_new['new_product'];
				$argsProduct = array(
					'post_type'   => 'product',
					'post_status' => 'publish',
					'meta_query'  => [
						'relation' => 'AND',
						array(
							'key'     => '_virtual',
							'value'   => 'yes',
							'compare' => '!=',
						)
					],
					'tax_query'   => [
						'relation' => 'AND',
					]
				);


				switch ( $new_product['option'] ) {
					case "product_cat":
						$products_by_product_cat = $new_product['products_by_product_cat'];
						if ( ! empty( $products_by_product_cat ) ) {
							$argsProduct['tax_query'][] = [
								'taxonomy' => $products_by_product_cat->taxonomy,
								'field'    => 'slug',
								'terms'    => (array) $products_by_product_cat->slug,
								'operator' => "IN"
							];
						}
						break;
					case "custom":
						$custom_products = $new_product['custom'];
						if ( ! empty( $outstanding_products_custom ) ) {
							$argsProduct['post__in'] = (array) $custom_products;
							$argsProduct['orderby']  = 'post__in';
						}
						?>
						<?php
						break;
					default:
						break;
				}

				$sort = $new_product['sort'];

				if ( $new_product['option'] != 'custom' ) {
					switch ( $sort ) {
						case 'asc':
							$argsProduct['order'] = 'ASC';
							break;
						case 'top':
							$argsProduct['orderby']  = 'meta_value_num';
							$argsProduct['order']    = 'DESC';
							$argsProduct['meta_key'] = 'total_sales';
							break;
						case 'sale':
							$argsProduct['meta_query'] = WC()->query->get_meta_query();
							$argsProduct['post__in']   = array_merge( array( 0 ), wc_get_product_ids_on_sale() );
							break;
						case 'view':
							$argsProduct['orderby']  = 'meta_value_num';
							$argsProduct['order']    = 'DESC';
							$argsProduct['meta_key'] = '_mona_post_view';
							break;
						default:
							$argsProduct['order'] = 'DESC';
							break;
					}

				}
				$loop = new WP_Query( $argsProduct );
				?>
                <div class="home-prod-swiper">
                    <div class="swiper">
                        <div class="swiper-wrapper">
							<?php
							while ( $loop->have_posts() ) {
								$loop->the_post();
								?>
                                <div class="swiper-slide">
									<?php
									/**
									 * GET TEMPLATE PART
									 * BOX PRODUCT SOLD HOME
									 */
									$slug = '/partials/loop/box';
									$name = 'product-sold-home';
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
            <div class="home-prod-ctr">
                <div class="btn-prev">
                    <i class="far fa-chevron-left"></i>
                </div>
                <div class="btn-next">
                    <i class="far fa-chevron-right"></i>
                </div>
            </div>
        </div>
    </div>
</div>
