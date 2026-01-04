<?php

$routes = [
    'home' => ['controller' => 'HomeController', 'method' => 'display'],
    'dashboard' => ['controller' => 'DashboardController', 'method' => 'display'],
    'login' => ['controller' => 'LoginController', 'method' => 'displayLoginForm'],
    'do-login' => ['controller' => 'LoginController', 'method' => 'login'],
    'logout' => ['controller' => 'LoginController', 'method' => 'logout'],
    'edit-project' => ['controller' => 'ProjectController', 'method' => 'editProject'],
    'update-project' => ['controller' => 'ProjectController', 'method' => 'updateProject'],
    'project'   => ['controller' => 'ProjectController', 'method' => 'display'],


    'error' => ['controller' => 'ErrorController', 'method' => 'display'],
];
