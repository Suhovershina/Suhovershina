<?php

$title = 'Категория';
require_once '../templates/header.php';

$categoryId = $_GET['id'];

$query = "SELECT * FROM categories WHERE id = :categoryId";
$res = $pdo->prepare($query);
$res->execute([
    ':categoryId' => $categoryId,
]
);
$category = $res->fetch();


$query = "SELECT * FROM products WHERE category_id = :categoryId";
$res = $pdo->prepare($query);
$res->execute([
    ':categoryId' => $categoryId,
]);
$products = $res->fetchAll();

$cards = ' ';

foreach ($products as $product){
    $disabled = isset($_SESSION['products'][$product['id']]) ? ' ' : 'disabled';
    $cards .= 
   "
        <div class='col-3 mb-2'>
            <div class='card'>
            <div class='card-image'>

                <img class='card-img-top' src='/images/products/{$product['picture']}' alt='Card image cap'>
            </div>
                    <div class='card-body'>
                    <h5 class='card-title'><a href='/pages/product.php?id={$product['id']}'>{$product['name']}</a></h5>
                        <p class='card-text'>{$product['description']}</p>
                            <div class='card-price'>
                                {$product['price']}
                            </div>
                        <div class='card-basket-buttons'>
                            <div>
                                <form method='post' action='/action/basket/remove_product.php'>
                                    <input name='id' hidden value='{$product['id']}'>
                                    <input name='category_id' hidden value='{$product['category_id']}'>
                                    <button $disabled class='btn btn-danger btn-product-remove'>-</button>
                                </form>
                            </div>
                            <div class='card-basket-quantity'>
                                {$_SESSION['products'][$product['id']]}
                            </div>
                            <div>
                            <form method='post' action='/action/basket/add_product.php'>
                                <input name='id' hidden value='{$product['id']}'>
                                <input name='category_id' hidden value='{$product['category_id']}'>
                                <button class='btn btn-success btn-product-add'>+</button>
                            </form>
                            </div>
                        </div>";

                        if (isset($_SESSION['favorites'][$product['id']])) {
                            $cards .= "<div class='btn'>
                            <div>
                               <form method='post' action='/action/favorites/remove_product.php'>
                                   <input name='id' hidden value='{$product['id']}'>
                                   <input name='category_id' hidden value='{$product['category_id']}'>
                                   <button class='btn btn-danger'>Удалить из избранного</button>
                               </form>
                           </div>
                        </div>";
                        } else {
                            $cards .= "<div class='btn'>
                            <div>
                            <form method='post' action='/action/favorites/add_product.php'>
                                    <input name='id' hidden value='{$product['id']}'>
                                    <input name='category_id' hidden value='{$product['category_id']}'>
                                    <button class='btn btn-success'>Добавить в избранное</button>
                            </form>
                        </div>
                        </div>";
                        }
       
                $cards .= "</div>
            </div>
        </div>";
       
}

?>

        <h1>
            <?= $category['name'] ?>
        </h1>

        <h4>
            <?= $category['description'] ?>
        </h4>


        <div class="row">
            <?= $cards ?>
        </div>

<?php
require_once '../templates/footer.php';
?>