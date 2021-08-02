$(document).ready(function() {

    load_comment();

    function load_comment() {
        $.ajax({
            type: "POST",
            url: "code.php",
            data: {
                "comment_load_data": true
            },
            success: function(response) {
                $('.comment_container').html("");
                console.log(response);
                $.each(response, function(key, value) {

                    $('.comment_container').
                    append('<div class="reply_box border p-2 mb-2">\
                            <h6 class="username border-bottom d-inline">' + value.user['name'] + '  : ' + '</h6> <span>' + value.cmt['date'] + '</span>\
                            <p class="para">' + value.cmt['comment'] + '</p>\
                            <button value="' + value.cmt['id'] + '" class="badge btn-warning reply_btn">Reply</button>\
                            <button value="' + value.cmt['id'] + '" class="badge btn-danger view_reply_btn">View Replies</button>\
                            <div class="ml-4 reply_section">\
                            </div>\
                        </div>\
                        ');
                });

            }
        });
    }

    $(document).on('click', '.reply_btn', function() {
        var thisClicked = $(this);
        var cmt_id = thisClicked;

        $('.reply_section').html("");
        thisClicked.closest('.reply_box').find('.reply_section').
        html('<input type="text" class="reply_msg form-control my-2" placeholder="Reply">\
                    <div class="text_end">\
                        <button class="btn btn-sm btn-primary reply_add_btn">Reply</button>\
                        <button class="btn btn-sm btn-danger reply_add_cancel">Cancel</button>\
                    </div>');
    });



    $('.add_comment_btn').click(function(e) {
        e.preventDefault();

        var msg = $('.comment_textbox').val();
        if ($.trim(msg).length == 0) {
            error_msg = "Please type comment";
            $('#error_status').text(error_msg);
        } else {
            error_msg = "";
            $('#error_status').text(error_msg);
        }

        if (error_msg == "") {
            var data = {
                'msg': msg,
                'add_comment': true,
            }

            $.ajax({
                type: "POST",
                url: "code.php",
                data: data,
                success: function(response) {
                    alert(response);
                    $('.comment_textbox').val("");
                }
            })

        } else {
            return false;
        }
    });
});