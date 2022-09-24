function logout() {
    $.ajax({
        url: 'controllers/users_controller.php',
        beforeSend: function (xhr) { xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content')) },
        type: 'DELETE',
        success(data) {
            $('body').html(data);
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
