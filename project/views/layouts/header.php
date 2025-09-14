<?php
// Get current language and supported languages
$currentLang = $i18n->getCurrentLanguage();
$supportedLanguages = $i18n->getSupportedLanguages();
$isRtl = $i18n->isRtl();

// Determine current page from REQUEST_URI
$currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$currentPath = rtrim($currentPath, '/') ?: '/';

// Define pages that should use the simple navbar
$simpleNavbarPages = ['/login', '/register'];

// Check if current path should use simple navbar (only if not logged in)
$useSimpleNavbar = false;
if (!$user) {
    foreach ($simpleNavbarPages as $page) {
        if ($currentPath === $page) {
            $useSimpleNavbar = true;
            break;
        }
    }

    // Also check for other projects pages (use simple navbar only if not logged in)
    if ($currentPath === '/projects' || strpos($currentPath, '/projects/') === 0) {
        $useSimpleNavbar = true;
    }
}

// Check for projects detail page (no navbar CSS)
$isProjectDetail = preg_match('/^\/projects\/\d+$/', $currentPath);
?>

<!DOCTYPE html>
<html lang="<?php echo $currentLang; ?>" dir="<?php echo $isRtl ? 'rtl' : 'ltr'; ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "UniGrad-" . $view->escape($title ?? __('common.title')); ?></title>
    <link rel="icon" type="image/png" href="/images/unilogo.png">

    <!-- Stylesheets -->
    <?php if ($currentPath === '/' || $currentPath === '/home'): ?>
        <link href="/css/style.css" rel="stylesheet">
    <?php endif; ?>
    <?php if ($isProjectDetail): ?>
        <link href="/css/navbar.css" rel="stylesheet">
    <?php elseif ($useSimpleNavbar): ?>
        <link href="/css/simple-navbar.css" rel="stylesheet">
    <?php else: ?>
        <link href="/css/navbar.css" rel="stylesheet">
    <?php endif; ?>
    <link href="/css/footer.css" rel="stylesheet">

    <!-- RTL Styles for Arabic -->
    <?php if ($isRtl): ?>
        <link href="/css/rtl.css" rel="stylesheet">
    <?php endif; ?>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <?php if ($currentLang === 'ar'): ?>
        <!-- Arabic fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@100..900&display=swap" rel="stylesheet">
    <?php else: ?>
        <!-- Latin fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <?php endif; ?>

    <style>
        .btn-primary {
            background-color: #8d1d1d;
            border-color: #8d1d1d;
        }

        .btn-primary:hover {
            background-color: #8d1d1d;
            border-color: #8d1d1d;
        }

        <?php if ($currentLang === 'ar'): ?>body {
            font-family: 'Noto Sans Arabic', sans-serif;
        }

        <?php endif; ?>

        /* Language Selector Styles */
        .language-selector {
            position: relative;
            margin-left: 1rem;
        }

        .language-selector .dropdown-menu {
            min-width: 150px;
        }

        .language-option {
            display: flex;
            align-items: center;
            padding: 0.5rem 1rem;
            text-decoration: none;
            color: #333;
            transition: background-color 0.2s;
        }

        .language-option:hover {
            background-color: #f8f9fa;
            color: #333;
        }

        .language-flag {
            margin-right: 0.5rem;
            font-size: 1.2em;
        }

        .current-language {
            display: flex;
            align-items: center;
            padding: 0.375rem 0.75rem;
            background: transparent;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
            color: #495057;
            cursor: pointer;
        }

        .current-language:hover {
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <?php if ($useSimpleNavbar && (!$isProjectDetail)) : ?>
        <nav class="navbar">
            <a href="/">
                <div class="logo">
                    <img src="/images/unilogo.png" alt="UniGrad Logo" class="logo-img">
                    <div class="logo-text">
                        <div class="logo-title">UniGrad</div>
                        <div class="logo-subtitle"><?php echo __('nav.inspiring_tomorrow'); ?></div>
                    </div>
                </div>
            </a>

            <div class="d-flex align-items-center">
                <!-- Language Selector -->
                <div class="language-selector dropdown">
                    <button class="current-language dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <span class="language-flag"><?php echo $supportedLanguages[$currentLang]['flag']; ?></span>
                        <span><?php echo $supportedLanguages[$currentLang]['name']; ?></span>
                    </button>
                    <ul class="dropdown-menu">
                        <?php foreach ($supportedLanguages as $langCode => $langData): ?>
                            <?php if ($langCode !== $currentLang): ?>
                                <li>
                                    <form method="POST" action="/language/switch" class="m-0">
                                        <input type="hidden" name="language" value="<?php echo $langCode; ?>">
                                        <input type="hidden" name="redirect" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                                        <button type="submit" class="language-option border-0 bg-transparent w-100 text-start">
                                            <span class="language-flag"><?php echo $langData['flag']; ?></span>
                                            <span><?php echo $langData['name']; ?></span>
                                        </button>
                                    </form>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <?php if (!$user): ?>
                    <a href="/login" class="sign-in-link"><?php echo __('nav.sign_in'); ?></a>
                <?php else: ?>
                    <div class="user-dropdown">
                        <button class="contact-btn dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i>
                            <?php echo $view->escape($user['full_name']); ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="/profile">
                                    <i class="bi bi-person me-2"></i><?php echo __('nav.profile'); ?>
                                </a></li>
                            <li><a class="dropdown-item" href="/projects/dashboard">
                                    <i class="bi bi-collection me-2"></i><?php echo __('nav.my_projects'); ?>
                                </a></li>
                            <li><a class="dropdown-item" href="/projects/upload">
                                    <i class="bi bi-upload me-2"></i><?php echo __('nav.upload_project'); ?>
                                </a></li>
                            <?php if ($user['role'] === 'admin'): ?>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="/admin/dashboard">
                                        <i class="bi bi-speedometer2 me-2"></i><?php echo __('nav.admin_panel'); ?>
                                    </a></li>
                            <?php endif; ?>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="/logout">
                                    <i class="bi bi-box-arrow-right me-2"></i><?php echo __('nav.logout'); ?>
                                </a></li>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </nav>
    <?php else: ?>
        <nav class="navbar sticky">
            <div class="logo">
                <a href="/"><img src="/images/unilogo.png" alt="Logo" class="logo-img"></a>
                <div class="logo-text">
                    <div class="logo-title">UniGrad</div>
                    <div class="logo-subtitle"><?php echo __('nav.inspiring_tomorrow'); ?></div>
                </div>
            </div>

            <ul class="nav-links">
                <li><a href="/"><?php echo __('nav.home'); ?></a></li>
                <li><a href="/projects"><?php echo __('nav.browse'); ?></a></li>
                <li><a href="/about"><?php echo __('nav.about'); ?></a></li>
                <li><a href="/#cta"><?php echo __('nav.contact_us'); ?></a></li>
            </ul>

            <div class="d-flex align-items-center">
                <!-- Language Selector -->
                <div class="language-selector dropdown">
                    <button class="current-language dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <span class="language-flag"><?php echo $supportedLanguages[$currentLang]['flag']; ?></span>
                        <span><?php echo $supportedLanguages[$currentLang]['name']; ?></span>
                    </button>
                    <ul class="dropdown-menu">
                        <?php foreach ($supportedLanguages as $langCode => $langData): ?>
                            <?php if ($langCode !== $currentLang): ?>
                                <li>
                                    <form method="POST" action="/language/switch" class="m-0">
                                        <input type="hidden" name="language" value="<?php echo $langCode; ?>">
                                        <input type="hidden" name="redirect" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                                        <button type="submit" class="language-option border-0 bg-transparent w-100 text-start">
                                            <span class="language-flag"><?php echo $langData['flag']; ?></span>
                                            <span><?php echo $langData['name']; ?></span>
                                        </button>
                                    </form>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <?php if ($user): ?>
                    <div class="user-dropdown">
                        <button class="contact-btn dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i>
                            <?php echo $view->escape($user['full_name']); ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="/profile">
                                    <i class="bi bi-person me-2"></i><?php echo __('nav.profile'); ?>
                                </a></li>
                            <li><a class="dropdown-item" href="/projects/dashboard">
                                    <i class="bi bi-collection me-2"></i><?php echo __('nav.my_projects'); ?>
                                </a></li>
                            <li><a class="dropdown-item" href="/projects/upload">
                                    <i class="bi bi-upload me-2"></i><?php echo __('nav.upload_project'); ?>
                                </a></li>
                            <?php if ($user['role'] === 'admin'): ?>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="/admin/dashboard">
                                        <i class="bi bi-speedometer2 me-2"></i><?php echo __('nav.admin_panel'); ?>
                                    </a></li>
                            <?php endif; ?>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="/logout">
                                    <i class="bi bi-box-arrow-right me-2"></i><?php echo __('nav.logout'); ?>
                                </a></li>
                        </ul>
                    </div>
                <?php else: ?>
                    <a href="/login" class="contact-btn"><?php echo __('nav.login'); ?></a>
                <?php endif; ?>
            </div>
        </nav>
    <?php endif; ?>

    <!-- Flash Messages -->
    <?php if (!empty($errors)): ?>
        <div class="container mt-3">
            <div class="alert alert-danger alert-dismissible fade show">
                <strong><?php echo __('common.error'); ?>!</strong>
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