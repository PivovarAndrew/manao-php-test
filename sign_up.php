<?php
include_once 'helpers/session_helper.php';
?>

<form>
    <h2>Welcome</h2>
    <input type="hidden" name="type" value="sign_up">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    <input type="email" name="sign_up_email" value="<?php echo $_SESSION['email_value'] ?>" placeholder="Enter email">
    <?php echo flash('email') ?>

    <input type="text" name="sign_up_login" value="<?php echo $_SESSION['login_value'] ?>" placeholder="Enter login">
    <?php echo flash('login') ?>

    <input type="text" name="sign_up_name" value="<?php echo $_SESSION['name_value'] ?>" placeholder="Enter name">
    <?php echo flash('name') ?>

    <input type="password" name="sign_up_password" value="<?php echo $_SESSION['password_value'] ?>" placeholder="Enter password">
    <?php echo flash('password') ?>

    <input type="password" name="sign_up_password_confirm" value="<?php echo $_SESSION['password_confirm_value'] ?>" placeholder="Confirm your password">
    <?php echo flash('password_confirm') ?>

    <button type="submit" name="submit" id="sign-up" class="submit">
        Sign up
    </button>
</form>