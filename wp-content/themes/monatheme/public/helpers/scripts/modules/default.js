export default function MonaCreateModuleDefault() {
    let number_min = $(".m-quantity-cart-item").attr("min");
    let number_max = $(".m-quantity-cart-item").attr("max");
    $(document).on("click", ".count-minus", function (e) {
        e.preventDefault();
        let parent = $(this).closest(".quantity");
        var numberMain = parent.find(".count-number");
        if (numberMain) {
            let input_number = parent.find(".qty"),
                number = input_number.val();
            if (parseInt(number) > parseInt(number_min)) {
                number--;
                input_number.val(number);
                numberMain.html(number < 10 && number > 0 ? `0${number}` : number);
            }
            $('.woocommerce-cart-form .btn-update').removeAttr("disabled");
            $('.woocommerce-cart-form .btn-update').attr("aria-disabled", "false");
        }

    });

    $(document).on("click", ".count-plus", function (e) {
        e.preventDefault();
        let parent = $(this).closest(".quantity");
        var numberMain = parent.find(".count-number");

        if (numberMain) {
            let input_number = parent.find(".qty"),
                number = input_number.val();
            if (parseInt(number) < parseInt(number_max)) {
                number++;
                input_number.val(number);
                numberMain.html(number < 10 && number > 0 ? `0${number}` : number);
            }
            $('.woocommerce-cart-form .btn-update').removeAttr("disabled");
            $('.woocommerce-cart-form .btn-update').attr("aria-disabled", "false");
        }
    });

    $('.select').select2();


    $('body.woocommerce-cart').on('click', '.count-btn', function (e) {
        e.preventDefault();
        $('[name="update_cart"]').removeAttr('disabled');
        // $('[name="update_cart"]').removeClass('button');
        $('[name="update_cart"]').attr('clicked', true);
        $(document.body).trigger('wc_fragment_refresh');
    });

    $('body.woocommerce-cart').on('click', '[name="update_cart"]', function (e) {
        e.preventDefault();
        $(this).trigger('submit');
    });

    // Gọi API thành phố
    $(document).ready(function (e) {
        // e.preventDefault();
        $.ajax({
            url: `https://provinces.open-api.vn/api/p/`,
            method: "GET",
            timeout: 0,
            success: function (result) {
                // let districts = result.districts;
                // console.log(result);
                let html = `<option value="" disabled="" selected="" class="disable">Thành phố</option>`;
                jQuery.each(result, function (e, i) {
                    html += `<option value="${i.name}" data-code="${i.code}">${i.name}</option>`;
                });

                $("#billing_state").html(html);

                // // $('#m-ward').html(<option value="" disabled="" selected="" class="disable">${mona_ajax_url.txt.ChoiceWard}</option>);

            },
            error: function (error) {
                $("#billing_city")
                    .closest(".f-group")
                    .html(
                        `<input type="text" class="f-control" required placeholder="Quận / Huyện" name="_district" value="">`
                    );
                // $('#m-ward').closest('.f-group').html(<input type="text" class="f-control" required placeholder="${mona_ajax_url.txt.ChoiceWard}" name="_ward" value="">);
            }
        });
    });

    // Gọi API Quận
    $("#billing_state").on("change", function (e) {
        let code = $(this).find("option:selected").attr("data-code");
        $.ajax({
            url: `https://provinces.open-api.vn/api/p/${code}?depth=2`,
            method: "GET",
            timeout: 0,
            success: function (result) {
                let districts = result.districts;
                let html = `<option value="" disabled="" selected="" class="disable">Quận / Huyện</option>`;
                jQuery.each(districts, function (e, i) {
                    html += `<option value="${i.name}" data-code="${i.code}">${i.name}</option>`;
                });
                $("#billing_city").html(html);
                $("#billing_country").html(
                    `<option value="" disabled="" selected="" class="disable">Quận / Huyện</option>`
                );
            },
            error: function (error) {
                $("#billing_city")
                    .closest(".f-group")
                    .html(
                        `<input type="text" class="f-control" required placeholder="Quận / Huyện" name="_district" value="">`
                    );
                $("#billing_country")
                    .closest(".f-group")
                    .html(
                        `<input type="text" class="f-control" required placeholder="Quận / Huyện" name="_ward" value="">`
                    );
            }
        });
    });

    $("#billing_city").on("change", function (e) {
        let code = $(this).find("option:selected").attr("data-code");
        $.ajax({
            url: `https://provinces.open-api.vn/api/d/${code}?depth=2`,
            method: "GET",
            timeout: 0,
            success: function (result) {
                let wards = result.wards;
                let html = `<option value="" disabled="" selected="" class="disable">Phường / Xã</option>`;
                jQuery.each(wards, function (e, i) {
                    html += `<option value="${i.name}" data-code="${i.code}">${i.name}</option>`;
                });
                var parent = $("#billing_country").closest('.woocommerce-input-wrapper');
                parent.html('<select name="billing_country" id="billing_country" class="m-select">' + html + '</select>');
                $(document).ready(function () {
                    $('.m-select').select2();
                });
            },
            error: function (error) {
                $("#billing_country")
                    .closest(".f-group")
                    .html(
                        `<input type="text" class="f-control" required placeholder="Phường / Xã" name="_ward" value="">`
                    );
            }
        });
    });

    // var choose_bank = document.querySelector('#bank-choose');
    // var check1 = document.querySelector('.wc_payment_method.payment_method_cod');
    // var check2 = document.querySelector('.wc_payment_method.payment_method_bacs');
    // // Thêm sự kiện click vào button1
    // check1.addEventListener('click', function () {
    //     // Ẩn phần tử box1
    //     choose_bank.style.display = 'none';
    // });

    // // Thêm sự kiện click vào button2
    // check2.addEventListener('click', function () {
    //     // Hiện phần tử box1
    //     choose_bank.style.display = 'block';
    // });
    // const showTransfer = document.querySelector(".wrapper-transfer .wrapper-transfer-item")
    // const transfer = document.querySelector(".transfer .recheck-item.active")
    // const cash = document.querySelector(".cash")
    // if (transfer) {
    //     showTransfer.classList.add('active')
    // } else {
    //     showTransfer.classList.remove('active')
    // }

    $('.recheck-input').on("click", function (e) {
        e.preventDefault();
        if ($(this)[0].checked = true) {
            console.log('1');
        } else {
            console.log('0');
        }
    });

    // function refrestjs() {
    //     const showTransfer = document.querySelector(".wrapper-transfer-item")
    //     const transfer = document.querySelector(".transfer")
    //     const cash = document.querySelector(".cash")
    //     if (transfer) {

    //         showTransfer.classList.add('active')

    //     }
    // }

    $(document).on("change", ".wc_payment_method input", function (e) {
        e.preventDefault();
        let val_payment_method = $(this).val();
        console.log(val_payment_method);
        if (val_payment_method == "bacs") {
            $('.wrapper-transfer-item').addClass("active");
            let tab = document.querySelectorAll('.tabJS');
            if (tab) {
                tab.forEach((t) => {
                    let tBtn = t.querySelectorAll('.tabBtn');
                    let tPanel = t.querySelectorAll('.tabPanel');
                    let tLink = t.querySelectorAll('.tabLink');
        
                    // for tab
                    if (tBtn.length !== 0 && tPanel.length === tBtn.length) {
                        tBtn[0].classList.add('active');
                        // tPanel[0].classList.add('open');
                        // if(tLink[0]) {
                        //     tLink[0].classList.add('open');
                        // }
        
                        for (let i = 0; i < tBtn.length; i++) {
                            tBtn[i].addEventListener('click', showPanel);
        
                            function showPanel(e) {
                                // e.preventDefault();
                                for (let a = 0; a < tBtn.length; a++) {
                                    tBtn[a].classList.remove('active');
                                    tPanel[a].classList.remove('open');
                                    console.log(tPanel[a])
                                    if(tLink[a]) {
                                        tLink[a].classList.remove('open');
                                    }
                                }
                                tBtn[i].classList.add('active');
                                tPanel[i].classList.add('open');
                                // if(tLink[i]) {
                                //     tLink[i].classList.add('open');
                                // }
                            }
                        }
                    }
                });
            }
        } else {
            $('.wrapper-transfer-item').removeClass("active");
        }
    });

}
