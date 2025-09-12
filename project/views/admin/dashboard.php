<!-- Main content for admin dashboard template -->
<style>
    .admin-section {
        background-color: #414040;
        min-height: calc(100vh - 200px);
        padding: 50px 20px;
        color: #fafafa;
    }

    .admin-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .admin-header {
        background-color: #eee;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
        margin-bottom: 30px;
        color: #333;
        text-align: center;
    }

    .admin-title {
        font-family: "Rubik", "sans-serif";
        font-size: 30px;
        font-weight: 700;
        color: #666;
        letter-spacing: 0.5px;
        margin: 0;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
    }

    .stat-card {
        background-color: #eee;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        color: #333;
        text-align: center;
        border-left: 4px solid #b52626;
    }

    .stat-number {
        font-size: 36px;
        font-weight: 700;
        color: #b52626;
        margin-bottom: 10px;
    }

    .stat-label {
        font-size: 16px;
        color: #555;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .admin-nav {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
    }

    .admin-nav-card {
        background-color: #eee;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        color: #333;
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        text-decoration: none;
        display: block;
    }

    .admin-nav-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
        color: #333;
        text-decoration: none;
    }

    .nav-icon {
        font-size: 48px;
        margin-bottom: 15px;
        color: #b52626;
    }

    .nav-title {
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 10px;
        color: #333;
    }

    .nav-description {
        font-size: 14px;
        color: #666;
        line-height: 1.4;
    }

    .recent-section {
        background-color: #eee;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        color: #333;
    }

    .recent-title {
        font-size: 22px;
        font-weight: 600;
        color: #333;
        margin-bottom: 20px;
        border-bottom: 2px solid #ddd;
        padding-bottom: 10px;
    }

    .recent-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .recent-item {
        padding: 15px 0;
        border-bottom: 1px solid #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .recent-item:last-child {
        border-bottom: none;
    }

    .recent-info {
        flex: 1;
    }

    .recent-project-title {
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
    }

    .recent-meta {
        font-size: 14px;
        color: #666;
    }

    .recent-status {
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

    @media (max-width: 768px) {

        .stats-grid,
        .admin-nav {
            grid-template-columns: 1fr;
        }

        .recent-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }
    }
</style>

<div class="admin-section">
    <div class="admin-container">
        <div class="admin-header">
            <h1 class="admin-title">Admin Dashboard</h1>
        </div>

        <!-- Statistics Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number"><?php echo $stats['total_users']; ?></div>
                <div class="stat-label">Total Users</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo $stats['total_projects']; ?></div>
                <div class="stat-label">Total Projects</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo $stats['pending_projects']; ?></div>
                <div class="stat-label">Pending Projects</div>
            </div>
        </div>

        <!-- Admin Navigation -->
        <div class="admin-nav">
            <a href="/admin/users" class="admin-nav-card">
                <div class="nav-icon">👥</div>
                <div class="nav-title">Manage Users</div>
                <div class="nav-description">View, edit, and manage user accounts</div>
            </a>
            <a href="/admin/specializations" class="admin-nav-card">
                <div class="nav-icon">🎓</div>
                <div class="nav-title">Specializations</div>
                <div class="nav-description">Add and manage academic specializations</div>
            </a>
            <a href="/projects" class="admin-nav-card">
                <div class="nav-icon">📚</div>
                <div class="nav-title">All Projects</div>
                <div class="nav-description">Browse and manage all projects</div>
            </a>
        </div>

        <!-- Recent Projects -->
        <div class="recent-section">
            <h2 class="recent-title">Recent Projects</h2>
            <?php if (!empty($stats['recent_projects'])): ?>
                <ul class="recent-list">
                    <?php foreach ($stats['recent_projects'] as $project): ?>
                        <li class="recent-item">
                            <div class="recent-info">
                                <div class="recent-project-title"><?php echo $view->escape($project['title']); ?></div>
                                <div class="recent-meta">
                                    by <?php echo $view->escape($project['author_name']); ?> •
                                    <?php echo date('M j, Y', strtotime($project['created_at'])); ?>
                                </div>
                            </div>
                            <span class="recent-status status-<?php echo $project['status']; ?>">
                                <?php echo $view->escape(ucfirst($project['status'])); ?>
                            </span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p style="color: #666; text-align: center; padding: 20px;">No recent projects found.</p>
            <?php endif; ?>
        </div>
    </div>
</div>