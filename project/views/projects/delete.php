<!-- Main content for delete project template -->
<style>
    .delete-section {
        background-color: #414040;
        min-height: calc(100vh - 200px);
        padding: 50px 20px;
        color: #fafafa;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .delete-container {
        max-width: 500px;
        width: 100%;
        background-color: #eee;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
        color: #333;
        text-align: center;
    }

    .delete-title {
        font-family: "Rubik", "sans-serif";
        font-size: 28px;
        font-weight: 700;
        color: #dc3545;
        margin-bottom: 20px;
        letter-spacing: 0.5px;
    }

    .warning-icon {
        font-size: 60px;
        color: #dc3545;
        margin-bottom: 20px;
    }

    .delete-warning {
        font-size: 16px;
        color: #555;
        margin-bottom: 30px;
        line-height: 1.5;
    }

    .project-info {
        background-color: #f8f8f8;
        padding: 20px;
        border-radius: 6px;
        margin-bottom: 30px;
        border-left: 4px solid #dc3545;
        text-align: left;
    }

    .project-title {
        font-size: 18px;
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
    }

    .project-details {
        font-size: 14px;
        color: #666;
        line-height: 1.4;
    }

    .form-actions {
        display: flex;
        gap: 15px;
        justify-content: center;
    }

    .delete-btn {
        background-color: #dc3545;
        color: white;
        border: none;
        padding: 15px 30px;
        font-size: 16px;
        font-weight: 400;
        border-radius: 25px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .delete-btn:hover {
        background-color: #c82333;
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
    .rtl .delete-container {
        text-align: center;
    }

    .rtl .project-info {
        text-align: right;
        border-left: none;
        border-right: 4px solid #dc3545;
    }

    .rtl .form-actions {
        flex-direction: row-reverse;
    }

    @media (max-width: 768px) {
        .delete-container {
            padding: 30px 20px;
        }

        .form-actions {
            flex-direction: column;
        }

        .delete-btn,
        .cancel-btn {
            width: 100%;
            margin: 5px 0;
        }

        .rtl .form-actions {
            flex-direction: column;
        }
    }
</style>

<div class="delete-section">
    <div class="delete-container">
        <div class="warning-icon">⚠️</div>
        <h1 class="delete-title"><?php echo __('project_management.delete_project'); ?></h1>

        <p class="delete-warning">
            <?php echo __('project_management.delete_warning'); ?>
        </p>

        <div class="project-info">
            <div class="project-title"><?php echo $view->escape($project['title']); ?></div>
            <div class="project-details">
                <strong><?php echo __('project_management.author'); ?>:</strong> <?php echo $view->escape($project['author_name']); ?><br>
                <strong><?php echo __('project_management.year'); ?>:</strong> <?php echo $view->escape($project['year']); ?><br>
                <strong><?php echo __('project_management.uploaded'); ?>:</strong> <?php echo date('F j, Y', strtotime($project['created_at'])); ?>
            </div>
        </div>

        <form method="POST">
            <div class="form-actions">
                <button type="submit" class="delete-btn"><?php echo __('project_management.yes_delete'); ?></button>
                <a href="/projects/dashboard" class="cancel-btn"><?php echo __('project_management.cancel'); ?></a>
            </div>
        </form>
    </div>
</div>