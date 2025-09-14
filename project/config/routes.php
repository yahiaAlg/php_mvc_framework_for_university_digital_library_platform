<?php

return [
    // Home routes
    '/' => ['HomeController', 'index'],
    '/home' => ['HomeController', 'index'],
    '/about' => ['HomeController', 'about'],

    // Language switching
    '/language/switch' => ['LanguageController', 'switch'],

    // Authentication routes
    '/login' => ['AuthController', 'login'],
    '/register' => ['AuthController', 'register'],
    '/logout' => ['AuthController', 'logout'],

    // Project routes
    '/projects' => ['ProjectController', 'listings'],
    '/projects/(\d+)' => ['ProjectController', 'detail'],
    '/projects/upload' => ['ProjectController', 'upload'],
    '/projects/(\d+)/edit' => ['ProjectController', 'edit'],
    '/projects/(\d+)/delete' => ['ProjectController', 'delete'],
    '/projects/dashboard' => ['ProjectController', 'dashboard'],
    '/projects/download/(\d+)' => ['ProjectController', 'download'],

    // User routes
    '/profile' => ['UserController', 'profile'],
    '/profile/edit' => ['UserController', 'editProfile'],

    // Admin routes
    '/admin/dashboard' => ['DashboardController', 'index'],
    '/admin/users' => ['DashboardController', 'users'],
    '/admin/users/(\d+)/edit' => ['DashboardController', 'editUser'],
    '/admin/users/(\d+)/delete' => ['DashboardController', 'deleteUser'],
    '/admin/specializations' => ['DashboardController', 'specializations'],
    '/admin/specializations/(\d+)/edit' => ['DashboardController', 'editSpecialization'],
    '/admin/specializations/(\d+)/delete' => ['DashboardController', 'deleteSpecialization'],
    '/admin/projects' => ['DashboardController', 'adminProjects'],
    '/admin/projects/(\d+)/edit' => ['DashboardController', 'editProject'],
    '/admin/projects/(\d+)/approve' => ['DashboardController', 'approveProject'],
    '/admin/projects/(\d+)/reject' => ['DashboardController', 'rejectProject'],
    '/admin/projects/(\d+)/delete' => ['DashboardController', 'deleteProject'],
    '/admin/categories' => ['DashboardController', 'categories'],
    '/admin/categories/(\d+)/edit' => ['DashboardController', 'editCategory'],
    '/admin/categories/(\d+)/delete' => ['DashboardController', 'deleteCategory'],
];
