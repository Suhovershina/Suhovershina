<?php
session_start();
 unset($_SESSION['favorites']);

 header('Location: /pages/basket.php');
