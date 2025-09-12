<?php

require_once __DIR__ . '/../core/Model.php';

class User extends Model
{
    protected string $table = 'users';
    protected array $fillable = [
        'username', 'email', 'password_hash', 'full_name', 
        'specialization_id', 'role', 'created_at', 'updated_at'
    ];

    public function findByEmail(string $email): ?array
    {
        $result = $this->database->query(
            "SELECT * FROM {$this->table} WHERE email = ?",
            [$email]
        )->fetch();

        return $result ?: null;
    }

    public function findByUsername(string $username): ?array
    {
        $result = $this->database->query(
            "SELECT * FROM {$this->table} WHERE username = ?",
            [$username]
        )->fetch();

        return $result ?: null;
    }

    public function count(): int
    {
        return $this->database->query("SELECT COUNT(*) as count FROM {$this->table}")
                              ->fetch()['count'];
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