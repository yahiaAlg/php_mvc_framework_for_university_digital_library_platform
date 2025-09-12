<?php

require_once __DIR__ . '/../core/Model.php';

class Project extends Model
{
    protected string $table = 'projects';
    protected array $fillable = [
        'title', 'description', 'author_name', 'supervisor',
        'specialization_id', 'user_id', 'file_path', 'year',
        'keywords', 'status', 'created_at', 'updated_at'
    ];

    public function findWithDetails(int $id): ?array
    {
        $sql = "
            SELECT p.*, s.name as specialization_name, s.faculty,
                   u.full_name as uploaded_by
            FROM {$this->table} p
            LEFT JOIN specializations s ON p.specialization_id = s.id
            LEFT JOIN users u ON p.user_id = u.id
            WHERE p.id = ?
        ";

        $result = $this->database->query($sql, [$id])->fetch();
        return $result ?: null;
    }

    public function findByUser(int $userId, int $page = 1, int $perPage = 12): array
    {
        return $this->paginate($page, $perPage, ['user_id' => $userId]);
    }

    public function search(?string $query = null, array $conditions = [], int $page = 1, int $perPage = 12): array
    {
        $offset = ($page - 1) * $perPage;
        
        $sql = "
            SELECT p.*, s.name as specialization_name, s.faculty
            FROM {$this->table} p
            LEFT JOIN specializations s ON p.specialization_id = s.id
            WHERE p.status = 'approved'
        ";
        
        $params = [];
        
        // Add search conditions
        if ($query) {
            $sql .= " AND (p.title LIKE ? OR p.description LIKE ? OR p.keywords LIKE ? OR p.author_name LIKE ?)";
            $searchTerm = "%{$query}%";
            $params = array_fill(0, 4, $searchTerm);
        }
        
        // Add other conditions
        if (!empty($conditions)) {
            foreach ($conditions as $column => $value) {
                $sql .= " AND p.{$column} = ?";
                $params[] = $value;
            }
        }
        
        // Get total count
        $countSql = str_replace('SELECT p.*, s.name as specialization_name, s.faculty', 'SELECT COUNT(*) as total', $sql);
        $total = $this->database->query($countSql, $params)->fetch()['total'];
        
        // Add ordering and pagination
        $sql .= " ORDER BY p.created_at DESC LIMIT {$perPage} OFFSET {$offset}";
        $results = $this->database->query($sql, $params)->fetchAll();
        
        return [
            'data' => $results,
            'total' => $total,
            'current_page' => $page,
            'per_page' => $perPage,
            'last_page' => ceil($total / $perPage)
        ];
    }

    public function getRecent(int $limit = 5): array
    {
        $sql = "
            SELECT p.*, s.name as specialization_name
            FROM {$this->table} p
            LEFT JOIN specializations s ON p.specialization_id = s.id
            WHERE p.status = 'approved'
            ORDER BY p.created_at DESC
            LIMIT {$limit}
        ";

        return $this->database->query($sql)->fetchAll();
    }

    public function count(): int
    {
        return $this->database->query("SELECT COUNT(*) as count FROM {$this->table}")
                              ->fetch()['count'];
    }

    public function countByStatus(string $status): int
    {
        return $this->database->query(
            "SELECT COUNT(*) as count FROM {$this->table} WHERE status = ?",
            [$status]
        )->fetch()['count'];
    }

    public function create(array $data): int
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        
        return parent::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        
        return parent::update($id, $data);
    }
}