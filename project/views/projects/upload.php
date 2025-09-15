<!-- Main content for upload project template -->
<style>
    .upload-section {
        background-color: #414040;
        min-height: calc(100vh - 200px);
        padding: 50px 20px;
        color: #fafafa;
    }

    .upload-container {
        max-width: 700px;
        margin: 0 auto;
        background-color: #eee;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
        color: #333;
    }

    .upload-title {
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

    .file-upload-section {
        background-color: #f8f8f8;
        padding: 20px;
        border-radius: 6px;
        margin-bottom: 20px;
        border-left: 4px solid #b52626;
    }

    .file-upload-title {
        font-size: 18px;
        color: #555;
        margin-bottom: 10px;
        font-weight: 600;
    }

    .file-upload-note {
        font-size: 14px;
        color: #666;
        margin-bottom: 15px;
    }

    .file-input {
        width: 100%;
        padding: 15px;
        border: 2px dashed #ddd;
        border-radius: 6px;
        background-color: white;
        cursor: pointer;
        transition: border-color 0.3s ease;
    }

    .file-input:hover {
        border-color: #b52626;
    }

    .form-actions {
        display: flex;
        gap: 15px;
        justify-content: center;
        margin-top: 30px;
    }

    .submit-btn {
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

    .submit-btn:hover {
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

    /* RTL Support */
    .rtl .upload-container {
        text-align: right;
    }

    .rtl .upload-title {
        text-align: center;
    }

    .rtl .form-input,
    .rtl .form-select,
    .rtl .form-textarea {
        text-align: right;
        direction: rtl;
    }

    .rtl .form-input::placeholder,
    .rtl .form-textarea::placeholder {
        text-align: right;
    }

    .rtl .form-row {
        flex-direction: row-reverse;
    }

    .rtl .form-actions {
        flex-direction: row-reverse;
    }

    @media (max-width: 768px) {
        .upload-container {
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

        .submit-btn,
        .cancel-btn {
            width: 100%;
            margin: 5px 0;
        }

        .rtl .form-row {
            flex-direction: column;
        }

        .rtl .form-actions {
            flex-direction: column;
        }
    }
</style>

<div class="upload-section">
    <div class="upload-container">
        <h1 class="upload-title"><?php echo __('project_management.upload_project'); ?></h1>

        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label class="form-label"><?php echo __('project_management.project_title'); ?></label>
                <input type="text" name="title" class="form-input" required>
            </div>

            <div class="form-group">
                <label class="form-label"><?php echo __('project_management.description'); ?></label>
                <textarea name="description" class="form-textarea" placeholder="<?php echo __('project_management.describe_project'); ?>" required></textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label"><?php echo __('project_management.author_name'); ?></label>
                    <input type="text" name="author_name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label"><?php echo __('project_management.supervisor'); ?></label>
                    <input type="text" name="supervisor" class="form-input" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label"><?php echo __('project_management.specialization'); ?></label>
                    <select name="specialization_id" class="form-select" required>
                        <option value=""><?php echo __('project_management.select_specialization'); ?></option>
                        <?php foreach ($specializations as $spec): ?>
                            <option value="<?php echo $spec['id']; ?>"><?php echo $view->escape($spec['name']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label"><?php echo __('project_management.year'); ?></label>
                    <input type="number" name="year" class="form-input" min="2000" max="<?php echo date('Y'); ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label"><?php echo __('project_management.keywords'); ?></label>
                <input type="text" name="keywords" class="form-input" placeholder="<?php echo __('project_management.keywords_placeholder'); ?>" required>
            </div>

            <div class="file-upload-section">
                <div class="file-upload-title"><?php echo __('project_management.image_file'); ?></div>
                <div class="file-upload-note">
                    <?php echo __('project_management.image_file_note'); ?>
                </div>
                <input type="file" name="image_file" class="file-input" accept=".png,.jpeg,.jpg" required>
            </div>
            <div class="file-upload-section">
                <div class="file-upload-title"><?php echo __('project_management.project_file'); ?></div>
                <div class="file-upload-note">
                    <?php echo __('project_management.project_file_note'); ?>
                </div>
                <input type="file" name="project_file" class="file-input" accept=".pdf,.doc,.docx" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="submit-btn"><?php echo __('project_management.upload_button'); ?></button>
                <a href="/projects/dashboard" class="cancel-btn"><?php echo __('project_management.cancel'); ?></a>
            </div>
        </form>
    </div>
</div>