function signUp(user) {
    $.ajax({
        url: 'controllers/users_controller.php',
        beforeSend: function (xhr) { xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content')) },
        type: 'POST',
        dataType: 'json',
        data:
        {
            type: "sign_up",
            email: user.email,
            login: user.login,
            name: user.name,
            password: user.password,
            password_confirm: user.password_confirm
        },

        success(data) {
            if (data.success) {
                location.reload();
            } else {
                $('.sign-up-container').load(' .sign-up-container > *')
            }
        }
    });
    return false;
}

document.addEventListener("DOMContentLoaded", function (event) {
    $(document).on('click', '#sign-up', function (e) {
        e.preventDefault()
        signUp(getUserSignUpInfo())
    });
});
