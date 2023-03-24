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
                            $.confirm({
                                title: result.data.title,
                                icon: 'fa fa-bell',
                                closeIcon: true,
                                content: result.data.message,
                                type: 'blue',
                                buttons: {
                                    tryAgain: {
                                        text: result.data.action.title,
                                        btnClass: 'btn-blue',
                                        action: function () {
                                            location.href = result.data.action.url;
                                        }
                                    },
                                    close: {
                                        text: result.data.action.title_close,
                                    }
                                },
                            });
                            loadProductCart();
                            $('#monaCartQty').html(result.data.cart_data.count);
                            $(document.body).trigger('wc_fragment_refresh');
                        }
                        loading.removeClass('loading');
                    } else {
                        $.confirm({
                            title: result.data.title,
                            icon: 'fa fa-bell',
                            closeIcon: true,
                            content: result.data.message,
                            type: 'red',
                            buttons: {
                                close: {
                                    text: result.data.title_close
                                }
                            }
                        });
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

    $(document).on('change', '.select-custom-main', function () {
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