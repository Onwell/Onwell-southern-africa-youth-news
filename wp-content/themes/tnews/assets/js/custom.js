(function ($) {
    "use strict";

    var page = 2;

    var $grid = $('.blog-posts').isotope({
        itemSelector: '.post',
    });

    var $loadmoreButton = $('.loadmore'); // Reference to the loadmore button

    $('body').on('click', '.loadmore', function() {
        $loadmoreButton.html('<i class="fa-solid fa-arrow-rotate-right fa-spin me-1"></i> Load More');
        $loadmoreButton.attr('disabled', 'disabled');

        var data = {
            'action': 'load_posts_by_ajax',
            'page': page,
            'security': blog.security
        };

        $.post(blog.ajaxurl, data, function(response) {
            if ($.trim(response) != '') {
                var $newItems = $(response);

                $('.blog-posts').append($newItems);
                $grid.isotope('insert', $newItems);
                
                // $grid.isotope({ filter: '*' });

                page++;

                $loadmoreButton.html('Load More');
                $loadmoreButton.removeAttr('disabled');
            } else {
                $loadmoreButton.hide();
            }
        });
    });


})(jQuery);