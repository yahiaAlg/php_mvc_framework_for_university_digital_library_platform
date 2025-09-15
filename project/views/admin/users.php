<!-- Admin Users Template with Internationalization -->
<style>
    .users-section {
        background-color: #414040;
        min-height: calc(100vh - 200px);
        padding: 50px 20px;
        color: #fafafa;
    }

    .users-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .users-header {
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

    .users-title {
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

    .users-table-container {
        background-color: #eee;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        overflow: hidden;
    }

    .users-table {
        width: 100%;
        border-collapse: collapse;
        color: #333;
    }

    .users-table th {
        background-color: #b52626;
        color: white;
        padding: 15px;
        text-align: left;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 14px;
    }

    .users-table td {
        padding: 15px;
        border-bottom: 1px solid #ddd;
    }

    .users-table tr:hover {
        background-color: #f8f9fa;
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        background-color: #555;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        font-weight: 600;
        margin-right: 10px;
    }

    .user-info {
        display: flex;
        align-items: center;
    }

    .user-details {
        flex: 1;
    }

    .user-name {
        font-weight: 600;
        color: #333;
        margin-bottom: 3px;
    }

    .user-email {
        font-size: 14px;
        color: #666;
    }

    .user-role {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .role-admin {
        background-color: #dc3545;
        color: white;
    }

    .role-student {
        background-color: #28a745;
        color: white;
    }

    .user-actions {
        display: flex;
        gap: 10px;
    }

    .action-btn {
        padding: 6px 12px;
        border: none;
        border-radius: 15px;
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

    @media (max-width: 768px) {
        .users-header {
            flex-direction: column;
            gap: 20px;
        }

        .users-table-container {
            overflow-x: auto;
        }

        .users-table {
            min-width: 600px;
        }

        .user-info {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .user-avatar {
            margin-right: 0;
        }
    }
</style>

<div class="users-section">
    <div class="users-container">
        <div class="users-header">
            <h1 class="users-title"><?php echo __('admin.manage_users_title'); ?></h1>
            <a href="/admin/dashboard" class="back-btn"><?php echo __('admin.back_to_dashboard'); ?></a>
        </div>

        <div class="users-table-container">
            <table class="users-table">
                <thead>
                    <tr>
                        <th><?php echo __('admin.user'); ?></th>
                        <th><?php echo __('admin.username'); ?></th>
                        <th><?php echo __('admin.role'); ?></th>
                        <th><?php echo __('admin.specialization'); ?></th>
                        <th><?php echo __('admin.joined'); ?></th>
                        <th><?php echo __('admin.actions'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users['data'] as $user): ?>
                        <tr>
                            <td>
                                <div class="user-info">
                                    <div class="user-avatar">
                                        <?php echo strtoupper(substr($user['full_name'], 0, 1)); ?>
                                    </div>
                                    <div class="user-details">
                                        <div class="user-name"><?php echo $view->escape($user['full_name']); ?></div>
                                        <div class="user-email"><?php echo $view->escape($user['email']); ?></div>
                                    </div>
                                </div>
                            </td>
                            <td><?php echo $view->escape($user['username']); ?></td>
                            <td>
                                <span class="user-role role-<?php echo $user['role']; ?>">
                                    <?php echo __('admin.' . $user['role']); ?>
                                </span>
                            </td>
                            <td><?php echo $view->escape($user['specialization_name'] ?? __('admin.not_specified')); ?></td>
                            <td><?php echo date('M j, Y', strtotime($user['created_at'])); ?></td>
                            <td>
                                <div class="user-actions">
                                    <a href="/admin/users/<?php echo $user['id']; ?>/edit" class="action-btn edit-btn"><?php echo __('admin.edit'); ?></a>
                                    <?php if ($user['role'] !== 'admin'): ?>
                                        <a href="/admin/users/<?php echo $user['id']; ?>/delete" class="action-btn delete-btn"><?php echo __('admin.delete'); ?></a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <?php if ($users['total_pages'] > 1): ?>
            <div class="pagination">
                <?php if ($users['current_page'] > 1): ?>
                    <a href="?page=<?php echo $users['current_page'] - 1; ?>">&laquo; <?php echo __('admin.previous'); ?></a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $users['total_pages']; $i++): ?>
                    <?php if ($i == $users['current_page']): ?>
                        <span class="current"><?php echo $i; ?></span>
                    <?php else: ?>
                        <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    <?php endif; ?>
                <?php endfor; ?>

                <?php if ($users['current_page'] < $users['total_pages']): ?>
                    <a href="?page=<?php echo $users['current_page'] + 1; ?>"><?php echo __('admin.next'); ?> &raquo;</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>