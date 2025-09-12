<?php

// Set error reporting for development
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Define base path
define('BASE_PATH', dirname(__DIR__));

// Load core classes
require_once BASE_PATH . '/core/Application.php';
require_once BASE_PATH . '/core/Controller.php';
require_once BASE_PATH . '/core/Model.php';
require_once BASE_PATH . '/core/View.php';
require_once BASE_PATH . '/core/Router.php';
require_once BASE_PATH . '/core/Database.php';
require_once BASE_PATH . '/core/Session.php';
require_once BASE_PATH . '/core/Validator.php';

// Load models
require_once BASE_PATH . '/models/User.php';
require_once BASE_PATH . '/models/Project.php';
require_once BASE_PATH . '/models/Specialization.php';
require_once BASE_PATH . '/models/Category.php';

// Create and run application
try {
    $app = new Application();
    $GLOBALS['app'] = $app;
    $app->run();
} catch (Exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo "Something went wrong. Please try again later.";
}