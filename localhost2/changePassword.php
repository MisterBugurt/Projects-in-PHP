<?php
require_once('unclude/connect.php');

session_start();

$id = $_SESSION['id'];
$query = "SELECT * FROM users WHERE id='$id'";

$result = mysqli_query($link, $query);
$user = mysqli_fetch_assoc($result);

$hash = $user['password'];
$oldPassword = $_POST['old_password'];
$newPassword = $_POST['new_password'];
$newPasswordConfirm = $_POST['new_password_confirm'];

if (!empty($_POST['submit'])) {
    if ($newPassword === $newPasswordConfirm) {
        if (password_verify($oldPassword, $hash)) {

            $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);

            $query = "UPDATE users SET password='$newPasswordHash' WHERE id='$id'";
            mysqli_query($link, $query);
            unset($err);
            header('Location:account.php');
        } else {
            $err['pass'] = 'Eror Password!';
        }
    } else {
        $err['passConfirm'] = 'Password not match!';
    }
}
?>

<form action="" method="post">
    <?= 'Cтарый пароль:' ?>
    <input name="old_password" type="password"> <?= $err['pass'] ?><br>
    <?= 'Новый пароль:' ?>
    <input name="new_password" type="password"><?= $err['passConfirm'] ?><br>
    <?= 'Новый пароль ещё раз:' ?>
    <input name="new_password_confirm" type="password"><br>
    <input type="submit" name="submit">
</form>