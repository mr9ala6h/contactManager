<?php
class Contact
{
    public static function all(): array
    {
        return Database::pdo()->query('SELECT * FROM contacts ORDER BY name')->fetchAll();
    }

    public static function find(int $id): ?array
    {
        $st = Database::pdo()->prepare('SELECT * FROM contacts WHERE id = :id');
        $st->execute([':id' => $id]);
        return $st->fetch() ?: null;
    }

    public static function create(array $d): void
    {
        $st = Database::pdo()->prepare(
            'INSERT INTO contacts (name, email, phone) VALUES (:name, :email, :phone)'
        );
        $st->execute([':name' => $d['name'], ':email' => $d['email'], ':phone' => $d['phone']]);
    }

    public static function update(int $id, array $d): void
    {
        $st = Database::pdo()->prepare(
            'UPDATE contacts SET name = :name, email = :email, phone = :phone WHERE id = :id'
        );
        $st->execute([':name' => $d['name'], ':email' => $d['email'], ':phone' => $d['phone'], ':id' => $id]);
    }

    public static function delete(int $id): void
    {
        $st = Database::pdo()->prepare('DELETE FROM contacts WHERE id = :id');
        $st->execute([':id' => $id]);
    }
}
