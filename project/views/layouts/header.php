<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $view->escape($title ?? 'UniGrad - Digital Library'); ?></title>
    <link rel="icon" type="image/png" href="/images/unilogo.png">

    <!-- Stylesheets -->
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/navbar.css" rel="stylesheet">
    <link href="/css/footer.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar sticky">
        <div class="logo">
            <a href="/"><img src="/images/unilogo.png" alt="Logo" class="logo-img"></a>
            <div class="logo-text">
                <div class="logo-title">UniGrad</div>
                <div class="logo-subtitle">Inspiring Tomorrow</div>
            </div>
        </div>

        <ul class="nav-links">
            <li><a href="/">Home</a></li>
            <li><a href="/projects">Browse</a></li>
            <li><a href="/#about">About</a></li>
            <li><a href="/#cta">Contact Us</a></li>
        </ul>

        <?php if ($user): ?>
            <div class="user-dropdown">
                <button class="contact-btn dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle me-1"></i>
                    <?php echo $view->escape($user['full_name']); ?>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="/profile">
                            <i class="bi bi-person me-2"></i>Profile
                        </a></li>
                    <li><a class="dropdown-item" href="/projects/dashboard">
                            <i class="bi bi-collection me-2"></i>My Projects
                        </a></li>
                    <li><a class="dropdown-item" href="/projects/upload">
                            <i class="bi bi-upload me-2"></i>Upload Project
                        </a></li>
                    <?php if ($user['role'] === 'admin'): ?>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="/admin/dashboard">
                                <i class="bi bi-speedometer2 me-2"></i>Admin Panel
                            </a></li>
                    <?php endif; ?>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="/logout">
                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                        </a></li>
                </ul>
            </div>
        <?php else: ?>
            <a href="/login" class="contact-btn">Login</a>
        <?php endif; ?>
    </nav>

    <!-- Flash Messages -->
    <?php if (!empty($errors)): ?>
        <div class="container mt-3">
            <div class="alert alert-danger alert-dismissible fade show">
                <strong>Error!</strong>
                <ul class="mb-0">
                    <?php foreach ($errors as $field => $fieldErrors): ?>
                        <?php if (is_array($fieldErrors)): ?>
                            <?php foreach ($fieldErrors as $error): ?>
                                <li><?php echo $view->escape($error); ?></li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li><?php echo $view->escape($fieldErrors); ?></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <div class="container mt-3">
            <div class="alert alert-success alert-dismissible fade show">
                <?php echo $view->escape($success); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    <?php endif; ?>