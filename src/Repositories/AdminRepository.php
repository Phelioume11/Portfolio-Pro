<?php

namespace App\Repositories;

use App\Core\Database;
use PDO;

class AdminRepository
{
    public function getByUsername(string $username): ?array
    {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM `admin-connexion` WHERE `admin-username` = :username");
        $stmt->execute(['username' => $username]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function setToken(string $username, string $token): void
    {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("UPDATE `admin-connexion` SET `admin_token` = :token WHERE `admin-username` = :username");
        $stmt->execute(['token' => $token, 'username' => $username]);
    }

    public function getByToken(string $token): ?array
    {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM `admin-connexion` WHERE `admin_token` = :token");
        $stmt->execute(['token' => $token]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function clearToken(string $token): void
    {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("UPDATE `admin-connexion` SET `admin_token` = NULL WHERE `admin_token` = :token");
        $stmt->execute(['token' => $token]);
    }
}
