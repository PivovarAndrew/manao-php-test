function signUp(user) {
    console.log(user)
    $.ajax({
        url: 'controllers/users_controller.php',
        beforeSend: function (xhr) { xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content')) },
        type: 'POST',
        dataType: 'text',
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
            console.log(data)
            if ($('form', $('<div/>').html(data)).length > 0) {
                $('.sign-up-container').html(data)
            } else {
                $('body').html(data);
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
