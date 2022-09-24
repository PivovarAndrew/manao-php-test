function getUserSignUpInfo() {
    return {
        email: $('input[name="sign_up_email"]').val(),
        login: $('input[name="sign_up_login"]').val(),
        name: $('input[name="sign_up_name"]').val(),
        password: $('input[name="sign_up_password"]').val(),
        password_confirm: $('input[name="sign_up_password_confirm"]').val()
    }
}

function getUserSignInInfo() {
    return {
        login: $('input[name="sign_in_login"]').val(),
        password: $('input[name="sign_in_password"]').val()
    }
}
