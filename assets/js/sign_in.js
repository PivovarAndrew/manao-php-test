function signIn(user) {
    $.ajax({
        url: 'controllers/users_controller.php',
        beforeSend: function (xhr) { xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content')) },
        type: 'POST',
        dataType: 'text',
        data:
        {
            type: "sign_in",
            login: user.login,
            password: user.password
        },

        success(data) {
            console.log(data)
            if ($('form', $('<div/>').html(data)).length > 0) {
                $('.sign-in-container').html(data)
            } else {
                $('body').html(data);
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
