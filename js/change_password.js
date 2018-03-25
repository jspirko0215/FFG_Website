$(document).ready(function () {

    var $body = $('body'),
        $alertBox = null,
        $content = $('#content'),
        $form = $content.find('#changepasswordform');

    //IE doen't like that fadein
    if (!$.browser.msie) $body.fadeTo(0, 0.0).delay(100).fadeTo(1000, 1);

    // $("input[type=text]").uniform();


    $form.wl_Form({
        method: 'post',
        ajax: true,
        serialize: false,
        parseQuery: true,
        dataType: 'json',
        status: true,
        sent: false,
        confirmSend: false,
        tooltip: {
            gravity: 'nw'
        },
        onRequireError: function (element) {
            console.log(element)
        },
        onValidError: function (element) {
            console.log(element)
        },
        onPasswordError: function (element) {
            console.log(element)
        },
        onFileError: function (element) {
            console.log(element)
        },
        onBeforeSubmit: function (data) {
            console.log(data)
        },
        onSuccess: function (data, status, xhr) {
            console.log(data)
            if (data.ok == 1) {
                alert("Password successful changed");
                document.location.href = '/members/login';
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