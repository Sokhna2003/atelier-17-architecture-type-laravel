<?php
declare(strict_types=1);

namespace Core;

class Database
{
    private static ?\PDO $pdo = null;

    public static function connect(): \PDO
    {
        if (self::$pdo === null) {
            $config = require dirname(__DIR__) . '/config/database.php';
            self::$pdo = new \PDO(
                "mysql:host={$config['host']};dbname={$config['dbname']}",
                $config['user'],
                $config['password'],
                [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                ]
            );
        }
        return self::$pdo;
    }
}
