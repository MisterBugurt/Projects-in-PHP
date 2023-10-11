<?php
$login = !empty($_POST['login']) ? $_POST['login'] : '';
$password = !empty($_POST['password']) ? $_POST['password'] : '';


if ($login === 'admin' && $password === 'Pa$$w0rd') {
    $authResult = 'Авторизация прошла успешно';
} else if ( $login !== 'admin') {
    $authResult = 'Логин неверный';
} else {
    $authResult = 'Пароль неверный';
}
?>
<html>
<head>
    <title>Результат авторизации</title>
</head>
<body>
<p>

    <?= $authResult ?>
</p>
</body>
</html>