<?php

namespace App\Controllers;

use App\Repositories\ProjectRepository;

class HomeController
{
    public function display(): void
    {
        $projectRepo = new ProjectRepository();
        $projects = $projectRepo->findAll();

        $template = 'home';
        include __DIR__ . '/../views/layout.phtml';
    }
}
