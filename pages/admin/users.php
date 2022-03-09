<?php
$title = 'Пользователи';
require_once '../../templates/header.php';



$query = "SELECT * FROM users";
$res = $pdo->query($query);
$users = $res->fetchAll();

$query = "SELECT * FROM cities";
$res = $pdo->query($query);
$cities = $res->fetchAll();

echo "
<table class='table table-bordered'>
    <thead>
        <tr>
            <th>id</th>
            <th>Логин</th>
            <th>Имя</th>
            <th>id города</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
";

foreach ($users as $user) {
    // if ($user['city_id']) {
    //     $city = $user['city_id'];
    // } else {
    //     $city = '-';
    // }

    $city = $user['city_id'] ? $user['city_id'] : '-';

    echo "
        <tr>
            <td>{$user['id']}</td>
            <td>{$user['login']}</td>
            <td>
                <a href='../user.php?id={$user['id']}'>
                    {$user['name']}
                </a>
            </td>
            <td>{$city}</td>
            <td class='text-center'>
                <form method='post' action='../../action/del_user.php'>
                    <input type='hidden' name='id' value='{$user['id']}'>
                    <button type='submit' class='btn btn-danger btn-user-delete'>x</button>
                </form>
            </td>
        </tr>
    ";
}

echo "</tbody>
</table>";

?>
