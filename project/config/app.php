<?php

return [
    'name' => 'University Digital Library',
    'url' => $_ENV['APP_URL'] ?? 'http://localhost',
    'timezone' => 'UTC',
    'upload_path' => 'public/uploads/',
    'allowed_file_types' => ['pdf', 'doc', 'docx', 'png', 'jpg', 'jpeg'],
    'max_file_size' => 10485760, // 10MB
    'items_per_page' => 12,
    'session_lifetime' => 7200, // 2 hours
];
