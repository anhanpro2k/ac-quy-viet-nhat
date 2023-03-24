<?php
/**
 * Template name: Trang chủ Page
 * @author : Hy Hý
 */
get_header();
while ( have_posts() ):
	the_post();
	?>
    <main>
		<?php
		Elements::Group( 'home' )->Html();
		?>
    </main>
<?php
endwhile;
get_footer();