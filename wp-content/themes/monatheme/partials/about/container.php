<?php

/**
 * Section name: About container
 * Description: 
 * Author: Monamedia
 * Order: 0
 */


?>
<section class="sec-about">
    <div class="about">
        <?php
        $true = get_field('m_about_tf');
        if ($true == true) {
            $group = get_field('mona_about_section_intro');

        ?>
            <div class="about-intro sec-pd8">
                <div class="container">
                    <?php if (!empty($group)) {

                    ?>
                        <div class="about-intro-row row">
                            <div class="about-intro-info col-7">
                                <div class="content">
                                    <h2 class="title blur mb4 load-img"><?php echo $group['intro_title']; ?></h2>
                                    <div class="desc" data-aos="fade-up">
                                        <div class="desc-txt mona-content">
                                            <?php echo $group['intro_description']; ?>
                                        </div>
                                    </div>
                                    <div class="about-intro-tag row" data-aos="fade-up">
                                        <?php
                                        if (!empty($group['intro_list'])) {
                                            foreach ($group['intro_list'] as $list) {
                                        ?>
                                                <div class="about-intro-item col-6">
                                                    <div class="inner">
                                                        <?php echo $list['intro_list_title']; ?>
                                                    </div>
                                                </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="about-intro-img col-5">
                                <div class="img">
                                    <div class="img-inner img-animated load-img">
                                        <?php if (!empty($group['intro_image'])) {
                                            echo wp_get_attachment_image($group['intro_image'], 'larger');
                                        } else {
                                            echo  '<img src="' . get_site_url() . '/template/assets/images/default-image.jpg" alt="">';
                                        }
                                        ?>
                                    </div>
                                    <span class="fake-layer"></span>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        <?php
        }
        ?>
        <?php
        $value_tit = get_field('m_about_value_title');
        $value_des = get_field('m_about_value_descript');
        $value_list = get_field('m_about_value_list');
        if (!empty($value_tit)) {
        ?>
            <div class="about-core sec-pd">
                <div class="container">
                    <h2 class="title blur load-img center"><?php echo $value_tit; ?></h2>
                    <p class="title-desc center blur load-img">
                        <?php echo $value_des; ?>
                    </p>
                    <?php
                    if (!empty($value_list)) {
                    ?>
                        <div class="about-core-block">
                            <?php
                            $value_i = 1;
                            foreach ($value_list as $value_list) {

                            ?>
                                <div class="about-core-item load-img">
                                    <div class="inner">
                                        <div class="img">
                                            <div class="img-inner">
                                                <?php if (!empty($value_list['m_about_value_list_image'])) {
                                                    echo wp_get_attachment_image($value_list['m_about_value_list_image'], 'larger');
                                                } else {
                                                    echo  '<img src="' . get_site_url() . '/template/assets/images/default-image.jpg" alt="">';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <div class="content-inner">
                                                <h3 class="tt"><?php echo $value_list['m_about_value_list_title']; ?></h3>
                                                <p class="desc">
                                                    <?php echo $value_list['m_about_value_list_descript']; ?>
                                                </p>
                                            </div>
                                            <div class="content-number">
                                                <div class="content-number-inner">
                                                    <?php if ($value_i > 9) {
                                                        echo $value_i;
                                                    } else {
                                                        echo '0' . $value_i;
                                                    } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mid">
                                            <div class="mid-inner"></div>
                                        </div>
                                        <div class="circle">
                                            <div class="circle-icon">
                                                <?php if (!empty($value_list['m_about_value_list_icon'])) {
                                                    echo wp_get_attachment_image($value_list['m_about_value_list_icon'], 'medium');
                                                } else {
                                                    echo  '<img src="' . get_site_url() . '/template/assets/images/default-image.jpg" alt="">';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                $value_i++;
                            }
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        <?php
        }
        ?>

        <?php
        $look_tit = get_field('m_about_look_title');
        $look_des = get_field('m_about_look_descript');
        $look_img = get_field('m_about_look_image');
        if (!empty($look_des)) {
        ?>
            <div class="about-banner">
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
                    <?php if (!empty($look_img)) {
                        echo wp_get_attachment_image($look_img, '1728x640');
                    } else {
                        echo  '<img src="' . get_site_url() . '/template/assets/images/default-image.jpg" alt="">';
                    }
                    ?>
                </div>
                <div class="about-banner-content">
                    <div class="container">
                        <div class="inner row" data-aos="fade-up">
                            <div class="inner-left col-3">
                                <h2 class="title white"><?php echo $look_tit; ?></h2>
                            </div>
                            <div class="inner-right col-9">
                                <p class="desc c-white">
                                    <?php echo $look_des; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
        <?php
        $commit_tit = get_field('m_about_commit_title');
        $commit_img = get_field('m_about_commit_image');
        $commit_list = get_field('m_about_commit_list');
        if (!empty($commit_list)) {
        ?>
            <div class="about-commit sec-pd8">
                <div class="container">
                    <h2 class="title blur center mb4 load-img"><?php echo $commit_tit; ?></h2>
                    <div class="about-commit-wr row">
                        <div class="about-commit-left col-7">
                            <div class="about-commit-collapse collapse-block">
                                <?php
                                foreach ($commit_list as $commit_list) {
                                ?>
                                    <div class="about-commit-item collapse-item" data-aos="fade-up">
                                        <div class="collapse-head">
                                            <span class="tt"><?php echo $commit_list['m_about_commit_list_title']; ?></span>
                                            <span class="icon"></span>
                                        </div>
                                        <div class="collapse-body">
                                            <p class="desc">
                                                <?php echo $commit_list['m_about_commit_list_descript']; ?>
                                            </p>
                                        </div>
                                    </div>
                                <?php
                                } ?>
                            </div>
                        </div>
                        <div class="about-commit-right col-5">
                            <div class="about-commit-img img-animated load-img">
                                <?php if (!empty($commit_img)) {
                                    echo wp_get_attachment_image($commit_img, 'larger');
                                } else {
                                    echo  '<img src="' . get_site_url() . '/template/assets/images/default-image.jpg" alt="">';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</section>