<?php

/**
 * Undocumented class
 */
class MonaProducts {

	public static function PriceProduct( $product_id = '', $position = 'list' ) {

		if ( empty( $product_id ) ) {
			$product_id = get_the_ID();
		}

		$product      = wc_get_product( $product_id );
		$product_type = $product->get_type();
		if ( $product->is_on_sale() ) {
			$class_onsale = 'price-wrap-sale';
		} else {
			$class_onsale = '';
		}
		ob_start();
		?>

		<?php switch ( $product_type ) :
			case 'variable': ?>
                <div class="pro-price price-wrap variable <?php echo $position; ?> <?php echo $class_onsale; ?>">
					<?php echo $product->get_price_html(); ?>
                </div>
				<?php break; ?>

			<?php case 'simple': ?>
                <div class="pro-price price-wrap simple <?php echo $position; ?> <?php echo $class_onsale; ?>">
					<?php echo $product->get_price_html(); ?>
                </div>
				<?php break; ?>

			<?php default: ?>
				<?php if ( $position == 'list' ) { ?>
                    <div class="pro-price price-wrap <?php echo $position; ?> <?php echo $class_onsale; ?>">
						<?php echo $product->get_price_html(); ?>
                    </div>
				<?php } elseif ( $position == 'detail' ) { ?>

                    <div class="info-content__price">
                        <div class="pro-price price-wrap <?php echo $position; ?> <?php echo $class_onsale; ?>">
							<?php echo $product->get_price_html(); ?>
                        </div>
						<?php
						if ( $product->is_on_sale() ) {

							if ( $product->is_type( 'variable' ) ) {

								$percent_array        = [];
								$available_variations = $product->get_available_variations();
								if ( ! empty ( $available_variations ) ) {

									foreach ( $available_variations as $key => $available_variation_item ) {
										$available_variation_id    = $available_variation_item['variation_id'];
										$product_with_variation_id = wc_get_product( $available_variation_id );
										if ( ! empty ( $product_with_variation_id->get_sale_price() ) ) {
											$percent         = mona_type_percensale( $product_with_variation_id->get_sale_price(), $product_with_variation_id->get_regular_price() );
											$percent_array[] = $percent;
										}
									}

								}

							} else {
								$percent_array             = 0;
								$available_variation_id    = $product_id;
								$product_with_variation_id = wc_get_product( $available_variation_id );
								if ( ! empty ( $product_with_variation_id->get_sale_price() ) ) {
									$percent_array = mona_type_percensale( $product_with_variation_id->get_sale_price(), $product_with_variation_id->get_regular_price() );
								}
							}

							if ( is_array( $percent_array ) ) {
								$value         = number_format( max( $percent_array ) );
								$percentResult = __( '-', 'monamedia' ) . $value . __( '%', 'monamedia' );
							} else {
								$value         = number_format( $percent_array );
								$percentResult = __( '-', 'monamedia' ) . $value . __( '%', 'monamedia' );
							} ?>
                            <div class="onsale"><?php echo $percentResult; ?></div>
						<?php } ?>
                    </div>
				<?php } ?>
				<?php break; ?>
			<?php endswitch; ?>

		<?php
		return ob_get_clean();
	}

	public static function ButtonProduct( $product_id = '' ) {

		if ( empty( $product_id ) ) {
			$product_id = get_the_ID();
		}
		$product = wc_get_product( $product_id );
		ob_start();

		$is_in_stock = $product->is_in_stock();
		if ( $product->is_type( 'variation' ) ) {
			$current_product_id = $product->get_parent_id();
		} else {
			$current_product_id = $product_id;
		}
		?>
        <div class="button">
            <a href="javascript:;"
               class="btn-third btn-buy shop-now mona-buy-now is-loading-btn">
                <span class="txt"><?php echo __( 'Mua ngay', 'monamedia' ); ?></span>
            </a>
        </div>
        <a href="javscript:;"
           class="card btn-add add-to-cart-btn mona-add-to-cart-detail is-loading-btn<?php echo ! $is_in_stock ? ' disable' : '' ?>">
                <span class="icon">
                    <img src="<?php echo get_site_url(); ?>/template/assets/images/p-card.svg" alt="">
                </span>
            <span class="txt"><?php echo __( 'Thêm vào giỏ hàng', 'monamedia' ); ?></span>
        </a>
		<?php
		return ob_get_clean();
	}


