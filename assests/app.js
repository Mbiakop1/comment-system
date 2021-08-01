$(document).ready(function() {


    function load_comment() {
        $.ajax({
            type: "POST",
            url: "code.php",
            data: {
                "comment_load_data": true,
            },
            success: function(response) {
                $('.comment_container').htm("");
            }
        })
    }




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