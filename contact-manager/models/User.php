<?php
class User
{
    public static function findByUsername(string $username): ?array
    {
        $st = Database::pdo()->prepare('SELECT * FROM users WHERE username = :u');
        $st->execute([':u' => $username]);
        return $st->fetch() ?: null;
    }

    public static function create(string $username, string $password): void
    {
        $st = Database::pdo()->prepare(
            'INSERT INTO users (username, password_hash) VALUES (:u, :h)'
        );
        $st->execute([':u' => $username, ':h' => password_hash($password, PASSWORD_DEFAULT)]);
    }
}
