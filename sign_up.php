<?php
include_once 'helpers/session_helper.php';
?>

<form>
    <h2>Welcome</h2>
    <input type="hidden" name="type" value="sign_up">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    <input type="email" name="sign_up_email" value="<?php echo $_SESSION['sign_up_email_value'] ?>" placeholder="Enter email">
    <?php echo flash('sign_up', 'email') ?>

    <input type="text" name="sign_up_login" value="<?php echo $_SESSION['sign_up_login_value'] ?>" placeholder="Enter login">
    <?php echo flash('sign_up', 'login') ?>

    <input type="text" name="sign_up_name" value="<?php echo $_SESSION['sign_up_name_value'] ?>" placeholder="Enter name">
    <?php echo flash('sign_up', 'name') ?>

    <input type="password" name="sign_up_password" value="<?php echo $_SESSION['sign_up_password_value'] ?>" placeholder="Enter password">
    <?php echo flash('sign_up', 'password') ?>

    <input type="password" name="sign_up_password_confirm" value="<?php echo $_SESSION['sign_up_password_confirm_value'] ?>" placeholder="Confirm your password">
    <?php echo flash('sign_up', 'password_confirm') ?>

    <button type="submit" name="submit" id="sign-up" class="submit">
        Sign up
    </button>
</form>