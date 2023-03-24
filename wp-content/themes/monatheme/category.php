<?php
/**
 * The template for displaying category.
 *
 * @package Monamedia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
$current = get_queried_object();
?>
    <main class="main">
        <div class="new">
            <div class="container">
				<?php
				/**
				 * GET TEMPLATE PART
				 * BREADCRUMB
				 */
				$slug = '/partials/breadcrumb';
				echo get_template_part( $slug );
				?>
            </div>
            <section id="mona-daily-news" class="sec-daily sec-pdb">
                <div class="new-daily">
                    <div class="container">
                        <div class="new-daily-wr row">
                            <div class="new-daily-main col-8">
								<?php
								$current_page = get_query_var( 'paged' );
								$current_page = max( 1, $current_page );
								$offset_start = 0;
								$order        = 'DESC';
								$per_page     = 7;
								$offset       = ( $current_page - 1 ) * $per_page + $offset_start;
								$argsNews     = array(
									'post_type'      => 'post',
									'paged'          => $current_page,
									'offset'         => $offset,
									'post_status'    => 'publish',
									'posts_per_page' => $per_page,
									'order'          => $order,
									'tax_query'      => [
										'relation' => 'AND',
										[
											'taxonomy' => 'category',
											'field'    => 'id',
											'terms'    => $current->term_id,
										]
									]
								);

								$loop = new WP_Query( $argsNews );
								?>
								<?php
								$mona_blog_title = get_field( 'mona_blog_title' );
								?>
                                <h1 class="title blur mb4 load-img">
									<?php
									echo $current->name;
									?>
                                </h1>
                                <div class="new-daily-list row">
									<?php
									while ( $loop->have_posts() ) {
										$loop->the_post();
										?>
                                        <div class="new-daily-item col">
											<?php
											/**
											 * GET TEMPLATE PART
											 * BOX NEWS
											 */
											$slug = '/partials/loop/box';
											$name = 'news';
											echo get_template_part( $slug, $name );
											?>
                                        </div>
										<?php
									}
									wp_reset_query();
									?>
                                </div>
                                <div class="pagimain">
									<?php mona_pagination_link_news( $loop ); ?>
                                </div>
                            </div>
                            <div class="new-daily-side col-4">
                                <div class="new-daily-side-item">
									<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'sidebar_news' ) ) : ?><?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
			<?php
			/**
			 * GET TEMPLATE PART
			 * POLICY GLOBAL
			 */
			$slug = '/partials/global/global';
			$name = 'policy';
			echo get_template_part( $slug, $name );
			?>
        </div>
    </main>

<?php get_footer();
