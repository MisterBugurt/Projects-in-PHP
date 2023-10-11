<?php
require_once('unclude/connect.php');
session_start();

$id = $_GET['id'];

$query = "SELECT * FROM users WHERE id ='$id'";
$result = mysqli_query($link, $query);
$user = mysqli_fetch_assoc($result);

?>

<ul>
    <li>Логин: <?= $user['login'] ?></li>
    <li>Имя: <?= $user['name'] ?></li>
    <li>Фамилия: <?= $user['surname'] ?></li>
    <li>Отчество: <?= $user['lastname'] ?></li><br>
    <li>Дата регистрации: <?= $user['date'] ?></li>
    <li>Сменить пароль: <a href="changePassword.php">Тык</a></li>
    <li>Статус пользователя: <b><?= $user['status'] ?></b></li>
</ul>