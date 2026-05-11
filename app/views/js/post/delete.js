function deletePost(id) {
    if (!confirm('Are you sure you want to delete this post?')) {
        return;
    }

    $.ajax({
        url: '?controller=post&action=delete',
        type: 'POST',
        data: { id: id },

        success: function () {
            window.location.reload();
        },

        error: function () {
            alert('Error deleting post');
        }
    });
}