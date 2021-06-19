$(document).ready(function () {
    let url = null;
    let data = [];
    let form = null;
    let comments = null;
    $('.card-modal').click(function () {
        comments = $('#task-id' + this.id).find('.comments');
        form = $('#task-id' + this.id).find('form');
        url = form.attr('action');
    });
    $(".sendComment").on('click', function () {
        data['comment'] = form.find('.comment').val();
        if (form.find('.comment').val() != '') {
            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'JSON',
                data: {comment: data['comment']},    // <-- Added data property
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                }
            });
        }
        form.find('.comment').val('');
    });

    var refresh = setInterval(function (event) {
        if (url != null) {
            $.get(url + '/getComment', function (response) {
                comments.html(response);
            });
        }
    }, 500);

});
