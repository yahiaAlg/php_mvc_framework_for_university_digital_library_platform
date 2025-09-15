<!-- Edit Specialization Template with Internationalization -->
<style>
    .edit-specialization-section {
        background-color: #414040;
        min-height: calc(100vh - 200px);
        padding: 50px 20px;
        color: #fafafa;
    }

    .edit-specialization-container {
        max-width: 600px;
        margin: 0 auto;
    }

    .edit-specialization-header {
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

    .edit-specialization-title {
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
    .form-textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
        background-color: white;
        font-family: inherit;
    }

    .form-textarea {
        min-height: 120px;
        resize: vertical;
    }

    .form-input:focus,
    .form-textarea:focus {
        outline: none;
        border-color: #b52626;
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
        .edit-specialization-header {
            flex-direction: column;
            gap: 20px;
        }
    }
</style>

<div class="edit-specialization-section">
    <div class="edit-specialization-container">
        <div class="edit-specialization-header">
            <h1 class="edit-specialization-title"><?php echo __('admin.edit_specialization_title'); ?></h1>
            <a href="/admin/specializations" class="back-btn"><?php echo __('admin.back_to_specializations'); ?></a>
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
                <div class="form-group">
                    <label class="form-label"><?php echo __('admin.specialization_name'); ?></label>
                    <input type="text" name="name" class="form-input"
                        value="<?php echo $view->escape($specialization['name']); ?>" required>
                </div>

                <div class="form-group">
                    <label class="form-label"><?php echo __('admin.faculty'); ?></label>
                    <input type="text" name="faculty" class="form-input"
                        value="<?php echo $view->escape($specialization['faculty']); ?>" required>
                </div>

                <div class="form-group">
                    <label class="form-label"><?php echo __('admin.description'); ?></label>
                    <textarea name="description" class="form-textarea"
                        placeholder="<?php echo __('admin.brief_description_placeholder'); ?>" required><?php echo $view->escape($specialization['description']); ?></textarea>
                </div>

                <button type="submit" class="save-btn"><?php echo __('admin.update_specialization'); ?></button>
            </form>
        </div>
    </div>
</div>