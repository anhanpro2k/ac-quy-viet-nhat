export default function MonaCreateModuleAccount() {
    // submit form login
    $(document).on('submit', '#formLogin', function (e) {
        e.preventDefault();
        var $this = $(this);
        let loading = $this.find('button');
        var $form = $this.serialize();
        if (!loading.hasClass('loading')) {
            $.ajax({
                url: mona_ajax_url.ajaxURL,
                type: 'post',
                data: {
                    action: 'mona_ajax_custommer_login',
                    form: $form,
                },
                error: function (request) {
                    loading.removeClass('loading');
                },
                beforeSend: function () {
                    $('.mona-error').fadeOut();
                    loading.addClass('loading');
                },
                success: function (result) {
                    if (result.success) {

                        if (result.data.redirect != '') {
                            window.location.href = result.data.redirect;
                        } else {
                            window.location.reload();
                        }

                    } else {

                        if (result.data.title) {

                            $.confirm({
                                title: result.data.title,
                                icon: 'fa fa-bell',
                                closeIcon: false,
                                content: result.data.message,
                                type: 'red',
                                buttons: {
                                    close: {
                                        text: result.data.title_close,
                                    }
                                },
                            });

                        } else {

                            if (result.data.error) {

                                $.each(result.data.error, function (key, val) {
                                    $('.' + key).html(val);
                                    $('.' + key).fadeIn();
                                });

                            }

                        }

                    }
                    loading.removeClass('loading');
                }
            });
        }

    });
    // submit form register
    $(document).on('submit', '#formRegister', function (e) {
        e.preventDefault();
        var $this = $(this);
        let loading = $this.find('button');
        var $form = $this.serialize();
        if (!loading.hasClass('loading')) {
            $.ajax({
                url: mona_ajax_url.ajaxURL,
                type: 'post',
                data: {
                    action: 'mona_ajax_custommer_register',
                    form: $form,
                },
                error: function (request) {
                    loading.removeClass('loading');
                },
                beforeSend: function () {
                    $('.mona-error').fadeOut();
                    loading.addClass('loading');
                },
                success: function (result) {

                    if (result.success) {

                        // if (result.data.redirect != '') {
                        //     $('#registerUser #registerSuccess').attr('href', result.data.redirect);
                        //     $('#registerUser').addClass('open');
                        // }
                        if (result.data.redirect != '') {
                            window.location.href = result.data.redirect;
                        } else {
                            window.location.reload();
                        }

                    } else {

                        if (result.data.title) {

                            $.confirm({
                                title: result.data.title,
                                icon: 'fa fa-bell',
                                closeIcon: false,
                                content: result.data.message,
                                type: 'red',
                                buttons: {
                                    close: {
                                        text: result.data.title_close,
                                    }
                                },
                            });

                        } else {

                            if (result.data.error) {

                                $.each(result.data.error, function (key, val) {
                                    $('.' + key).html(val);
                                    $('.' + key).fadeIn();
                                });

                            }

                        }
                    }

                    loading.removeClass('loading');
                }
            });
        }
    });

    // update user
    $(document).on('submit', '#formUser', function (e) {
        e.preventDefault();
        var $this = $(this);
        var form = $this.serialize();
        var loading = $this.find('button');
        var form_wrap = $this.find('.account-infor')
        var form_data = new FormData();
        form_data.append('action', 'mona_ajax_update_account');
        if ($('.upload-image').prop('files').length > 0) {
            var file_data = $('.upload-image').prop('files')[0];
            form_data.append('user_avatar', file_data);
        }
        form_data.append('formdata', form);
        if (!$this.hasClass('loading')) {
            $.ajax({
                url: mona_ajax_url.ajaxURL,
                contentType: false,
                processData: false,
                type: 'post',
                data: form_data,
                error: function (request) {
                    $('.mona-notice').remove();
                    loading.removeClass('loading');
                },
                beforeSend: function (response) {
                    $('.mona-notice').remove();
                    loading.addClass('loading');
                },
                success: function (result) {
                    if (result.success) {

                        // $('.mona-notice.success').html(result.data.message);
                        form_wrap.after('<div class="mona-notice success">' + result.data.message + '</div>');

                    } else {
                        if (result.data.title) {

                            $.confirm({
                                title: result.data.title,
                                icon: 'fa fa-bell',
                                closeIcon: false,
                                content: result.data.message,
                                type: 'red',
                                buttons: {
                                    close: {
                                        text: result.data.title_close,
                                    }
                                },
                            });

                        } else {
                            if (result.data.error) {
                                $.each(result.data.error, function (key, val) {
                                    $('.' + key).html(val);
                                    $('.' + key).fadeIn();
                                });
                            }
                        }
                    }

                    loading.removeClass('loading');
                }
            });
        }
    });

    // change pass
    $(document).on('submit', '#formChangePass', function (e) {
        e.preventDefault();
        var $this = $(this);
        var form_wrap = $this.find('.account-infor');
        var loading = $this.find('button');
        var formdata = $this.serialize();
        if (!loading.hasClass('loading')) {
            $.ajax({
                url: mona_ajax_url.ajaxURL,
                type: 'post',
                data: {
                    action: 'mona_ajax_user_change_password',
                    formdata: formdata,
                },
                error: function (request) {
                    $('.mona-notice').remove();
                    loading.removeClass('loading');
                },
                beforeSend: function () {
                    $('.mona-notice').remove();
                    loading.addClass('loading');

                },
                success: function (result) {
                    if (result.success) {
                        form_wrap.after('<div class="mona-notice success">' + result.data.message + '</div>');
                        if (result.data.redirect) {
                            window.location.href = result.data.redirect;
                        }
                    } else {
                        form_wrap.after('<div class="mona-error mona-notice error">' + result.data.message + '</div>');
                    }
                    loading.removeClass('loading');
                }
            });
        }
    });


    //Check password
    $(document).ready(function () {
        $("#formRegister #password").on("keyup", function () {
            var password = $(this).val();

            $(".mona-error-user-pass-length").removeClass("hidden");
            $(".mona-error-user-pass-upper-case").removeClass("hidden");
            $(".mona-error-user-pass-numberic").removeClass("hidden");
            $(".mona-error-user-pass-special").removeClass("hidden");


            if (password.length < 8) {
                $(".mona-error-user-pass-length").addClass("mona-error");
            } else {
                $(".mona-error-user-pass-length").removeClass("mona-error");
            }

            if (!/[A-Z]/.test(password)) {
                $(".mona-error-user-pass-upper-case").addClass("mona-error");
            } else {
                $(".mona-error-user-pass-upper-case").removeClass("mona-error hidden");
            }

            if (!/\d/.test(password)) {
                $(".mona-error-user-pass-numberic").addClass("mona-error");
            } else {
                $(".mona-error-user-pass-numberic").removeClass("mona-error hidden");
            }

            if (!/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
                $(".mona-error-user-pass-special").addClass("mona-error");
            } else {
                $(".mona-error-user-pass-special").removeClass("mona-error hidden");
            }
        });

        // Password field
        var passwordField = $('input[name="password"]');
        var passwordNoteList = $('.mona-password');

        passwordField.keyup(function () {
            var passwordVal = passwordField.val();

            // Check password field condition
            var hasMinLength = passwordVal.length >= 8;
            var hasUpperCase = /[A-Z]/.test(passwordVal);
            var hasNumeric = /\d/.test(passwordVal);
            var hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(passwordVal);

            // Update note list
            passwordNoteList.find('.mona-error-user-pass-length').toggleClass('mona-error', !hasMinLength);
            passwordNoteList.find('.mona-error-user-pass-upper-case').toggleClass('mona-error', !hasUpperCase);
            passwordNoteList.find('.mona-error-user-pass-numberic').toggleClass('mona-error', !hasNumeric);
            passwordNoteList.find('.mona-error-user-pass-special').toggleClass('mona-error', !hasSpecialChar);
        });

// New password field
        var newPasswordField = $('input[name="new_password"]');
        var newPasswordNoteList = $('.mona-password');

        newPasswordField.keyup(function () {
            var newPasswordVal = newPasswordField.val();

            // Check new password field condition
            var hasMinLength = newPasswordVal.length >= 8;
            var hasUpperCase = /[A-Z]/.test(newPasswordVal);
            var hasNumeric = /\d/.test(newPasswordVal);
            var hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(newPasswordVal);

            // Update note list
            newPasswordNoteList.find('.mona-error-user-pass-length').toggleClass('mona-error', !hasMinLength);
            newPasswordNoteList.find('.mona-error-user-pass-upper-case').toggleClass('mona-error', !hasUpperCase);
            newPasswordNoteList.find('.mona-error-user-pass-numberic').toggleClass('mona-error', !hasNumeric);
            newPasswordNoteList.find('.mona-error-user-pass-special').toggleClass('mona-error', !hasSpecialChar);

            // Show note list
            if (newPasswordVal.length > 0) {
                newPasswordNoteList.css('display', 'flex');
            } else {
                newPasswordNoteList.css('display', 'none');
            }
        });
// New password field
        var renewPasswordField = $('input[name="renew_password"]');
        var renewPasswordNoteList = $('.mona-re-password');

        renewPasswordField.keyup(function () {
            var renewPasswordVal = renewPasswordField.val();

            // Check new password field condition
            var hasMinLength = renewPasswordVal.length >= 8;
            var hasUpperCase = /[A-Z]/.test(renewPasswordVal);
            var hasNumeric = /\d/.test(renewPasswordVal);
            var hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(renewPasswordVal);

            // Update note list
            renewPasswordNoteList.find('.mona-error-user-pass-length').toggleClass('mona-error', !hasMinLength);
            renewPasswordNoteList.find('.mona-error-user-pass-upper-case').toggleClass('mona-error', !hasUpperCase);
            renewPasswordNoteList.find('.mona-error-user-pass-numberic').toggleClass('mona-error', !hasNumeric);
            renewPasswordNoteList.find('.mona-error-user-pass-special').toggleClass('mona-error', !hasSpecialChar);

            // Show/hide note list
            if (renewPasswordVal.length > 0) {
                renewPasswordNoteList.css('display', 'flex');
            } else {
                renewPasswordNoteList.css('display', 'none');
            }
        });


        $("#formRegister #password").on("keyup", function () {
            var password = $(this).val();

            $(".mona-error-user-pass-length").removeClass("hidden");
            $(".mona-error-user-pass-upper-case").removeClass("hidden");
            $(".mona-error-user-pass-numberic").removeClass("hidden");
            $(".mona-error-user-pass-special").removeClass("hidden");


            if (password.length < 8) {
                $(".mona-error-user-pass-length").addClass("mona-error");
            } else {
                $(".mona-error-user-pass-length").removeClass("mona-error");
            }

            if (!/[A-Z]/.test(password)) {
                $(".mona-error-user-pass-upper-case").addClass("mona-error");
            } else {
                $(".mona-error-user-pass-upper-case").removeClass("mona-error hidden");
            }

            if (!/\d/.test(password)) {
                $(".mona-error-user-pass-numberic").addClass("mona-error");
            } else {
                $(".mona-error-user-pass-numberic").removeClass("mona-error hidden");
            }

            if (!/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
                $(".mona-error-user-pass-special").addClass("mona-error");
            } else {
                $(".mona-error-user-pass-special").removeClass("mona-error hidden");
            }
        });
    });
}