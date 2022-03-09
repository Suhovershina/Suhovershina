<?php

$document_root = $_SERVER['DOCUMENT_ROOT'];
require $document_root . '../config.php';

$userId =  $_POST['id'];


$query = "DELETE FROM users WHERE id = :id";
$res = $pdo->prepare($query);
$res->execute([
    ':id' => $userId,
]);

header('Location: ../index.php');