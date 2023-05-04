<?php
global $post;
?>
<div class="newest-item">
    <div class="topitem">
        <p class="by">
			<?php echo __( 'Đăng bởi', 'monamedia' ); ?>
            <strong><?php echo get_the_author_meta( 'display_name', $post->post_author ); ?></strong>
        </p>
        <p class="date">
			<?php echo date_i18n( 'd \t\h\á\n\g m, Y', strtotime( get_the_date( $post->ID ) ) ); ?>
        </p>
    </div>
    <p>
        <a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>"
           class="tt"><?php echo esc_html( get_the_title( $post->ID ) ); ?></a>
    </p>
    <p class="desc">
		<?php echo esc_html( get_the_excerpt( $post->ID ) ); ?>
    </p>
</div>
