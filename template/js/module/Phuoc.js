export default function PhuocModule() {
    const swipperThumb = document.querySelector(".chitiet-sanpham")
    if (swipperThumb) {
        var galleryThumbs = new Swiper('.gallery-thumbs', {
            spaceBetween:10,
            slidesPerView: 3,
            freeMode: true,
            loopedSlides: 3,
            direction: 'horizontal',
            breakpoints: { 
              500: {
                direction: "horizontal",
                spaceBetween: 6,
                slidesPerView: 5,
              },
              1199: {
                direction: "vertical",
                spaceBetween:15,
                slidesPerView: 5,
              },
            }
          });
          var galleryTop = new Swiper('.gallery-top', {
            spaceBetween: 10,
            loopedSlides: 5, 
            navigation: {
              nextEl: '.swiper-button-next',
              prevEl: '.swiper-button-prev',
            },
            thumbs: {
              swiper: galleryThumbs,
            },
          });
    }
    
    const related= document.querySelector(".related-products")
    if (related) {
      var relatedSwiper = new Swiper(".related-swiper.swiper", {
        slidesPerView: 1,
        spaceBetween: 0,
        pagination: {
            el: ".swiper-pagination",
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
                slidesPerView: 5,
                spaceBetween: 10,
            }
        }
      });

    }

    const showTransfer = document.querySelector(".wrapper-transfer-item")
    const transfer = document.querySelector(".transfer")
    const cash = document.querySelector(".cash")
    if(transfer) {
      transfer.addEventListener('click', () => {
        showTransfer.classList.add('active')
      })
      cash.addEventListener('click', () => {
        showTransfer.classList.remove('active')
      })
    }
}