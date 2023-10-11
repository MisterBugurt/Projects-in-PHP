<?php
require_once('unclude/connect.php');
session_start();

$status = $_SESSION['status'];
$id = $_SESSION['id'];

$query = "SELECT * FROM users WHERE id='$id'";

$result = mysqli_query($link, $query);
$user = mysqli_fetch_assoc($result);

if (!empty($_SESSION['auth'])) :
?>
    <a href="logout.php">Выйти</a><br>
    <a href="changePassword.php">Сменить пароль</a><br>
    <a href="deleteProfile.php">Удалить профиль</a><br>
<?php endif ?><br>

<form action="" method="POST">
    <input name="name" value="<?= $user['name'] ?>">
    <input name="surname" value="<?= $user['surname'] ?>">
    <input type="submit" name="submit">
</form>

<?php
if ($status === 'admin') :
?>
    <a href="users.php">Просмотр всех польхователей базы</a><br>
<?php endif ?>

<?php
if (!empty($_POST['submit'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];

    $query = "UPDATE users SET name='$name', surname='$surname' WHERE id='$id'";
    mysqli_query($link, $query);
}
