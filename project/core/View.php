<?php

class View
{
    private string $viewsPath;
    private string $layoutsPath;

    public function __construct()
    {
        $this->viewsPath = __DIR__ . '/../views/';
        $this->layoutsPath = $this->viewsPath . 'layouts/';
    }

    public function render(string $view, array $data = []): void
    {
        // Store the view name before extract() overwrites it
        $viewName = $view;

        // Extract data to variables
        extract($data);

        // Start output buffering
        ob_start();

        // Include the view file - use $viewName instead of $view
        $viewFile = $this->viewsPath . str_replace('.', '/', $viewName) . '.php';

        if (!file_exists($viewFile)) {
            throw new Exception("View file not found: {$viewFile}");
        }

        include $viewFile;

        // Get the content
        $content = ob_get_clean();

        // Render with layout
        include $this->layoutsPath . 'main.php';
    }

    public function renderPartial(string $partial, array $data = []): string
    {
        extract($data);

        ob_start();
        $partialFile = $this->viewsPath . str_replace('.', '/', $partial) . '.php';

        if (file_exists($partialFile)) {
            include $partialFile;
        }

        return ob_get_clean();
    }

    public function escape(string $string): string
    {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }
}
