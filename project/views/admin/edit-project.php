<!-- Admin Edit Project Template with Internationalization -->
<style>
    .edit-project-section {
        background-color: #414040;
        min-height: calc(100vh - 200px);
        padding: 50px 20px;
        color: #fafafa;
    }

    .edit-project-container {
        max-width: 800px;
        margin: 0 auto;
    }

    .edit-project-header {
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

    .edit-project-title {
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

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
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
    .form-select,
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
    .form-select:focus,
    .form-textarea:focus {
        outline: none;
        border-color: #b52626;
    }

    .categories-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 10px;
        margin-top: 10px;
    }

    .category-checkbox {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 12px;
        background-color: #f8f9fa;
        border-radius: 20px;
        border: 1px solid #ddd;
        transition: all 0.3s ease;
    }

    .category-checkbox:hover {
        background-color: #e9ecef;
    }

    .category-checkbox input[type="checkbox"] {
        margin: 0;
    }

    .category-checkbox input[type="checkbox"]:checked+label {
        color: #b52626;
        font-weight: 600;
    }

    .category-checkbox label {
        margin: 0;
        cursor: pointer;
        font-size: 14px;
        text-transform: none;
        letter-spacing: normal;
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
        .edit-project-header {
            flex-direction: column;
            gap: 20px;
        }

        .form-row {
            grid-template-columns: 1fr;
        }

        .categories-container {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="edit-project-section">
    <div class="edit-project-container">
        <div class="edit-project-header">
            <h1 class="edit-project-title"><?php echo __('admin.edit_project_title'); ?></h1>
            <a href="/admin/projects" class="back-btn"><?php echo __('admin.back_to_projects'); ?></a>
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
                    <label class="form-label"><?php echo __('admin.project_title'); ?></label>
                    <input type="text" name="title" class="form-input"
                        value="<?php echo $view->escape($project['title']); ?>" required>
                </div>

                <div class="form-group">
                    <label class="form-label"><?php echo __('admin.description'); ?></label>
                    <textarea name="description" class="form-textarea" required><?php echo $view->escape($project['description']); ?></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label"><?php echo __('admin.author_name'); ?></label>
                        <input type="text" name="author_name" class="form-input"
                            value="<?php echo $view->escape($project['author_name']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><?php echo __('admin.supervisor'); ?></label>
                        <input type="text" name="supervisor" class="form-input"
                            value="<?php echo $view->escape($project['supervisor']); ?>" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label"><?php echo __('admin.specialization'); ?></label>
                        <select name="specialization_id" class="form-select" required>
                            <option value=""><?php echo __('admin.select_specialization'); ?></option>
                            <?php foreach ($specializations as $spec): ?>
                                <option value="<?php echo $spec['id']; ?>"
                                    <?php echo $project['specialization_id'] == $spec['id'] ? 'selected' : ''; ?>>
                                    <?php echo $view->escape($spec['name']); ?> (<?php echo $view->escape($spec['faculty']); ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><?php echo __('admin.year'); ?></label>
                        <select name="year" class="form-select" required>
                            <?php for ($y = date('Y'); $y >= 2000; $y--): ?>
                                <option value="<?php echo $y; ?>"
                                    <?php echo $project['year'] == $y ? 'selected' : ''; ?>>
                                    <?php echo $y; ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label"><?php echo __('admin.keywords'); ?></label>
                        <input type="text" name="keywords" class="form-input"
                            value="<?php echo $view->escape($project['keywords']); ?>"
                            placeholder="<?php echo __('admin.comma_separated_keywords'); ?>">
                    </div>

                    <div class="form-group">
                        <label class="form-label"><?php echo __('admin.status'); ?></label>
                        <select name="status" class="form-select" required>
                            <option value="pending" <?php echo $project['status'] === 'pending' ? 'selected' : ''; ?>><?php echo __('admin.pending'); ?></option>
                            <option value="approved" <?php echo $project['status'] === 'approved' ? 'selected' : ''; ?>><?php echo __('admin.approved'); ?></option>
                            <option value="rejected" <?php echo $project['status'] === 'rejected' ? 'selected' : ''; ?>><?php echo __('admin.rejected'); ?></option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label"><?php echo __('admin.categories'); ?></label>
                    <div class="categories-container">
                        <?php foreach ($categories as $category): ?>
                            <div class="category-checkbox">
                                <input type="checkbox"
                                    name="categories[]"
                                    value="<?php echo $category['id']; ?>"
                                    id="category_<?php echo $category['id']; ?>"
                                    <?php echo in_array($category['id'], $project_categories) ? 'checked' : ''; ?>>
                                <label for="category_<?php echo $category['id']; ?>">
                                    <?php echo $view->escape($category['name']); ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <button type="submit" class="save-btn"><?php echo __('admin.update_project'); ?></button>
            </form>
        </div>
    </div>
</div>