$(document).ready(function () {
//when user clicks on like button-
    $('.like-btn').on('click', function () {
        var post_id = $(this).data('id');
        var user_id = userId;
        $clicked_btn = $(this);

        if ($clicked_btn.hasClass('bi-hand-thumbs-up')) {
            action = 'like';
        } else if ($clicked_btn.hasClass('bi-hand-thumbs-up-fill')) {
            action = 'unlike';
        }
        $.ajax({
            url: 'server.php',
            type: 'post',
            data: {
                'action': action,
                'post_id': post_id,
                'user_id': user_id
            },
            success: function (data) {
                res=JSON.parse(data);
                if (action == 'like') {
                    $clicked_btn.removeClass('bi-hand-thumbs-up');
                    $clicked_btn.addClass('bi-hand-thumbs-up-fill');
                } else if (action == 'unlike') {
                    $clicked_btn.removeClass('bi-hand-thumbs-up-fill');
                    $clicked_btn.addClass('bi-hand-thumbs-up');
                }
                //displaying number of likes and dislikes
                $clicked_btn.siblings('span.likes').text(res.likes);
                $clicked_btn.siblings('span.dislikes').text(res.dislikes);   
                
                //changing button styles for previously clicked buttons
                $clicked_btn.siblings('i.bi-hand-thumbs-down-fill').removeClass('bi-hand-thumbs-down-fill').addClass('bi-hand-thumbs-down');
                
               
            }


        })
    });

//when user clicks on dislike button-
    $('.dislike-btn').on('click', function () {
        var post_id = $(this).data('id');
        var user_id = userId;
        $clicked_btn = $(this);

        if ($clicked_btn.hasClass('bi-hand-thumbs-down')) {
            action = 'dislike';
        } else if ($clicked_btn.hasClass('bi-hand-thumbs-down-fill')) {
            action = 'undislike';
        }
        $.ajax({
            url: 'server.php',
            type: 'post',
            data: {
                'action': action,
                'post_id': post_id,
                'user_id': user_id
            },
            success: function (data) {
                res=JSON.parse(data);
                if (action == 'dislike') {
                    $clicked_btn.removeClass('bi-hand-thumbs-down');
                    $clicked_btn.addClass('bi-hand-thumbs-down-fill');
                } else if (action == 'undislike') {
                    $clicked_btn.removeClass('bi-hand-thumbs-down-fill');
                    $clicked_btn.addClass('bi-hand-thumbs-down');
                }
                //displaying number of likes and dislikes
                $clicked_btn.siblings('span.likes').text(res.likes);
                $clicked_btn.siblings('span.dislikes').text(res.dislikes);    
               
                //changing styles for previously reacted post

                $clicked_btn.siblings('i.bi-hand-thumbs-up-fill').removeClass('bi-hand-thumbs-up-fill').addClass('bi-hand-thumbs-up');
            }


        })
    });

});