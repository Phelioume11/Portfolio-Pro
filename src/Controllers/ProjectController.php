<?php

namespace App\Controllers;

use App\Repositories\ProjectRepository;

class ProjectController
{
    public function display()
    {
        // Vérifie qu'un id de projet est passé
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: index.php?route=error");
            exit;
        }

        $repo = new ProjectRepository();
        $project = $repo->findById($id);

        if (!$project) {
            header("Location: index.php?route=error");
            exit;
        }

        // Charge le template edit-project.phtml
        $template = 'edit-project';
        require __DIR__ . '/../views/layout.phtml';
    }

    public function editProject(): void
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            header('Location: index.php?route=dashboard'); // redirection si ID manquant
            exit;
        }

        $repo = new \App\Repositories\ProjectRepository();
        $project = $repo->findById((int)$id);

        if (!$project) {
            header('Location: index.php?route=dashboard'); // redirection si projet inexistant
            exit;
        }

        include __DIR__ . '/../views/edit-project.phtml';
    }

    public function updateProject(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)$_POST['id'];
            $nom = $_POST['nom'];
            $labels = $_POST['labels'];

            $img = null;
            if (!empty($_FILES['img']['name'])) {
                $imgName = basename($_FILES['img']['name']);
                move_uploaded_file($_FILES['img']['tmp_name'], __DIR__ . '/../../public/img/' . $imgName);
                $img = $imgName;
            }

            $repo = new \App\Repositories\ProjectRepository();
            $repo->updateProject($id, $nom, $labels, $img);

            header('Location: index.php?route=dashboard');
            exit;
        }
    }

}
