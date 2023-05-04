<?php
global $post;
$product = wc_get_product( $post->ID );
?>

<div class="newprod-item">
    <div class="inner">
        <div class="img">
            <a href="<?php echo get_permalink( $post->ID ) ?>" class="img-inner">
				<?php if ( has_post_thumbnail() ) {
					the_post_thumbnail( '100x100' );
				} else { ?>
                    <img src="<?php echo get_template_directory_uri() ?>/public/helpers/images/default-thumbnail.jpg"
                         alt="">
				<?php } ?>
            </a>
        </div>
        <div class="info">
            <div class="info-inner">
                <p>
                    <a href="<?php echo get_permalink( $post->ID ); ?>"
                       class="tt"><?php echo get_the_title( $post->ID ); ?></a>
                </p>
				<?php
				if ( $product->is_on_sale() ) {
					?>
                    <div class="price">
						<?php
						echo wp_kses_post( wc_price( $product->get_sale_price() ) );
						?>
                    </div>
                    <span class="info-old-prices mona-price">
					<?php echo wp_kses_post( wc_price( $product->get_regular_price() ) ); ?>
                    </span>
					<?php
				} else { ?>
                    <div class="price">
						<?php
						echo wp_kses_post( wc_price( $product->get_regular_price() ) );
						?>
                    </div>
					<?php
				} ?>
            </div>
        </div>
    </div>
</div>
