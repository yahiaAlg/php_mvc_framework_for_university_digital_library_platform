<?php

abstract class Model
{
    protected Database $database;
    protected string $table;
    protected string $primaryKey = 'id';
    protected array $fillable = [];

    public function __construct()
    {
        global $app;
        $this->database = $app->getDatabase();
    }

    public function findAll(): array
    {
        return $this->database->query("SELECT * FROM {$this->table}")->fetchAll();
    }

    public function findById(int $id): ?array
    {
        $result = $this->database->query(
            "SELECT * FROM {$this->table} WHERE {$this->primaryKey} = ?",
            [$id]
        )->fetch();

        return $result ?: null;
    }

    public function create(array $data): int
    {
        $filteredData = $this->filterFillable($data);
        $columns = implode(', ', array_keys($filteredData));
        $placeholders = ':' . implode(', :', array_keys($filteredData));

        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";
        $this->database->query($sql, $filteredData);

        return $this->database->lastInsertId();
    }

    public function update(int $id, array $data): bool
    {
        $filteredData = $this->filterFillable($data);
        $setPairs = [];

        foreach (array_keys($filteredData) as $column) {
            $setPairs[] = "{$column} = :{$column}";
        }

        $setClause = implode(', ', $setPairs);
        $filteredData[$this->primaryKey] = $id;

        $sql = "UPDATE {$this->table} SET {$setClause} WHERE {$this->primaryKey} = :{$this->primaryKey}";
        
        return $this->database->query($sql, $filteredData)->rowCount() > 0;
    }

    public function delete(int $id): bool
    {
        return $this->database->query(
            "DELETE FROM {$this->table} WHERE {$this->primaryKey} = ?",
            [$id]
        )->rowCount() > 0;
    }

    public function paginate(int $page = 1, int $perPage = 12, array $conditions = []): array
    {
        $offset = ($page - 1) * $perPage;
        
        $whereClause = '';
        $params = [];
        
        if (!empty($conditions)) {
            $whereConditions = [];
            foreach ($conditions as $column => $value) {
                $whereConditions[] = "{$column} = ?";
                $params[] = $value;
            }
            $whereClause = 'WHERE ' . implode(' AND ', $whereConditions);
        }

        // Get total count
        $countSql = "SELECT COUNT(*) as total FROM {$this->table} {$whereClause}";
        $total = $this->database->query($countSql, $params)->fetch()['total'];

        // Get paginated results
        $sql = "SELECT * FROM {$this->table} {$whereClause} LIMIT {$perPage} OFFSET {$offset}";
        $results = $this->database->query($sql, $params)->fetchAll();

        return [
            'data' => $results,
            'total' => $total,
            'current_page' => $page,
            'per_page' => $perPage,
            'last_page' => ceil($total / $perPage)
        ];
    }

    protected function filterFillable(array $data): array
    {
        return array_intersect_key($data, array_flip($this->fillable));
    }
}