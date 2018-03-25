$(document).ready(function () {
    var $body = $('body'),
        $alertBox = null,
        $content = $('#content'),
        $form = $content.find('#profileform');


    //IE doen't like that fadein
    if (!$.browser.msie) $body.fadeTo(0, 0.0).delay(100).fadeTo(1000, 1);

    $("input").uniform();


    $form.wl_Form({
        method: 'post',
        ajax: true,
        dataType: 'json',
        status: false,
        confirmSend: false,
        onRequireError: function (element) {
        },
        onValidError: function (element) {
        },
        onPasswordError: function (element) {
        },
        onFileError: function (element) {
        },
        onBeforeSubmit: function (data) {
        },
        onSuccess: function (data, status, xhr) {
            if (data.ok == 1) {
                alert("Your profile data has been saved.")
                document.location.href = '/members/dashboard';
            }
            else {
                if ($alertBox) {
                    try {
                        $alertBox.wl_Alert('close');
                    }
                    catch (r) {
                    }

                }
                $alertBox = $.wl_Alert(data.error, 'warning', '#content', null, {speed: 1});
            }
        }
    });


});