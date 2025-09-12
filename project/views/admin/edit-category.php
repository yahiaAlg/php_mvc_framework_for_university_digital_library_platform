<!-- Edit Category Template -->
<style>
    .edit-category-section {
        background-color: #414040;
        min-height: calc(100vh - 200px);
        padding: 50px 20px;
        color: #fafafa;
    }

    .edit-category-container {
        max-width: 600px;
        margin: 0 auto;
    }

    .edit-category-header {
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

    .edit-category-title {
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
        min-height: 100px;
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
        .edit-category-header {
            flex-direction: column;
            gap: 20px;
        }
    }
</style>

<div class="edit-category-section">
    <div class="edit-category-container">
        <div class="edit-category-header">
            <h1 class="edit-category-title">Edit Category</h1>
            <a href="/admin/categories" class="back-btn">Back to Categories</a>
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
                    <label class="form-label">Category Name</label>
                    <input type="text" name="name" class="form-input"
                        value="<?php echo $view->escape($category['name']); ?>" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-textarea"
                        placeholder="Brief description of the category..."><?php echo $view->escape($category['description'] ?? ''); ?></textarea>
                </div>

                <button type="submit" class="save-btn">Update Category</button>
            </form>
        </div>
    </div>
</div>