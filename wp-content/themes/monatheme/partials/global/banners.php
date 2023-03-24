<?php

$m_banner = get_field('m_banner_image_global');
?>
<div class="banner">
    <div class="banner-img load-img">
        <?php if (!empty($m_banner)) {
            echo wp_get_attachment_image($m_banner, '1728x460');
        } else {
            echo  '<img src="' . get_site_url() . '/template/assets/images/default-image.jpg" alt="">';
        }
        ?>
    </div>
    <div class="container">
        <div class="banner-wr">
            <div class="banner-content">
                <h1 class="title blur white load-img">
                    <?php the_title(); ?>
                </h1>
            </div>
        </div>
    </div>
</div>