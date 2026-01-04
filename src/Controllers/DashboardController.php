<?php

namespace App\Controllers;

use App\Repositories\AdminRepository;
use App\Repositories\ProjectRepository;

class DashboardController
{
    private AdminRepository $adminRepo;
    private ProjectRepository $projectRepo;

    public function __construct()
    {
        $this->adminRepo = new AdminRepository();
        $this->projectRepo = new ProjectRepository();
    }

    private function checkAccess(): bool
    {
        if (!empty($_COOKIE['admin_token'])) {
            $admin = $this->adminRepo->getByToken($_COOKIE['admin_token']);
            return $admin !== null;
        }
        return false;
    }

    public function display(): void
    {
        if (!$this->checkAccess()) {
            header('Location: index.php?route=login');
            exit;
        }

        $projects = $this->projectRepo->findAll();
        include __DIR__ . '/../views/dashboard.phtml';
    }

    public function editProject(): void
    {
        if (!$this->checkAccess()) {
            header('Location: index.php?route=login');
            exit;
        }

        $projectId = $_GET['id'] ?? null;
        if (!$projectId) {
            header('Location: index.php?route=dashboard');
            exit;
        }

        $projects = $this->projectRepo->findAll(); // pour récupérer les infos du projet
        include __DIR__ . '/../views/edit-project.phtml';
    }
}
