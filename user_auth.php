<div id="auth_container">
    <div class="form-container sign-up-container">
        <?php include_once 'sign_up.php'; ?>
    </div>

    <div class="form-container sign-in-container">
        <?php include_once 'sign_in.php'; ?>
    </div>

    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <button class="overlay-btn" id="sign-in-switch">Sign In</button>
            </div>
            
            <div class="overlay-panel overlay-right">
                <button class="overlay-btn" id="sign-up-switch">Sign Up</button>
            </div>
        </div>
    </div>
</div>