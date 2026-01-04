<?php

namespace App\Controllers;

use App\Repositories\ProjectRepository;

class DashboardController
{
    private ProjectRepository $projectRepo;

    public function __construct()
    {
        $this->projectRepo = new ProjectRepository();
    }

    public function display(): void
    {
        $projects = $this->projectRepo->findAll();
        include __DIR__ . '/../views/dashboard.phtml';
    }

    public function editProject(): void
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: index.php?route=dashboard');
            exit;
        }

        $project = $this->projectRepo->findById($id);
        if (!$project) {
            header('Location: index.php?route=error');
            exit;
        }

        $error = '';
        include __DIR__ . '/../views/edit-project.phtml';
    }
}
