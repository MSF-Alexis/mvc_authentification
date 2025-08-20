<?php
namespace App\Models;

use App\Core\Model;

class User extends Model
{
    static string $table = "users";

    public function store(array $data): bool
    {
        try {
            $query = sprintf("
            INSERT INTO %s (name, email, password) 
            VALUES (:name, :email, :password)
        ", self::$table);

            $stmt = $this->db->prepare($query);

            return $stmt->execute([
                'name' => $data['pseudo'],
                'email' => $data['email'],
                'password' => $data['password'],
            ]);
        } catch (\PDOException $e) {
            $className = static::class;
            error_log("[$className::store] Erreur lors de l'insertion en base : " . $e->getMessage());
            return false;
        } catch (\Exception $e) {
            $className = static::class;
            error_log("[$className::store] Erreur inattendue dans store() : " . $e->getMessage());
            return false;
        }
    }

    public function findByEmail(string $email): array | null
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM " . self::$table . " WHERE email = ?");
            $stmt->execute([$email]);
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);

            return $result ? $result : null;
        } catch (\PDOException $e) {
            $className = static::class;
            error_log("[$className::getByEmail] Erreur lecture utilisateur : " . $e->getMessage());
            return null;
        }
    }
}