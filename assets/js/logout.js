function logout() {
    $.ajax({
        url: 'controllers/users_controller.php',
        beforeSend: function (xhr) { xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content')) },
        type: 'DELETE',
        success(_data) {
            location.reload();
        }
    });
    return false;
}

document.addEventListener("DOMContentLoaded", function (event) {
    $(document).on('click', '#logout', function (e) {
        e.preventDefault()
        logout()
    });
});
