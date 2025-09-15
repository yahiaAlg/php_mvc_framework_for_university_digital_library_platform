<!-- Admin Categories Template with Internationalization -->
<style>
    .categories-section {
        background-color: #414040;
        min-height: calc(100vh - 200px);
        padding: 50px 20px;
        color: #fafafa;
    }

    .categories-container {
        max-width: 1000px;
        margin: 0 auto;
    }

    .categories-header {
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

    .categories-title {
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

    .content-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
    }

    .add-form-container,
    .list-container {
        background-color: #eee;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        color: #333;
    }

    .section-title {
        font-size: 22px;
        font-weight: 600;
        color: #333;
        margin-bottom: 20px;
        border-bottom: 2px solid #ddd;
        padding-bottom: 10px;
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
        min-height: 80px;
        resize: vertical;
    }

    .form-input:focus,
    .form-textarea:focus {
        outline: none;
        border-color: #b52626;
    }

    .add-btn {
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

    .add-btn:hover {
        background-color: #8d1d1d;
    }

    .categories-list {
        max-height: 600px;
        overflow-y: auto;
    }

    .category-item {
        padding: 15px 0;
        border-bottom: 1px solid #eee;
    }

    .category-item:last-child {
        border-bottom: none;
    }

    .category-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 8px;
    }

    .category-name {
        font-size: 18px;
        font-weight: 600;
        color: #333;
        margin: 0;
    }

    .category-actions {
        display: flex;
        gap: 8px;
    }

    .action-btn {
        padding: 4px 10px;
        border: none;
        border-radius: 12px;
        font-size: 12px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
    }

    .edit-btn {
        background-color: #555;
        color: white;
    }

    .edit-btn:hover {
        background-color: #333;
        color: white;
    }

    .delete-btn {
        background-color: #dc3545;
        color: white;
    }

    .delete-btn:hover {
        background-color: #c82333;
        color: white;
    }

    .category-description {
        font-size: 14px;
        color: #666;
        line-height: 1.4;
    }

    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: #666;
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
        .categories-header {
            flex-direction: column;
            gap: 20px;
        }

        .content-grid {
            grid-template-columns: 1fr;
        }

        .add-form-container {
            order: 1;
        }

        .list-container {
            order: 2;
        }

        .category-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }
    }
</style>

<div class="categories-section">
    <div class="categories-container">
        <div class="categories-header">
            <h1 class="categories-title"><?php echo __('admin.manage_categories_title'); ?></h1>
            <a href="/admin/dashboard" class="back-btn"><?php echo __('admin.back_to_dashboard'); ?></a>
        </div>

        <div class="content-grid">
            <!-- Add Category Form -->
            <div class="add-form-container">
                <h2 class="section-title"><?php echo __('admin.add_new_category'); ?></h2>

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
                        <label class="form-label"><?php echo __('admin.category_name'); ?></label>
                        <input type="text" name="name" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><?php echo __('admin.description'); ?></label>
                        <textarea name="description" class="form-textarea" placeholder="<?php echo __('admin.brief_category_description_placeholder'); ?>"></textarea>
                    </div>

                    <button type="submit" class="add-btn"><?php echo __('admin.add_category'); ?></button>
                </form>
            </div>

            <!-- Categories List -->
            <div class="list-container">
                <h2 class="section-title"><?php echo __('admin.current_categories'); ?></h2>

                <div class="categories-list">
                    <?php if (!empty($categories)): ?>
                        <?php foreach ($categories as $category): ?>
                            <div class="category-item">
                                <div class="category-header">
                                    <h3 class="category-name"><?php echo $view->escape($category['name']); ?></h3>
                                    <div class="category-actions">
                                        <a href="/admin/categories/<?php echo $category['id']; ?>/edit" class="action-btn edit-btn"><?php echo __('admin.edit'); ?></a>
                                        <a href="/admin/categories/<?php echo $category['id']; ?>/delete" class="action-btn delete-btn" onclick="return confirm('<?php echo __('admin.are_you_sure_delete_category'); ?>')"><?php echo __('admin.delete'); ?></a>
                                    </div>
                                </div>
                                <?php if (!empty($category['description'])): ?>
                                    <div class="category-description"><?php echo $view->escape($category['description']); ?></div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="empty-state">
                            <p><?php echo __('admin.no_categories_found'); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>