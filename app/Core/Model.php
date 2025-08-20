<?php
namespace App\Core;

use PDO;

class Model
{
    protected PDO $db;

    public function __construct()
    {
        $this->db = static::getDB();
    }

    public static function getDB()
    {
        static $pdo;
        try {
            if (!$pdo) {
                $host = $_ENV['DB_HOST'];
                $db   = $_ENV['DB_NAME'] ?? '';
                $user = $_ENV['DB_USER'];
                $pass = $_ENV['DB_PASSWORD'];
                $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
        return $pdo;
    }
}
