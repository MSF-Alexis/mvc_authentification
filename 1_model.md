markdown authentification suivant

# 1. Modèle User

## 🎯 Objectif

Créer la classe `User` pour gérer la persistance des utilisateurs en base de données, en utilisant les acquis du projet MVC précédent.

## 📋 Table `users`

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pseudo VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
```

## 🏗️ Classe `User` (app/Models/User.php)

```php
<?php

namespace App\Models;

use App\Core\Model;

class User extends Model
{
    static string $table = 'users';

    // Enregistre un nouvel utilisateur
    public function store(array $data): bool
    {
        // TODO: Implémentez cette méthode
        // Utilisez les requêtes préparées pour insérer pseudo, email et password
        // Retournez true/false selon le succès
    }

    // Recherche un utilisateur par email
    public function findByEmail(string $email): array|null
    {
        // TODO: Implémentez cette méthode
        // Utilisez une requête préparée avec WHERE email = :email
        // Retournez le tableau associatif ou null si non trouvé
    }

    // Recherche un utilisateur par ID
    public function findById(int $id): array|null
    {
        // TODO: Implémentez cette méthode
        // Récupérez id, pseudo, email, created_at (sans le password)
        // Retournez le tableau associatif ou null si non trouvé
    }
}
```

---

## ✅ Test de votre implémentation

```php
// Dans un fichier de test
$userModel = new \App\Models\User();

// Test store()
$created = $userModel->store([
    'pseudo' => 'testuser',
    'email'  => 'test@example.com',
    'password'=> password_hash('secret', PASSWORD_ARGON2I),
]);
var_dump($created); // Doit afficher true

// Test findByEmail()
$user = $userModel->findByEmail('test@example.com');
var_dump($user['pseudo']); // Doit afficher 'testuser'

// Test findById()
$userById = $userModel->findById($user['id']);
var_dump(isset($userById['password'])); // Doit afficher false
```

## 🎯 Objectifs d'apprentissage

Cette étape vous permet de :
1. **Réviser** les requêtes préparées et la sécurité
2. **Pratiquer** l'héritage de classe avec Model
3. **Implémenter** des méthodes CRUD essentielles
