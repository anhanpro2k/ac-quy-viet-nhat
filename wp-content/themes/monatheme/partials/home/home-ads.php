<?php
/**
 * Section name: Home ads 1
 * Description:
 * Author: Monamedia
 * Order: 4
 */
?>
<?php
$mona_home_section_banner_ads = get_field( 'mona_home_section_banner_ads' );
?>

<?php
if ( content_exists( $mona_home_section_banner_ads ) ) {
	?>
    <div class="chitiet-sanpham">
        <section class="sec-bn">
            <div class="banner banner-style-02">
                <div class="banner-img load-img">
					<?php
					if ( ! empty( $mona_home_section_banner_ads['ads_background'] ) ) {
						?>
						<?php echo wp_get_attachment_image( $mona_home_section_banner_ads['ads_background'], 'banner-desktop-image', '', [ 'class' => '' ] ); ?>
						<?php
					}
					?>
                </div>
                <div class="container">
                    <div class="banner-wr">
                        <div class="banner-content">
                            <div class="title sub-title-top white" data-aos="fade-right"
                                 data-aos-delay="200"><?php echo $mona_home_section_banner_ads['ads_title_1']; ?> </div>
                            <h2 class="title title-scale white load-img" data-aos="fade-right" data-aos-delay="500">
								<?php echo $mona_home_section_banner_ads['ads_title_2']; ?>
                            </h2>
                            <div class="title sub-title-bottom white" data-aos="fade-right"
                                 data-aos-delay="800">
                                <?php echo $mona_home_section_banner_ads['ads_title_3']; ?>
                            </div>
                            <div class="btn-viewall" data-aos="fade-right" data-aos-delay="1000">
								<?php
								if ( ! empty( $mona_home_section_banner_ads['ads_link'] ) ) {
									?>
                                    <a href="<?php echo $mona_home_section_banner_ads['ads_link']['url']; ?>"
                                       class="btn-third">
										<span
                                                class="txt"><?php echo $mona_home_section_banner_ads['ads_link']['title']; ?></span>
                                        <div class="icon">
                                            <img
                                                    src="<?php echo get_site_url(); ?>/template/assets/images/chevrons-right.svg"
                                                    alt="">
                                        </div>
                                    </a>
									<?php
								}
								?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block-skew-top">
                    <div class="wrapper-skew">
                        <div class="skew-item"></div>
                        <div class="skew-item"></div>
                        <div class="skew-item"></div>
                        <div class="skew-item"></div>
                        <div class="skew-item"></div>
                        <div class="skew-item"></div>
                        <div class="skew-item"></div>
                        <div class="skew-item"></div>
                        <div class="skew-item"></div>
                    </div>

                </div>
                <div class="block-skew-bottom">
                    <div class="wrapper-skew">
                        <div class="skew-item"></div>
                        <div class="skew-item"></div>
                        <div class="skew-item"></div>
                        <div class="skew-item"></div>
                        <div class="skew-item"></div>
                        <div class="skew-item"></div>
                    </div>
                    <div class="block-skew-bottom-border"></div>
                </div>
                <div class="backround-modify">
                    <div class="image">
                        <img src="<?php echo get_site_url(); ?>/template/assets/images/p-backround-modify.png" alt="">
                    </div>
                </div>
                <div class="background-acquy" data-aos="zoom-in">
                    <div class="image">
						<?php echo wp_get_attachment_image( $mona_home_section_banner_ads['ads_product'], 'medium-square', '', [ 'class' => '' ] ); ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
	<?php
}
?>
