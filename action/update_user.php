<?php
session_start();
$user = 'root';
$password = '';
$pdo = new Pdo('mysql:dbname=fullstack;host=127.0.0.1', $user, $password);

$userId = $_POST['id'];
$name = $_POST['name'];
$login = $_POST['login'];
$cityId = $_POST['city_id'];

$query = "UPDATE users SET name = :name, city_id = :city_id, login = :login WHERE id = :id";
$res = $pdo->prepare($query);
$status = $res->execute([
    ':id' => $userId,
    ':login' => $login,
    ':name' => $name,
    ':city_id' => $cityId,
]);

if (!$status) {
    $error = $res->errorInfo()[2];
    $_SESSION['error'] = $error;
} else {
    $_SESSION['success'] = true;
}

header("Location: ../pages/user.php?id=$userId");