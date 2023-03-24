<?php
/**
 * Section name: GLOBAL POLICY
 * Description:
 * Author: Monamedia
 * Order: 0
 */


$title = get_field( 'm_about_policy_title', MONA_PAGE_ABOUT );
$list  = get_field( 'm_about_policy_list', MONA_PAGE_ABOUT );
if ( ! empty( $list ) ) {
	?>
    <section class="sec-policy">
        <div class="policy sec-pd8">
            <div class="container">
                <div class="policy-wr">
                    <h2 class="title center mb4 blur load-img"><?php echo $title; ?></h2>
                    <div class="swiper">
                        <div class="swiper-wrapper">
							<?php
							foreach ( $list as $list ) {
								?>
                                <div class="swiper-slide">
                                    <div class="policy-item">
                                        <div class="icon">
											<?php if ( ! empty( $list['m_about_policy_list_icon'] ) ) {
												echo wp_get_attachment_image( $list['m_about_policy_list_icon'], 'medium' );
											} else {
												echo '<img src="' . get_site_url() . '/template/assets/images/default-image.jpg" alt="">';
											}
											?>
                                        </div>
                                        <div class="desc">
                                            <p class="desc-txt">
												<?php echo $list['m_about_policy_list_descript']; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
							<?php } ?>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
	<?php
}
?>