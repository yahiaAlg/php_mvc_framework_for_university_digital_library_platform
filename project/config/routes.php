<?php

return [
    // Home routes
    '/' => ['HomeController', 'index'],
    '/home' => ['HomeController', 'index'],
    '/about' => ['HomeController', 'about'],
    
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
    '/admin/specializations' => ['DashboardController', 'specializations'],
];