export default function gallery() {
    $('.gallery').each(function () {
      const $this = $(this);
      const $item = $this.find('.gItem');
      $(function () {
        $this.lightGallery({
          selector: $item,
          thumbnail: true,
          zoom: true,
        });
      });
    });
  
    // lightGallery(document.querySelector('.gallery'), {
    //   selector: '.gItem',
    //   thumbnail: true,
    //       zoom: true,
    // });
  }
  