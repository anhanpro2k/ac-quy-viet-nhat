<?php global $post; ?>
<div class="inner">
    <div class="img">
        <a href="<?php echo get_permalink( $post->ID ); ?>" class="img-inner">
			<?php
			if ( ! empty( get_the_post_thumbnail( $post->ID ) ) ) {
				echo get_the_post_thumbnail( $post->ID, 'medium-square' );
			} else { ?>
                <img src="<?php echo get_template_directory_uri() ?>/public/helpers/images/default-thumbnail.jpg"
                     alt="">
				<?php
			} ?>
        </a>
    </div>
    <div class="info">
        <div class="info-inner">
            <div class="topitem">
                <p class="by">
					<?php echo __( 'Đăng bởi', 'monamedia' ); ?>
                    <strong><?php echo get_the_author(); ?></strong>
                </p>
                <p class="date">
					<?php echo date_i18n( 'd \t\h\á\n\g m, Y', strtotime( get_the_date() ) ); ?>
                </p>
            </div>
            <h3>
                <a href="<?php echo get_permalink( $post->ID ); ?>"
                   class="tt"><?php echo get_the_title( $post->ID ); ?></a>
            </h3>
            <p class="desc">
				<?php echo get_the_excerpt( $post->ID ); ?>
            </p>
        </div>
    </div>
</div>
