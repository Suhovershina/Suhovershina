<?php



require_once '../../templates/header.php';

$productId = $_GET['id'];

$query = 'SELECT * FROM products WHERE id = :id';
$res = $pdo->prepare($query);
$res->execute([
    ':id' => $productId
]);

$product = $res->fetch();

    $query = "SELECT * FROM categories";
    $res = $pdo->query($query);
    $categories = $res->fetchAll();

?>


<form method="POST" action="../../action/admin/update_product.php">
    <label>Имя</label>
    <input name='id' hidden value='<?=$product['id']?>'>
    <input value="<?= $product['name']?>" class="form-control mb-2" name='name' placeholder="Наименование продукта">
    <label>Краткое описание</label>
    <textarea class="form-control mb-2" name='description' placeholder="Описание"><?=$product['description']?></textarea>
    <textarea class="form-control mb-2" name='detailed' placeholder="Детальное описание"><?=$product['detailed']?></textarea>
    <input value="<?=$product['price']?>" class="form-control mb-2" name='price' placeholder="Цена">


    <button class="btn btn-primary w-100" type="submit">Сохранить</button>
</form>
       

<?php


require_once '../../templates/footer.php'; ?>