<?php

/**
 * Template name: Trang Giới Thiệu 
 * @author : Hy Hý
 */
get_header();
while (have_posts()) :
    the_post();
?>


    <main class="main">
        <div class="new">
            <section class="sec-bn">
                <?php get_template_part('partials/global/banners'); ?>
            </section>
            <div class="container">
                <?php get_template_part('partials/breadcrumb'); ?>
            </div>
            <?php
            Elements::Section('about/container')->Html();
            Elements::Section('about/policy-about')->Html();
            ?>

        </div>
    </main>
<?php
endwhile;
get_footer();
