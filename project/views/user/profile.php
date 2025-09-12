<!-- Main content for profile template -->
<style>
    .profile-section {
        background-color: #414040;
        min-height: calc(100vh - 200px);
        padding: 50px 20px;
        color: #fafafa;
    }

    .profile-container {
        max-width: 800px;
        margin: 0 auto;
        background-color: #eee;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
        color: #333;
    }

    .profile-header {
        text-align: center;
        margin-bottom: 40px;
        padding-bottom: 20px;
        border-bottom: 2px solid #ddd;
    }

    .profile-title {
        font-family: "Rubik", "sans-serif";
        font-size: 30px;
        font-weight: 700;
        color: #666;
        margin-bottom: 10px;
        letter-spacing: 0.5px;
    }

    .profile-avatar {
        width: 100px;
        height: 100px;
        background-color: #555;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0 auto 20px;
        color: #ddd;
        font-size: 40px;
    }

    .profile-info {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        margin-bottom: 30px;
    }

    .info-group {
        background-color: #f8f8f8;
        padding: 20px;
        border-radius: 6px;
        border-left: 4px solid #b52626;
    }

    .info-label {
        font-weight: 600;
        color: #555;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }

    .info-value {
        font-size: 18px;
        color: #333;
        font-weight: 400;
    }

    .profile-actions {
        text-align: center;
        margin-top: 30px;
    }

    .edit-btn {
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
        margin: 0 10px;
    }

    .edit-btn:hover {
        background-color: #333;
        color: #ddd;
    }

    .dashboard-btn {
        background-color: #b52626;
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
        margin: 0 10px;
    }

    .dashboard-btn:hover {
        background-color: #8d1d1d;
        color: #ddd;
    }

    @media (max-width: 768px) {
        .profile-container {
            padding: 30px 20px;
        }

        .profile-info {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .profile-actions {
            flex-direction: column;
        }

        .edit-btn,
        .dashboard-btn {
            margin: 10px 0;
            width: 100%;
        }
    }
</style>

<div class="profile-section">
    <div class="profile-container">
        <div class="profile-header">
            <div class="profile-avatar">
                <i class="bi bi-person-circle"></i>
            </div>
            <h1 class="profile-title">My Profile</h1>
        </div>

        <div class="profile-info">
            <div class="info-group">
                <div class="info-label">Full Name</div>
                <div class="info-value"><?php echo $view->escape($user['full_name']); ?></div>
            </div>

            <div class="info-group">
                <div class="info-label">Username</div>
                <div class="info-value"><?php echo $view->escape($user['username']); ?></div>
            </div>

            <div class="info-group">
                <div class="info-label">Email</div>
                <div class="info-value"><?php echo $view->escape($user['email']); ?></div>
            </div>

            <div class="info-group">
                <div class="info-label">Specialization</div>
                <div class="info-value"><?php echo $view->escape($specialization['name'] ?? 'Not specified'); ?></div>
            </div>

            <div class="info-group">
                <div class="info-label">Role</div>
                <div class="info-value"><?php echo $view->escape(ucfirst($user['role'])); ?></div>
            </div>

            <div class="info-group">
                <div class="info-label">Member Since</div>
                <div class="info-value"><?php echo date('F j, Y', strtotime($user['created_at'])); ?></div>
            </div>
        </div>

        <div class="profile-actions">
            <a href="/profile/edit" class="edit-btn">Edit Profile</a>
            <a href="/projects/dashboard" class="dashboard-btn">My Projects</a>
        </div>
    </div>
</div>