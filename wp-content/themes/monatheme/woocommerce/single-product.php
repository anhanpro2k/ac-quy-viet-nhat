<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header();
global $post;
$current_product_id = $post->ID;
$product_id         = $post->ID;
$product_obj        = wc_get_product( $current_product_id ); ?>
    <main class="main chitiet-sanpham">
        <form id="frmAddProduct">
            <input type="hidden" name="product_id" value="<?php the_ID() ?>">
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
                    <div class="product-detail">
                        <div class="wrapper-product">
                            <div class="swiper gallery-thumbs">
                                <div class="swiper-wrapper">
									<?php
									// Lấy thông tin ảnh sản phẩm
									global $product;
									$product_gallery = $product->get_gallery_image_ids();

									// Nếu có gallery thì hiển thị các ảnh sản phẩm
									if ( $product_gallery ) {
										// Hiển thị ảnh đầu tiên là thumbnail của sản phẩm
										?>
                                        <div class="swiper-slide">
                                            <div class="media-inner">
												<?php the_post_thumbnail( 'medium-square' ); ?>
                                            </div>
                                        </div>
										<?php
										foreach ( $product_gallery as $image_id ) {
											echo '<div class="swiper-slide">
														<div class="media-inner">
															<img src="' . wp_get_attachment_image_src( $image_id, 'medium-square' )[0] . '" alt="">
														</div>
												</div>';
										}
									} // Nếu không có gallery thì hiển thị ảnh thumbnail của sản phẩm
									else {
										echo '<div class="swiper-slide">
                                            <div class="media-inner">
                                                <img src="' . wp_get_attachment_image_src( get_post_thumbnail_id( $product->get_id() ), 'medium-square' )[0] . '" alt="">
                                            </div>
                                        </div>';
									}
									?>
                                </div>
                            </div>
                            <div class="swiper gallery-top">
                                <div class="swiper-wrapper gallery">
									<?php
									// Lấy thông tin ảnh thumbnail
									global $product;
									$thumbnail_id = get_post_thumbnail_id( $product->get_id() );

									// Hiển thị ảnh thumbnail
									echo '<div class="swiper-slide gItem" data-src="' . wp_get_attachment_image_src( $thumbnail_id, 'medium-square' )[0] . '">
                                    <div class="image">
                                        <img src="' . wp_get_attachment_image_src( $thumbnail_id, 'medium-square' )[0] . '" alt="">
                                    </div>  
                                </div>';

									// Lấy thông tin ảnh gallery sản phẩm
									$product_gallery = $product->get_gallery_image_ids();

									// Hiển thị các ảnh gallery sản phẩm
									foreach ( $product_gallery as $image_id ) {
										echo '<div class="swiper-slide gItem" data-src="' . wp_get_attachment_image_src( $image_id, 'banner-desktop-image' )[0] . '">
                                        <div class="image">
                                            <img src="' . wp_get_attachment_image_src( $image_id, 'medium-square' )[0] . '" alt="">
                                        </div>  
                                    </div>';
									}
									?>
                                </div>
                            </div>
                        </div>
						<?php
						global $woocommerce;
						$cart_items = $woocommerce->cart->get_cart(); ?>
                        <div class="content-product" data-aos="fade-right">
                            <h1 class="title-product-detail content-product-item">
								<?php the_title() ?>
                            </h1>
                            <div class="sku content-product-item">
                                <span class="name"><?php echo __( 'Mã sản phẩm', 'monamedia' ); ?>:</span>
                                <p class="txt"><?php echo esc_html( $product->get_sku() ); ?></p>
                            </div>
                            <div class="price content-product-item">
                                <span class="name"><?php echo __( 'Giá bán', 'monamedia' ); ?>:</span>

								<?php
								if ( $product->is_on_sale() ) {
									?>
                                    <span class="info-prices mona-price">
                                                        <?php
                                                        echo wp_kses_post( wc_price( $product->get_sale_price() ) );
                                                        ?>
                                                            </span>
									<?php if ( $product->get_regular_price() ) : ?>
                                        <span class="info-old-prices mona-price">
                                                                <?php echo wp_kses_post( wc_price( $product->get_regular_price() ) ); ?>
                                                                </span>
									<?php endif; ?>
									<?php
								} else { ?>
                                    <div class="txt"
                                         id="monaProductPrice">
										<?php echo wp_kses_post( wc_price( $product->get_regular_price() ) ); ?></div>
									<?php
								} ?>

                                <!--                                <div class="txt"-->
                                <!--                                     id="monaProductPrice">-->
                                <!--									-->
								<?php //echo wp_kses_post( wc_price( $product->get_regular_price() ) ); ?><!--</div>-->


                            </div>
                            <div class="wrapper-box content-product-item">
                                <div class="quantity-wrapper">
                                    <div class="quantity">
                                        <div class="count-btn count-minus">
                                            <img src="<?php echo get_site_url(); ?>/template/assets/images/p-count.svg"
                                                 alt="">
                                        </div>
                                        <input type="number" name="quantity" class="count-input" step="1" min="1"
                                               max="999"
                                               value="1" title="SL" placeholder="" inputmode="numeric"
                                               autocomplete="off"
                                               hidden="">
                                        <p class="count-number">01</p>
                                        <div class="count-btn count-plus">
                                            <img src="<?php echo get_site_url(); ?>/template/assets/images/p-plus01.svg"
                                                 alt="">
                                        </div>
                                    </div>
                                </div>
								<?php echo MonaProducts::ButtonProduct( $product_id ); ?>
                            </div>

							<?php
							$mona_product_used = get_field( 'mona_product_used' );
							?>

							<?php
							if ( content_exists( $mona_product_used ) ) {
								?>
                                <div class="wrapper-quantity-detail">
                                    <span class="name-detail"><?php echo __( 'Sử dụng cho', 'monamedia' ); ?>:</span>
                                    <div class="inner-detail Honda Civic recheck-block row">
										<?php
										foreach ( $mona_product_used as $key_used => $item_used ) {
											if ( ! empty( $item_used ) ) {
												?>
                                                <div class="col">
                                                    <div class="detail-item recheck-item">
                                                        <a href="<?php echo get_term_link( $item_used, 'category_vehicle_brand' ) ?>"
                                                           class="Honda-btn">
															<?php
															$term_used = get_term( $item_used, 'category_vehicle_brand' );
															$term_name = $term_used->name;
															if ( get_taxonomy_level( $term_used->term_id, 'category_vehicle_brand' ) == 3 ) {
																$term_parent = get_term( $term_used->parent, 'category_vehicle_brand' );
																$term_name   = $term_parent->name . ' - ' . $term_name;
															}
															?>
                                                            <span
                                                                    class="txt"><?php echo esc_html( $term_name ); ?></span></a>
                                                    </div>
                                                </div>

												<?php
											}
										}
										?>
                                    </div>
                                </div>
								<?php
							} ?>


                        </div>
                    </div>


                    <div class="intro-produdct">
                        <div class="intro-produdct-left" data-aos="fade-left">
                            <h3 class="intro-produdct-title">
								<?php echo __( 'Mô tả sản phẩm', 'monamedia' ); ?>:
                            </h3>
                            <div class="intro-produdct-content mona-content">
								<?php echo wpautop( $product->get_short_description() ); ?>
                            </div>
                        </div>
                        <div class="intro-produdct-right" data-aos="fade-right">
                            <h3 class="intro-produdct-title"><?php echo __( 'Giới thiệu Chung', 'monamedia' ); ?>:</h3>
                            <div class="intro-produdct-content mona-content">
								<?php the_content(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>


		<?php
		/**
		 * GET TEMPLATE PART
		 * product
		 */
		$slug = '/partials/global/global';
		$name = 'policy';
		echo get_template_part( $slug, $name );
		?>

		<?php
		$posttype   = get_post_type( $post );
		$taxonomies = get_object_taxonomies( $posttype );
		$argsPost   = [
			'post_type'      => $posttype,
			'post_status'    => 'publish',
			'posts_per_page' => 8,
			'order'          => 'DESC',
			'post__not_in'   => array( $post->ID ),
			'meta_query'     => [
				'relation' => 'AND',
			],
			'tax_query'      => [
				'relation' => 'OR',
			],
		];

		if ( ! empty( $taxonomies ) ) {
			foreach ( $taxonomies as $key => $taxonomy ) {
				$taxonomy_ids = wp_get_post_terms( $post->ID, $taxonomy, array( "fields" => "ids" ) );
				if ( ! empty( $taxonomy_ids ) ) {
					$argsPost['tax_query'][] = [
						'taxonomy' => $taxonomy,
						'field'    => 'id',
						'terms'    => (array) @$taxonomy_ids,
					];
				}
			}
		}
		$loopPost = new WP_Query( $argsPost );
		?>
        <section class="related-products">
            <div class="container">
                <h3 class="related-products-title"><?php echo __( 'SẢN PHẨM LIÊN QUAN', 'monamedia' ); ?></h3>
                <div class="swiper related-swiper">
                    <div class="swiper-wrapper product-list">
						<?php
						while ( $loopPost->have_posts() ) {
							$loopPost->the_post();
							?>
                            <div class="swiper-slide">
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
							<?php
						}
						wp_reset_query();
						?>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>
    </main>
<?php
get_footer();

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */