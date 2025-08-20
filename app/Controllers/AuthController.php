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
        // Démarre la session si ce n’est pas déjà fait
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function showRegisterForm()
    {
        $this->render("auth/register", [
            'title'  => 'Inscription',
            'errors' => []
        ]);
    }

    public function showLoginForm()
    {
        $this->render("auth/login", [
            'title'  => 'Connexion',
            'errors' => []
        ]);
    }

    public function login()
    {
        $errors   = [];
        $email    = trim($_POST['email']    ?? '');
        $password = trim($_POST['password'] ?? '');

        // Validation des champs
        if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "L'adresse email n'est pas valide.";
        }
        if ($password === '' || strlen($password) < 8) {
            $errors[] = "Le mot de passe doit contenir au moins 8 caractères.";
        }
        if (!empty($errors)) {
            $this->render("auth/login", [
                'title'  => 'Connexion',
                'errors' => $errors
            ]);
            return;
        }

        // Recherche en base et vérification du mot de passe
        $user = $this->user->findByEmail($email);
        if (!$user || !password_verify($password, $user['password'] ?? '')) {
            $this->render("auth/login", [
                'title'  => 'Connexion',
                'errors' => ["Email ou mot de passe erroné."]
            ]);
            return;
        }

        // Création de la session utilisateur
        $this->createSession($user);

        // Redirection après connexion
        header('Location: /dashboard');
        exit;
    }

    /**
     * Initialise la session avec les données utilisateur
     *
     * @param array $user Tableau associatif retourné par findByEmail()
     */
    private function createSession(array $user): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        // Regénération de l’ID de session pour éviter la fixation
        session_regenerate_id(true);

        $_SESSION['user'] = [
            'id'    => $user['id'],
            'name'  => $user['name'],
            'email' => $user['email'],
        ];
    }

    public function register()
    {
        $pseudo   = trim($_POST['pseudo']   ?? '');
        $email    = trim($_POST['email']    ?? '');
        $password = trim($_POST['password'] ?? '');

        $errors = [];

        if ($pseudo === '' || !preg_match('/^[a-zA-Z0-9_]{3,20}$/', $pseudo)) {
            $errors[] = "Le pseudo doit faire entre 3 et 20 caractères alphanumériques.";
        }
        if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "L'adresse email n'est pas valide.";
        }
        if (strlen($password) < 8) {
            $errors[] = "Le mot de passe doit contenir au moins 8 caractères.";
        }

        if (!empty($errors)) {
            $this->render("auth/register", [
                'title'  => 'Inscription',
                'errors' => $errors
            ]);
            return;
        }

        $hash = password_hash($password, PASSWORD_ARGON2I);
        $this->user->store([
            'pseudo'   => $pseudo,
            'email'    => $email,
            'password' => $hash
        ]);

        // Création de la session utilisateur
        $this->createSession($this->user->findByEmail($email));

        // Redirection après connexion
        header('Location: /dashboard');
        exit;
    }

    public function logout(): void
    {
        // S'assurer que la session est démarrée
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Vider toutes les variables de session
        $_SESSION = [];


        // Détruire la session
        session_destroy();

        // Rediriger vers la page d'accueil
        header('Location: /');
        exit;
    }
}
