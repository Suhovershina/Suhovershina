<?php
$title = 'Избранное';
require_once '../templates/header.php';

$favoritesProducts = $_SESSION['favorites'];

if ($favoritesProducts == 0) { //проверяет на NULL 
    echo '<div class="text-center">Пусто</div>';

} else { 

$productIds = array_keys($favoritesProducts);

$ids = implode(',', $productIds); //пришлось костылить чтобы выводилось корректно

$query = "SELECT * FROM products WHERE id IN ($ids)";
$res = $pdo->prepare($query);
$res->execute([
    $ids
]);
$products = $res->fetchAll();

var_dump($favoritesProducts);
var_dump($productIds);
var_dump($ids);


?>

<table class="table table-bordered mt-2">
    <tbody>
        <tr>
            <td>Название</td>
            <td>Цена</td>
            <td></td>
        </tr>
        <?php
        foreach ($products as $product) {
            echo
            "
            <tr>
                <td>{$product['name']}</td>
                <td>{$product['price']}</td>
                
                <td>
                <form method='post' action='/action/favorites/remove_product_favorites.php'>
                    <input name='id' hidden value='{$product['id']}'>
                    <input name='category_id' hidden value='{$product['category_id']}'>
                    <button $disabled class='btn btn-danger btn-product-remove'>-</button>
                </form>
            </td>

            </tr>
            ";
        }
        ?>
    </tbody>
</table>

<?php
}
require_once '../templates/footer.php';
?>
