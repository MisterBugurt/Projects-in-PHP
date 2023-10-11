<?php

session_start();

require_once('unclude/connect.php');

$err = [];

if (!empty($_POST['login']) and !empty($_POST['password'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $query = "SELECT *, statuses.name as status FROM users LEFT JOIN statuses ON users.status_id=statuses.id WHERE login ='$login'";
    $result = mysqli_query($link, $query);
    $user = mysqli_fetch_assoc($result);

    if (!empty($user)) {

        $hash = $user['password']; // соленый пароль из БД        

        if (password_verify($password, $hash)) { // Сравниваем соленые хеши и авторизовываем
            $_SESSION['flash']  = 'Вы успешно авторизирвованы!';
            $_SESSION['auth'] = true;
            $_SESSION['login'] = $user['login'];
            $_SESSION['id'] = $user['id'];
            $_SESSION['status'] = $user['status'];

            header('Location:account.php');
        } else {
            $err['password'] = 'Пароль или логин неверный';
        }
    } else {
        $err['login'] = 'Пользователь не найден!';
    }
}

?>

<form action="" method="POST">
    <input name="login" value="login"><?= $err['login'] ?>
    <input name="password" value="password" type="password"><?= $err['password'] ?>
    <button type="submit">Войти</button>
</form>
<a href="register.php">Регистрация</a> <br>