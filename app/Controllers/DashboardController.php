<?php

namespace App\Controllers;

use App\Core\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        // Démarre la session si nécessaire
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Vérifie qu’une session utilisateur est en cours
        if (!isset($_SESSION['user'])) {
            header('Location: /logout');
            exit;
        }
    }

    public function index()
    {
        // Rend la vue dashboard en passant les données de session
        $this->render('dashboard', [
            'user' => $_SESSION['user']
        ], 'layout.logged');
    }
}
