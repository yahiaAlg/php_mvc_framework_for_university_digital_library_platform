<!-- Admin Edit User Template with Internationalization -->
<style>
    .edit-user-section {
        background-color: #414040;
        min-height: calc(100vh - 200px);
        padding: 50px 20px;
        color: #fafafa;
    }

    .edit-user-container {
        max-width: 600px;
        margin: 0 auto;
    }

    .edit-user-header {
        background-color: #eee;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
        margin-bottom: 30px;
        color: #333;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .edit-user-title {
        font-family: "Rubik", "sans-serif";
        font-size: 30px;
        font-weight: 700;
        color: #666;
        letter-spacing: 0.5px;
        margin: 0;
    }

    .back-btn {
        background-color: #555;
        color: #ddd;
        border: none;
        padding: 12px 25px;
        font-size: 16px;
        font-weight: 400;
        border-radius: 25px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .back-btn:hover {
        background-color: #333;
        color: #ddd;
    }

    .form-container {
        background-color: #eee;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        color: #333;
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
        font-family: inherit;
    }

    .form-input:focus,
    .form-select:focus {
        outline: none;
        border-color: #b52626;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .save-btn {
        background-color: #b52626;
        color: white;
        border: none;
        padding: 12px 25px;
        font-size: 16px;
        font-weight: 400;
        border-radius: 25px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        width: 100%;
    }

    .save-btn:hover {
        background-color: #8d1d1d;
    }

    .password-note {
        font-size: 12px;
        color: #666;
        margin-top: 5px;
        font-style: italic;
    }

    .error-messages {
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
        color: #721c24;
        padding: 12px;
        border-radius: 4px;
        margin-bottom: 20px;
    }

    .error-messages ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .error-messages li {
        margin-bottom: 5px;
    }

    @media (max-width: 768px) {
        .edit-user-header {
            flex-direction: column;
            gap: 20px;
        }

        .form-row {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="edit-user-section">
    <div class="edit-user-container">
        <div class="edit-user-header">
            <h1 class="edit-user-title"><?php echo __('admin.edit_user_title'); ?></h1>
            <a href="/admin/users" class="back-btn"><?php echo __('admin.back_to_users'); ?></a>
        </div>

        <div class="form-container">
            <?php if (!empty($errors)): ?>
                <div class="error-messages">
                    <ul>
                        <?php foreach ($errors as $fieldErrors): ?>
                            <?php if (is_array($fieldErrors)): ?>
                                <?php foreach ($fieldErrors as $error): ?>
                                    <li><?php echo $view->escape($error); ?></li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li><?php echo $view->escape($fieldErrors); ?></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label"><?php echo __('admin.username'); ?></label>
                        <input type="text" name="username" class="form-input"
                            value="<?php echo $view->escape($userSelected['username']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><?php echo __('admin.email'); ?></label>
                        <input type="email" name="email" class="form-input"
                            value="<?php echo $view->escape($userSelected['email']); ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label"><?php echo __('admin.full_name'); ?></label>
                    <input type="text" name="full_name" class="form-input"
                        value="<?php echo $view->escape($userSelected['full_name']); ?>" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label"><?php echo __('admin.role'); ?></label>
                        <select name="role" class="form-select" required>
                            <option value="student" <?php echo $userSelected['role'] === 'student' ? 'selected' : ''; ?>><?php echo __('admin.student'); ?></option>
                            <option value="admin" <?php echo $userSelected['role'] === 'admin' ? 'selected' : ''; ?>><?php echo __('admin.admin'); ?></option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><?php echo __('admin.specialization'); ?></label>
                        <select name="specialization_id" class="form-select">
                            <option value=""><?php echo __('admin.select_specialization'); ?></option>
                            <?php foreach ($specializations as $spec): ?>
                                <option value="<?php echo $spec['id']; ?>"
                                    <?php echo $userSelected['specialization_id'] == $spec['id'] ? 'selected' : ''; ?>>
                                    <?php echo $view->escape($spec['name']); ?> (<?php echo $view->escape($spec['faculty']); ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label"><?php echo __('admin.new_password'); ?></label>
                        <input type="password" name="password" class="form-input">
                        <div class="password-note"><?php echo __('admin.password_blank_note'); ?></div>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><?php echo __('admin.confirm_new_password'); ?></label>
                        <input type="password" name="password_confirmation" class="form-input">
                    </div>
                </div>

                <button type="submit" class="save-btn"><?php echo __('admin.update_user'); ?></button>
            </form>
        </div>
    </div>
</div>