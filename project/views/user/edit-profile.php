<!-- Main content for edit profile template -->
<style>
    .edit-profile-section {
        background-color: #414040;
        min-height: calc(100vh - 200px);
        padding: 50px 20px;
        color: #fafafa;
    }

    .edit-profile-container {
        max-width: 600px;
        margin: 0 auto;
        background-color: #eee;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
        color: #333;
    }

    .edit-profile-title {
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

    .form-label {
        display: block;
        font-weight: 600;
        color: #555;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
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

    .password-section {
        background-color: #f8f8f8;
        padding: 20px;
        border-radius: 6px;
        margin-bottom: 20px;
        border-left: 4px solid #b52626;
    }

    .password-section h3 {
        font-size: 18px;
        color: #555;
        margin-bottom: 15px;
    }

    .password-note {
        font-size: 14px;
        color: #666;
        margin-bottom: 15px;
        font-style: italic;
    }

    .form-actions {
        display: flex;
        gap: 15px;
        justify-content: center;
        margin-top: 30px;
    }

    .save-btn {
        background-color: #b52626;
        color: #ddd;
        border: none;
        padding: 15px 30px;
        font-size: 16px;
        font-weight: 400;
        border-radius: 25px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .save-btn:hover {
        background-color: #8d1d1d;
    }

    .cancel-btn {
        background-color: #555;
        color: #ddd;
        border: none;
        padding: 15px 30px;
        font-size: 16px;
        font-weight: 400;
        border-radius: 25px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .cancel-btn:hover {
        background-color: #333;
        color: #ddd;
    }

    @media (max-width: 768px) {
        .edit-profile-container {
            padding: 30px 20px;
        }

        .form-row {
            flex-direction: column;
            gap: 0;
        }

        .form-row .form-group {
            margin-bottom: 20px;
        }

        .form-actions {
            flex-direction: column;
        }

        .save-btn,
        .cancel-btn {
            width: 100%;
            margin: 5px 0;
        }
    }
</style>

<div class="edit-profile-section">
    <div class="edit-profile-container">
        <h1 class="edit-profile-title"><?php echo __('profile.edit_profile'); ?></h1>

        <form method="POST">
            <div class="form-group">
                <label class="form-label"><?php echo __('profile.full_name'); ?></label>
                <input type="text" name="full_name" class="form-input"
                    value="<?php echo $view->escape($user['full_name']); ?>" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label"><?php echo __('profile.username'); ?></label>
                    <input type="text" name="username" class="form-input"
                        value="<?php echo $view->escape($user['username']); ?>" required>
                </div>
                <div class="form-group">
                    <label class="form-label"><?php echo __('profile.email'); ?></label>
                    <input type="email" name="email" class="form-input"
                        value="<?php echo $view->escape($user['email']); ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label"><?php echo __('profile.specialization'); ?></label>
                <select name="specialization_id" class="form-select" required>
                    <option value=""><?php echo __('profile.select_specialization'); ?></option>
                    <?php foreach ($specializations as $spec): ?>
                        <option value="<?php echo $spec['id']; ?>"
                            <?php echo ($spec['id'] == $user['specialization_id']) ? 'selected' : ''; ?>>
                            <?php echo $view->escape($spec['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="password-section">
                <h3><?php echo __('profile.change_password'); ?></h3>
                <div class="password-note">
                    <?php echo __('profile.password_note'); ?>
                </div>
                <div class="form-group">
                    <label class="form-label"><?php echo __('profile.new_password'); ?></label>
                    <input type="password" name="password" class="form-input"
                        placeholder="<?php echo __('profile.enter_new_password'); ?>">
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="save-btn"><?php echo __('profile.save_changes'); ?></button>
                <a href="/profile" class="cancel-btn"><?php echo __('common.cancel'); ?></a>
            </div>
        </form>
    </div>
</div>