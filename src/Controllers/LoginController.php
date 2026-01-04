<?php

namespace App\Controllers;

use App\Repositories\AdminRepository;

class LoginController
{
    private AdminRepository $adminRepo;

    public function __construct()
    {
        $this->adminRepo = new AdminRepository();
    }

    // Affiche le formulaire de connexion
    public function displayLoginForm(): void
    {
        // Redirection si déjà connecté
        if ($this->isLogged()) {
            header('Location: index.php?route=dashboard');
            exit;
        }

        $error = '';
        include __DIR__ . '/../views/login.phtml';
    }

    // Vérifie login et mot de passe
    public function login(): void
    {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $admin = $this->adminRepo->getByUsername($username);

            if ($admin && password_verify($password, $admin['admin-pass'])) {
                // Générer un token sécurisé
                $token = bin2hex(random_bytes(16));
                $this->adminRepo->setToken($username, $token);

                // Créer le cookie (1 jour)
                setcookie('admin_token', $token, time() + 86400, '/');
                $_COOKIE['admin_token'] = $token; // pour la même requête

                header('Location: index.php?route=dashboard');
                exit;
            } else {
                $error = 'Identifiant ou mot de passe incorrect.';
            }
        }

        include __DIR__ . '/../views/login.phtml';
    }

    // Déconnexion
    public function logout(): void
    {
        if (!empty($_COOKIE['admin_token'])) {
            $token = $_COOKIE['admin_token'];
            $this->adminRepo->clearToken($token);

            setcookie('admin_token', '', time() - 3600, '/'); // Supprimer cookie
            unset($_COOKIE['admin_token']);
        }

        header('Location: index.php?route=login');
        exit;
    }

    // Vérifie si l’utilisateur est connecté via cookie
    public function isLogged(): bool
    {
        if (!empty($_COOKIE['admin_token'])) {
            $admin = $this->adminRepo->getByToken($_COOKIE['admin_token']);
            return $admin !== null;
        }
        return false;
    }
}
