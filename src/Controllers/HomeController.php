<?php

namespace App\Controllers;

use App\Repositories\ProductRepository;

class HomeController{

    public function display(){
        // Chercher les produits à afficher
        $productRepo = new ProductRepository();
        $products = $productRepo->findAll();

        $template = 'home';
        require_once '../src/views/layout.phtml';
    }
}