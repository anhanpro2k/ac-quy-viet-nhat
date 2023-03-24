<?php
/**
 * Section name: HOME BRAND
 * Description:
 * Author: Monamedia
 * Order: 1
 */
?>

<?php
$mona_home_section_brand = get_field( 'mona_home_section_brand' );
?>
<?php
if ( content_exists( $mona_home_section_brand ) ) {
	?>
    <div class="home-brand ss-pd">
        <div class="container">
            <div class="home-brand-wr">
                <div class="aq-sub load-img">
                                    <span class="decor-left">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </span>
                    <h2 class="aq-sub-txt blur load-img">
						<?php echo $mona_home_section_brand['brand_title']; ?>
                    </h2>
                    <span class="decor-right">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </span>
                </div>

                <!-- Swiper -->
                <div class="home-brand-swiper" data-aos="fade-up">
                    <div class="swiper">
                        <div class="swiper-wrapper">
							<?php
							if ( content_exists( $mona_home_section_brand['brand_list'] ) ) {
								?>
								<?php
								foreach ( $mona_home_section_brand['brand_list'] as $key_brand => $item_brand ) {
									?>
                                    <div class="swiper-slide">
                                        <div class="home-brand-item">
                                            <a href="<?php echo $item_brand['link']['url'] ?>" target="_blank"
                                               class="inner">
												<?php echo wp_get_attachment_image( $item_brand['logo'], 'medium-square', '', [ 'class' => '' ] ); ?>
                                            </a>
                                        </div>
                                    </div>
									<?php
								}
								?>
								<?php
							}
							?>
                        </div>
                        <!-- <div class="home-brand-swiper swiper-pagination"></div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
	<?php
}
?>
