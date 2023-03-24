export default function CountUpModule() {
  // $(document).ready(function () {
  //   $('.as-number .count').counterUp({
  //     delay: 5,
  //     time: 3000
  //   });
  // });

  let a = 0;
  let counterBlock = document.querySelector(".counter-js");
  if (counterBlock) {
    let oTop = counterBlock.offsetTop - window.innerHeight;
    $(window).on("scroll", function () {
      if (a == 0 && $(window).scrollTop() > oTop) {
        console.log($(".numb-count").attr("data-count"));
        $(".numb-count").each(function () {
          let $this = $(this),
            countTo = $this.attr("data-count");
          $({
            countNum: $this.text(),
          }).animate(
            {
              countNum: countTo,
            },

            {
              duration: 2000,
              easing: "swing",
              step: function () {
                $this.text(Math.floor(this.countNum) < 10 ? `0${Math.floor(this.countNum)}` : `${Math.floor(this.countNum)}`);
              },
              complete: function () {
                $this.text(Math.floor(this.countNum) < 10 ? `0${Math.floor(this.countNum)}` : `${Math.floor(this.countNum)}`);
              },
            }
          );
        });
        a = 1;
      }
    });
  } else {
    return;
  }
}