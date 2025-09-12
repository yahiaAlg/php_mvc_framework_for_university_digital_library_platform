<?php

class Validator
{
    private array $errors = [];

    public function validate(array $data, array $rules): bool
    {
        $this->errors = [];

        foreach ($rules as $field => $fieldRules) {
            $value = $data[$field] ?? null;
            $this->validateField($field, $value, $fieldRules);
        }

        return empty($this->errors);
    }

    private function validateField(string $field, $value, array $rules): void
    {
        foreach ($rules as $rule) {
            if (is_string($rule)) {
                $this->applyRule($field, $value, $rule);
            } elseif (is_array($rule)) {
                $ruleName = $rule[0];
                $ruleParams = array_slice($rule, 1);
                $this->applyRule($field, $value, $ruleName, $ruleParams);
            }
        }
    }

    private function applyRule(string $field, $value, string $rule, array $params = []): void
    {
        switch ($rule) {
            case 'required':
                if (empty($value)) {
                    $this->errors[$field][] = ucfirst($field) . ' is required.';
                }
                break;

            case 'email':
                if (!empty($value) && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->errors[$field][] = ucfirst($field) . ' must be a valid email address.';
                }
                break;

            case 'min':
                $min = $params[0];
                if (!empty($value) && strlen($value) < $min) {
                    $this->errors[$field][] = ucfirst($field) . " must be at least {$min} characters.";
                }
                break;

            case 'max':
                $max = $params[0];
                if (!empty($value) && strlen($value) > $max) {
                    $this->errors[$field][] = ucfirst($field) . " must not exceed {$max} characters.";
                }
                break;

            case 'confirmed':
                $confirmField = $field . '_confirmation';
                if (!empty($value) && $value !== ($_POST[$confirmField] ?? '')) {
                    $this->errors[$field][] = ucfirst($field) . ' confirmation does not match.';
                }
                break;

            case 'unique':
                $table = $params[0];
                $column = $params[1] ?? $field;
                if (!empty($value) && $this->isValueExists($table, $column, $value)) {
                    $this->errors[$field][] = ucfirst($field) . ' is already taken.';
                }
                break;
        }
    }

    private function isValueExists(string $table, string $column, $value): bool
    {
        global $app;
        $database = $app->getDatabase();
        
        $result = $database->query(
            "SELECT COUNT(*) as count FROM {$table} WHERE {$column} = ?",
            [$value]
        )->fetch();

        return $result['count'] > 0;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function sanitize(array $data): array
    {
        $sanitized = [];
        
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $sanitized[$key] = trim(htmlspecialchars($value, ENT_QUOTES, 'UTF-8'));
            } else {
                $sanitized[$key] = $value;
            }
        }

        return $sanitized;
    }
}