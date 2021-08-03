$(document).ready(function() {

    load_comment();

    // load comments//////////////////////////////////////////////////////
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
                    append('<div class="c" id="k"> <span onClick="myFunction(event)" id="click" class="cli"> click to toggle</span>\
                    <div id="hi" class="reply_box border p-2 mb-2">\
                            <h6 class="username border-bottom d-inline">' + value.user['name'] + '  : ' + '</h6> <span>' + value.cmt['date'] + '</span>\
                            <p class="para">' + value.cmt['comment'] + '</p>\
                            <button value="' + value.cmt['id'] + '" class="badge btn-warning reply_btn">Reply</button>\
                            <button value="' + value.cmt['id'] + '" class="badge btn-danger view_reply_btn">View Replies</button>\
                            <div class="ml-10 reply_section">\
                            </div>\
                        </div>\
                        </div>\
                        ');
                });

            }
        });
    }

    //  show reply form/////////////////////////////////
    $(document).on('click', '.reply_btn', function() {
        var thisClicked = $(this);
        var cmt_id = thisClicked;

        $('.reply_section').html("");
        thisClicked.closest('.reply_box').find('.reply_section').
        html('<input type="text" class="reply_msg form-control my-2" placeholder="Reply">\
                    <div class="text_end">\
                        <button class="btn btn-sm btn-primary reply_add_btn">Reply</button>\
                        <button class="btn btn-sm btn-danger reply_cancel_btn">Cancel</button>\
                    </div>');
    });

    // cancel      reply///////////////////////////////////////////////////////////////////
    $(document).on('click', '.reply_cancel_btn', function() {
        $('.reply_section').html("");
    });

    // add       reply///////////////////////////////////////////////////////////////////
    $(document).on('click', '.reply_add_btn', function(e) {
        e.preventDefault();

        var thisClicked = $(this);
        var cmt_id = thisClicked.closest('.reply_box').find('.reply_btn').val();
        var reply = thisClicked.closest('.reply_box').find('.reply_msg').val();


        var data = {
            'comment_id': cmt_id,
            'reply_msg': reply,
            'add_reply': true
        }

        $.ajax({
            type: "POST",
            url: "code.php",
            data: data,
            success: function(response) {
                alert(response);
                $('.reply_section').html("");

            }
        });

    });

    //  view replies/////////////////////////
    $(document).on('click', '.view_reply_btn', function(e) {
        e.preventDefault();

        var thisClicked = $(this);
        var cmt_id = thisClicked.val();

        $.ajax({
            type: "POST",
            url: "code.php",
            data: {
                'cmt_id': cmt_id,
                'view_comment_data': true
            },
            success: function(response) {
                console.log(response);

                $('.reply_section').html("");
                $.each(response, function(key, value) {

                    thisClicked.closest('.reply_box').find('.reply_section').
                    append('<div class="sub_reply_box border_bottom p-2 mb-2">\
                                <input type="hidden" class="get_username" value="' + value.user['name'] + '"/>\
                                <h6 class="username border-bottom d-inline">' + value.user['name'] + ' : ' + value.cmt['date_added'] + '</span>\
                                <p class="para">' + value.cmt['reply'] + '</p>\
                                <button value="' + value.cmt['comment_id'] + '" class="badge btn-warning sub_reply_btn">Reply</button>\
                                <div class="ml-10 sub_reply_section">\
                                </div>\
                            </div>\
                    ');
                })

            }
        });

    });


    // reply to a reply /////////////////////////////////
    $(document).on('click', '.sub_reply_btn', function(e) {
        e.preventDefault();
        var thisClicked = $(this);
        var cmt_id = thisClicked.val();
        var username = thisClicked.closest('.sub_reply_box').find('.get_username').val();


        $('.sub_reply_section').html("");
        thisClicked.closest('.sub_reply_box').find('.sub_reply_section').
        append('<div>\
               <input type="text" value="@' + username + ' " class="sub_reply_msg form-control my-2" placeholder="Reply">\
               </div>\
                    <div class="text_end">\
                        <button class="btn btn-sm btn-primary sub_reply_add_btn">Reply</button>\
                        <button class="btn btn-sm btn-danger sub_reply_cancel_btn">Cancel</button>\
                    </div>');
    });



    // submit  reply////////////////////

    $(document).on('click', '.sub_reply_add_btn', function(e) {
        e.preventDefault();
        var thisClicked = $(this);
        var cmt_id = thisClicked.closest('.sub_reply_box').find('.sub_reply_btn').val();
        var reply = thisClicked.closest('.sub_reply_box').find('.sub_reply_msg').val();


        var data = {
            'cmt_id': cmt_id,
            'reply_msg': reply,
            'add_subreplies': true
        }

        $.ajax({
            type: "POST",
            url: "code.php",
            data: data,
            success: function(response) {
                alert(response);
                $('.reply_section').html("");
            }
        })

    })


    // cancel reply///////////////////
    $(document).on('click', '.sub_reply_cancel_btn', function(e) {

        e.preventDefault();
        $('.sub_reply_section').html("");

    })




    //  add comments///////////////////
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

// toggle classlist

var myFunction = (e) => {
    var div = e.target.closest("#k").querySelector("#hi");
    div.classList.toggle("show");
}