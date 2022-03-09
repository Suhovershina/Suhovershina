<?php
require  $_SERVER['DOCUMENT_ROOT'] . '../config.php';

$productId = $_POST['id'];
$category_id = $_POST['category_id'];

$products = $_SESSION['products'] ?? [];



if (isset($products[$productId])) {
    $products [$productId] += 1;
} else {
    $products [$productId] = 1;
}

$_SESSION['products'] = $products;

header ("Location: /pages/category.php?id=$category_id");