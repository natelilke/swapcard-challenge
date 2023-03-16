(function ($) {
    //Masks
    $('.phone-us-mask').mask('(000) 000-0000');

    //Btn resposible to open form div
    var form = $('#send-new-message-form');
    $('#btn-open-form').click(function () {
        form.removeClass('d-none');
    });

    $('#btn-close-form').click(function () {
        form.addClass('d-none');
    });

})(jQuery);
