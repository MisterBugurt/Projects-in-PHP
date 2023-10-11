<?php

$err = [];
require_once('unclude/connect.php');

if (!empty($_POST['login']) and !empty($_POST['password']) and !empty($_POST['confirm'])) { // если кнопка нажата
    if ($_POST['password'] === $_POST['confirm']) { // проверка пароля

        $date = date('Y-m-d');
        $login = $_POST['login'];
        $password = $_POST['password'];
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $country = $_POST['country'];

        if (preg_match('~[a-z]+~i', $login)) { // проверка  на латиницу логина
            if (strlen($login) >= 4 and strlen($login) <= 16) { // првоерка на длинну логина
                if (strlen($password) >= 6 and strlen($password) <= 12) {  // првоерка на длинну пароля

                    $passhash = password_hash($password, PASSWORD_DEFAULT);

                    /* находим пользователя  в  базе */
                    $query = "SELECT * FROM users WHERE login='$login'";
                    $user = mysqli_fetch_assoc(mysqli_query($link, $query));

                    if (empty($user) and !empty($login) and !empty($passhash)) { // есть ли такой пользователь

                        session_start();

                        $query = "INSERT INTO users SET login='$login', password='$passhash', name='$name', lastname='$lastname', surname='$surname', date='$date', email='$email', country='$country', status_id='2'";
                        mysqli_query($link, $query);


                        $_SESSION['auth'] = true;

                        /* пишем id  в сессию */
                        $id = mysqli_insert_id($link);
                        $_SESSION['id'] = $id;
                        header('Location:account.php');
                    } else {
                        $err['login'] = 'Логин занят';
                    }
                } else {
                    $err['pass'] = 'Пароль должен быть от 6 до 12 символов!';
                }
            } else {
                $err['login'] = 'Логин должен быть от 4 до 10 символов!';
            }
        } else {
            $err['login'] = 'Используйте латиницу!';
        }
    } else {
        $err['pass'] = 'Пароль не совпадает!';
    }
}
