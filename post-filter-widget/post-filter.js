
// send request
jQuery(document).ready(function($) {
    $('#filter-form').submit(function(event) {
        event.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            url: post_filter.ajax_url,
            type: 'POST',
            data: formData + '&action=filter_posts',
            success: function(response) {
               // $('#posts-container').html(response);
                $('#posts-container').replaceWith('<div id="posts-container">' + response + '</div>');
            }
        });
    });
});



