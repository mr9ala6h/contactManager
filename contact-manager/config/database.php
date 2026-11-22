<?php
class Database
{
    private static ?PDO $pdo = null;

    public static function pdo(): PDO
    {
        if (self::$pdo === null) {
            $c = require __DIR__ . '/config.php';
            $dsn = "mysql:host={$c['host']};dbname={$c['db']};charset=utf8mb4";
            try {
                self::$pdo = new PDO($dsn, $c['user'], $c['pass'], [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ]);
            } catch (PDOException $e) {
                error_log($e->getMessage());
                http_response_code(500);
                exit('Database connection failed.');
            }
        }
        return self::$pdo;
    }
}
