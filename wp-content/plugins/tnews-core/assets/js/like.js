jQuery(document).ready(function($) {
    $('.custom-like-button').on('click', function() {
        var post_id = $(this).data('post-id');
        var like_count_field = $('#custom-like-count');
        var liked_cookie_name = 'liked_post_' + post_id;

        if (!getCookie(liked_cookie_name)) {
            // Like the post
            $.ajax({
                type: 'POST',
                url: ajax_object.ajax_url,
                data: {
                    action: 'custom_like_action',
                    post_id: post_id,
                },
                success: function(response) {
                    like_count_field.text(response);
                    setCookie(liked_cookie_name, '1', 365); // Set the cookie for one year
                }
            });
        } else {
            // Unlike the post
            $.ajax({
                type: 'POST',
                url: ajax_object.ajax_url,
                data: {
                    action: 'custom_unlike_action',
                    post_id: post_id,
                },
                success: function(response) {
                    like_count_field.text(response);
                    deleteCookie(liked_cookie_name);
                }
            });
        }
    });

    function getCookie(name) {
        var value = "; " + document.cookie;
        var parts = value.split("; " + name + "=");
        if (parts.length === 2) return parts.pop().split(";").shift();
    }

    function setCookie(name, value, days) {
        var expires = new Date();
        expires.setTime(expires.getTime() + days * 24 * 60 * 60 * 1000);
        document.cookie = name + '=' + value + ';expires=' + expires.toUTCString() + ';path=/';
    }

    function deleteCookie(name) {
        var expires = new Date();
        expires.setTime(expires.getTime() - 1);
        document.cookie = name + '=;expires=' + expires.toUTCString() + ';path=/';
    }
});