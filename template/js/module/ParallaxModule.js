export default function ParallaxScroll() {
    let imgPrl = document.querySelectorAll(".decor-js img");
    let bgPrl = document.querySelectorAll(".decor-bg-js img");
    let rtPrl = document.querySelectorAll(".decor-rt-js img");
    let h = window.innerHeight;
    let w = window.innerWidth;
    if (imgPrl && window.innerWidth > 992) {
        window.addEventListener("scroll", () => {
            imgPrl.forEach((el) => {
                let pos = el.getBoundingClientRect().top;

                if (pos > -h / 2 && pos < h) {
                    let Y = (pos / h) * 100;

                    el.style.transform = `translateY(` + `${Y}` + `px)`;
                }
            });
        });
    }
    if (bgPrl && window.innerWidth > 992) {
        window.addEventListener("scroll", () => {
            bgPrl.forEach((el) => {
                let pos = el.getBoundingClientRect().top;

                if (pos > -w / 2 && pos < w) {
                    let x = (pos / w) * 200;
                    el.style.transform = `translateX(` + `${x}` + `px)`;

                }
            });
        });
    }
    if (rtPrl && window.innerWidth > 992) {
        window.addEventListener("scroll", () => {
            rtPrl.forEach((el) => {
                let pos = el.getBoundingClientRect().top;

                if (pos > -w / 2 && pos < w) {
                    let x = (pos / w) * 200;
                    el.style.transform = `rotate(` + `${x}` + `deg)`;

                }
            });
        });
    }
}