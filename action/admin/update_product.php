<?php
session_start();
$user = 'root';
$password = '';
$pdo = new Pdo('mysql:dbname=fullstack;host=127.0.0.1', $user, $password);

$productId = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$detailed = $_POST['detailed'];

$query = "UPDATE products SET name = :name, description :description, price = :price, detailed :detailed WHERE id = :id";
$res = $pdo->prepare($query);
$productsNew = $res->execute([
    ':id' => $productId,
    ':name' => $name,
    ':description' => $description,
    ':price' => $price,
    ':detailed' => $detailed
]);


header("Location: ../../pages/admin/update_product.php?id=$productId");








