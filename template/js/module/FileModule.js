export default function FileModule() {
    const uploadFile = document.querySelector("#re-form-upload")
    if (uploadFile) {
        $(".re-form-image").fadeOut();

        function removeFile(index) {
            const dt = new DataTransfer()
            const input = document.getElementById('re-form-upload')
            const { files } = input

            for (let i = 0; i < files.length; i++) {
                const file = files[i]
                if (index !== i)
                    dt.items.add(file)
            }

            input.files = dt.files;
            console.log(uploadFile.files)
        }
        uploadFile.addEventListener('change', (e) => {
            $('.re-form-image').fadeOut();
            $('.cmt-image-item').remove();
            const inputFile = uploadFile.files;
            let length_file = inputFile.length;
            if (length_file == 0) {
                $(".re-form-image").fadeOut();
            } else {
                $(".re-form-image").fadeIn();

            }
            for (var i = 0; i < length_file; i++) {
                (function(i) {
                    var FR = new FileReader();
                    FR.onload = function(e) {
                        $(".re-form-image .cmt-image-list").append('<div class="cmt-image-item col"> <div class="cmt-image-img"><img src="' + e.target.result + '" alt=""><i class="fas fa-times cmt-image-delete" data-id="' + i + '"></i>  </div></div>');
                        $(".account-info-ava-change").append('<img src="' + e.target.result + '" alt="">');

                        $('.cmt-image-delete').on('click', function(event) {
                            event.preventDefault()
                            let id = $(this).attr('data-id')
                            removeFile(id)
                        })
                    };
                    FR.readAsDataURL(inputFile[i]);
                })(i);
            }
            console.log(inputFile)

        })
        document.addEventListener('click', (e) => {
            const cmtImageItems = document.querySelectorAll('.re-form-image .cmt-image-item')
            const iconDeletes = e.target.closest('.cmt-image-img i');
            if (iconDeletes) {
                iconDeletes.parentElement.parentElement.remove();
                if (cmtImageItems.length <= 1) {
                    $(".re-form-image").fadeOut();
                }
                removeFile(parseInt(iconDeletes.getAttribute("data-id")))
            }

        })

    }
}