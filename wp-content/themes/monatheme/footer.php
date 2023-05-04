<!-- footer -->
<footer class="footer">
    <?php
    $mail_title   = mona_get_option('section_info_footer_title');
    $mail_content = mona_get_option('section_info_footer_content');
    $mail_code    = mona_get_option('section_info_footer_code');
    if (!empty($mail_code)) {
    ?>
        <div class="footer-top">
            <div class="container">
                <div class="footer-top-wr">
                    <div class="footer-top-regis">
                        <p class="tt"><?php echo $mail_title; ?></p>
                        <p class="desc">
                            <?php echo $mail_content; ?>
                        </p>
                    </div>
                    <div class="footer-top-input">
                        <?php echo do_shortcode($mail_code); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom-wr">
                <div class="footer-logo">
                    <?php echo get_custom_logo(); ?>
                </div>
                <?php
                $footer_title   = mona_get_option('section_info_title');
                $footer_phone   = mona_get_option('section_info_phone');
                $footer_address = mona_get_option('section_info_address');
                $footer_email   = mona_get_option('section_info_email');
                $footer_time    = mona_get_option('section_info_time');
                if (!empty($footer_title)) {
                ?>
                    <div class="footer-list row">
                        <div class="footer-item col">
                            <p class="footer-item-tt"><?php echo $footer_title; ?></p>
                            <ul class="address">
                                <li class="address-item">
                                    <p class="tt"><?php _e('Điện thoại', 'monamedia'); ?>:</p>
                                    <div class="address-link mona-content">
                                        <?php echo $footer_phone; ?>
                                    </div>
                                </li>
                                <li class="address-item">
                                    <p class="tt"><?php _e('Địa chỉ', 'monamedia'); ?>:</p>
                                    <div class="desc">
                                        <?php echo $footer_address; ?>
                                    </div>
                                </li>
                                <li class="address-item">
                                    <p class="tt"><?php _e('Email', 'monamedia'); ?>:</p>
                                    <div class="desc">
                                        <?php echo $footer_email; ?>
                                    </div>
                                </li>
                                <li class="address-item">
                                    <p class="tt"><?php _e('Giờ làm việc', 'monamedia'); ?>:</p>
                                    <div class="desc">
                                        <?php echo $footer_time; ?>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="footer-item col">
                            <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar_menu_sp')) : ?>
                            <?php endif; ?>
                        </div>
                        <div class="footer-item col">
                            <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar_menu_pol')) : ?>
                            <?php endif; ?>
                            <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar_menu_service')) : ?>
                            <?php endif; ?>
                        </div>
                        <div class="footer-item col">
                            <p class="footer-item-tt"><?php _e('Fanpage', 'monamedia'); ?></p>
                            <div class="footer-final">
                                <?php
                                $footer_frame_fb = mona_get_option('section_social_footer_iframe_fb');
                                if (!empty($footer_frame_fb)) {
                                ?>
                                    <div class="footer-iframe">
                                        <?php echo $footer_frame_fb; ?>
                                    </div>
                                <?php } ?>
                                <ul class="footer-social">
                                    <?php
                                    $footer_fb_link = mona_get_option('section_social_footer_link');
                                    $footer_fb_img  = mona_get_option('section_social_footer_img');
                                    if (!empty($footer_fb_link)) {
                                    ?>
                                        <li class="footer-social-item">
                                            <a target="_blank" href="<?php echo $footer_fb_link; ?>" class="footer-social-link">
                                                <img src="<?php echo $footer_fb_img; ?>" alt="">
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php
                                    $footer_ins_link = mona_get_option('section_social_footer_link_2');
                                    $footer_ins_img  = mona_get_option('section_social_footer_img_2');
                                    if (!empty($footer_ins_link)) {
                                    ?>
                                        <li class="footer-social-item">
                                            <a target="_blank" href="<?php echo $footer_ins_link; ?>" class="footer-social-link">
                                                <img src="<?php echo $footer_ins_img; ?>" alt="">
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php
                                    $footer_tw_link = mona_get_option('section_social_footer_link_3');
                                    $footer_tw_img  = mona_get_option('section_social_footer_img_3');
                                    if (!empty($footer_tw_link)) {
                                    ?>
                                        <li class="footer-social-item">
                                            <a target="_blank" href="<?php echo $footer_tw_link; ?>" class="footer-social-link">
                                                <img src="<?php echo $footer_tw_img; ?>" alt="">
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                                <?php
                                $footer_img_pg = mona_get_option('section_social_footer_img_pg');
                                if (!empty($footer_img_pg)) {
                                ?>
                                    <a class="footer-note">
                                        <img src="<?php echo $footer_img_pg; ?>" alt="">
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <?php
            $copy     = mona_get_option('section_info_copy');
            $copy_img = mona_get_option('section_info_copy_img');
            if (!empty($copy_img)) {
            ?>
                <div class="footer-copyright">
                    <!-- <p class="txt"><?php echo $copy; ?></p> -->
                    <span class="icon">
                        <img src="<?php echo $copy_img; ?>" alt="">
                    </span>
                </div>
            <?php } ?>
        </div>
    </div>
</footer>

<div class="back-to-top backToTop">
    <div class="triangle"></div>
    <div class="triangle"></div>
    <div class="triangle"></div>
</div>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v16.0" nonce="gYJ4L8Ou"></script>
<script src="<?php echo get_site_url(); ?>/template/js/library/jquery/jquery.js"></script>
<script src="<?php echo get_site_url(); ?>/template/js/library/swiper/swiper-bundle.min.js"></script>
<script src="<?php echo get_site_url(); ?>/template/js/library/aos/aos.js"></script>
<script src="<?php echo get_site_url(); ?>/template/js/library/select2/select2.min.js"></script>
<script src="<?php echo get_site_url(); ?>/template/js/library/magnific/jquery.magnific-popup.min.js"></script>
<script src="<?php echo get_site_url(); ?>/template/js/library/gallery/lightgallery-all.min.js"></script>
<script src="<?php echo get_site_url(); ?>/template/js/library/jquery/jquery-migrate.js"></script>
<script src="<?php echo get_site_url(); ?>/template/js/library/isotope/isotope.pkgd.min.js"></script>
<script src="<?php echo get_site_url(); ?>/template/js/library/datetime/moment.min.js"></script>
<script src="<?php echo get_site_url(); ?>/template/js/library/datetime/daterangepicker.min.js"></script>
<script src="<?php echo get_site_url(); ?>/template/js/library/smoothscroll/SmoothScroll.min.js"></script>
<script src="<?php echo get_site_url(); ?>/template/js/library/scrollreveal/scrollreveal.js"></script>
<script src="<?php echo get_site_url(); ?>/template/js/library/datepicker/jquery-ui.js"></script>
<script src="<?php echo get_site_url(); ?>/template/js/main.js" type="module"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<?php wp_footer(); ?>
</body>

</html>