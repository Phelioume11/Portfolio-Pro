<?php

namespace App\Repositories;

use App\Models\Project;
use App\Core\Database;
use PDO;

class ProjectRepository
{
    public function findAll(): array
    {
        $pdo = Database::getInstance();

        $query = $pdo->prepare("SELECT * FROM projects ORDER BY date_creation DESC");
        $query->execute();

        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        $projects = [];
        foreach ($results as $row) {
            $projects[] = $this->hydrate($row);
        }

        return $projects;
    }

    public function findById(int $id): ?Project
    {
        $pdo = Database::getInstance(); // CORRECT
        $stmt = $pdo->prepare("SELECT * FROM projects WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data ? $this->hydrate($data) : null;
    }

    public function updateProject(int $id, string $nom, string $labels, ?string $img = null): void
    {
        $pdo = Database::getInstance(); // CORRECT

        if ($img) {
            $stmt = $pdo->prepare("UPDATE projects SET nom = :nom, labels = :labels, img = :img WHERE id = :id");
            $stmt->execute([
                'nom' => $nom,
                'labels' => $labels,
                'img' => $img,
                'id' => $id
            ]);
        } else {
            $stmt = $pdo->prepare("UPDATE projects SET nom = :nom, labels = :labels WHERE id = :id");
            $stmt->execute([
                'nom' => $nom,
                'labels' => $labels,
                'id' => $id
            ]);
        }
    }

    private function hydrate(array $data): Project
    {
        $project = new Project();
        $project->setId($data['id']);
        $project->setNom($data['nom']);
        $project->setLabels($data['labels']);
        $project->setImg($data['img']);
        $project->setDescription($data['description']);
        $project->setDateCreation($data['date_creation']);

        return $project;
    }

}
