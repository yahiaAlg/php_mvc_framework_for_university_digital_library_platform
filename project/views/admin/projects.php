<!-- Admin Projects Template with Internationalization -->
<style>
    .projects-section {
        background-color: #414040;
        min-height: calc(100vh - 200px);
        padding: 50px 20px;
        color: #fafafa;
    }

    .projects-container {
        max-width: 1400px;
        margin: 0 auto;
    }

    .projects-header {
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

    .projects-title {
        font-family: "Rubik", "sans-serif";
        font-size: 30px;
        font-weight: 700;
        color: #666;
        letter-spacing: 0.5px;
        margin: 0;
    }

    .header-controls {
        display: flex;
        gap: 15px;
        align-items: center;
    }

    .status-filter {
        padding: 8px 15px;
        border: 1px solid #ddd;
        border-radius: 20px;
        font-size: 14px;
        background-color: white;
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

    .category-btn {
        background-color: #28a745;
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

    .category-btn:hover {
        background-color: #22903bff;
        color: #ddd;
    }

    .projects-table-container {
        background-color: #eee;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        overflow: hidden;
    }

    .projects-table {
        width: 100%;
        border-collapse: collapse;
        color: #333;
    }

    .projects-table th {
        background-color: #b52626;
        color: white;
        padding: 15px;
        text-align: left;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 14px;
    }

    .projects-table td {
        padding: 15px;
        border-bottom: 1px solid #ddd;
        vertical-align: top;
    }

    .projects-table tr:hover {
        background-color: #f8f9fa;
    }

    .project-title {
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
        max-width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .project-author {
        font-size: 13px;
        color: #666;
        margin-bottom: 3px;
    }

    .project-specialization {
        font-size: 12px;
        color: #b52626;
        font-weight: 500;
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
        background-color: #ffc107;
        color: #856404;
    }

    .status-approved {
        background-color: #28a745;
        color: white;
    }

    .status-rejected {
        background-color: #dc3545;
        color: white;
    }

    .project-actions {
        display: flex;
        gap: 5px;
        flex-wrap: wrap;
    }

    .action-btn {
        padding: 4px 8px;
        border: none;
        border-radius: 12px;
        font-size: 11px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
        white-space: nowrap;
    }

    .edit-btn {
        background-color: #555;
        color: white;
    }

    .edit-btn:hover {
        background-color: #333;
        color: white;
    }

    .approve-btn {
        background-color: #28a745;
        color: white;
    }

    .approve-btn:hover {
        background-color: #1e7e34;
        color: white;
    }

    .reject-btn {
        background-color: #ffc107;
        color: #856404;
    }

    .reject-btn:hover {
        background-color: #e0a800;
        color: #856404;
    }

    .delete-btn {
        background-color: #dc3545;
        color: white;
    }

    .delete-btn:hover {
        background-color: #c82333;
        color: white;
    }

    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 30px;
        gap: 10px;
    }

    .pagination a,
    .pagination span {
        padding: 10px 15px;
        background-color: #eee;
        color: #333;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .pagination a:hover {
        background-color: #b52626;
        color: white;
    }

    .pagination .current {
        background-color: #b52626;
        color: white;
    }

    @media (max-width: 1024px) {
        .projects-header {
            flex-direction: column;
            gap: 20px;
        }

        .header-controls {
            flex-direction: column;
            width: 100%;
            gap: 10px;
        }

        .projects-table-container {
            overflow-x: auto;
        }

        .projects-table {
            min-width: 800px;
        }
    }
</style>

<div class="projects-section">
    <div class="projects-container">
        <div class="projects-header">
            <h1 class="projects-title"><?php echo __('admin.manage_projects_title'); ?></h1>
            <div class="header-controls">
                <select class="status-filter" onchange="filterByStatus(this.value)">
                    <option value="all" <?php echo $current_status === 'all' ? 'selected' : ''; ?>><?php echo __('admin.all_projects'); ?></option>
                    <option value="pending" <?php echo $current_status === 'pending' ? 'selected' : ''; ?>><?php echo __('admin.pending'); ?></option>
                    <option value="approved" <?php echo $current_status === 'approved' ? 'selected' : ''; ?>><?php echo __('admin.approved'); ?></option>
                    <option value="rejected" <?php echo $current_status === 'rejected' ? 'selected' : ''; ?>><?php echo __('admin.rejected'); ?></option>
                </select>
                <a href="/admin/categories" class="category-btn"><?php echo __('admin.categories'); ?>📚</a>
                <a href="/admin/dashboard" class="back-btn"><?php echo __('admin.back_to_dashboard'); ?></a>
            </div>
        </div>

        <div class="projects-table-container">
            <table class="projects-table">
                <thead>
                    <tr>
                        <th><?php echo __('admin.project'); ?></th>
                        <th><?php echo __('admin.year'); ?></th>
                        <th><?php echo __('admin.status'); ?></th>
                        <th><?php echo __('admin.uploaded'); ?></th>
                        <th><?php echo __('admin.actions'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($projects['data'] as $project): ?>
                        <tr>
                            <td>
                                <div class="project-title"><?php echo $view->escape($project['title']); ?></div>
                                <div class="project-author"><?php echo __('admin.by'); ?> <?php echo $view->escape($project['author_name']); ?></div>
                                <div class="project-specialization"><?php echo $view->escape($project['specialization_name'] ?? __('admin.no_specialization')); ?></div>
                            </td>
                            <td><?php echo $project['year']; ?></td>
                            <td>
                                <span class="project-status status-<?php echo $project['status']; ?>">
                                    <?php echo __('admin.' . $project['status']); ?>
                                </span>
                            </td>
                            <td><?php echo date('M j, Y', strtotime($project['created_at'])); ?></td>
                            <td>
                                <div class="project-actions">
                                    <a href="/admin/projects/<?php echo $project['id']; ?>/edit" class="action-btn edit-btn"><?php echo __('admin.edit'); ?></a>

                                    <?php if ($project['status'] === 'pending'): ?>
                                        <a href="/admin/projects/<?php echo $project['id']; ?>/approve" class="action-btn approve-btn"><?php echo __('admin.approve'); ?></a>
                                        <a href="/admin/projects/<?php echo $project['id']; ?>/reject" class="action-btn reject-btn"><?php echo __('admin.reject'); ?></a>
                                    <?php elseif ($project['status'] === 'rejected'): ?>
                                        <a href="/admin/projects/<?php echo $project['id']; ?>/approve" class="action-btn approve-btn"><?php echo __('admin.approve'); ?></a>
                                    <?php elseif ($project['status'] === 'approved'): ?>
                                        <a href="/admin/projects/<?php echo $project['id']; ?>/reject" class="action-btn reject-btn"><?php echo __('admin.reject'); ?></a>
                                    <?php endif; ?>

                                    <a href="/admin/projects/<?php echo $project['id']; ?>/delete" class="action-btn delete-btn"
                                        onclick="return confirm('<?php echo __('admin.are_you_sure_delete_project'); ?>')"><?php echo __('admin.delete'); ?></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <?php if ($projects['last_page'] > 1): ?>
            <div class="pagination">
                <?php if ($projects['current_page'] > 1): ?>
                    <a href="?page=<?php echo $projects['current_page'] - 1; ?>&status=<?php echo $current_status; ?>">&laquo; <?php echo __('admin.previous'); ?></a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $projects['last_page']; $i++): ?>
                    <?php if ($i == $projects['current_page']): ?>
                        <span class="current"><?php echo $i; ?></span>
                    <?php else: ?>
                        <a href="?page=<?php echo $i; ?>&status=<?php echo $current_status; ?>"><?php echo $i; ?></a>
                    <?php endif; ?>
                <?php endfor; ?>

                <?php if ($projects['current_page'] < $projects['last_page']): ?>
                    <a href="?page=<?php echo $projects['current_page'] + 1; ?>&status=<?php echo $current_status; ?>"><?php echo __('admin.next'); ?> &raquo;</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
    function filterByStatus(status) {
        const currentUrl = new URL(window.location);
        currentUrl.searchParams.set('status', status);
        currentUrl.searchParams.delete('page'); // Reset to first page
        window.location.href = currentUrl.toString();
    }
</script>