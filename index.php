<?php
$title = 'Главная';
require_once 'templates/header.php';


$query = "SELECT * FROM categories";
$res = $pdo->query($query);
$categories = $res->fetchAll();

$cards = ' ';

foreach ($categories as $category){
    $cards .= 
   "
        <div class='col-3 mb-2'>
            <div class='card'>
                <img class='card-img-top' src='/images/categories/nophoto.png' alt='Card image cap'>
                    <div class='card-body'>
                    <h5 class='card-title'>{$category['name']}</h5>
                        <p class='card-text'>{$category['description']}</p>
                        <a href='/pages/category.php?id={$category['id']}' class='btn btn-primary'>Перейти</a>
                    </div>
            </div>
        </div>
       
   ";
}

$query = "SELECT * FROM products";
$res = $pdo->query($query);
$products = $res->fetchAll();

$products = ' ';



?>


<div class="row">
    <?= $cards ?>
</div>


<?php
require_once 'templates/footer.php';
?>