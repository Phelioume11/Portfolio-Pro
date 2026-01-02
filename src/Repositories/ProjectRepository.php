<?php

namespace App\Repositories;

use App\Models\Project;

class ProjectRepository
{
    public function findAll(): array
    {
        $pdo = \Database::getInstance();

        $query = $pdo->prepare("SELECT * FROM projects ORDER BY date_creation DESC");
        $query->execute();

        $results = $query->fetchAll(\PDO::FETCH_ASSOC);

        $projects = [];
        foreach ($results as $row) {
            $projects[] = $this->hydrate($row);
        }

        return $projects;
    }

    private function hydrate(array $data): Project
    {
        $project = new Project();
        $project->setId($data['id']);
        $project->setNom($data['nom']);
        $project->setLabels($data['labels']);
        $project->setImg($data['img']);
        $project->setDateCreation($data['date_creation']);

        return $project;
    }
}
