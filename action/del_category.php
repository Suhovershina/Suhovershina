<?php

$document_root = $_SERVER['DOCUMENT_ROOT'];
require $document_root . '../config.php';

$categoryId =  $_POST['id'];



$query = "DELETE FROM categories WHERE id = :id";
$res = $pdo->prepare($query);
$res->execute([
    ':id' => $categoryId,
]);

header('Location: ../pages/admin/categories.php');