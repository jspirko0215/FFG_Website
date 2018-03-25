$(document).ready(function () {

    var $body = $('body'),
        $content = $('#content'),
        $form = $content.find('#loginform');

    //IE doen't like that fadein
    if (!$.browser.msie) $body.fadeTo(0, 0.0).delay(100).fadeTo(1000, 1);

    $("input").uniform();

    $form.wl_Form({
        status: false,
        ajax: true,
        dataType: 'json',
        confirmSend: false,
        onBeforeSubmit: function (data) {
            $form.wl_Form('set', 'sent', false);
            if (data.login && data.password) {
                $form.submit();
            } else {
                $.wl_Alert('Please fill the form!', 'note', '#content');
                return false;
            }


        },
        onSuccess: function (data, status, xhr) {
            if (data.ok == 1) {
                document.location.href = '/members/dashboard';
            }
            else {
                $.wl_Alert(data.error, 'warning', '#content');
            }
        }
    });


});