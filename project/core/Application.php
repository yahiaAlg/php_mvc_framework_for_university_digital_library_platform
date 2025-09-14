<?php

class Application
{
    private Router $router;
    private Database $database;
    private Session $session;
    private I18n $i18n;
    private array $config;

    public function __construct()
    {
        $this->loadConfig();
        $this->initializeCore();
        $this->startSession();
        $this->initializeI18n();
    }

    private function loadConfig(): void
    {
        $this->config = [
            'app' => require_once __DIR__ . '/../config/app.php',
            'database' => require_once __DIR__ . '/../config/database.php',
            'routes' => require_once __DIR__ . '/../config/routes.php',
        ];
    }

    private function initializeCore(): void
    {
        $this->database = new Database($this->config['database']);
        $this->session = new Session();
        $this->router = new Router($this->config['routes']);
    }

    private function startSession(): void
    {
        $this->session->start();
    }

    private function initializeI18n(): void
    {
        require_once __DIR__ . '/I18n.php';
        $this->i18n = I18n::getInstance();
        $this->i18n->initializeFromSession($this->session);

        // Set the session reference for future language changes
        $this->i18n->setSession($this->session);
    }

    public function run(): void
    {
        try {
            $this->router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
        } catch (Exception $e) {
            $this->handleError($e);
        }
    }

    private function handleError(Exception $e): void
    {
        error_log($e->getMessage());

        if ($e->getCode() === 404) {
            http_response_code(404);
            include __DIR__ . '/../views/errors/404.php';
        } else {
            http_response_code(500);
            include __DIR__ . '/../views/errors/500.php';
        }
    }

    public function getConfig(string $key = null)
    {
        if ($key === null) {
            return $this->config;
        }

        return $this->config[$key] ?? null;
    }

    public function getDatabase(): Database
    {
        return $this->database;
    }

    public function getSession(): Session
    {
        return $this->session;
    }

    public function getI18n(): I18n
    {
        return $this->i18n;
    }
}
