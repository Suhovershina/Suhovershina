<?php

$document_root = $_SERVER['DOCUMENT_ROOT'];
require $document_root . '../config.php';

$productId =  $_POST['id'];



$query = "DELETE FROM products WHERE id = :id";
$res = $pdo->prepare($query);
$res->execute([
    ':id' => $productId,
]);

header('Location: ../pages/admin/products.php');