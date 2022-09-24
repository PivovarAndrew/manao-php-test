document.addEventListener("DOMContentLoaded", function (event) {
    $(document).on('click', '#sign-up-switch', () => {
        $('#auth_container').addClass("non-registered");
    });

    $(document).on('click', '#sign-in-switch', () => {
        $('#auth_container').removeClass("non-registered");
    });
});
