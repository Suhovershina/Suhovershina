<?php
require  $_SERVER['DOCUMENT_ROOT'] . '../config.php';

$productId = $_POST['id'];
$category_id = $_POST['category_id'];

$products = $_SESSION['products'] ?? [];

if (isset($products[$productId])) {
    if ($products[$productId] ==1) {
        unset($products [$productId]);
    } else {
        $products [$productId] -= 1;
    }
}


$_SESSION['products'] = $products;

header ("Location: /pages/basket.php");