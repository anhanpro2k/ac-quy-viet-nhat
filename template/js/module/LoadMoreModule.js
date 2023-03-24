export default function LoadMoreModule() {
    $(document).ready(function () {
        readMore($('.new-out-menu-list'), 13);

        function readMore(jObj, lineNum) {
            if (isNaN(lineNum)) {
                lineNum = 4;
            }
            var go = new ReadMore(jObj, lineNum);
        }

        //class
        function ReadMore(_jObj, lineNum) {
            var READ_MORE_LABEL = 'Xem thêm';
            var HIDE_LABEL = 'Thu gọn';

            var jObj = _jObj;
            var textMinHeight = '' + (parseInt(jObj.children('.new-out-menu-lists').css('line-height'), 10) * lineNum) + 'px';
            var textMaxHeight = '' + jObj.children('.new-out-menu-lists').css('height');

            jObj.children('.new-out-menu-lists').css('height', '' + textMaxHeight);
            jObj.children('.new-out-menu-lists').css('transition', 'height 1s');
            jObj.children('.new-out-menu-lists').css('height', '' + textMinHeight);

            jObj.append('<button class="btn-read">' + READ_MORE_LABEL + '</button>');

            jObj.children('.btn-read').click(function () {
                if (jObj.children('.new-out-menu-lists').css('height') === textMinHeight) {
                    jObj.children('.new-out-menu-lists').css('height', '' + textMaxHeight);
                    jObj.children('.btn-read').html(HIDE_LABEL).addClass('active');
                } else {
                    jObj.children('.new-out-menu-lists').css('height', '' + textMinHeight);
                    jObj.children('.btn-read').html(READ_MORE_LABEL).removeClass('active');
                }
            });

        }
    });
    $(document).ready(function () {
        const loadContainer = document.querySelectorAll(".load-container");
        if (loadContainer) {
            loadContainer.forEach((item) => {
                const loadNumberInit = parseInt(item.getAttribute("data-load-init"));
                const loadNumberSl = parseInt(item.getAttribute("data-load-sl"));
                const loadItems = item.querySelectorAll(".load-item");
                const loadBtn = item.querySelector(".load-btn");
                loadItems.forEach((item) => {
                    item.classList.add("load-hidden");
                });
                if (loadItems.length <= loadNumberInit) {
                    $(loadBtn).hide();
                }
                $(loadItems).slice(0, loadNumberInit).show();
                $(loadItems).slice(0, loadNumberInit).removeClass("load-hidden");
                $(loadBtn).on("click", function (e) {
                    e.preventDefault();
                    const loadItemsAffter = item.querySelectorAll(
                        ".load-item.load-hidden"
                    );
                    if ($(item.querySelectorAll(".load-item.load-hidden")).length !== 0) {
                        $(loadItemsAffter).slice(0, loadNumberSl).slideDown();
                        $(loadItemsAffter)
                            .slice(0, loadNumberSl)
                            .removeClass("load-hidden");
                    }
                    if ($(item.querySelectorAll(".load-item.load-hidden")).length == 0) {
                        loadBtn.classList.add(".load-collapse");
                        loadBtn.querySelector(".text").innerHTML = "Thu gọn";
                        loadBtn.classList.add('active')
                        if (loadItemsAffter.length == 0) {
                            $(loadItems).slice(loadNumberInit).slideUp();
                            loadItems.forEach((item) => {
                                item.classList.add("load-hidden");
                            });
                            $(loadItems).slice(0, loadNumberInit).removeClass("load-hidden");
                            loadBtn.querySelector(".text").innerHTML = "Xem thêm";
                            loadBtn.classList.remove('active')

                        }
                    }
                });
            });
        }
    });
}