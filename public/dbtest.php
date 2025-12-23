<?php
require_once __DIR__ . '/../config/Database.php';

$pdo = Database::getInstance();
$products = $pdo->query("SELECT * FROM products")->fetchAll();

echo "<pre>";
print_r($products);
