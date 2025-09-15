<!-- Main content for projects dashboard template -->
<style>
    .dashboard-section {
        background-color: #414040;
        min-height: calc(100vh - 200px);
        padding: 50px 20px;
        color: #fafafa;
    }

    .dashboard-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .dashboard-header {
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

    .dashboard-title {
        font-family: "Rubik", "sans-serif";
        font-size: 30px;
        font-weight: 700;
        color: #666;
        letter-spacing: 0.5px;
        margin: 0;
    }

    .upload-btn {
        background-color: #b52626;
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

    .upload-btn:hover {
        background-color: #8d1d1d;
        color: #ddd;
    }

    .projects-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 20px;
    }

    .project-card {
        background-color: #eee;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        padding: 25px;
        color: #333;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .project-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
    }

    .project-title {
        font-size: 20px;
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
        line-height: 1.3;
    }

    .project-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        font-size: 14px;
        color: #666;
    }

    .project-status {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-pending {
        background-color: #fff3cd;
        color: #856404;
    }

    .status-approved {
        background-color: #d4edda;
        color: #155724;
    }

    .status-rejected {
        background-color: #f8d7da;
        color: #721c24;
    }

    .project-description {
        color: #555;
        margin-bottom: 15px;
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .project-info {
        font-size: 14px;
        color: #666;
        margin-bottom: 15px;
    }

    .project-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .action-btn {
        padding: 8px 16px;
        border: none;
        border-radius: 20px;
        font-size: 14px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
    }

    .view-btn {
        background-color: #28a745;
        color: white;
    }

    .view-btn:hover {
        background-color: #218838;
        color: white;
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

    .empty-state {
        background-color: #eee;
        padding: 60px 30px;
        border-radius: 8px;
        text-align: center;
        color: #666;
    }

    .empty-state h3 {
        font-size: 24px;
        margin-bottom: 15px;
        color: #555;
    }

    .empty-state p {
        font-size: 16px;
        margin-bottom: 25px;
        line-height: 1.5;
    }

    /* RTL Support */
    .rtl .dashboard-header {
        flex-direction: row-reverse;
    }

    .rtl .project-meta {
        flex-direction: row-reverse;
    }

    .rtl .project-info {
        text-align: right;
    }

    .rtl .project-actions {
        flex-direction: row-reverse;
        justify-content: flex-start;
    }

    @media (max-width: 768px) {
        .dashboard-header {
            flex-direction: column;
            gap: 20px;
            text-align: center;
        }

        .projects-grid {
            grid-template-columns: 1fr;
        }

        .project-card {
            padding: 20px;
        }

        .project-meta {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .project-actions {
            justify-content: center;
        }

        .rtl .dashboard-header {
            flex-direction: column;
        }

        .rtl .project-meta {
            flex-direction: column;
            align-items: flex-end;
        }

        .rtl .project-actions {
            justify-content: center;
        }
    }
</style>

<div class="dashboard-section">
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1 class="dashboard-title"><?php echo __('dashboard.my_projects'); ?></h1>
            <a href="/projects/upload" class="upload-btn"><?php echo __('dashboard.upload_new_project'); ?></a>
        </div>

        <?php if (!empty($projects['data'])): ?>
            <div class="projects-grid">
                <?php foreach ($projects['data'] as $project): ?>
                    <div class="project-card">
                        <h3 class="project-title"><?php echo $view->escape($project['title']); ?></h3>

                        <div class="project-meta">
                            <span><?php echo __('dashboard.year'); ?>: <?php echo $view->escape($project['year']); ?></span>
                            <span class="project-status status-<?php echo $project['status']; ?>">
                                <?php echo $view->escape(ucfirst($project['status'])); ?>
                            </span>
                        </div>

                        <p class="project-description">
                            <?php echo $view->escape($project['description']); ?>
                        </p>

                        <div class="project-info">
                            <strong><?php echo __('dashboard.author'); ?>:</strong> <?php echo $view->escape($project['author_name']); ?><br>
                            <strong><?php echo __('dashboard.supervisor'); ?>:</strong> <?php echo $view->escape($project['supervisor']); ?>
                        </div>

                        <div class="project-actions">
                            <a href="/projects/<?php echo $project['id']; ?>" class="action-btn view-btn"><?php echo __('dashboard.view'); ?></a>
                            <a href="/projects/<?php echo $project['id']; ?>/edit" class="action-btn edit-btn"><?php echo __('dashboard.edit'); ?></a>
                            <a href="/projects/<?php echo $project['id']; ?>/delete" class="action-btn delete-btn"><?php echo __('dashboard.delete'); ?></a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <h3><?php echo __('dashboard.no_projects_yet'); ?></h3>
                <p><?php echo __('dashboard.no_projects_message'); ?></p>
                <a href="/projects/upload" class="upload-btn"><?php echo __('dashboard.upload_first_project'); ?></a>
            </div>
        <?php endif; ?>
    </div>
</div>