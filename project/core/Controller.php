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

    protected function render(string $viewName, array $data = []): void
    {
        // echo "DEBUG Controller::render() called with viewName: ";
        // var_dump($viewName);
        // echo "\n";

        $data['user'] = $this->getCurrentUser();
        $data['errors'] = $this->session->getFlash('errors') ?? [];
        $data['success'] = $this->session->getFlash('success') ?? '';
        $data['view'] = $this->view;

        // echo "DEBUG About to call \$this->view->render() with parameters:\n";
        // echo "First param (should be viewName): ";
        // var_dump($viewName);
        // echo "Second param (data array keys): ";
        // var_dump(array_keys($data));
        // echo "\n";

        $this->view->render($viewName, $data);
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
