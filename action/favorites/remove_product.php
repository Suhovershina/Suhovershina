<?php
require  $_SERVER['DOCUMENT_ROOT'] . '../config.php';

$productId = $_POST['id'];
$category_id = $_POST['category_id'];

$products = $_SESSION['favorites'] ?? [];

if (isset($products[$productId])) {
    if ($products[$productId] ==1) {
        unset($products [$productId]);
    } else {
        $products [$productId] -= 1;
    }
}


$_SESSION['favorites'] = $products;

header ("Location: /pages/category.php?id=$category_id");