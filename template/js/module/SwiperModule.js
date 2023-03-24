export default function SwiperModule() {
    var policySwiper = new Swiper(".policy-wr .swiper", {
        slidesPerView: 1,
        spaceBetween: 0,
        pagination: {
            el: ".policy-wr .swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            0: {
                slidesPerView: 1,
                spaceBetween: 8,
            },
            600: {
                slidesPerView: 2,
                spaceBetween: 16,
            },
            800: {
                slidesPerView: 3,
                spaceBetween: 16,
            },
            1200: {
                slidesPerView: 4,
                spaceBetween: 24,
            }
        }
    });

    var homebannerSwiper = new Swiper(".about-banner.homepage .swiper", {
        effect: "fade",
        navigation: {
            nextEl: ".about-banner.homepage .swiper-button-next",
            prevEl: ".about-banner.homepage .swiper-button-prev",
        },
    });


    var homebrandSwiper = new Swiper(".home-brand-swiper .swiper", {
        slidesPerView: 4,
        spaceBetween: 30,
        pagination: {
            el: ".home-brand-swiper .swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            0: {
                slidesPerView: 1,
                spaceBetween: 8,
            },
            320: {
                slidesPerView: 2,
                spaceBetween: 16,
            },
            600: {
                slidesPerView: 3,
                spaceBetween: 16,
            },
            1200: {
                slidesPerView: 4,
                spaceBetween: 24,
            }
        }
    });

    var homeprodSwiper = new Swiper(".home-prod-swiper .swiper", {
        slidesPerView: 3,
        spaceBetween: 30,
        pagination: {
            el: ".home-prod-swiper .swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl:".home-prod-ctr .btn-next",
            prevEl:".home-prod-ctr .btn-prev"
        },
        breakpoints: {
            0: {
                slidesPerView: 1,
                spaceBetween: 8,
            },
            450: {
                slidesPerView: 2,
                spaceBetween: 16,
            },
            600: {
                slidesPerView: 3,
                spaceBetween: 16,
            },
            1000: {
                slidesPerView: 4,
                spaceBetween: 16,
            },
            1200: {
                slidesPerView: 5,
                spaceBetween: 24,
            }
        }
    });
}