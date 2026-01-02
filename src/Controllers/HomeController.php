<?php

namespace App\Controllers;

use App\Repositories\ProjectRepository;

class HomeController
{
    public function display()
    {
        $projectRepo = new ProjectRepository();
        $projects = $projectRepo->findAll();

        $template = 'home';
        require_once '../src/views/layout.phtml';
    }
}
