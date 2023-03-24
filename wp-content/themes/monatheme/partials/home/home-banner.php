<?php
/**
 * Section name: HOME BANNER
 * Description:
 * Author: Monamedia
 * Order: 0
 */
?>

<?php
$mona_home_section_banner = get_field( 'mona_home_section_banner' );
?>

<?php
if ( content_exists( $mona_home_section_banner ) && content_exists( $mona_home_section_banner['banner_list_items'] ) ) {
	?>
    <div class="about-banner homepage">
        <div class="about-banner-img">
            <div class="about-banner-img-decor load-img">
                <div class="block">
                    <div class="block-left">
                    </div>
                    <div class="block-right">
                    </div>
                </div>
                <div class="wing">
                    <div class="wing-left">
                        <span class="wing-item"></span>
                        <span class="wing-item"></span>
                        <span class="wing-item"></span>
                    </div>
                    <div class="wing-right">
                        <span class="wing-item"></span>
                        <span class="wing-item"></span>
                        <span class="wing-item"></span>
                    </div>
                </div>
            </div>
            <div class="swiper">
                <div class="swiper-wrapper">
					<?php
					foreach ( $mona_home_section_banner['banner_list_items'] as $key_banner => $item_banner ) {
						?>
                        <div class="swiper-slide">
                            <div class="about-banner-img-bg">
								<?php
								if ( ! empty( $item_banner['background'] ) && ! $item_banner['video_banner'] ) {
									?>
									<?php echo wp_get_attachment_image( $item_banner['background'], 'banner-desktop-image', '', [ 'class' => '' ] ); ?>
									<?php
								} elseif ( $item_banner['video_banner'] && ! empty( $item_banner['video'] ) ) { ?>
                                    <video playsinline="playsinline" autoplay="autoplay" muted="muted"
                                           loop="loop">
                                        <source src="<?php echo $item_banner['video']['url'] ?>"
                                                type="video/mp4">
                                    </video>
									<?php
								}
								?>
                            </div>
                            <div class="about-banner-home">
                                <div class="container">
                                    <div class="about-banner-home-content">
                                        <div class="aq-sub">
                                                     <span class="decor-left">
                                                         <span></span>
                                                         <span></span>
                                                         <span></span>
                                                     </span>
                                            <p class="aq-sub-txt">
												<?php
												if ( ! empty( $item_banner ['subtitle'] ) ) {
													?>
													<?php echo $item_banner ['subtitle']; ?>
													<?php
												}
												?>
                                            </p>
                                            <span class="decor-right">
                                                         <span></span>
                                                         <span></span>
                                                         <span></span>
                                                     </span>
                                        </div>
                                        <div class="aq-title">
											<?php
											if ( ! empty( $item_banner ['title'] ) ) {
												if ( $key_banner == 0 ) {
													?>
                                                    <h1 class="aq-title-txt">

														<?php echo $item_banner['title']; ?>
                                                    </h1>
													<?php
												} else { ?>
                                                    <h2 class="aq-title-txt">

														<?php echo $item_banner['title']; ?>

                                                    </h2>
													<?php
												}
											}
											?>
                                        </div>
										<?php
										if ( ! empty( $item_banner ['description'] ) ) {
											?>
                                            <p class="aq-desc c-white">
												<?php echo $item_banner ['description']; ?>
                                            </p>
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
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
        <div class="about-banner-content">
            <div class="container">
                <div class="inner row" data-aos="fade-up">
                    <div class="inner-left col-3">
                        <h2 class="title white"><?php echo __( 'TÌM ẮC QUY THEO XE', 'monamedia' ); ?>:</h2>
                    </div>
                    <div class="inner-right col-9">
                        <div class="about-filter">
                            <form id="mona-home-product-filter">
                                <div class="row is-loading-group">
                                    <div class="about-filter-item col">
                                        <select class="select-custom-main" name="car-brand"
                                                data-placeholder="<?php esc_html_e( 'Hãng', 'monamedia' ); ?>">
                                            <option
                                                    value="all"><?php esc_html_e( 'Hãng', 'monamedia' ); ?></option>
											<?php
											$terms = get_terms( array(
												'taxonomy'   => 'category_vehicle_brand',
												'hide_empty' => false,
												'parent'     => 0
											) );
											if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
												foreach ( $terms as $term ) {
													echo '<option value="' . esc_attr( $term->slug ) . '">' . esc_html( $term->name ) . '</option>';
												}
											}
											?>
                                        </select>
                                    </div>
                                    <div class="about-filter-item col">
                                        <select class="select-custom-main" name="car-model" data-placeholder="Dòng xe">
                                            <option value="all"><?php echo __( 'Dòng xe', 'monamedia' ); ?></option>
                                        </select>
                                    </div>
                                    <div class="about-filter-item col">
                                        <select class="select-custom-main" name="car-year" data-placeholder="Đời xe">
                                            <option value="all"><?php echo __( 'Đời xe', 'monamedia' ); ?></option>
                                        </select>
                                    </div>
                                    <div class="about-filter-btn col">
                                        <a href="<?php echo get_permalink( MONA_WC_PRODUCTS ) ?>" class="btn-find">
                                            <i class="fal fa-search"></i>
                                            <span class="txt"><?php echo __( 'Tìm', 'monamedia' ); ?></span>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<?php
}
?>
