(function ($) {
    //Masks
    $('.phone-us-mask').mask('(000) 000-0000');

    //Btn resposible to open form div
    var form = $('#send-new-message-form');
    $('#btn-open-form').on('click', function () {
        form.removeClass('d-none');
    });

    $('#btn-close-form').on('click', function () {
        form.addClass('d-none');
    });


    var modalElement = document.getElementById('modal-details');
    var modal = new bootstrap.Modal(document.getElementById('modal-details'), []);
    $('.show-details').on('click', function (e) {
        e.preventDefault();

        var _this = $(this);

        var id = $(this).data('email-id');

        if (_this.data('loaded')) {
            modalElement.getElementsByClassName('modal-body')[0].innerHTML = _this.siblings('div').html();
            modal.show();
        }
        else {
            _this.prop('disabled', true);
            _this.html('Loading...');

            $.ajax({
                method: 'GET',
                url: 'index/show-details/' + id,
                type: 'html',
                success: function (html) {
                    $(html).insertAfter(_this);
                    _this.html('Details');
                    _this.prop('disabled', false);
                    _this.data('loaded', 'true');
                    modalElement.getElementsByClassName('modal-body')[0].innerHTML = _this.siblings('div').html();
                    modal.show();
                },
                error: function () {
                    alert('An unexpected error occurred, try restarting the page..');
                }
            });
        }
    });

})(jQuery);
