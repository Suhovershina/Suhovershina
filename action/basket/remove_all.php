<?php
session_start();
 unset($_SESSION['products']);

 header('Location: /pages/basket.php');
