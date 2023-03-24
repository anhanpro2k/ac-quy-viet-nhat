<?php
/**
 * Section name: SECTION ADVANTAGE
 * Description:
 * Author: Monamedia
 * Order: 8
 */
?>

<?php
$mona_home_section_advantage = get_field( 'mona_home_section_advantage' );
?>
<?php
if ( content_exists( $mona_home_section_advantage ) ) {
	?>
    <div class="home-feature">
		<?php
		foreach ( $mona_home_section_advantage as $key_advantage => $item_advantage ) {
			?>
            <div class="home-feature-item">
                <div class="inner">
					<?php
					if ( ! empty( $item_advantage['advantage_icon'] ) ) {
						?>
                        <div class="icon">
							<?php echo wp_get_attachment_image( $item_advantage['advantage_icon'], '100x100', '', [ 'class' => '' ] ); ?>
                        </div>
						<?php
					}
					?>
					<?php
					if ( ! empty( $item_advantage['advantage_info'] ) ) {
						?>
                        <div class="tt">
							<?php echo $item_advantage['advantage_info']; ?>
                        </div>
						<?php
					}
					?>
                </div>
            </div>
			<?php
		}
		?>
    </div>
	<?php
}
?>
