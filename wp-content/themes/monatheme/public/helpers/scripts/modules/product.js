import Select2Module from "/template/js/module/Select2Module.js";

function AlertCustom(type = 'success', title = "", desc = '') {
    if (type == "error") {
        var icon_alert = '<i class="m-css-icon fas fa-times-circle"></i>';
        var title = title != "" ? title : "Lỗi";
        var desc = desc != "" ? desc : "Đã xảy ra lỗi nghiệm trọng";
    } else if (type == "warning") {
        var icon_alert = '<i class="m-css-icon  fas fa-exclamation-circle"></i>';
        var title = title != "" ? title : "Cảnh báo";
        var desc = desc != "" ? desc : "Vui lòng kiểm tra lại";
    } else {
        var icon_alert = '<i class="m-css-icon fas fa-check-circle"></i>';
        var title = title != "" ? title : "Thành công";
        var desc = desc != "" ? desc : "Hành động đã thành công";
    }
    var html_default = `
            <div class="alert showAlert show ${type}">
                <div class="msg-icon">${icon_alert}</div>
                <div class="msg-info">
                <span class="msg">
                <span class="m-bold-text">${title}</span>
                <span class="m-main-text"> ${desc}</span>
                </span>
                </div>
                <div class="close-btn">
                <span class="fas fa-times"></span>
                </div>
            </div>
        `;
    let check_empty = jQuery('.alert').hasClass('show');

    if (!check_empty) {
        $("body").append(html_default);
        setTimeout(function () {
            jQuery('.alert').removeClass("show");
            jQuery('.alert').addClass("hide");
            setTimeout(() => {
                jQuery('.alert').remove();
            }, 1000);
        }, 3000);
    }

    jQuery('.close-btn').click(function () {
        jQuery('.alert').removeClass("show");
        jQuery('.alert').addClass("hide");
        setTimeout(() => {
            jQuery('.alert').remove();
        }, 1000);
    });
}

