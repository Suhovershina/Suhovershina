<?php

$title = 'Продукт';
require_once '../templates/header.php';

$productId = $_GET['id'];

$query = "SELECT * FROM products WHERE id = :productId";
$res = $pdo->prepare($query);
$res->execute([
    ':productId' => $productId,
]
);
$products = $res->fetch();

?>

<h1>
    <?= $products['name'] ?>
</h1>
<div class='card-in'>
<div class='card-image-in'>
<img class='card-img-in' src='/images/products/<?= $products['picture'] ?>' alt='Card image cap'>
</div>
<div class='card-price-in'>
<?= $products['price'] ?>
    <p>
    <?= $products['detailed'] ?>
    </p>
</div>
</div>
<?php
require_once '../templates/footer.php';
?>