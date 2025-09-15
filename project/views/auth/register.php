<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Rubik", "sans-serif";
    }

    body {
        background-color: #414040;
        color: #fafafa;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }

    .register-container {
        width: 100%;
        max-width: 500px;
        background-color: #eee;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
    }

    .register-title {
        font-family: "Rubik", "sans-serif";
        font-size: 30px;
        font-weight: 700;
        color: #666;
        margin-bottom: 40px;
        text-align: center;
        letter-spacing: 0.5px;
    }

    .form-row {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
    }

    .form-row .form-group {
        flex: 1;
        margin-bottom: 0;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-input,
    .form-select {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
        background-color: white;
    }

    .form-input:focus,
    .form-select:focus {
        outline: none;
        border-color: #b52626;
    }

    .register-button {
        background-color: #555;
        color: #ddd;
        border: none;
        padding: 15px 30px;
        margin: 15px auto;
        font-size: 18px;
        font-weight: 400;
        border-radius: 25px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        display: block;
    }

    .register-button:hover {
        background-color: #333;
    }

    .signin-link {
        text-align: center;
        font-size: 14px;
        color: #666;
    }

    .signin-link a {
        color: #666;
        text-decoration: none;
    }

    .signin-link a:hover {
        text-decoration: underline;
        color: #b52626;
    }

    .footer,
    .footer-bottom {
        background-color: transparent;
        width: 100%;
    }

    /* RTL Support */
    .rtl .register-container {
        text-align: right;
    }

    .rtl .register-title {
        text-align: center;
    }

    .rtl .form-input,
    .rtl .form-select {
        text-align: right;
        direction: rtl;
    }

    .rtl .form-input::placeholder {
        text-align: right;
    }

    .rtl .form-row {
        flex-direction: row-reverse;
    }

    .rtl .signin-link {
        text-align: center;
    }

    @media (max-width: 768px) {
        .register-container {
            max-width: 400px;
            padding: 30px;
        }

        .form-row {
            flex-direction: column;
            gap: 0;
        }

        .form-row .form-group {
            margin-bottom: 20px;
        }

        .rtl .form-row {
            flex-direction: column;
        }
    }
</style>

<div class="register-container">
    <h2 class="register-title"><?php echo __('auth.register_title'); ?></h2>
    <form method="POST">
        <div class="form-group">
            <input type="text" name="full_name" class="form-input" placeholder="<?php echo __('auth.full_name'); ?>" required>
        </div>
        <div class="form-row">
            <div class="form-group">
                <input type="text" name="username" class="form-input" placeholder="<?php echo __('auth.username'); ?>" required>
            </div>
            <div class="form-group">
                <input type="email" name="email" class="form-input" placeholder="<?php echo __('auth.email'); ?>" required>
            </div>
        </div>
        <div class="form-group">
            <select name="specialization_id" class="form-select" required>
                <option value=""><?php echo __('auth.select_specialization'); ?></option>
                <?php foreach ($specializations as $spec): ?>
                    <option value="<?php echo $spec['id']; ?>"><?php echo $view->escape($spec['name']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-input" placeholder="<?php echo __('auth.password'); ?>" required>
        </div>
        <button type="submit" class="register-button"><?php echo __('auth.register_button'); ?></button>
        <div class="signin-link">
            <?php echo __('auth.have_account'); ?> <a href="/login"><?php echo __('auth.sign_in'); ?></a>
        </div>
    </form>
</div>