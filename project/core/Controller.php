<?php

abstract class Controller
{
    protected View $view;
    protected Session $session;
    protected Database $database;
    protected Validator $validator;

    public function __construct()
    {
        global $app;
        $this->view = new View();
        $this->session = $app->getSession();
        $this->database = $app->getDatabase();
        $this->validator = new Validator();
    }

    protected function render(string $view, array $data = []): void
    {
        $data['user'] = $this->getCurrentUser();
        $data['errors'] = $this->session->getFlash('errors') ?? [];
        $data['success'] = $this->session->getFlash('success') ?? '';
        
        $this->view->render($view, $data);
    }

    protected function redirect(string $path): void
    {
        header("Location: $path");
        exit;
    }

    protected function getCurrentUser(): ?array
    {
        $userId = $this->session->get('user_id');
        if (!$userId) {
            return null;
        }

        $userModel = new User();
        return $userModel->findById($userId);
    }

    protected function requireAuth(): void
    {
        if (!$this->getCurrentUser()) {
            $this->session->setFlash('errors', ['Please log in to access this page.']);
            $this->redirect('/login');
        }
    }

    protected function requireRole(string $role): void
    {
        $user = $this->getCurrentUser();
        if (!$user || $user['role'] !== $role) {
            http_response_code(403);
            $this->render('errors/403');
            exit;
        }
    }

    protected function handleFormSubmission(string $method = 'POST'): bool
    {
        return $_SERVER['REQUEST_METHOD'] === $method;
    }
}