	public static function GalleryProduct( $product_id = '' ) {
		if ( empty( $product_id ) ) {
			$product_id = get_the_ID();
		}
		$product_obj  = wc_get_product( $product_id );
		$product_type = $product_obj->get_type();
		ob_start(); ?>

		<?php
		if ( $product_obj->get_type() == 'variation' ) {
			$mona_product_variation_gallery = get_field( 'mona_product_variation_gallery', $product_id );
			?>
            <div class="prodt-slider">
                <div class="prodt-slider-main gallery">
                    <div class="swiper">
                        <div class="swiper-wrapper">

							<?php
							if ( ! empty( $mona_product_variation_gallery ) ) {
								foreach ( $mona_product_variation_gallery as $attachment_id ) { ?>
                                    <div class="swiper-slide">
                                        <div class="prodt-img gItem"
                                             data-src="<?php echo wp_get_attachment_image_url( $attachment_id, 'full' ); ?>">
											<?php echo wp_get_attachment_image( $attachment_id, 'box-m' ); ?>
                                        </div>
                                    </div>
								<?php }
							} else {
								$thumbnail_url = ! empty( get_the_post_thumbnail_url( $product_id, 'full' ) ) ? get_the_post_thumbnail_url( $product_id, 'full' ) : get_template_directory_uri() . '/public/helpers/images/default-thumbnail.png';
								$thumbnail     = ! empty( get_the_post_thumbnail( $product_id, 'full' ) ) ? get_the_post_thumbnail_url( $product_id, 'full' ) : '<img src="' . get_template_directory_uri() . '/public/helpers/images/default-thumbnail.png' . '" />';
								?>
                                <div class="swiper-slide">
                                    <div class="prodt-img gItem" data-src="<?php echo $thumbnail_url; ?>">
										<?php echo $thumbnail; ?>
                                    </div>
                                </div>
							<?php } ?>

                        </div>
                    </div>
                </div>
                <div class="prodt-slider-thumb">
                    <div class="swiper">
                        <div class="swiper-wrapper">
							<?php foreach ( $mona_product_variation_gallery as $attachment_id ) { ?>
                                <div class="swiper-slide">
                                    <div class="prodt-img">
										<?php echo wp_get_attachment_image( $attachment_id, 'box-s' ); ?>
                                    </div>
                                </div>
							<?php } ?>
                        </div>
                    </div>
                </div>
            </div>
			<?php
		} else {
			$attachment_ids = $product_obj->get_gallery_image_ids();
			?>
            <div class="prodt-slider">
                <div class="prodt-slider-main gallery">
                    <div class="swiper">
                        <div class="swiper-wrapper">

							<?php
							if ( ! empty( $attachment_ids ) ) {
								foreach ( $attachment_ids as $attachment_id ) { ?>
                                    <div class="swiper-slide">
                                        <div class="prodt-img gItem"
                                             data-src="<?php echo wp_get_attachment_image_url( $attachment_id, 'full' ); ?>">
											<?php echo wp_get_attachment_image( $attachment_id, 'box-m' ); ?>
                                        </div>
                                    </div>
								<?php }
							} else {
								$thumbnail_url = ! empty( get_the_post_thumbnail_url( $product_id, 'full' ) ) ? get_the_post_thumbnail_url( $product_id, 'full' ) : get_template_directory_uri() . '/public/helpers/images/default-thumbnail.png';
								$thumbnail     = ! empty( get_the_post_thumbnail( $product_id, 'full' ) ) ? get_the_post_thumbnail_url( $product_id, 'full' ) : '<img src="' . get_template_directory_uri() . '/public/helpers/images/default-thumbnail.png' . '" />';
								?>
                                <div class="swiper-slide">
                                    <div class="prodt-img gItem" data-src="<?php echo $thumbnail_url; ?>">
										<?php echo $thumbnail; ?>
                                    </div>
                                </div>
							<?php } ?>

                        </div>
                    </div>
                </div>
                <div class="prodt-slider-thumb">
                    <div class="swiper">
                        <div class="swiper-wrapper">
							<?php foreach ( $attachment_ids as $attachment_id ) { ?>
                                <div class="swiper-slide">
                                    <div class="prodt-img">
										<?php echo wp_get_attachment_image( $attachment_id, 'box-s' ); ?>
                                    </div>
                                </div>
							<?php } ?>
                        </div>
                    </div>
                </div>
            </div>
		<?php } ?>

		<?php
		return ob_get_clean();
	}

	public static function RatingTotal( $product_id = '' ) {
		if ( empty( $product_id ) ) {
			$product_id = get_the_ID();
		}
		$product_obj  = wc_get_product( $product_id );
		$product_type = $product_obj->get_type();
		ob_start();
		?>

		<?php
		$ratingScore  = get_rating_score( $product_id );
		$argsComments = [
			'post_type'  => 'product',
			'post__in'   => [ $product_id ],
			'meta_query' => [
				'relation' => 'AND',
			]
		];
		$comments     = get_comments( $argsComments );
		$totalComment = count( $comments );
		?>
        <div class="cmt-dg mb-32">
            <p class="number">
				<?php echo $ratingScore; ?>
            </p>
			<?php if ( $ratingScore > 0 ) {
				$percentWidth = $ratingScore * 100 / 5;
			} else {
				$percentWidth = 0;
			} ?>
            <div class="content">
                <p class="text">
					<?php echo $totalComment . __( ' Đánh giá', 'monamedia' ); ?>
                </p>
                <div class="star">
                    <div class="star-list">
                        <div class="star-flex star-empty">
                            <img src="<?php echo get_site_url() ?>/template/assets/images/star-opa.svg" alt=""
                                 class="icon">
                            <img src="<?php echo get_site_url() ?>/template/assets/images/star-opa.svg" alt=""
                                 class="icon">
                            <img src="<?php echo get_site_url() ?>/template/assets/images/star-opa.svg" alt=""
                                 class="icon">
                            <img src="<?php echo get_site_url() ?>/template/assets/images/star-opa.svg" alt=""
                                 class="icon">
                            <img src="<?php echo get_site_url() ?>/template/assets/images/star-opa.svg" alt=""
                                 class="icon">
                        </div>
                        <div class="star-flex star-filter" style="width: <?php echo $percentWidth; ?>%;">
                            <img src="<?php echo get_site_url() ?>/template/assets/images/star.svg" alt="" class="icon">
                            <img src="<?php echo get_site_url() ?>/template/assets/images/star.svg" alt="" class="icon">
                            <img src="<?php echo get_site_url() ?>/template/assets/images/star.svg" alt="" class="icon">
                            <img src="<?php echo get_site_url() ?>/template/assets/images/star.svg" alt="" class="icon">
                            <img src="<?php echo get_site_url() ?>/template/assets/images/star.svg" alt="" class="icon">
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<?php
		return ob_get_clean();
	}

}