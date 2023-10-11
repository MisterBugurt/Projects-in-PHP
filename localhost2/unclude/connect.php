<meta charset="utf-8">

<?php


$host = 'localhost2'; // имя хоста
$user = 'root';      // имя пользователя
$pass = 'root';          // пароль
$name = 'mydb';      // имя базы данных

$link = mysqli_connect($host, $user, $pass, $name);
mysqli_query($link, "SET NAMES 'utf8'");