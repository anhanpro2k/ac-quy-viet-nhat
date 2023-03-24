<?php

/**
 * Template name: Trang Liên Hệ
 * @author : Hy Hý
 */
get_header();
while ( have_posts() ) :
	the_post();
	$map       = get_field( 'mona_contact_map' );
	$contact_g = get_field( 'mona_contact_contact' );
	$info_g    = get_field( 'mona_contact_info' );
	$current   = get_queried_object();
	?>
    <main class="main">
        <section class="sec-contact">
			<?php if ( ! empty( $map ) ) { ?>
                <div class="contact-map">
					<?php echo $map; ?>
                </div>
			<?php } ?>
            <div class="contact-block">
                <div class="contact-wr">
                    <div class="contact-form">
                        <div class="contact-form-wr">
                            <h1 class="tt mb4" data-aos="fade-up"><?php
								if ( ! empty( $contact_g['contact_title'] ) ) {
									?>
									<?php echo $contact_g['contact_title']; ?>
									<?php
								} else {
									echo $current->post_title;
								}
								?></h1>
							<?php if ( ! empty( $contact_g['contact_shortcode'] ) ) {
								echo do_shortcode( $contact_g['contact_shortcode'] );
							}
							?>
                        </div>
						<?php if ( ! empty( $info_g ) ) {
							$list = $info_g['info_label_list'];
							?>
                            <div class="contact-address" data-aos="fade-up">
                                <div class="contact-address-list row">
									<?php foreach ( $list as $list ) {
										$sel     = $list['info_label_list_sel'];
										$name    = $list['info_label_title'];
										$content = $list['info_label_content'];
										if ( $sel == 1 ) {
											?>
                                            <div class="contact-address-item col">
                                                <p class="tt"><?php echo $name; ?></p>
                                                <p class="desc">
													<?php echo $content; ?>
                                                </p>
                                            </div>
										<?php } elseif ( $sel == 2 ) { ?>
                                            <div class="contact-address-item col">
                                                <p class="tt"><?php echo $name; ?></p>
                                                <a href=" mailto:<?php echo $content; ?>" class="desc">
													<?php echo $content; ?>
                                                </a>
                                            </div>
										<?php } elseif ( $sel == 3 ) { ?>
                                            <div class="contact-address-item col">
                                                <p class="tt"><?php echo $name; ?></p>
                                                <p class="desc">
													<?php echo $content; ?>
                                                </p>
                                            </div>
										<?php }
									} ?>
                                </div>
                            </div>
						<?php } ?>
                    </div>
                    <div class="contact-img load-img img-animated">
						<?php if ( ! empty( $contact_g['contact_image'] ) ) {
							echo wp_get_attachment_image( $contact_g['contact_image'], '1200x900' );
						} else {
							echo '<img src="' . get_site_url() . '/template/assets/images/default-image.jpg" alt="">';
						}
						?>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php
endwhile;
get_footer();
