<?php

$routes = [
    'home'           => ['controller' => 'HomeController', 'method' => 'display'],
    'project'        => ['controller' => 'ProjectController', 'method' => 'displayProject'], // <-- mettre displayProject
    'edit-project'   => ['controller' => 'ProjectController', 'method' => 'editProject'],
    'do-edit-project'=> ['controller' => 'ProjectController', 'method' => 'updateProject'],
    'dashboard'      => ['controller' => 'DashboardController', 'method' => 'display'],
    'login'          => ['controller' => 'LoginController', 'method' => 'displayLoginForm'],
    'do-login'       => ['controller' => 'LoginController', 'method' => 'login'],
    'logout'         => ['controller' => 'LoginController', 'method' => 'logout'],
    'error'          => ['controller' => 'ErrorController', 'method' => 'display'],
    'delete-project' => ['controller' => 'ProjectController','method' => 'deleteProject'],
    'update-project' => ['controller' => 'ProjectController','method' => 'updateProject']

];
