<?php

namespace App\Controllers;

use App\Repositories\ProjectRepository;

class ProjectController
{
    /* =========================
       PAGE DÉTAIL PROJET (PUBLIC)
       ========================= */
    public function displayProject(): void
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            header('Location: index.php?route=home');
            exit;
        }

        $repo = new ProjectRepository();
        $project = $repo->findById((int)$id);

        if (!$project) {
            header('Location: index.php?route=home');
            exit;
        }

        include __DIR__ . '/../views/project-detail.phtml';
    }

    /* =========================
       DASHBOARD – LISTE PROJETS
       ========================= */
    public function dashboard(): void
    {
        if (empty($_COOKIE['admin_token'])) {
            header('Location: index.php?route=login');
            exit;
        }

        $repo = new ProjectRepository();
        $projects = $repo->findAll();

        include __DIR__ . '/../views/dashboard.phtml';
    }

    /* =========================
       PAGE ÉDITION PROJET
       ========================= */
    public function editProject(): void
    {
        if (empty($_COOKIE['admin_token'])) {
            header('Location: index.php?route=login');
            exit;
        }

        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: index.php?route=dashboard');
            exit;
        }

        $repo = new ProjectRepository();
        $project = $repo->findById((int)$id);

        if (!$project) {
            header('Location: index.php?route=dashboard');
            exit;
        }

        include __DIR__ . '/../views/edit-project.phtml';
    }

    /* =========================
       UPDATE PROJET
       ========================= */
    public function updateProject(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?route=dashboard');
            exit;
        }

        $repo = new ProjectRepository();

        $id = (int)$_POST['id'];
        $nom = $_POST['nom'];
        $labels = $_POST['labels'];

        $img = null;
        if (!empty($_FILES['img']['name'])) {
            $imgName = basename($_FILES['img']['name']);
            move_uploaded_file(
                $_FILES['img']['tmp_name'],
                __DIR__ . '/../../public/img/' . $imgName
            );
            $img = $imgName;
        }

        $repo->updateProject($id, $nom, $labels, $img);

        header('Location: index.php?route=dashboard');
        exit;
    }

    /* =========================
       DELETE PROJET (LE BUG ÉTAIT ICI)
       ========================= */
    public function deleteProject(): void
    {
        if (empty($_COOKIE['admin_token'])) {
            header('Location: index.php?route=login');
            exit;
        }

        $id = $_GET['id'] ?? null;

        if (!$id) {
            header('Location: index.php?route=dashboard');
            exit;
        }

        $repo = new ProjectRepository();
        $repo->deleteById((int)$id);

        header('Location: index.php?route=dashboard');
        exit;
    }
}
