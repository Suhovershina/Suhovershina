<?php
$title = 'Корзина';
require_once '../templates/header.php';

$basketProducts = $_SESSION['products'];

if ($basketProducts == 0) { //проверяет на NULL 
    echo '<div class="text-center">Корзина пуста</div>';

} else { 

$productIds = array_keys($basketProducts);

$ids = implode(',', $productIds); //пришлось костылить чтобы выводилось корректно

$query = "SELECT * FROM products WHERE id IN ($ids)";
$res = $pdo->prepare($query);
$res->execute([
    $ids
]);
$products = $res->fetchAll();


?>

<table class="table table-bordered mt-2">
    <tbody>
        <?php
        foreach ($products as $product) {
            $sum = (float) $basketProducts[$product['id']] * $product['price'];
            echo
            "
            <tr>
                <td>{$product['name']}</td>
                <td>{$product['price']}</td>
                <td>{$basketProducts[$product['id']]}</td>
                <td>{$sum}</td>
                <td>
                <form method='post' action='/action/basket/remove_product_basket.php'>
                    <input name='id' hidden value='{$product['id']}'>
                    <input name='category_id' hidden value='{$product['category_id']}'>
                    <button $disabled class='btn btn-danger btn-product-remove'>-</button>
                </form>
            </td>
                <td>
                <form method='post' action='/action/basket/add_product_basket.php'>
                    <input name='id' hidden value='{$product['id']}'>
                    <input name='category_id' hidden value='{$product['category_id']}'>
                    <button class='btn btn-success btn-product-add'>+</button>
                </form>
                </td>
            </tr>
            ";
        }
        ?>
    </tbody>
</table>


<!-- Small modal -->
<form method="POST" action="../action/basket/remove_all.php">
<button type="submit" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm">Очистить корзину</button>
</form>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Заказать</button>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content mt-5 mb-2">

<?php 


$query = "SELECT * FROM users";
$res = $pdo->query($query);
$users = $res->fetchAll();


$query = "SELECT * FROM cities";
$res = $pdo->query($query);
$cities = $res->fetchAll();

foreach ($users as $user) {?>

            <form action="" method="post">
                <input name='id' hidden value='<?=$user['id']?>'>
                <input class="form-control mb-2" name='name' value='<?=$user['name']?>'> 
                <input class="form-control mb-2" placeholder="mail" name="email">
                <select class="form-control mb-2" name="city_id">
                <?php
                    if (!$user['city_id']) {
                        echo '<option selected disabled>-- Выберите город --</option>';
                    }
                    foreach ($cities as $city) {
                        $selected = $city['id'] == $user['city_id'] ? 'selected' : '';
                        echo "<option $selected value='{$city['id']}'>{$city['name']}</option>";
                    }
                ?>
            </select>
                <button disabled type="submit" class="btn btn-success w-100">Отправить</button>
            </form>
                <?php } ?>
        </div>
    </div>
    </div>


<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      Корзина очищена
    </div>
  </div>
</div>

<?php
}
require_once '../templates/footer.php';
?>
