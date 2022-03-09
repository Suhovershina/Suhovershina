<?php

define('PRODUCTS_IMG_ROOT', '/images/products/');
session_start();

$document_root = $_SERVER['DOCUMENT_ROOT'];

$user = 'root';
$password = '';
$pdo = new Pdo('mysql:dbname=fullstack;host=127.0.0.1', $user, $password);