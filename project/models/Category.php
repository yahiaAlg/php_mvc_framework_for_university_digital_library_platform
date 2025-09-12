<?php

require_once __DIR__ . '/../core/Model.php';

class Category extends Model
{
    protected string $table = 'categories';
    protected array $fillable = ['name', 'description'];

    public function getProjectCategories(int $projectId): array
    {
        $sql = "
            SELECT c.*
            FROM {$this->table} c
            JOIN project_categories pc ON c.id = pc.category_id
            WHERE pc.project_id = ?
        ";

        return $this->database->query($sql, [$projectId])->fetchAll();
    }

    public function attachToProject(int $projectId, array $categoryIds): void
    {
        // First, remove existing categories
        $this->database->query(
            "DELETE FROM project_categories WHERE project_id = ?",
            [$projectId]
        );

        // Then add new categories
        foreach ($categoryIds as $categoryId) {
            $this->database->query(
                "INSERT INTO project_categories (project_id, category_id) VALUES (?, ?)",
                [$projectId, $categoryId]
            );
        }
    }
}