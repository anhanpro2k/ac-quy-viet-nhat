<?php
/**
 * Section name: Category 1
 * Description: Danh mục sản phẩm 1
 * Author: Monamedia
 * Order: 3
 */
?>

<?php
$mona_home_section_cat1 = get_field( 'mona_home_section_cat1' );
?>

<?php
if ( content_exists( $mona_home_section_cat1 ) ) {
	?>
    <div class="home-prodbox hasbg">
        <div class="container">
            <div class="home-prodbox-wr tabJS">
                <div class="head" data-aos="fade-up">
					<?php
					$cat1_category = $mona_home_section_cat1['cat1_category'];
					?>
                    <h2 class="head-tt"><?php
						if ( ! empty( $cat1_category ) ) {
							?>
							<?php echo get_term( $cat1_category )->name; ?>
							<?php
						} ?>
                    </h2>
					<?php
					$cat1_brand = $mona_home_section_cat1['cat1_brand'];
					?>
					<?php
					if ( content_exists( $cat1_brand ) ) {
						?>
                        <div class="head-tabbtn scrollDeskJS">
							<?php
							foreach ( $cat1_brand as $key_brand => $item_brand ) {
								?>
								<?php
								if ( ! empty( $item_brand ) ) {
									?>
                                    <div class="head-tabbtn-it tabBtn"><?php echo get_term( $item_brand )->name; ?></div>
									<?php
								}
								?>
								<?php
							}
							?>
                        </div>
						<?php
					}
					?>

					<?php
					$cat1_link = $mona_home_section_cat1['cat1_link'];
					?>

					<?php
					if ( ! empty( $cat1_link ) ) {
						?>
                        <a target="_blank" href="<?php echo esc_url( $cat1_link['url'] ); ?>" class="btn-seeallyel">
                            <span class="txt"><?php echo ! empty( $cat1_link['title'] ) ? $cat1_link['title'] : __( 'Xem tất cả', 'monamedia' );; ?></span>
                            <i class="fas fa-chevron-double-right"></i>
                        </a>
						<?php
					}
					?>

                </div>

                <div class="home-prodbox-panel" data-aos="fade-up" data-aos-delay="400">
					<?php
					if ( content_exists( $mona_home_section_cat1['cat1_brand'] ) ) {
						?>
						<?php
						foreach ( $mona_home_section_cat1['cat1_brand'] as $key_brand => $item_brand ) {
							if ( ! empty( $item_brand ) ) {
								?>
								<?php
								$current_page = get_query_var( 'paged' );
								$current_page = max( 1, $current_page );
								$offset_start = 0;
								$order        = 'DESC';
								$per_page     = 7;
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
											'taxonomy' => 'category_brand',
											'field'    => 'id',
											'terms'    => $item_brand,
										],
									]
								);
								if ( ! empty( $cat1_category ) ) {
									$argsProduct['tax_query'][] = [
										'taxonomy' => 'product_cat',
										'field'    => 'id',
										'terms'    => $cat1_category,
									];
								}

								$loop = new WP_Query( $argsProduct );

								?>
								<?php if ( $loop->have_posts() ): ?>
                                    <div class="home-prodbox-panelwr tabPanel">
                                        <div class="contentTab">
                                            <div class="home-prodbox-list">
												<?php
												$loop->the_post();
												global $post;
												$product = wc_get_product( $post->ID );
												?>
                                                <div class="home-prodbox-item big">
                                                    <div class="info">
                                                        <div class="info-tag">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="tag">
																		<?php
																		$product_tags = get_field( 'mona_product_tag', $post->ID );
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
																		<?php if ( ! $product->is_in_stock() ) : ?>
                                                                            <span class="tag-item gray"><?php echo __( 'Hết hàng', 'monamedia' ); ?></span>
																		<?php endif; ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
																	<?php
																	if ( is_numeric( $product->get_regular_price() ) && is_numeric( $product->get_sale_price() ) ) {
																		$discount_percentage = round( ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100 );
																	} else {
																		$discount_percentage = 0;
																	}
																	if ( $discount_percentage ) :
																		?>
                                                                        <span class="info-tag-item dis ">
                                                                        <?php echo esc_html( '-' . $discount_percentage . '%' ); ?>
                                                                    </span>
																	<?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <h2>
                                                            <a class="info-tt" href="<?php the_permalink(); ?>">
																<?php the_title(); ?>
                                                            </a>
                                                        </h2>
                                                        <span class="info-prices">
                                                        <?php
                                                        echo wp_kses_post( wc_price( $product->get_regular_price() ) );
                                                        ?>
                                                    </span>
														<?php if ( $product->get_regular_price() && $product->get_sale_price() ) : ?>
                                                            <span class="info-old-prices">
                                                                <?php echo wp_kses_post( wc_price( $product->get_regular_price() ) ); ?>
                                                        </span>
														<?php endif; ?>
                                                        <form class="frmAddProductCart">
                                                            <input type="hidden" name="product_id"
                                                                   value="<?php echo $post->ID; ?>">
                                                            <a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>"
                                                               class="btn-third mona-add-to-cart-list is-loading-btn">
                                                                <span class="txt"><?php esc_html_e( 'Mua ngay', 'monamedia' ); ?></span>
                                                            </a>
                                                        </form>
                                                    </div>
                                                    <div class="home-prodbox-item-img">
                                                        <div class="inner">
															<?php
															if ( has_post_thumbnail() ) {
																echo wp_kses_post( get_the_post_thumbnail( $post->ID, 'medium-square' ) );
															} else {
																echo '<img src="' . esc_url( get_template_directory_uri() ) . '/public/helpers/images/default-thumbnail.jpg" alt="">';
															}
															?>
                                                        </div>
                                                    </div>

                                                </div>

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
                                        </div>
                                    </div>
								<?php endif ?>

								<?php
							}
						}
						?>
						<?php
					}
					?>
                </div>
            </div>
        </div>
    </div>
	<?php
}
?>
