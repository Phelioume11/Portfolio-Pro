<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository{

    public function findAll(): array{
        // Se connecter à la base de données
        $pdo = \Database::getInstance();

        // On prépare la requête et on l'exécute
        $query = $pdo->prepare("SELECT * FROM product");
        $query->execute();

        // On récupère les données
        $results = $query->fetchAll(\PDO::FETCH_ASSOC);

        // On transforme les données en objets Product
        $products = [];
        foreach ($results as $row) {
            $products[] = $this->hydrate($row);
        }
        return $products;
    }

    public function hydrate(array $data):Product{
        
        $product = new Product();
        $product->setId($data['id']);
        $product->setName($data['name']);
        $product->setPrice($data['price']);
        return $product;
    }
}