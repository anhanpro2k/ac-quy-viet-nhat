<?php
/**
 * Section name: Home ads 2
 * Description:
 * Author: Monamedia
 * Order: 7
 */
?>
<?php
$mona_home_section_banner_ads2 = get_field( 'mona_home_section_banner_ads2' );
?>

<?php
if ( content_exists( $mona_home_section_banner_ads2 ) ) {
	?>
    <div class="home-adv">
        <div class="container">
            <div class="home-adv-row row">
				<?php foreach ( $mona_home_section_banner_ads2 as $key_ads => $item_ads ) { ?>
					<?php if ( ! empty( $item_ads['ads2_banner'] ) && ! empty( $item_ads['ads2_link']['url'] ) ) { ?>
                        <div class="col-6">
                            <div class="img">
                                <a target="_blank" href="<?php echo $item_ads['ads2_link']['url']; ?>"
                                   class="img-inner img-animated load-img">
									<?php echo wp_get_attachment_image( $item_ads['ads2_banner'], 'medium-square', '', array( 'class' => '' ) ); ?>
                                </a>
                            </div>
                        </div>
					<?php } else if ( empty( $item_ads['ads2_link']['url'] ) && ! empty( $item_ads['ads2_banner'] ) ) { ?>
                        <div class="col-6">
                            <div class="img">
                                <a
                                        class="img-inner img-animated load-img">
									<?php echo wp_get_attachment_image( $item_ads['ads2_banner'], 'medium-square', '', array( 'class' => '' ) ); ?>
                                </a>
                            </div>
                        </div>
						<?php
					} ?>
				<?php } ?>
            </div>
        </div>
    </div>
	<?php
}
?>