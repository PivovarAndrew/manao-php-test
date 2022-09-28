function signIn(user) {
    $.ajax({
        url: 'controllers/users_controller.php',
        beforeSend: function (xhr) { xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content')) },
        type: 'POST',
        dataType: 'json',
        data:
        {
            type: "sign_in",
            login: user.login,
            password: user.password
        },

        success(data) {
            if (data.success) {
                location.reload();
            } else {
                $('.sign-in-container').load(' .sign-in-container > *')
            }
        },
    });
    return false;
}

document.addEventListener("DOMContentLoaded", function (event) {
    $(document).on('click', '#sign-in', function (e) {
        e.preventDefault()
        signIn(getUserSignInInfo())
    });
});
