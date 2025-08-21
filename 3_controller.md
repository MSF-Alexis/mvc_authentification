# 3. Contrôleur d'Authentification (AuthController)

## 🎯 Objectif

Créer le contrôleur `AuthController` pour gérer l'inscription, la connexion et la déconnexion des utilisateurs en appliquant les concepts PHP du cours initial.

## 📋 Méthodes à implémenter

**TODO: Implémentez les méthodes suivantes**

```php
<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class AuthController extends Controller
{
    private User $user;

    public function __construct()
    {
        $this->user = new User();
        // TODO: Démarrer la session si nécessaire
    }

    public function showRegisterForm()
    {
        // TODO: Afficher le formulaire d'inscription
        // Utilisez $this->render() avec 'auth/register'
    }

    public function register()
    {
        // TODO: Traiter l'inscription
        // 1. Récupérer et nettoyer les données $_POST
        // 2. Valider les données (pseudo, email, password)
        // 3. Hasher le mot de passe
        // 4. Enregistrer en base avec $this->user->store()
        // 5. Créer la session et rediriger
    }

    public function showLoginForm()
    {
        // TODO: Afficher le formulaire de connexion
        // Utilisez $this->render() avec 'auth/login'
    }

    public function login()
    {
        // TODO: Traiter la connexion
        // 1. Récupérer et valider email/password
        // 2. Vérifier l'utilisateur avec $this->user->findByEmail()
        // 3. Vérifier le mot de passe avec password_verify()
        // 4. Créer la session et rediriger
    }

    public function logout()
    {
        // TODO: Gérer la déconnexion
        // 1. Vider $_SESSION
        // 2. Détruire la session
        // 3. Rediriger vers l'accueil
    }
}
```

---

## 🔍 Concepts PHP à appliquer

### **Variables et superglobales**

```php
// Récupération des données formulaire
$pseudo = trim($_POST['pseudo'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

// Gestion des sessions
$_SESSION['user'] = [
    'id' => $user['id'],
    'pseudo' => $user['pseudo'],
    'email' => $user['email'],
];
```

### **Tableaux pour la gestion d'erreurs**

```php
// Création du tableau d'erreurs
$errors = [];

// Ajout d'erreurs
$errors[] = "Le pseudo doit faire entre 3 et 20 caractères.";
$errors[] = "L'adresse email n'est pas valide.";

// Test si des erreurs existent
if (!empty($errors)) {
    // Réafficher le formulaire avec erreurs
}
```

### **Structures de contrôle**

```php
// Validation avec IF multiples
if ($pseudo === '' || !preg_match('/^[a-zA-Z0-9_]{3,20}$/', $pseudo)) {
    $errors[] = "Pseudo invalide";
}

if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Email invalide";
}

if (strlen($password) < 8) {
    $errors[] = "Mot de passe trop court";
}
```

### **Fonctions de validation**

```php
// Validation email
filter_var($email, FILTER_VALIDATE_EMAIL)

// Validation avec regex
preg_match('/^[a-zA-Z0-9_]{3,20}$/', $pseudo)

// Longueur de chaîne
strlen($password)

// Nettoyage des données
trim($data)
```

---

## 🔒 Sécurité - Hachage des mots de passe

### **Inscription - Hacher le mot de passe**

```php
// TODO: Appliquez cette technique dans register()
$hash = password_hash($password, PASSWORD_ARGON2I);

// Enregistrer en base
$this->user->store([
    'pseudo' => $pseudo,
    'email' => $email,
    'password' => $hash  // Hash, pas le mot de passe en clair !
]);
```

### **Connexion - Vérifier le mot de passe**

```php
// TODO: Appliquez cette technique dans login()
$user = $this->user->findByEmail($email);

if (!$user || !password_verify($password, $user['password'] ?? '')) {
    $errors[] = "Email ou mot de passe erroné.";
}
```

---

## 🎭 Gestion des sessions

### **Démarrage de session**

```php
// TODO: Dans le constructeur
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Régénération d'ID pour sécurité
session_regenerate_id(true);
```

### **Création de session utilisateur**

```php
// TODO: Créez cette méthode privée
private function createSession(array $user): void
{
    $_SESSION['user'] = [
        'id' => $user['id'],
        'pseudo' => $user['pseudo'],
        'email' => $user['email'],
    ];
}
```

### **Destruction de session**

```php
// TODO: Dans logout()
$_SESSION = [];           // Vider le tableau
session_destroy();       // Détruire côté serveur
header('Location: /');   // Rediriger
exit;
```

---

## 📄 Formulaires HTML associés

### **Formulaire d'inscription** (`views/auth/register.php`)

```html
<form method="POST" action="/register">
    <input type="text" name="pseudo" placeholder="Pseudo" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <button type="submit">S'inscrire</button>
</form>
```

### **Formulaire de connexion** (`views/auth/login.php`)

```html
<form method="POST" action="/login">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <button type="submit">Se connecter</button>
</form>
```

---

## ✅ Tests de votre implémentation

```php
// Test inscription
// 1. Aller sur /register
// 2. Remplir le formulaire
// 3. Vérifier la redirection vers /dashboard
// 4. Vérifier que $_SESSION['user'] existe

// Test connexion  
// 1. Se déconnecter
// 2. Aller sur /login
// 3. Saisir les bonnes données
// 4. Vérifier la connexion

// Test validation
// 1. Tester avec pseudo trop court
// 2. Tester avec email invalide  
// 3. Tester avec mot de passe court
// 4. Vérifier l'affichage des erreurs
```

## 🎯 Objectifs d'apprentissage

Cette étape vous permet de :

1. **Appliquer** les variables, tableaux et superglobales PHP
2. **Pratiquer** les structures de contrôle (IF, validation)
3. **Utiliser** les fonctions de sécurité (password_hash, filter_var)
4. **Gérer** les sessions et l'authentification utilisateur
5. **Traiter** les formulaires selon les bonnes pratiques