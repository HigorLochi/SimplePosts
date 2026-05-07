function deleteUser(id) {
    if (!confirm('Are you sure you want to delete this user?')) {
        return;
    }

    $.ajax({
        url: '?controller=user&action=delete',
        type: 'POST',
        data: { id: id },

        success: function () {
            window.location.reload();
        },

        error: function () {
            alert('Error deleting user');
        }
    });
}