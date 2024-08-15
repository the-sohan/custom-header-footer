jQuery(document).ready(function($) {
    $('.sehf-toggle').on('change', function() {
        var postId = $(this).data('post-id');
        var isChecked = $(this).is(':checked');

        $.ajax({
            url: sehfAjax.ajax_url,
            type: 'POST',
            data: {
                action: 'sehf_toggle_template_status',
                post_id: postId,
                _ajax_nonce: sehfAjax.nonce
            },
            success: function(response) {
                if (response.success) {
                    // Handle success response
                    console.log('Status updated: ' + response.data.status);
                } else {
                    console.error('Error: ' + response.data);
                }
            }
        });
    });
});
