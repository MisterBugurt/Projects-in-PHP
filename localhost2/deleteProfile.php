<?php
require_once('unclude/connect.php');
session_start();

$err = [];
$id = $_SESSION['id'];
$query = "SELECT * FROM users WHERE id='$id'";

$result = mysqli_query($link, $query);
$user = mysqli_fetch_assoc($result);


if (!empty($_POST['submit'])) {
    if (password_verify($_POST['password'], $hash)) {
        $query = "DELETE FROM users WHERE id='$id'";
        mysqli_query($link, $query);
        header('Location:logout.php');
    } else {
        $err['pass'] = 'Eror password!';
    }
}
?>
<form action="" method="post">
    <?= $err['pass'] ?>
    <?= 'Введите пароль:' ?>
    <input type="password" name="password" value="123">
    <input type="submit" name="submit">
</form>