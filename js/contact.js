$(function () {

    // window.verifyRecaptchaCallback = function (response) {
    //     $('input[data-recaptcha]').val(response).trigger('change')
    // }
    //
    // window.expiredRecaptchaCallback = function () {
    //     $('input[data-recaptcha]').val("").trigger('change')
    // }

    // Validate form contents
    $('#contact-form').validator();

    console.log('validated');


    $('#contact-form').on('submit', function (e) {
        if (!e.isDefaultPrevented()) {
            var url =  $(form).attr('action')
            var data = $(this).serializeArray();
            console.log(url);
            $.ajax({
                type: "POST",
                url: url,
                data: $(this).serializeArray(),
                success: function (data) {
                    console.log(data.message)
                    // var messageAlert = 'alert-' + data.type;
                    // var messageText = data.message;
                    // console.log(messageText);
                    // // var alertBox = '<div class="alert ' + messageAlert + ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + messageText + '</div>';
                    // if (messageAlert && messageText) {
                    //     // $('#contact-form').find('.messages').html(alertBox);
                    //     $('#contact-form').reset();
                    //     // grecaptcha.reset();
                    // }
                }
            });
            return false;
        }
    })
});
