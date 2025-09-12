<?php

require_once __DIR__ . '/../core/Model.php';

class Specialization extends Model
{
    protected string $table = 'specializations';
    protected array $fillable = ['name', 'faculty', 'description'];

    public function findByFaculty(string $faculty): array
    {
        return $this->database->query(
            "SELECT * FROM {$this->table} WHERE faculty = ? ORDER BY name",
            [$faculty]
        )->fetchAll();
    }

    public function getWithProjectCounts(): array
    {
        $sql = "
            SELECT s.*, COUNT(p.id) as project_count
            FROM {$this->table} s
            LEFT JOIN projects p ON s.id = p.specialization_id AND p.status = 'approved'
            GROUP BY s.id
            ORDER BY s.name
        ";

        return $this->database->query($sql)->fetchAll();
    }
}