export default function MonaCreateModuleProduct() {

    $(document).ready(function () {
        $('.cate-prod-filtbar-item').on('click', function () {
            var name = $(this).find('.cate-prod-filtbar-link').data('name');
            var value = $(this).find('.cate-prod-filtbar-link').data('value');
            $('input[name="sort"]').val(value);
        });
    });

    function AddToCart(formdata, act, loading) {
        if (!loading.hasClass('loading')) {
            $.ajax({
                url: mona_ajax_url.ajaxURL,
                type: 'post',
                data: {
                    action: 'mona_ajax_add_to_cart',
                    formdata: formdata,
                    type: act
                },
                error: function (request) {
                    loading.removeClass('loading');
                },
                beforeSend: function (response) {
                    loading.addClass('loading');
                },
                success: function (result) {
                    if (result.success) {
                        if (act == 'buy_now' && result.data.redirect) {
                            window.location.href = result.data.redirect;
                        } else {
                            // $.confirm({
                            //     title: result.data.title,
                            //     icon: 'fa fa-bell',
                            //     closeIcon: true,
                            //     content: result.data.message,
                            //     type: 'blue',
                            //     buttons: {
                            //         tryAgain: {
                            //             text: result.data.action.title,
                            //             btnClass: 'btn-blue',
                            //             action: function () {
                            //                 location.href = result.data.action.url;
                            //             }
                            //         },
                            //         close: {
                            //             text: result.data.action.title_close,
                            //         }
                            //     },
                            // });
                            AlertCustom('success', result.data.action.title, result.data.message);
                            loadProductCart();
                            $('#monaCartQty').html(result.data.cart_data.count);
                            $(document.body).trigger('wc_fragment_refresh');
                        }
                        loading.removeClass('loading');
                    } else {
                        // $.confirm({
                        //     title: result.data.title,
                        //     icon: 'fa fa-bell',
                        //     closeIcon: true,
                        //     content: result.data.message,
                        //     type: 'red',
                        //     buttons: {
                        //         close: {
                        //             text: result.data.title_close
                        //         }
                        //     }
                        // });
                        AlertCustom('error', result.data.action.title, result.data.message);

                        loading.removeClass('loading');
                    }
                }
            });

        }
    }

    // AJAX LOAD LẠI GIỎ HÀNG
    function loadProductCart() {
        var $this = $(this);
        var act = $this.data('act');
        var loading = $('.widget_shopping_cart_content.is-loading-group');
        if (!loading.hasClass('loading')) {
            $.ajax({
                url: mona_ajax_url.ajaxURL,
                type: 'post',
                data: {
                    action: 'mona_ajax_loading_cart',
                    type: act
                },
                error: function (request) {
                    loading.removeClass('loading');
                },
                beforeSend: function (response) {
                    loading.addClass('loading');
                },
                success: function (result) {
                    if (result.success) {

                        if (result.data.cart_html) {
                            $('.header-cart-box  .widget_shopping_cart_content.is-loading-group').html(result.data.cart_html);
                        }

                        loading.removeClass('loading');

                    }
                    loading.removeClass('loading');
                }
            });

        }
    }


    // AJAX LOAD PAGE SẢN PHẨM
    $(document).on('click', '.cate-block-check-item.recheck-item,.mona-filter .cate-prod-filtbar-link', function (e) {
        e.preventDefault();
        var $this = $(this);
        var $recheckInput = $this.find('.recheck-input');
        if ($recheckInput.prop('checked')) {
            // nếu input đã được chọn trước đó
            $recheckInput.prop('checked', false);
        } else {
            // nếu input chưa được chọn trước đó
            $recheckInput.prop('checked', true);
        }

        if ($this.hasClass('cate-prod-filtbar-link')) {
            $('.cate-prod-filtbar-link.active').removeClass('active');
            $(this).addClass('active');
        }

        var formdata = $this.closest('#mona-form-product').serialize();
        var loading = $('#monaProductsList');
        if (!loading.hasClass('loading')) {
            $.ajax({
                url: mona_ajax_url.ajaxURL,
                type: 'post',
                data: {
                    action: 'mona_ajax_pagination_products',
                    formdata: formdata,
                },
                error: function (request) {
                    loading.removeClass('loading');
                },
                beforeSend: function (response) {
                    loading.addClass('loading');
                },
                success: function (result) {
                    if (result.success) {

                        if (result.data.products_html) {
                            $('#monaProductsList').html(result.data.products_html);
                        }

                        loading.removeClass('loading');

                    }
                    loading.removeClass('loading');
                }
            });
        }

    });

    $(document).on('click', '.pagination-products-ajax a.page-numbers', function (e) {
        e.preventDefault();
        var $this = $(this);
        var hrefThis = $this.attr('href');
        var paged = hrefThis.match(/\d+/);
        if (!paged) {
            paged = 1;
        } else {
            paged = paged[0];
        }

        var formdata = $this.closest('#mona-form-product').serialize();
        var loading = $('#monaProductsList');
        if (!loading.hasClass('loading')) {
            $.ajax({
                url: mona_ajax_url.ajaxURL,
                type: 'post',
                data: {
                    action: 'mona_ajax_pagination_products',
                    formdata: formdata,
                    paged: paged
                },
                error: function (request) {
                    loading.removeClass('loading');
                },
                beforeSend: function (response) {
                    loading.addClass('loading');
                },
                success: function (result) {
                    if (result.success) {

                        if (result.data.products_html) {
                            $('#monaProductsList').html(result.data.products_html);
                        }

                        loading.removeClass('loading');

                    }
                    loading.removeClass('loading');
                }
            });
        }

    });

    $(document).on('click', '.mona-add-to-cart-list', function (e) {
        e.preventDefault();
        var $this = $(this);
        if ($this.closest('.frmAddProductCart').length) {
            var formdata = $this.closest('.frmAddProductCart').serialize();
        } else if ($('.frmAddProductCart').length) {
            var formdata = $('.frmAddProductCart').serialize();
        } else {
            var formdata = $this.closest('form').serialize();
        }

        console.log(formdata);

        var act = $this.data('act');
        var loading = $this;
        AddToCart(formdata, act, loading);
    });

    $(document).on('click', '.mona-add-to-cart-detail', function (e) {
        e.preventDefault();
        var $this = $(this);
        if ($this.closest('#frmAddProduct').length) {
            var formdata = $this.closest('#frmAddProduct').serialize();
        } else if ($('#frmAddProduct').length) {
            var formdata = $('#frmAddProduct').serialize();
        } else {
            var formdata = $this.closest('#frmAddProduct').serialize();
        }

        var act = $this.data('act');
        var loading = $this;
        AddToCart(formdata, act, loading);
    });

    $(document).on('click', '.mona-buy-now', function (e) {

        e.preventDefault();
        var $this = $(this);
        if ($this.closest('#frmAddProduct').length) {
            var formdata = $this.closest('#frmAddProduct').serialize();
        } else if ($('#frmAddProduct').length) {
            var formdata = $('#frmAddProduct').serialize();
        } else {
            var formdata = $this.closest('#frmAddProduct').serialize();
        }

        var act = 'buy_now';
        var loading = $this;
        AddToCart(formdata, act, loading);
    });

    $(document).on('change', '.select-custom-main', function (e) {
        e.preventDefault();
        var $this = $(this);
        var formdata = $this.closest('#mona-home-product-filter').serialize();
        var loading = $('#mona-home-product-filter .row.is-loading-group');


        var selectedFilter = $this.attr('name');

        if (!loading.hasClass('loading')) {
            $.ajax({
                url: mona_ajax_url.ajaxURL,
                type: 'post',
                data: {
                    action: 'mona_ajax_loading_filter',
                    formdata: formdata,
                    filter: selectedFilter,
                },
                error: function (request) {
                    loading.removeClass('loading');
                },
                beforeSend: function (response) {
                    loading.addClass('loading');
                },
                success: function (result) {
                    if (result.success) {
                        if (result.data.products_html) {
                            $('#mona-home-product-filter .is-loading-group').html(result.data.products_html);
                        }
                        loading.removeClass('loading');

                    }
                    Select2Module();
                    loading.removeClass('loading');
                }
            });
        }
    });
    // $(document).on('click', '.mona-add-to-cart-detail', function (e) {
    //     e.preventDefault();
    //     var $this = $(this);
    //     if ($this.closest('.frmAddProduct').length) {
    //         var formdata = $this.closest('.frmAddProduct').serialize();
    //     } else if ($('.frmAddProduct').length) {
    //         var formdata = $('.frmAddProduct').serialize();
    //     } else {
    //         var formdata = $this.closest('form').serialize();
    //     }
    //
    //     var act = $this.data('act');
    //     var loading = $this;
    //     AddToCart(formdata, act, loading);
    // });

}