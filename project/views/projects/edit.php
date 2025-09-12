<!-- Main content for edit project template -->
<style>
    .edit-project-section {
        background-color: #414040;
        min-height: calc(100vh - 200px);
        padding: 50px 20px;
        color: #fafafa;
    }

    .edit-project-container {
        max-width: 700px;
        margin: 0 auto;
        background-color: #eee;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
        color: #333;
    }

    .edit-project-title {
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

    .current-file-section {
        background-color: #f8f8f8;
        padding: 20px;
        border-radius: 6px;
        margin-bottom: 20px;
        border-left: 4px solid #28a745;
    }

    .current-file-title {
        font-size: 16px;
        color: #555;
        margin-bottom: 10px;
        font-weight: 600;
    }

    .current-file-name {
        font-size: 14px;
        color: #333;
        background-color: #fff;
        padding: 8px 12px;
        border-radius: 4px;
        border: 1px solid #ddd;
        display: inline-block;
    }

    .file-upload-section {
        background-color: #f8f8f8;
        padding: 20px;
        border-radius: 6px;
        margin-bottom: 20px;
        border-left: 4px solid #b52626;
    }

    .file-upload-title {
        font-size: 16px;
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
        .edit-project-container {
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

<div class="edit-project-section">
    <div class="edit-project-container">
        <h1 class="edit-project-title">Edit Project</h1>

        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label class="form-label">Project Title</label>
                <input type="text" name="title" class="form-input"
                    value="<?php echo $view->escape($project['title']); ?>" required>
            </div>

            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-textarea" required><?php echo $view->escape($project['description']); ?></textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Author Name</label>
                    <input type="text" name="author_name" class="form-input"
                        value="<?php echo $view->escape($project['author_name']); ?>" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Supervisor</label>
                    <input type="text" name="supervisor" class="form-input"
                        value="<?php echo $view->escape($project['supervisor']); ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Year</label>
                    <input type="number" name="year" class="form-input"
                        value="<?php echo $view->escape($project['year']); ?>"
                        min="2000" max="<?php echo date('Y'); ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Keywords</label>
                <input type="text" name="keywords" class="form-input"
                    value="<?php echo $view->escape($project['keywords']); ?>"
                    placeholder="Separate keywords with commas" required>
            </div>

            <div class="current-file-section">
                <div class="current-file-title">Current File</div>
                <div class="current-file-name">
                    <?php echo $view->escape(basename($project['file_path'])); ?>
                </div>
            </div>
            <div class="file-upload-section">
                <div class="file-upload-title">Image File</div>
                <div class="file-upload-note">
                    Upload your image document (PNG, JPEG, JPG). Maximum file size: 10MB
                </div>
                <input type="file" name="image_file" class="file-input" accept=".png,.jpeg,.jpg">
            </div>
            <div class="file-upload-section">
                <div class="file-upload-title">Replace File (Optional)</div>
                <div class="file-upload-note">
                    Upload a new file to replace the current one (PDF, DOC, DOCX). Maximum file size: 10MB
                </div>
                <input type="file" name="project_file" class="file-input" accept=".pdf,.doc,.docx">
            </div>

            <div class="form-actions">
                <button type="submit" class="save-btn">Save Changes</button>
                <a href="/projects/dashboard" class="cancel-btn">Cancel</a>
            </div>
        </form>
    </div>
</div>