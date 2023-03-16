(function ($) {
    var form = $('#send-new-message-form');

    //Btn resposible to open form div
    $('#btn-open-form').click(function () {
        form.removeClass('d-none');
    });

    $('#btn-close-form').click(function () {
        form.addClass('d-none');
    });

})(jQuery);
