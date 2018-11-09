jQuery(document).ready(function ($) {
    $('#notify-subscribers').on('click', function (e) {
        e.preventDefault();
        var post_id = $(this).data('postid');
        $.ajax({
            url: ajaxurl,
            data: {
                action: 'vd_notify_subscribers',
                post_id: post_id
            },
            type: "POST",
            beforeSend: function(){
                $('#notify-subscribers').hide();
            }
        }).done(function (answer) {
            console.log(answer);            
            $('#response').show();
        }).fail(function (xhr, status, error) {
            var err = xhr.responseText;
            console.log(err);
        });
    });
});