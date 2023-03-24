<?php
/**
 * Section name: Home new
 * Description:
 * Author: Monamedia
 * Order: 9
 */
?>
<div class="home-news sec-pd8">
    <div class="container">
        <div class="home-news-wr">
            <h2 class="title center mb4 blur load-img"><?php echo __( 'TIN TỨC', 'monamedia' ); ?></h2>
            <div class="home-news-box">
                <div class="home-news-row row">
					<?php
					$current_page = get_query_var( 'paged' );
					$current_page = max( 1, $current_page );
					$offset_start = 0;
					$order        = 'DESC';
					$per_page     = 4;
					$offset       = ( $current_page - 1 ) * $per_page + $offset_start;
					$argsNews     = array(
						'post_type'      => 'post',
						'paged'          => $current_page,
						'offset'         => $offset,
						'post_status'    => 'publish',
						'posts_per_page' => $per_page,
						'order'          => $order,
					);

					$loop = new WP_Query( $argsNews );

					?>
					<?php if ( $loop->have_posts() ):

						?>
                        <div class="home-news-left col-6">
							<?php
							$loop->the_post();
							global $post;
							?>
                            <div class="home-news-item big">
                                <div class="inner">
                                    <div class="img">
                                        <a href="<?php echo get_permalink( $post->ID ); ?>"
                                           class="img-inner img-animated load-img">
											<?php
											if ( ! empty( has_post_thumbnail( $post->ID ) ) ) {
												echo get_the_post_thumbnail( $post->ID, 'medium-square' );
											} else { ?>
                                                <img src="<?php echo get_template_directory_uri() ?>/public/images/default-thumbnail.jpg"
                                                     alt="">
												<?php
											} ?>
                                        </a>
                                    </div>
                                    <div class="info">
                                        <div class="info-tag row">
                                                        <span class="info-tag-item col">
                                                            <span class="txt"><?php echo get_the_date( 'j F, Y', $post->ID ) ?></span>
                                                        </span>
                                            <span class="info-tag-item col">
                                                            <span class="txt"><?php echo get_the_author_meta( 'display_name', $post->post_author ); ?></span>
                                                        </span>
                                        </div>
                                        <h3>
                                            <a href="<?php echo get_permalink( $post->ID ) ?>"
                                               class="info-tt"><?php echo get_the_title( $post->ID ) ?></a>
                                        </h3>
                                        <p class="info-desc">
											<?php echo get_the_excerpt( $post->ID ); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="home-news-right col-6">
                            <div class="home-news-list row">
								<?php
								while ( $loop->have_posts() ) {
									$loop->the_post();
									?>
                                    <div class="home-news-item col">
                                        <div class="inner">
                                            <div class="img">
                                                <a href="<?php echo get_site_url( $post->ID ) ?>"
                                                   class="img-inner img-animated load-img">
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
                                                <div class="info-tag row">
                                                                   <span class="info-tag-item col">
                                                                       <span class="txt"><?php echo get_the_date( 'j F, Y', $post->ID ) ?></span>
                                                                   </span>
                                                    <span class="info-tag-item col">
                                                                       <span class="txt"><?php echo get_the_author_meta( 'display_name', $post->post_author ); ?></span>
                                                                   </span>
                                                </div>
                                                <h3>
                                                    <a href="<?php echo get_permalink( $post->ID ); ?>"
                                                       class="info-tt"><?php echo get_the_title( $post->ID ); ?></a>
                                                </h3>
                                                <p class="info-desc">
													<?php echo get_the_excerpt( $post->ID ); ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
									<?php
								}
								wp_reset_query();
								?>

                            </div>
                        </div>
					<?php endif ?>
                </div>
            </div>
            <a href="<?php echo get_permalink( MONA_PAGE_BLOG ) ?>" class="btn-seeallyel">
                <span class="txt"><?php echo __( 'Xem tất cả', 'monamedia' ); ?></span>
                <i class="fas fa-chevron-double-right"></i>
            </a>
        </div>
    </div>
</div>
