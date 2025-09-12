<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $view->escape($title ?? 'Digital Library'); ?></title>
    <link href="/css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">
                <i class="bi bi-book me-2"></i>Digital Library
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/projects">Browse Projects</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/about">About</a>
                    </li>
                </ul>
                
                <ul class="navbar-nav">
                    <?php if ($user): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i>
                                <?php echo $view->escape($user['full_name']); ?>
                            </a>
                            <ul class="dropdown-menu">
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
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="/admin/dashboard">
                                        <i class="bi bi-speedometer2 me-2"></i>Admin Panel
                                    </a></li>
                                <?php endif; ?>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="/logout">
                                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                                </a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/login">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/register">Register</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

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