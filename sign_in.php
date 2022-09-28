<?php
include_once 'helpers/session_helper.php';
?>

<form>
    <h2>Welcome back</h2>
    <input type="hidden" name="type" value="sign_in">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    <input type="text" name="sign_in_login" value="<?php echo $_SESSION['sign_in_login_value'] ?>" placeholder="Enter login">
    <?php echo flash('sign_in', 'login') ?>

    <input type="password" name="sign_in_password" value="<?php echo $_SESSION['sign_in_password_value'] ?>" placeholder="Enter password">
    <?php echo flash('sign_in', 'password') ?>

    <button type="submit" id="sign-in" class="submit">
        Sign in
    </button>
</form>