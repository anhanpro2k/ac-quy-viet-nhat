<?php
global $post;
$product = wc_get_product( $post->ID );
?>
<div class="product-item">
    <div class="inner">
        <div class="img">
            <a href="<?php the_permalink(); ?>" class="img-see">
                <img src="<?php echo get_site_url(); ?>/template/assets/images/eyes.svg" alt="">
            </a>
            <form class="frmAddProductCart">
                <input type="hidden" name="product_id" value="<?php echo $post->ID; ?>">
                <a data-product_id="<?php echo $post->ID; ?>"
                   class="img-cart mona-add-to-cart-list is-loading-btn">
                    <img src="<?php echo get_site_url(); ?>/template/assets/images/cart.svg" alt="">
                </a>
            </form>
			<?php if ( has_post_thumbnail() ) : ?>
                <a href="<?php the_permalink(); ?>" class="img-inner">
					<?php the_post_thumbnail( 'medium-square' ); ?>
                </a>
			<?php else : ?>
                <a href="<?php the_permalink(); ?>" class="img-inner">
                    <img src="<?php echo get_template_directory_uri() ?>/public/helpers/images/default-thumbnail.jpg"
                         alt="">
                </a>
			<?php endif; ?>

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
        <div class="info">
            <div class="info-inner">
                <h3>
                    <a href="<?php the_permalink(); ?>" class="tt"><?php the_title(); ?></a>
                </h3>
				<?php if ( $product->is_on_sale() ) : ?>
                    <p class="prices">
                        <span class="prices-dis">-<?php echo round( ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100 ); ?>%</span>
                        <span class="prices-txt"><?php echo wc_price( $product->get_sale_price() ); ?></span>
                    </p>
                    <div class="prices-old">
						<?php echo wc_price( $product->get_regular_price() ); ?>
                    </div>
				<?php else : ?>
                    <p class="prices">
                        <span class="prices-txt"><?php echo wc_price( $product->get_price() ); ?></span>
                    </p>
				<?php endif; ?>
            </div>
        </div>
    </div>
</div>
