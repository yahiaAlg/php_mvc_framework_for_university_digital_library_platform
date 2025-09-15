<link rel="stylesheet" href="/css/login.css">

<div class="login-container">
    <h2 class="login-title"><?php echo __('auth.login_title'); ?></h2>
    <form method="POST">
        <div class="form-group">
            <input type="email" name="email" class="form-input" placeholder="<?php echo __('auth.email'); ?>" required>
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-input" placeholder="<?php echo __('auth.password'); ?>" required>
        </div>
        <a href="#" class="forgot-password"><?php echo __('auth.forgotten_password'); ?></a>
        <button type="submit" class="login-button"><?php echo __('auth.login_button'); ?></button>
        <div class="signup-link">
            <?php echo __('auth.no_account'); ?> <a href="/register"><?php echo __('auth.apply_now'); ?></a>
        </div>
    </form>
</div>